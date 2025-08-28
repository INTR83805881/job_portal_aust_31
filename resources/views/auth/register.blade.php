@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-background">
    <div class="w-full max-w-md bg-card shadow-lg rounded-xl p-6">
        <!-- Logo & Heading -->
        <div class="text-center mb-6">
            <h1 class="text-2xl font-semibold text-foreground">Job Axis</h1>
            <p class="text-muted-foreground mt-2">Create your account</p>
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

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-foreground">Full Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required
                       class="w-full mt-1 px-3 py-2 border rounded-lg bg-input-background focus:ring focus:ring-ring">
                @error('name')
                    <p class="text-destructive text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-foreground">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                       class="w-full mt-1 px-3 py-2 border rounded-lg bg-input-background focus:ring focus:ring-ring">
                @error('email')
                    <p class="text-destructive text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-foreground">Password</label>
                <input id="password" type="password" name="password" required
                       class="w-full mt-1 px-3 py-2 border rounded-lg bg-input-background focus:ring focus:ring-ring">
                @error('password')
                    <p class="text-destructive text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-foreground">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                       class="w-full mt-1 px-3 py-2 border rounded-lg bg-input-background focus:ring focus:ring-ring">
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

        <p class="mt-6 text-center text-sm text-muted-foreground">
            Already have an account?
            <a href="{{ route('login') }}" class="text-primary font-medium">Sign In</a>
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
