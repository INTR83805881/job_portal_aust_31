@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6 mt-8">
    <h2 class="text-2xl font-bold mb-4">My Profile</h2>

    <div class="space-y-3 mb-6">
        <p><strong>User ID:</strong> {{ $user->id }}</p>
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
        <p><strong>Joined:</strong> {{ $user->created_at->format('M d, Y') }}</p>
    </div>

    {{-- Applicant Role --}}
    @if($user->role === 'applicant')
        @if($applicant)
            <div class="bg-gray-100 p-4 rounded mb-4">
                <h3 class="text-xl font-semibold mb-2">Applicant Details</h3>
                <p><strong>Address:</strong> {{ $applicant->address }}</p>
                <p><strong>Qualification:</strong> {{ $applicant->qualification }}</p>
                <p><strong>Resume:</strong> {{ $applicant->resume ?? 'Not uploaded' }}</p>
                <p><strong>Cover Letter:</strong> {{ $applicant->cover_letter ?? 'Not uploaded' }}</p>
            </div>
        @else
            <div class="bg-yellow-100 p-4 rounded mb-4">
                <h3 class="text-lg font-semibold mb-2">Create Applicant Profile</h3>
                <form method="POST" action="{{ route('profile.applicant.store') }}">
                    @csrf
                    <div class="mb-2">
                        <label>Address</label>
                        <input type="text" name="address" class="w-full border rounded p-2" required>
                    </div>
                    <div class="mb-2">
                        <label>Qualification</label>
                        <input type="text" name="qualification" class="w-full border rounded p-2" required>
                    </div>
                    <div class="mb-2">
                        <label>Resume (path)</label>
                        <input type="text" name="resume" class="w-full border rounded p-2">
                    </div>
                    <div class="mb-2">
                        <label>Cover Letter (path)</label>
                        <input type="text" name="cover_letter" class="w-full border rounded p-2">
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                </form>
            </div>
        @endif
    @endif

    {{-- Organization Role --}}
    @if($user->role === 'organization')
        @if($organization)
            <div class="bg-gray-100 p-4 rounded mb-4">
                <h3 class="text-xl font-semibold mb-2">Organization Details</h3>
                <p><strong>Company Name:</strong> {{ $organization->company_name }}</p>
                <p><strong>Address:</strong> {{ $organization->address }}</p>
            </div>
        @else
            <div class="bg-yellow-100 p-4 rounded mb-4">
                <h3 class="text-lg font-semibold mb-2">Create Organization Profile</h3>
                <form method="POST" action="{{ route('profile.organization.store') }}">
                    @csrf
                    <div class="mb-2">
                        <label>Company Name</label>
                        <input type="text" name="company_name" class="w-full border rounded p-2" required>
                    </div>
                    <div class="mb-2">
                        <label>Address</label>
                        <input type="text" name="address" class="w-full border rounded p-2" required>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                </form>
            </div>
        @endif
    @endif
</div>
@endsection
