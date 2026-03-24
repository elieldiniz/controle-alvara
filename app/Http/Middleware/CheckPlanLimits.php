<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPlanLimits
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Só verificamos limites para Owners (quem controla a assinatura)
        if ($user && $user->hasRole('owner')) {
            $plan = $user->plan;
            
            if (!$plan) {
                return redirect()->route('dashboard')->with('error', 'Você não possui um plano ativo.');
            }

            // Exemplo: Limite de Usuários (Membros + Owner)
            $currentUsersCount = \App\Models\User::where('parent_id', $user->id)
                ->orWhere('id', $user->id)
                ->count();

            // Se a rota for de criação de usuário (POST store), barramos se exceder
            if ($request->isMethod('POST') && $request->routeIs('users.store')) {
                if ($currentUsersCount >= $plan->max_users) {
                    return redirect()->back()->with('error', "Seu plano ({$plan->nome}) permite no máximo {$plan->max_users} usuários.");
                }
            }
        }

        return $next($request);
    }
}
