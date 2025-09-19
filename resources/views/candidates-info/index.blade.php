@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-6">
    <h2 class="text-2xl font-bold mb-4">Applicants for Job: {{ $job->title }}</h2>

    @if($applicants->isEmpty())
        <p class="text-gray-600">No applicants have applied yet.</p>
    @else
        <ul class="space-y-4">
            @foreach($applicants as $applicant)
                <li class="p-4 border rounded bg-white shadow">
                    <h3 class="text-lg font-semibold">{{ $applicant->user->name ?? 'Unknown' }}</h3>
                    <p class="text-gray-700"><strong>Email:</strong> {{ $applicant->user->email ?? 'N/A' }}</p>
                    <p class="text-gray-700"><strong>Qualification:</strong> {{ $applicant->qualification }}</p>

                    {{-- Contacts --}}
                    @if($applicant->contacts->isNotEmpty())
                        <div class="mt-2">
                            <h4 class="font-medium text-gray-700">Contacts:</h4>
                            <ul class="list-disc list-inside text-gray-600">
                                @foreach($applicant->contacts as $contact)
                                    <li>{{ ucfirst($contact->type) }}: {{ $contact->value }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Skills --}}
                    @if($applicant->skills->isNotEmpty())
                        <div class="mt-2">
                            <h4 class="font-medium text-gray-700">Skills:</h4>
                            <ul class="flex flex-wrap gap-2 mt-1">
                                @foreach($applicant->skills as $skill)
                                    <li class="px-2 py-1 bg-gray-200 text-gray-800 rounded text-sm">
                                        {{ $skill->skill_name }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Resume & Cover Letter --}}
                    <div class="mt-3 space-x-2">
                        @if($applicant->resume)
                            <a href="{{ route('appliedCandidates.viewResume', $applicant->id) }}" target="_blank" 
                               class="px-3 py-1 bg-blue-600 text-white rounded">View Resume</a>
                            <a href="{{ route('appliedCandidates.downloadResume', $applicant->id) }}" 
                               class="px-3 py-1 bg-green-600 text-white rounded">Download Resume</a>
                        @endif

                        @if($applicant->cover_letter)
                            <a href="{{ route('appliedCandidates.viewCoverLetter', $applicant->id) }}" target="_blank" 
                               class="px-3 py-1 bg-blue-600 text-white rounded">View Cover Letter</a>
                            <a href="{{ route('appliedCandidates.downloadCoverLetter', $applicant->id) }}" 
                               class="px-3 py-1 bg-green-600 text-white rounded">Download Cover Letter</a>
                        @endif
                    </div>

{{-- Accept / Reject --}}
@php
    $alreadyAccepted = \App\Models\CurrentJobs::where('job_id', $job->id)
                        ->where('applicant_id', $applicant->id)
                        ->exists();
@endphp

<div class="mt-3 flex gap-2">
    @if(!$alreadyAccepted)
    <form action="{{ route('appliedCandidates.accept', [$job->id, $applicant->id]) }}" method="POST" class="inline">
        @csrf
        <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">Accept</button>
    </form>
    @endif

    <form action="{{ route('appliedCandidates.reject', [$job->id, $applicant->id]) }}" method="POST" class="inline">
        @csrf
        <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">Reject</button>
    </form>
</div>


                </li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('applied.candidates.jobs') }}" 
       class="mt-6 inline-block px-3 py-1 bg-gray-600 text-white rounded">
       ← Back to Jobs
    </a>
</div>
@endsection
