<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 sticky top-0 z-40 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <x-application-logo class="block h-8 w-auto fill-current text-indigo-600" />
                    <span class="text-xl font-semibold text-indigo-600">Job Axis</span>
                </a>
            </div>

            <!-- Left Navigation Links -->
            <div class="hidden sm:flex space-x-6">
                <a href="{{ route('home') }}" class="{{ request()->is('/') ? 'text-indigo-600 font-medium' : 'text-gray-600 hover:text-indigo-600' }}">Home</a>
                <a href="{{ route('jobs.index') }}" class="{{ request()->is('jobs') ? 'text-indigo-600 font-medium' : 'text-gray-600 hover:text-indigo-600' }}">Jobs</a>
                <a href="{{ route('about') }}" class="{{ request()->is('about') ? 'text-indigo-600 font-medium' : 'text-gray-600 hover:text-indigo-600' }}">About</a>
                <a href="{{ route('contact') }}" class="{{ request()->is('contact') ? 'text-indigo-600 font-medium' : 'text-gray-600 hover:text-indigo-600' }}">Contact</a>
            </div>

            <!-- Right side Authentication -->
            <div class="hidden sm:flex sm:items-center sm:space-x-4">
                @guest
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600">Login</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">Sign Up</a>
                @endguest

                @auth
                    <!-- Dashboard Button -->
                    <a href="{{ route('dashboard') }}" 
                       class="px-4 py-2 text-sm font-medium text-indigo-600 border border-indigo-600 rounded-lg hover:bg-indigo-50 transition">
                        Dashboard
                    </a>

                    <!-- Profile Button -->
                    <a href="{{ route('profile.page') }}" 
                       class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition">
                        Profile
                    </a>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" 
                                class="px-4 py-2 text-sm font-medium text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-100 transition">
                            Log Out
                        </button>
                    </form>
                @endauth
            </div>

            <!-- Hamburger for mobile -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden">
        <!-- Left nav links -->
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600">Home</a>
            <a href="{{ route('jobs.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600">Jobs</a>
            <a href="{{ route('about') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600">About</a>
            <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600">Contact</a>
        </div>

        @auth
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1 px-3">
                <a href="{{ route('dashboard') }}" class="block w-full text-center px-4 py-2 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-100">Dashboard</a>
                <a href="{{ route('profile.page') }}" class="block w-full text-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-center px-4 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200">Log Out</button>
                </form>
            </div>
        @endauth
    </div>
</nav>
