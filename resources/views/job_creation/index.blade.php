@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6 mt-8">
    <h2 class="text-2xl font-bold mb-4">Job Management</h2>

    {{-- Organization Info --}}
    <div class="bg-gray-100 p-4 rounded mb-6">
        <h3 class="text-xl font-semibold mb-2">Organization Details</h3>

        @php $orgFields = ['company_name','address']; @endphp
        @foreach($orgFields as $field)
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

    {{-- Jobs Section --}}
    <div class="bg-gray-50 p-4 rounded mb-6">
        <h3 class="text-xl font-semibold mb-4">My Jobs</h3>

        @forelse($jobs as $job)
            <div class="border p-3 rounded mb-3">
                <div class="mb-2 flex items-center space-x-2">
                    <strong class="w-32">Title:</strong>
                    <span class="value">{{ $job->title }}</span>
                    <button type="button" class="edit-btn bg-blue-500 text-white px-2 py-1 rounded text-sm">Edit</button>

                    <form method="POST" action="{{ route('job_creation.update', $job->id) }}" class="hidden inline-flex items-center space-x-2">
                        @csrf
                        @method('PATCH')
                        <input type="text" name="title" class="border p-1 rounded w-60" value="{{ $job->title }}">
                        <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded text-sm">Save</button>
                    </form>
                </div>

                <div class="mb-2 flex items-center space-x-2">
                    <strong class="w-32">Description:</strong>
                    <span class="value">{{ $job->description }}</span>
                    <button type="button" class="edit-btn bg-blue-500 text-white px-2 py-1 rounded text-sm">Edit</button>

                    <form method="POST" action="{{ route('job_creation.update', $job->id) }}" class="hidden inline-flex items-center space-x-2 w-full">
                        @csrf
                        @method('PATCH')
                        <input type="text" name="description" class="border p-1 rounded w-full" value="{{ $job->description }}">
                        <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded text-sm">Save</button>
                    </form>
                </div>

                <div class="mb-2 flex items-center space-x-2">
                    <strong class="w-32">Location:</strong>
                    <span class="value">{{ $job->location }}</span>
                    <button type="button" class="edit-btn bg-blue-500 text-white px-2 py-1 rounded text-sm">Edit</button>

                    <form method="POST" action="{{ route('job_creation.update', $job->id) }}" class="hidden inline-flex items-center space-x-2">
                        @csrf
                        @method('PATCH')
                        <input type="text" name="location" class="border p-1 rounded w-60" value="{{ $job->location }}">
                        <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded text-sm">Save</button>
                    </form>
                </div>

                <div class="mb-2 flex items-center space-x-2">
                    <strong class="w-32">Salary:</strong>
                    <span class="value">{{ $job->salary ?? 'Not set' }}</span>
                    <button type="button" class="edit-btn bg-blue-500 text-white px-2 py-1 rounded text-sm">Edit</button>

                    <form method="POST" action="{{ route('job_creation.update', $job->id) }}" class="hidden inline-flex items-center space-x-2">
                        @csrf
                        @method('PATCH')
                        <input type="text" name="salary" class="border p-1 rounded w-60" value="{{ $job->salary }}">
                        <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded text-sm">Save</button>
                    </form>
                </div>

                <div class="mb-2 flex items-center space-x-2">
                    <strong class="w-32">Employment:</strong>
                    <span class="value">{{ ucfirst($job->employment_type) }}</span>
                    <button type="button" class="edit-btn bg-blue-500 text-white px-2 py-1 rounded text-sm">Edit</button>

                    <form method="POST" action="{{ route('job_creation.update', $job->id) }}" class="hidden inline-flex items-center space-x-2">
                        @csrf
                        @method('PATCH')
                        <select name="employment_type" class="border p-1 rounded w-60">
                            <option value="full-time" {{ $job->employment_type=='full-time' ? 'selected' : '' }}>Full-time</option>
                            <option value="part-time" {{ $job->employment_type=='part-time' ? 'selected' : '' }}>Part-time</option>
                            <option value="internship" {{ $job->employment_type=='internship' ? 'selected' : '' }}>Internship</option>
                        </select>
                        <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded text-sm">Save</button>
                    </form>
                </div>

                <div class="mb-2 flex items-center space-x-2">
                    <strong class="w-32">Deadline:</strong>
                    <span class="value">{{ $job->deadline->format('M d, Y') }}</span>
                    <button type="button" class="edit-btn bg-blue-500 text-white px-2 py-1 rounded text-sm">Edit</button>

                    <form method="POST" action="{{ route('job_creation.update', $job->id) }}" class="hidden inline-flex items-center space-x-2">
                        @csrf
                        @method('PATCH')
                        <input type="date" name="deadline" class="border p-1 rounded w-60" value="{{ $job->deadline->format('Y-m-d') }}">
                        <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded text-sm">Save</button>
                    </form>
                </div>

                {{-- Delete button --}}
                <form method="POST" action="{{ route('job_creation.delete', $job->id) }}" class="mt-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-sm">Delete Job</button>
                </form>
            </div>
        @empty
            <p>No jobs posted yet.</p>
        @endforelse
    </div>

    {{-- Add New Job --}}
    <div class="bg-yellow-100 p-4 rounded mb-4">
        <h3 class="text-lg font-semibold mb-2">Post New Job</h3>
        <form method="POST" action="{{ route('job_creation.store') }}">
            @csrf
            <div class="mb-2"><label>Title</label>
                <input type="text" name="title" class="w-full border rounded p-2" required>
            </div>
            <div class="mb-2"><label>Description</label>
                <textarea name="description" class="w-full border rounded p-2" required></textarea>
            </div>
            <div class="mb-2"><label>Location</label>
                <input type="text" name="location" class="w-full border rounded p-2" required>
            </div>
            <div class="mb-2"><label>Salary</label>
                <input type="text" name="salary" class="w-full border rounded p-2">
            </div>
            <div class="mb-2"><label>Employment Type</label>
                <select name="employment_type" class="w-full border rounded p-2" required>
                    <option value="full-time">Full-time</option>
                    <option value="part-time">Part-time</option>
                    <option value="internship">Internship</option>
                </select>
            </div>
            <div class="mb-2"><label>Deadline</label>
                <input type="date" name="deadline" class="w-full border rounded p-2" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Post Job</button>
        </form>
    </div>
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
