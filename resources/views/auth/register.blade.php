@extends('layouts.app')

@section('content')

<section class="relative w-full min-h-screen flex items-center justify-center bg-gray-100 py-20">
    <div class="absolute inset-0">
        <img src="{{ asset('images/we-are-hiring-digital-collage.jpg') }}" 
             alt="Job Axis Register Background" 
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/70 backdrop-blur-sm"></div>
    </div>

    <div class="relative z-10 w-full max-w-lg bg-white/90 backdrop-blur-xl rounded-2xl shadow-2xl p-10">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-gray-800">Create an Account ✨</h2>
            <p class="text-gray-600 mt-2">Join <span class="text-indigo-600 font-semibold">Job Axis</span> and start your journey today!</p>
        </div>

        <!-- Toggle -->
        <div class="flex border rounded-lg overflow-hidden mb-6">
            <a href="{{ route('login') }}"
               class="w-1/2 text-center py-2 {{ request()->routeIs('login') ? 'bg-primary text-primary-foreground' : 'bg-muted text-foreground' }}">
               Sign In
            </a>
            <a href="{{ route('register') }}"
               class="w-1/2 text-center py-2 {{ request()->routeIs('register') ? 'bg-primary text-primary-foreground' : 'bg-muted text-foreground' }}">
               Sign Up
            </a>
        </div>

        <!-- Signup Form -->
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            {{-- Name --}}
            <div class="mb-5">
                <x-input-label for="name" :value="__('Full Name')" class="text-gray-700" />
                <x-text-input id="name" 
                              class="block mt-2 w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                              type="text" 
                              name="name" 
                              :value="old('name')" 
                              required 
                              autofocus />
            </div>

            {{-- Email --}}
            <div class="mb-5">
                <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
                <x-text-input id="email" 
                              class="block mt-2 w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                              type="email" 
                              name="email" 
                              :value="old('email')" 
                              required />
            </div>

            {{-- Password --}}
            <div class="mb-5">
                <x-input-label for="password" :value="__('Password')" class="text-gray-700" />
                <x-text-input id="password" 
                              class="block mt-2 w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                              type="password"
                              name="password"
                              required />
            </div>

            {{-- Confirm Password --}}
            <div class="mb-6">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700" />
                <x-text-input id="password_confirmation" 
                              class="block mt-2 w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                              type="password"
                              name="password_confirmation"
                              required />
            </div>

            <!-- Role -->
            <div>
                <label for="role" class="block text-sm font-medium text-foreground">Register as</label>
                <select id="role" name="role" required
                        class="w-full mt-1 px-3 py-2 border rounded-lg bg-input-background focus:ring focus:ring-ring">
                    <option value="">Select Role</option>
                    <option value="applicant" {{ old('role') == 'applicant' ? 'selected' : '' }}>Applicant</option>
                    <option value="organization" {{ old('role') == 'organization' ? 'selected' : '' }}>Organization</option>
                </select>
                @error('role')
                    <p class="text-destructive text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit -->
            <button type="submit"
                    class="w-full bg-primary text-primary-foreground py-2 rounded-lg font-medium hover:opacity-90 transition">
                Sign Up
            </button>
        </form>

        <p class="mt-6 text-center text-gray-600">
            Already have an account? 
            <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">
                Log in here
            </a>
        </p>
    </div>
</section>
@endsection
