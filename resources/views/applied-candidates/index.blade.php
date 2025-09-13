@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-6">Applications for My Jobs</h2>

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
    @endif

    @if($applications->isEmpty())
        <p class="text-gray-600">No applications have been submitted for your jobs yet.</p>
    @else
        @foreach($applications as $app)
            @php 
                $job = $app->job; 
                $applicant = $app->applicant; 
            @endphp

            <div class="bg-white rounded-lg shadow p-6 mb-6 border border-gray-200">
                <div class="grid grid-cols-2 gap-6 items-start">
                    {{-- Applicant Info --}}
                    <div class="border-r pr-6">
                        <h3 class="text-xl font-semibold mb-3">Applicant Information</h3>
                        <p class="text-gray-700">
                            <span class="font-semibold">Name:</span> {{ $applicant->user?->name ?? 'N/A' }}
                        </p>
                        <p class="text-gray-700">
                            <span class="font-semibold">Email:</span> {{ $applicant->user?->email ?? 'N/A' }}
                        </p>
                        <p class="text-gray-700">
                            <span class="font-semibold">Applied on:</span> {{ $app->created_at->format('d M Y, h:i A') }}
                        </p>

                        {{-- Applicant Skills --}}
                        <div class="mt-3">
                            <span class="text-gray-700 font-semibold">Applicant Skills:</span>
                            <div class="mt-1 flex flex-wrap gap-2">
                                @forelse($applicant->applicantSkillsets as $appSkill)
                                    <span class="text-xs px-2 py-1 rounded-full bg-blue-100 text-blue-800">
                                        {{ $appSkill->skill?->skill_name ?? 'Unnamed Skill' }}
                                    </span>
                                @empty
                                    <span class="text-xs px-2 py-1 rounded-full bg-gray-100 text-gray-500">
                                        No skills listed
                                    </span>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    {{-- Job Info --}}
                    <div class="pl-6">
                        <h3 class="text-xl font-semibold mb-3">Job Information</h3>
                        <p class="text-gray-700">
                            <span class="font-semibold">Title:</span> {{ $job->title }}
                        </p>
                        <p class="text-gray-700">
                            <span class="font-semibold">Description:</span> {{ $job->description }}
                        </p>
                        <p class="text-gray-700">
                            <span class="font-semibold">Location:</span> {{ $job->location }}
                        </p>
                        <p class="text-gray-700">
                            <span class="font-semibold">Employment Type:</span> {{ ucfirst($job->employment_type) }}
                        </p>
                        <p class="text-gray-700">
                            <span class="font-semibold">Deadline:</span> {{ $job->deadline }}
                        </p>

                        {{-- Job Skills --}}
                        <div class="mt-3">
                            <span class="text-gray-700 font-semibold">Job Skills:</span>
                            <div class="mt-1 flex flex-wrap gap-2">
                                @forelse($job->jobSkillsets as $jobSkill)
                                    <span class="text-xs px-2 py-1 rounded-full bg-gray-100 text-gray-800">
                                        {{ $jobSkill->skill?->skill_name ?? 'Unnamed Skill' }}
                                    </span>
                                @empty
                                    <span class="text-xs px-2 py-1 rounded-full bg-gray-100 text-gray-500">
                                        No skills listed
                                    </span>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
