@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-6">
    <h2 class="text-2xl font-bold mb-4">Work Submissions for Job ID: {{ $jobId }}</h2>

    @if(session('success'))
        <div class="mb-4 p-2 bg-green-200 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($workSubmissions->isEmpty())
        <p class="text-gray-600">No submissions found for this job.</p>
    @else
        <div class="space-y-6">
            @foreach($workSubmissions as $submission)
                <div class="p-6 border rounded-lg bg-white shadow">

                    {{-- Applicant Info --}}
                    <div class="mb-4 p-3 bg-gray-100 rounded">
                        <p><strong>Name:</strong> {{ $submission->applicant->user->name ?? 'Unknown' }}</p>
                        <p><strong>Address:</strong> {{ $submission->applicant->address ?? 'N/A' }}</p>
                        <p><strong>Qualification:</strong> {{ $submission->applicant->qualification ?? 'N/A' }}</p>
                    </div>

                    {{-- Work Submission --}}
                    <p><strong>Work Link:</strong>
                        <a href="{{ $submission->work_file_path }}" target="_blank" class="text-blue-600 underline">
                            {{ $submission->work_file_path }}
                        </a>
                    </p>

                    {{-- Feedback Form --}}
                    <form action="{{ route('work-check.feedback.update', $submission->id) }}" method="POST" class="mt-4 space-y-2">
                        @csrf
                        <div>
                            <label class="block font-medium mb-1">Feedback</label>
                            <textarea name="feedback" class="border rounded p-2 w-full" rows="3">{{ $submission->feedback }}</textarea>
                        </div>
                        <div>
                            <label class="block font-medium mb-1">Rating (1-5)</label>
                            <input type="number" name="rating" min="1" max="5" value="{{ $submission->rating ?? '' }}" class="border rounded p-2 w-20">
                        </div>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update Feedback</button>
                    </form>

                    {{-- Accept & Terminate Buttons --}}
                    <div class="mt-4 flex space-x-4">
                        <form action="{{ route('work-check.accept', [$jobId, $submission->applicant_id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">
                                Accept Job
                            </button>
                        </form>
                        <form action="{{ route('work-check.terminate', [$jobId, $submission->applicant_id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded">
                                Terminate Employee
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
