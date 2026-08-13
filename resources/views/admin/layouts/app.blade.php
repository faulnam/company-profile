<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS (CDN for simplicity as requested) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        school: '#0f766e',
                        'school-dark': '#0d645d',
                        'school-darker': '#0a4f4a',
                    }
                }
            }
        }
    </script>
    
    <!-- Alpine.js with Collapse Plugin -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased bg-[#f8f9fa] text-gray-900" x-data="{ sidebarOpen: false }">
    
    <!-- Mobile Sidebar Backdrop -->
    <div x-show="sidebarOpen" class="fixed inset-0 z-40 bg-gray-900 bg-opacity-50 md:hidden" @click="sidebarOpen = false" x-transition.opacity style="display: none;"></div>

    <!-- Sidebar -->
    @include('admin.layouts.sidebar')

    <!-- Main Content Wrapper -->
    <div class="flex flex-col md:pl-56 min-h-screen transition-all duration-300">
        
        <!-- Topbar -->
        @include('admin.layouts.topbar')

        <!-- Page Content -->
        <main class="flex-1 p-6 md:p-8">
            {{ $slot }}
        </main>
    </div>

</body>
</html>
