<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') - INSEKTA</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom Styles -->
    <style>
        .bg-light-amber { background-color: #fef3c7; }
        .text-dark-amber { color: #92400e; }
        .border-primary-amber { border-color: #d97706; }
        .text-primary-amber { color: #d97706; }
        .bg-primary-amber { background-color: #d97706; }
        .hover\:bg-dark-amber:hover { background-color: #92400e; }
        .hover\:text-primary-amber:hover { color: #d97706; }
        .focus\:ring-primary-amber:focus { --tw-ring-color: #d97706; }
    </style>
</head>

<body class="bg-amber-50/30 font-sans antialiased text-[13px]">
    <div class="min-h-screen flex">
        {{-- Sidebar --}}
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 z-50 w-48 bg-white border-r border-amber-100 transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0">
            @include('components.admin.sidebar')
        </aside>

        {{-- Sidebar Overlay for Mobile --}}
        <div id="sidebar-overlay"
            class="fixed inset-0 z-40 bg-black bg-opacity-50 transition-opacity duration-300 ease-in-out opacity-0 pointer-events-none lg:hidden">
        </div>

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col overflow-hidden lg:ml-0">
            {{-- Header --}}
            @unless (isset($hideHeader) && $hideHeader)
                @include('components.admin.header')
            @endunless

            {{-- Main Content Area --}}
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-amber-50/30">
                <div class="container mx-auto px-2 sm:px-3 lg:px-4 py-3">
                    @yield('content')
                </div>
            </main>
        </div>

        {{-- Right Sidebar (if needed) --}}
        @unless (isset($hideSidebarRight) && $hideSidebarRight)
            <aside class="hidden xl:block w-72 bg-white border-l border-amber-100">
                @include('components.admin.right-sidebar')
            </aside>
        @endunless
    </div>

    {{-- JavaScript for Sidebar Toggle --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            function toggleSidebar() {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('opacity-0');
                overlay.classList.toggle('pointer-events-none');
            }

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', toggleSidebar);
            }

            if (overlay) {
                overlay.addEventListener('click', toggleSidebar);
            }

            // Close sidebar on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !sidebar.classList.contains('-translate-x-full')) {
                    toggleSidebar();
                }
            });
        });

        // Global notification system
        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full ${
                type === 'success' ? 'bg-green-50 border border-green-200 text-green-700' : 
                type === 'error' ? 'bg-red-50 border border-red-200 text-red-700' : 
                'bg-blue-50 border border-blue-200 text-blue-700'
            }`;
            
            notification.innerHTML = `
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        ${type === 'success' ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>' :
                          type === 'error' ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>' :
                          '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>'}
                    </svg>
                    <span class="text-sm font-medium">${message}</span>
                    <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-gray-400 hover:text-gray-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            // Animate in
            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => notification.remove(), 300);
            }, 5000);
        }
    </script>
</body>

</html>
