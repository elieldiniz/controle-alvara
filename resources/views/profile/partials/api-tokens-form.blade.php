<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Tokens de API') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Tokens de acesso pessoal permitem que você acesse nossa API de forma externa. Guarde seu token em um local seguro, pois ele não será exibido novamente.') }}
        </p>
    </header>

    @if (session('plainTextToken'))
        <div class="mt-6 p-4 bg-green-50 border border-green-200 rounded-md">
            <p class="text-sm text-green-700 font-bold mb-2">Seu novo token:</p>
            <code class="block p-2 bg-white border rounded text-xs break-all selection:bg-green-100">
                {{ session('plainTextToken') }}
            </code>
            <p class="mt-2 text-xs text-green-600">Copie este token agora. Ele não será mostrado novamente.</p>
        </div>
    @endif

    <form method="post" action="{{ route('profile.tokens.store') }}" class="mt-6 space-y-6">
        @csrf
        <div>
            <x-input-label for="token_name" :value="__('Nome do Token (Ex: Postman, App Mobile)')" />
            <x-text-input id="token_name" name="token_name" type="text" class="mt-1 block w-full" required />
            <x-input-error class="mt-2" :messages="$errors->get('token_name')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Gerar Novo Token') }}</x-primary-button>
        </div>
    </form>

    <div class="mt-10">
        <h3 class="text-md font-medium text-gray-900 mb-4">Tokens Ativos</h3>
        <div class="space-y-4">
            @forelse ($user->tokens as $token)
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <div>
                        <div class="font-bold text-gray-800">{{ $token->name }}</div>
                        <div class="text-xs text-gray-500">Último uso: {{ $token->last_used_at ? $token->last_used_at->diffForHumans() : 'Nunca usado' }}</div>
                        <div class="text-xs text-gray-400">Criado em: {{ $token->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                    <form method="post" action="{{ route('profile.tokens.destroy', $token->id) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-semibold" onclick="return confirm('Tem certeza que deseja revogar este token?')">
                            Revogar
                        </button>
                    </form>
                </div>
            @empty
                <p class="text-sm text-gray-500 italic">Você ainda não possui tokens de API ativos.</p>
            @endforelse
        </div>
    </div>
</section>
