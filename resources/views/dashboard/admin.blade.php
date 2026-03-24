<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Painel Administrativo (SaaS Global)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Usuários -->
                <div class="bg-white p-6 rounded-lg shadow-sm border-t-4 border-indigo-500">
                    <div class="text-indigo-600 font-bold text-xs uppercase mb-1">Total de Usuários</div>
                    <div class="text-3xl font-bold">{{ $stats['total_usuarios'] }}</div>
                </div>
                
                <!-- Empresas -->
                <div class="bg-white p-6 rounded-lg shadow-sm border-t-4 border-blue-500">
                    <div class="text-blue-600 font-bold text-xs uppercase mb-1">Empresas Cadastradas</div>
                    <div class="text-3xl font-bold">{{ $stats['total_empresas'] }}</div>
                </div>

                <!-- Alvarás -->
                <div class="bg-white p-6 rounded-lg shadow-sm border-t-4 border-orange-500">
                    <div class="text-orange-600 font-bold text-xs uppercase mb-1">Alvarás Monitorados</div>
                    <div class="text-3xl font-bold">{{ $stats['total_alvaras'] }}</div>
                </div>

                <!-- Planos -->
                <div class="bg-white p-6 rounded-lg shadow-sm border-t-4 border-green-500">
                    <div class="text-green-600 font-bold text-xs uppercase mb-1">Assinaturas Ativas</div>
                    <div class="text-3xl font-bold">{{ $stats['planos_ativos'] }}</div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="font-bold text-gray-700 mb-4">Ações Rápidas</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <a href="/admin/users" class="p-4 border rounded-md hover:bg-gray-50 flex flex-col items-center">
                            <span class="text-2xl mb-1">👥</span>
                            <span class="text-sm font-semibold">Gerenciar Usuários</span>
                        </a>
                        <a href="/admin/plans" class="p-4 border rounded-md hover:bg-gray-50 flex flex-col items-center">
                            <span class="text-2xl mb-1">💳</span>
                            <span class="text-sm font-semibold">Planos e Preços</span>
                        </a>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="font-bold text-gray-700 mb-4">Configurações do Sistema</h3>
                    <p class="text-sm text-gray-500 mb-4">Status dos serviços e logs globais.</p>
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span>Banco de Dados</span>
                            <span class="text-green-600 font-bold">Online</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span>Storage (S3/Local)</span>
                            <span class="text-green-600 font-bold">Conectado</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
