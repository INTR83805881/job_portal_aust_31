@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-6">
    <h2 class="text-2xl font-bold mb-4">Your Finished Works</h2>

    @if($completions->isEmpty())
        <p class="text-gray-600">You don’t have any finished jobs yet.</p>
    @else
        <div class="space-y-6">
            @foreach($completions as $completion)
                <div class="p-6 border rounded-lg bg-white shadow">
                    <h3 class="text-xl font-semibold mb-2">
                        {{ $completion->job->title ?? 'Unknown Job' }}
                    </h3>
                    <p><strong>Completed At:</strong> {{ $completion->completed_at?->format('d M Y, H:i') }}</p>

                    @if($completion->work)
                        <p class="mt-2">
                            <strong>Work File:</strong>
                            <a href="{{ $completion->work->work_file_path }}" target="_blank" class="text-blue-600 underline">
                                {{ $completion->work->work_file_path }}
                            </a>
                        </p>
                        <p class="mt-2"><strong>Feedback:</strong> {{ $completion->work->feedback ?? 'No feedback yet' }}</p>
                        <p><strong>Rating:</strong> 
                            @if($completion->work->rating)
                                {{ $completion->work->rating }}/5
                            @else
                                Not rated yet
                            @endif
                        </p>
                    @else
                        <p class="text-gray-600 mt-2">No work submission linked to this job.</p>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
