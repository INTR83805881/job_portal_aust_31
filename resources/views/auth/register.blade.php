@extends('layouts.app')

@section('content')

{{-- 🌟 Register Section --}}
<section class="relative w-full min-h-screen flex items-center justify-center bg-gray-100 py-20">

    {{-- Background --}}
    <div class="absolute inset-0">
        <img src="{{ asset('images/we-are-hiring-digital-collage.jpg') }}" 
             alt="Job Axis Register Background" 
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/70 backdrop-blur-sm"></div>
    </div>

    {{-- Register Card --}}
    <div class="relative z-10 w-full max-w-lg bg-white/90 backdrop-blur-xl rounded-2xl shadow-2xl p-10">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-gray-800">Create an Account ✨</h2>
            <p class="text-gray-600 mt-2">Join <span class="text-indigo-600 font-semibold">Job Axis</span> and start your journey today!</p>
        </div>

        <!-- Sign In / Sign Up Toggle -->
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
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-4">
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
                              autofocus 
                              autocomplete="name" />
            </div>

            {{-- Email --}}
            <div class="mb-5">
                <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
                <x-text-input id="email" 
                              class="block mt-2 w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                              type="email" 
                              name="email" 
                              :value="old('email')" 
                              required 
                              autocomplete="username" />
            </div>

            {{-- Password --}}
            <div class="mb-5">
                <x-input-label for="password" :value="__('Password')" class="text-gray-700" />
                <x-text-input id="password" 
                              class="block mt-2 w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                              type="password"
                              name="password"
                              required 
                              autocomplete="new-password" />
            </div>

            {{-- Confirm Password --}}
            <div class="mb-6">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700" />
                <x-text-input id="password_confirmation" 
                              class="block mt-2 w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                              type="password"
                              name="password_confirmation"
                              required 
                              autocomplete="new-password" />
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

            <!-- Applicant Fields -->
            <div id="applicant-fields" class="hidden space-y-4">
                <div>
                    <label for="address" class="block text-sm font-medium text-foreground">Address</label>
                    <input type="text" name="address" id="address" value="{{ old('address') }}"
                           class="w-full mt-1 px-3 py-2 border rounded-lg bg-input-background focus:ring focus:ring-ring">
                </div>
                <div>
                    <label for="qualification" class="block text-sm font-medium text-foreground">Qualification</label>
                    <input type="text" name="qualification" id="qualification" value="{{ old('qualification') }}"
                           class="w-full mt-1 px-3 py-2 border rounded-lg bg-input-background focus:ring focus:ring-ring">
                </div>
                <div>
                    <label for="resume" class="block text-sm font-medium text-foreground">Resume (PDF)</label>
                    <input type="file" name="resume" id="resume" accept=".pdf"
                           class="w-full mt-1 px-3 py-2 border rounded-lg bg-input-background focus:ring focus:ring-ring">
                </div>
                <div>
                    <label for="cover_letter" class="block text-sm font-medium text-foreground">Cover Letter (PDF)</label>
                    <input type="file" name="cover_letter" id="cover_letter" accept=".pdf"
                           class="w-full mt-1 px-3 py-2 border rounded-lg bg-input-background focus:ring focus:ring-ring">
                </div>
            </div>

            <!-- Organization Fields -->
            <div id="organization-fields" class="hidden space-y-4">
                <div>
                    <label for="company_name" class="block text-sm font-medium text-foreground">Company Name</label>
                    <input type="text" name="company_name" id="company_name" value="{{ old('company_name') }}"
                           class="w-full mt-1 px-3 py-2 border rounded-lg bg-input-background focus:ring focus:ring-ring">
                </div>
                <div>
                    <label for="org_address" class="block text-sm font-medium text-foreground">Address</label>
                    <input type="text" name="org_address" id="org_address" value="{{ old('org_address') }}"
                           class="w-full mt-1 px-3 py-2 border rounded-lg bg-input-background focus:ring focus:ring-ring">
                </div>
            </div>

            <!-- Submit -->
            <button type="submit"
                    class="w-full bg-primary text-primary-foreground py-2 rounded-lg font-medium hover:opacity-90 transition">
                Sign Up
            </button>
        </form>

        {{-- Already have account --}}
        <p class="mt-6 text-center text-gray-600">
            Already have an account? 
            <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">
                Log in here
            </a>
        </p>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const roleSelect = document.getElementById('role');
    const applicantFields = document.getElementById('applicant-fields');
    const organizationFields = document.getElementById('organization-fields');

    function toggleFields() {
        if(roleSelect.value === 'applicant') {
            applicantFields.classList.remove('hidden');
            organizationFields.classList.add('hidden');
        } else if(roleSelect.value === 'organization') {
            organizationFields.classList.remove('hidden');
            applicantFields.classList.add('hidden');
        } else {
            applicantFields.classList.add('hidden');
            organizationFields.classList.add('hidden');
        }
    }

    roleSelect.addEventListener('change', toggleFields);

    // Trigger on page load in case old input exists
    toggleFields();
});
</script>
@endsection
