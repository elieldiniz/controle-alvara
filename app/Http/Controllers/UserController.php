<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        
        // Apenas Owners podem ver/gerenciar a lista de membros
        if (!$user->hasRole('owner')) {
            abort(403);
        }

        $members = User::where('parent_id', $user->id)->get();
        $plan = $user->plan;

        return view('users.index', compact('members', 'plan'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $owner = $request->user();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'parent_id' => $owner->id,
            'owner_id' => $owner->owner_id, // Mesmo contexto de dados
            'plan_id' => $owner->plan_id,   // Mesmo plano
        ]);

        $user->assignRole('member');

        return redirect()->route('users.index')->with('success', 'Membro adicionado com sucesso!');
    }

    public function destroy(User $user)
    {
        // Verificar se pertence ao owner logado
        if ($user->parent_id !== auth()->id()) {
            abort(403);
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Membro removido.');
    }
}
