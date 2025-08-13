<header class="bg-white border-b border-amber-100 w-full">
    <div class="flex justify-between items-center h-16 px-4 sm:px-6 lg:px-8 pr-0">
        {{-- Left side - Logo and Title --}}
        <div class="flex items-center space-x-4">
            <button id="sidebar-toggle"
                class="lg:hidden p-2 rounded-md text-gray-400 hover:text-gray-600 hover:bg-amber-50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>

            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/insekgam.png') }}" alt="Logo" class="w-8 h-8 rounded-lg">
                <div class="hidden sm:block">
                    <h1 class="text-lg font-semibold text-gray-900">INSEKTA Admin</h1>
                    <p class="text-xs text-amber-600">Dashboard Management</p>
                </div>
            </div>
        </div>

        {{-- Right side - Actions and Profile --}}
        <div class="flex items-center space-x-4">
            {{-- Notifications --}}
            <button
                class="relative p-2 text-gray-400 hover:text-primary-amber hover:bg-light-amber rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                    </path>
                </svg>
                <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
            </button>

            {{-- Profile Dropdown --}}
            <div class="relative">
                <button class="flex items-center space-x-2 p-2 rounded-lg hover:bg-amber-50 transition-colors">
                    <img src="{{ auth()->user()->avatar ?? 'https://i.pravatar.cc/32' }}" alt="Profile"
                        class="w-8 h-8 rounded-full border-2 border-amber-200">
                    <span
                        class="hidden sm:block text-sm font-medium text-gray-700">{{ auth()->user()->name ?? 'Admin' }}</span>

                </button>
            </div>
        </div>
    </div>
</header>
