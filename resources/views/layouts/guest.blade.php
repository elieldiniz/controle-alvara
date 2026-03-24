<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-100 via-gray-200 to-gray-300 relative overflow-hidden">

        <!-- 🔥 FUNDO COM BLUR -->
        <div class="absolute inset-0 bg-gradient-to-br from-gray-50 via-gray-100 to-gray-200"></div>

        <!-- grid bem leve (opcional, dá um charme) -->
        <div class="absolute inset-0 opacity-30 
                bg-[linear-gradient(to_right,rgba(0,0,0,0.04)_1px,transparent_1px),
                    linear-gradient(to_bottom,rgba(0,0,0,0.04)_1px,transparent_1px)]
                bg-[size:60px_60px]">
        </div>

        <!-- CARD -->
        <div
            class="relative w-full max-w-6xl flex flex-col md:flex-row bg-white/80 backdrop-blur-lg shadow-2xl rounded-2xl overflow-hidden border border-gray-200">

            <!-- LADO ESQUERDO -->
            <div class="md:w-1/2 flex flex-col items-center justify-center 
            bg-gradient-to-br from-blue-400 via-indigo-400 to-indigo-500 
            p-12 text-white relative">

                <!-- camada de contraste -->
                <div class="absolute inset-0 bg-black/10"></div>

                <div class="relative z-10 text-center">

                    <a href="/">
                        <img src="{{ asset('logo.png') }}" alt="GEA Logo"
                            class="h-72 w-auto mb-8 mx-auto drop-shadow-xl object-contain">
                    </a>
                </div>
            </div>

            <!-- LADO DIREITO -->
            <div class="md:w-1/2 p-10 md:p-12 flex items-center bg-white">

                <div class="w-full max-w-md mx-auto">

                    <h2 class="text-2xl font-bold text-gray-800 mb-2">
                        Entrar na sua conta
                    </h2>

                    <p class="text-sm text-gray-500 mb-6">
                        Acesse seu painel de controle
                    </p>

                    <div class="space-y-5">
                        {{ $slot }}
                    </div>

                </div>

            </div>

        </div>

    </div>
</body>

</html>