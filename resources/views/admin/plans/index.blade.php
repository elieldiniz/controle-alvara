<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Gerenciar Planos
            </h2>
            <a href="{{ route('admin.plans.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-semibold transition">
                + Novo Plano
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="bg-gray-50 border-b">
                                <th class="px-6 py-3">Nome</th>
                                <th class="px-6 py-3">Máx. Usuários</th>
                                <th class="px-6 py-3">Recursos</th>
                                <th class="px-6 py-3 text-right">Ação</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach($plans as $plan)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-bold">{{ $plan->nome }}</td>
                                <td class="px-6 py-4">{{ $plan->max_users }}</td>
                                <td class="px-6 py-4 text-xs">
                                    {{ is_array($plan->features) ? implode(', ', $plan->features) : '—' }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <form action="{{ route('admin.plans.destroy', $plan) }}" method="POST" onsubmit="return confirm('Excluir este plano?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 font-bold">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
