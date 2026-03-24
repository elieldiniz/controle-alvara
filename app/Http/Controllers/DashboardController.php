<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\Alvara;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        
        // Se for Super Admin, ele é redirecionado para o Filament (Painel de Gestão SaaS)
        if ($user->hasRole('super-admin')) {
            return redirect()->to('/admin');
        }

        // Para Owners e Members (Multi-tenancy via OwnerScope automático)
        // O OwnerScope já filtra Empresas e Alvarás pelo owner_id do usuário logado
        
        $empresas = Empresa::withCount('alvaras')->latest()->get();
        
        // Empresa selecionada
        $empresaId = $request->get('empresa_id', $empresas->first()->id ?? null);
        $empresaSelecionada = $empresas->where('id', $empresaId)->first();
        
        // Alvarás da empresa selecionada
        $alvaras = $empresaSelecionada ? $empresaSelecionada->alvaras : collect();
        
        // Estatísticas do Workspace (Tenant)
        // Obs: Conta TODOS os alvarás do tenant, não só da empresa selecionada, para o dashboard principal?
        // Vamos manter focado na empresa selecionada como estava, mas o "total" pode ser do tenant.
        $stats = [
            'total' => Alvara::count(),
            'ativos' => Alvara::vigente()->count(),
            'em_renovacao' => Alvara::emRenovacao()->count(),
            'vencidos' => Alvara::vencido()->count(),
        ];
        
        return view('dashboard', compact('empresas', 'empresaSelecionada', 'alvaras', 'stats'));
    }
}
