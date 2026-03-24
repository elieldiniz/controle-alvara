<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        return view('admin.plans.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.plans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'max_users' => 'required|integer|min:1',
            'features' => 'nullable|array',
        ]);

        Plan::create([
            'nome' => $request->nome,
            'max_users' => $request->max_users,
            'features' => $request->features ?? [],
        ]);

        return redirect()->route('admin.plans.index')->with('success', 'Plano criado com sucesso!');
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();
        return redirect()->route('admin.plans.index')->with('success', 'Plano excluído.');
    }
}
