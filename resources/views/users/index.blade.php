<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Gerenciar Equipe
            </h2>
            @if($members->count() + 1 < $plan->max_users)
                <a href="{{ route('users.create') }}" class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-md text-sm font-semibold transition">
                    + Convidar Membro
                </a>
            @else
                <span class="text-xs text-orange-600 font-bold bg-orange-50 px-3 py-1 rounded-full border border-orange-200">
                    Limite do Plano Atingido ({{ $plan->max_users }} usuários)
                </span>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-bold mb-4">Membros da Equipe ({{ $members->count() + 1 }} / {{ $plan->max_users }})</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead>
                                <tr class="bg-gray-50 border-b">
                                    <th class="px-6 py-3">Nome</th>
                                    <th class="px-6 py-3">E-mail</th>
                                    <th class="px-6 py-3">Função</th>
                                    <th class="px-6 py-3 text-right">Ação</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                <!-- O próprio Owner -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 font-semibold">{{ auth()->user()->name }} (Você)</td>
                                    <td class="px-6 py-4">{{ auth()->user()->email }}</td>
                                    <td class="px-6 py-4"><span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs px-2">Owner</span></td>
                                    <td class="px-6 py-4 text-right">—</td>
                                </tr>
                                @foreach($members as $member)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ $member->name }}</td>
                                    <td class="px-6 py-4">{{ $member->email }}</td>
                                    <td class="px-6 py-4"><span class="bg-gray-100 text-gray-800 px-2 py-1 rounded text-xs">Membro</span></td>
                                    <td class="px-6 py-4 text-right">
                                        <form action="{{ route('users.destroy', $member) }}" method="POST" onsubmit="return confirm('Remover acesso deste usuário?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 text-xs font-bold">Remover</button>
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
    </div>
</x-app-layout>
