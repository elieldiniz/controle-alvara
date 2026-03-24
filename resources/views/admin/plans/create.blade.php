<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Novo Plano
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <form method="POST" action="{{ route('admin.plans.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="nome" :value="__('Nome do Plano')" />
                        <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="old('nome')" required autofocus />
                        <x-input-error :messages="$errors->get('nome')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="max_users" :value="__('Máximo de Usuários')" />
                        <x-text-input id="max_users" class="block mt-1 w-full" type="number" name="max_users" :value="old('max_users')" required />
                        <x-input-error :messages="$errors->get('max_users')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button>
                            Criar Plano
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
