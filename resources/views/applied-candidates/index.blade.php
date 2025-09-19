@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-6">
    <h2 class="text-2xl font-bold mb-4">Jobs Posted by Your Organization</h2>

    @if($jobs->isEmpty())
        <p class="text-gray-600">No jobs applied for currently.</p>
    @else
        <ul class="space-y-4">
            @foreach($jobs as $job)
                <li class="p-4 border rounded bg-white shadow">
                    <h3 class="text-lg font-semibold">{{ $job->title }}</h3>
                    <p class="text-gray-700">{{ $job->description }}</p>
                    <p class="text-sm text-gray-500">Deadline: {{ $job->deadline }}</p>

                  {{-- Organization info --}}
@if($job->organization)
    <p class="text-sm text-gray-500 mt-1">
        Organization: <span class="font-medium">{{ $job->organization->company_name }} (ID: {{ $job->organization->id }})</span>
    </p>
@endif


                    {{-- Skills --}}
                    @if($job->skills->isNotEmpty())
                        <div class="mt-2">
                            <h4 class="font-medium text-gray-700">Required Skills:</h4>
                            <ul class="flex flex-wrap gap-2 mt-1">
                                @foreach($job->skills as $skill)
                                    <li class="px-2 py-1 bg-gray-200 text-gray-800 rounded text-sm">
                                        {{ $skill->skill_name }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <a href="{{ route('applied.candidates.candidates', $job->id) }}" 
                       class="mt-2 inline-block px-3 py-1 bg-blue-600 text-white rounded">
                       View Applicants
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
