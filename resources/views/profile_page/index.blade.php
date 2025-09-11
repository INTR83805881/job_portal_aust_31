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

    {{-- Applicant --}}
    @if($user->role === 'applicant')
        @php $fields = ['address','qualification','resume','cover_letter']; @endphp

        @if($applicant)
            <div class="bg-gray-100 p-4 rounded mb-4">
                <h3 class="text-xl font-semibold mb-2">Applicant Details</h3>

                @foreach($fields as $field)
                    <div class="mb-2 flex items-center space-x-2">
                        <strong class="w-32">{{ ucfirst(str_replace('_',' ',$field)) }}:</strong>
                        <span class="value">{{ $applicant->$field ?? 'Not set' }}</span>

                        <button type="button" class="edit-btn bg-blue-500 text-white px-2 py-1 rounded text-sm">Edit</button>

                        <form method="POST" action="{{ route('profile.applicant.update') }}" class="hidden inline-flex items-center space-x-2">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="field" value="{{ $field }}">
                            <input type="text" name="value" class="border p-1 rounded w-60" value="{{ $applicant->$field }}">
                            <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded text-sm">Save</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @else
            {{-- Full POST form for new applicant --}}
            <div class="bg-yellow-100 p-4 rounded mb-4">
                <h3 class="text-lg font-semibold mb-2">Create Applicant Profile</h3>
                <form method="POST" action="{{ route('profile.applicant.store') }}">
                    @csrf
                    <div class="mb-2"><label>Address</label>
                        <input type="text" name="address" class="w-full border rounded p-2" required>
                    </div>
                    <div class="mb-2"><label>Qualification</label>
                        <input type="text" name="qualification" class="w-full border rounded p-2" required>
                    </div>
                    <div class="mb-2"><label>Resume</label>
                        <input type="text" name="resume" class="w-full border rounded p-2">
                    </div>
                    <div class="mb-2"><label>Cover Letter</label>
                        <input type="text" name="cover_letter" class="w-full border rounded p-2">
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                </form>
            </div>
        @endif
    @endif

    {{-- Organization --}}
    @if($user->role === 'organization')
        @php $fields = ['company_name','address']; @endphp

        @if($organization)
            <div class="bg-gray-100 p-4 rounded mb-4">
                <h3 class="text-xl font-semibold mb-2">Organization Details</h3>

                @foreach($fields as $field)
                    <div class="mb-2 flex items-center space-x-2">
                        <strong class="w-32">{{ ucfirst(str_replace('_',' ',$field)) }}:</strong>
                        <span class="value">{{ $organization->$field }}</span>

                        <button type="button" class="edit-btn bg-blue-500 text-white px-2 py-1 rounded text-sm">Edit</button>

                        <form method="POST" action="{{ route('profile.organization.update') }}" class="hidden inline-flex items-center space-x-2">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="field" value="{{ $field }}">
                            <input type="text" name="value" class="border p-1 rounded w-60" value="{{ $organization->$field }}">
                            <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded text-sm">Save</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @else
            {{-- Full POST form for new organization --}}
            <div class="bg-yellow-100 p-4 rounded mb-4">
                <h3 class="text-lg font-semibold mb-2">Create Organization Profile</h3>
                <form method="POST" action="{{ route('profile.organization.store') }}">
                    @csrf
                    <div class="mb-2"><label>Company Name</label>
                        <input type="text" name="company_name" class="w-full border rounded p-2" required>
                    </div>
                    <div class="mb-2"><label>Address</label>
                        <input type="text" name="address" class="w-full border rounded p-2" required>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                </form>
            </div>
        @endif
    @endif
</div>

<script>
document.querySelectorAll('.edit-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const container = this.parentElement;
        container.querySelector('.value').classList.toggle('hidden');
        container.querySelector('form').classList.toggle('hidden');
        this.classList.add('hidden');
    });
});
</script>
@endsection
