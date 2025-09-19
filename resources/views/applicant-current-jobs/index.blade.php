@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-6">
    <h2 class="text-2xl font-bold mb-4">My Current Jobs</h2>

    @if(session('success'))
        <div class="mb-4 p-2 bg-green-200 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-2 bg-red-200 text-red-800 rounded">
            {{ session('error') }}
        </div>
    @endif

    @if($currentJobs->isEmpty())
        <p class="text-gray-600">You have no current jobs assigned.</p>
    @else
        <ul class="space-y-4">
            @foreach($currentJobs as $cj)
                <li class="p-4 border rounded bg-white shadow">
                    {{-- Job Title --}}
                    <h3 class="text-lg font-semibold">
                        {{ $cj->job->title ?? 'Unknown Job' }}
                    </h3>
                    <br>
                    {{-- Org Details --}}
                    @if($cj->job->organization)
                        <p class="text-gray-700"><strong>Organization Name:</strong> {{ $cj->job->organization->company_name }}</p>
                        <p class="text-gray-700"><strong>Org Id:</strong> {{ $cj->job->organization->id }}</p>
                    @endif
                    <br>
                    <p class="text-gray-700"><strong>Location:</strong> {{ $cj->job->location ?? 'N/A' }}</p>
                    <p class="text-gray-700"><strong>Status:</strong> {{ ucfirst($cj->status) ?? 'N/A' }}</p>
                    <p class="text-gray-700"><strong>Assigned At:</strong> {{ $cj->assigned_at->format('d M Y H:i') }}</p>

                    {{-- Skills --}}
                    @if($cj->job->skills->isNotEmpty())
                        <div class="mt-3">
                            <h4 class="font-medium text-gray-700">Skills Required:</h4>
                            <ul class="flex flex-wrap gap-2 mt-1">
                                @foreach($cj->job->skills as $skill)
                                    <li class="px-2 py-1 bg-gray-200 text-gray-800 rounded text-sm">
                                        {{ $skill->skill_name }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Buttons --}}
                    <div class="mt-4 flex gap-3">
                        {{-- Submit Work --}}
                        @if($cj->status !== 'completed' && $cj->status !== 'submitted')
                            <a href="{{ route('work.submission.create', $cj->job->id) }}" 
                               class="px-3 py-1 bg-blue-500 text-white rounded">
                                Submit Work
                            </a>
                        @endif

                        {{-- Leave Job --}}
                        <form action="{{ route('applicant.current.jobs.destroy', $cj->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to leave this job?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded">
                                Leave Job
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
