<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $global_settings['school_name'] ?? config('app.name', 'Sekolah') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Oswald:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts & Styles via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        school: {
                            DEFAULT: '#0d9488',
                            dark: '#0f766e',
                            darker: '#115e59',
                            light: '#14b8a6'
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        body { background-color: #f3f4f6; }
        .heading-font { font-family: 'Oswald', sans-serif; }
        .bg-school { background-color: #0d9488; } 
        .text-school { color: #0d9488; }
        .border-school { border-color: #0d9488; }
        .bg-school-dark { background-color: #0f766e; }
        .bg-school-darker { background-color: #115e59; }
    </style>
    @stack('styles')
</head>
<body class="font-sans text-gray-800 antialiased flex flex-col min-h-screen bg-gray-100">

    <x-header.master />

    <!-- Main Content Boxed -->
    <main class="flex-grow w-full max-w-7xl mx-auto bg-white px-4 sm:px-6 lg:px-8 py-8 shadow-sm">
        {{ $slot }}
    </main>

    <x-footer />

    @stack('scripts')
</body>
</html>
