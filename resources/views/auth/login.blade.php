@extends('layouts.app')

@section('content')

{{-- 🌟 Login Section --}}
<section class="relative w-full min-h-screen flex items-center justify-center bg-gray-100 py-20">

    {{-- Background --}}
    <div class="absolute inset-0">
        <img src="{{ asset('images/we-are-hiring-digital-collage.jpg') }}" 
             alt="Job Axis Login Background" 
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/70 backdrop-blur-sm"></div>
    </div>

    {{-- Login Card --}}
    <div class="relative z-10 w-full max-w-md bg-white/90 backdrop-blur-xl rounded-2xl shadow-2xl p-8">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-gray-800">Welcome Back 👋</h2>
            <p class="text-gray-600 mt-2">Login to continue your journey with <span class="text-indigo-600 font-semibold">Job Axis</span></p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div class="mb-5">
                <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
                <x-text-input id="email" 
                              class="block mt-2 w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                              type="email" 
                              name="email" 
                              :value="old('email')" 
                              required 
                              autofocus 
                              autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            {{-- Password --}}
            <div class="mb-5">
                <x-input-label for="password" :value="__('Password')" class="text-gray-700" />
                <x-text-input id="password" 
                              class="block mt-2 w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                              type="password"
                              name="password"
                              required 
                              autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            {{-- Remember + Forgot --}}
            <div class="flex items-center justify-between mb-6">
                <label for="remember_me" class="flex items-center text-sm text-gray-600">
                    <input id="remember_me" type="checkbox" name="remember"
                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    <span class="ms-2">Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" 
                       class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                        Forgot password?
                    </a>
                @endif
            </div>

            {{-- Submit --}}
            <x-primary-button class="w-full py-3 text-lg rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 shadow-lg justify-center">
                {{ __('Log in') }}
            </x-primary-button>
        </form>

        {{-- Register Link --}}
        <p class="mt-6 text-center text-gray-600">
            Don’t have an account? 
            <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">
                Register here
            </a>
        </p>
    </div>
</section>

@endsection
