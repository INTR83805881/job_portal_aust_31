@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-center">Available Jobs</h1>

    @if(session('success'))
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 items-stretch">
        @foreach($jobs as $job)
            <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-xl transition duration-300 flex flex-col">
                <h3 class="text-xl font-semibold mb-2">{{ $job->title }}</h3>
                <p class="text-gray-700 mb-1"><strong>Company:</strong> {{ $job->organization->name ?? 'Unknown' }}</p>
                <p class="text-gray-700 mb-2"><strong>Location:</strong> {{ $job->location }}</p>
                <p class="text-gray-600 mb-4">{{ Str::limit($job->description, 150) }}</p>

                @guest
                    <a href="{{ route('login') }}" class="block bg-blue-500 text-white text-center py-2 px-4 rounded hover:bg-blue-600 transition duration-300 mt-auto">
                        Apply (Login First)
                    </a>
                @else
                    <form action="{{ route('jobs.apply', $job->id) }}" method="POST" class="mt-auto">
                        @csrf
                        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-300">
                            Apply
                        </button>
                    </form>
                @endguest
            </div>
        @endforeach
    </div>

    <!-- Pagination Links -->
    <div class="mt-8 flex justify-center">
        {{ $jobs->links() }}
    </div>
</div>
@endsection
