@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h2 class="text-2xl font-bold mb-4">Organization Current Jobs</h2>

    @if($currentJobs->isEmpty())
        <p class="text-gray-600">No current jobs found for your organization.</p>
    @else
        <div class="space-y-6">
            @foreach($currentJobs as $jobId => $jobEntries)
                @php
                    $job = $jobEntries->first()->job; // Get job info
                    $applicantsCount = $jobEntries->count(); // Count applicants for this job
                @endphp

                <div class="p-6 border rounded-lg bg-white shadow">
                    {{-- Job Info --}}
                    <h3 class="text-2xl font-semibold mb-2">
                        <a href="{{ route('work-check.index', $job->id) }}" class="text-blue-600 underline">
                            {{ $job->title ?? 'Untitled Job' }}
                        </a>
                    </h3>
                    <p class="text-gray-700"><strong>Employment Type:</strong> {{ $job->employment_type ?? 'N/A' }}</p>
                    <p class="text-gray-700"><strong>Salary:</strong> {{ $job->salary ?? 'Not specified' }}</p>
                    <p class="text-gray-700"><strong>Location:</strong> {{ $job->location ?? 'N/A' }}</p>

                    {{-- Job Skillsets --}}
                    <div class="mt-3">
                        <strong>Required Skills:</strong>
                        @if($job->skills && $job->skills->count() > 0)
                            <ul class="list-disc list-inside text-gray-700 mt-1">
                                @foreach($job->skills as $skill)
                                    <li>{{ $skill->skill_name }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-600">No specific skills required.</p>
                        @endif
                    </div>

                    {{-- Applicants Count --}}
                    <div class="mt-4 border-t pt-3">
                        <strong>Assigned Applicants:</strong> {{ $applicantsCount }}
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
