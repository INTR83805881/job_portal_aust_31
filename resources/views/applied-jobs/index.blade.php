@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-6">My Applied Jobs</h2>

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
    @endif

    @if($appliedJobs->isEmpty())
        <p class="text-gray-600">You have not applied for any jobs yet.</p>
    @else
        @foreach($appliedJobs as $application)
            @php $job = $application->job; @endphp
            @if($job)
                <div class="bg-white rounded-lg shadow p-6 mb-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-xl font-semibold">{{ $job->title }}</h3>
                            <p class="text-sm text-gray-500">{{ $job->organization?->company_name ?? 'N/A' }}</p>
                            <p class="text-gray-700">{{ $job->location }}</p>
                        </div>
                        <div class="flex gap-2">
                            {{-- Remove application --}}
                            <form action="{{ route('applied-jobs.remove', $application->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                    Remove
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Job Info --}}
                    <div class="mt-3 grid grid-cols-2 gap-4 text-sm text-gray-700">
                        <div><span class="font-semibold">Employment Type:</span> {{ ucfirst($job->employment_type) }}</div>
                        <div><span class="font-semibold">Salary:</span> {{ $job->salary ?? 'Negotiable' }}</div>
                        <div><span class="font-semibold">Deadline:</span> {{ $job->deadline }}</div>
                        <div><span class="font-semibold">Applied on:</span> {{ $application->created_at->format('d M Y, h:i A') }}</div>
                    </div>

                    {{-- Skills --}}
                    <div class="mt-3 flex flex-wrap gap-2">
                        @forelse($job->jobSkillsets as $skill)
                            <span class="text-xs px-2 py-1 rounded-full bg-gray-100 text-gray-800">
                                {{ $skill->skill?->skill_name ?? 'Unnamed Skill' }}
                            </span>
                        @empty
                            <span class="text-xs px-2 py-1 rounded-full bg-gray-100 text-gray-500">
                                No skills listed
                            </span>
                        @endforelse
                    </div>
                </div>
            @endif
        @endforeach
    @endif
</div>
@endsection
