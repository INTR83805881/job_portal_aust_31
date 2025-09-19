@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-6">
    <h2 class="text-2xl font-bold mb-4">Submit Work for {{ $currentJob->job->title }}</h2>

    @if(session('success'))
        <div class="mb-4 p-2 bg-green-200 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ $workSubmit ? route('work.submission.update', $currentJob->job->id) 
                                 : route('work.submission.store', $currentJob->job->id) }}" 
          method="POST">
        @csrf
        @if($workSubmit)
            @method('PATCH') {{-- Use PATCH if updating existing submission --}}
        @endif

        <div class="mb-4">
            <label class="block font-medium mb-2">Work Link (URL)</label>
            <input type="url" name="work_file_path" class="border rounded p-2 w-full" 
                   value="{{ $workSubmit->work_file_path ?? '' }}" required>

            @error('work_file_path')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror

            @if($workSubmit)
                <div class="mt-3 text-gray-700">
                    @if($workSubmit->rating)
                        <p><strong>Rating:</strong> {{ $workSubmit->rating }}/5</p>
                    @endif
                    @if($workSubmit->feedback)
                        <p><strong>Feedback:</strong> {{ $workSubmit->feedback }}</p>
                    @endif
                    <p class="text-sm text-gray-500">You can update your work link above.</p>
                </div>
            @endif
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
            {{ $workSubmit ? 'Update Work Link' : 'Submit Work Link' }}
        </button>
    </form>
</div>
@endsection
