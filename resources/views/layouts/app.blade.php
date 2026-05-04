<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CABEMCE') }} - Associação</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        
        <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
        
        <style>
            body {
                font-family: 'Outfit', sans-serif;
                background-color: #f1f5f9;
                color: #1e293b;
            }
            .bg-premium-navy {
                background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);
            }
            .text-premium-navy {
                color: #1e3a8a;
            }
            .bg-premium-light-blue {
                background-color: #eff6ff;
            }
            .border-premium-navy {
                border-color: #1e3a8a;
            }
            .premium-card {
                background: #ffffff;
                border: 1px solid rgba(30, 58, 138, 0.05);
                box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.05);
            }
            .premium-input {
                background: #f8fafc;
                border: 1px solid #e2e8f0;
                transition: all 0.2s;
            }
            .premium-input:focus {
                background: #ffffff;
                border-color: #1e3a8a;
                ring: 2px;
                ring-color: rgba(30, 58, 138, 0.1);
                outline: none;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="min-h-screen">
            <header class="bg-premium-navy py-5 px-6 mb-12 shadow-xl">
                <div class="max-w-7xl mx-auto flex justify-between items-center">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center font-bold text-blue-900 text-xl shadow-lg">C</div>
                        <h1 class="text-xl font-bold tracking-tight text-white">CABEMCE <span class="font-light opacity-80">Associação</span></h1>
                    </div>
                </div>
            </header>

            <main>
                {{ $slot }}
            </main>

            <footer class="py-12 px-6 text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} CABEMCE - Caixa Beneficente dos Militares do Ceará. Todos os direitos reservados.
            </footer>
        </div>
        
        @livewireScripts
        @stack('scripts')
    </body>
</html>
