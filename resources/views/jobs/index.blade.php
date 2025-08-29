@extends('layouts.app')

@section('content')
<h1>Available Jobs</h1>

@if(session('success'))
    <div style="color: green; font-weight:bold;">
        {{ session('success') }}
    </div>
@endif

@foreach($jobs as $job)
    <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
        <h3>{{ $job->title }}</h3>
        <p><strong>Company:</strong> {{ $job->organization->name ?? 'Unknown' }}</p>
        <p><strong>Location:</strong> {{ $job->location }}</p>
        <p>{{ $job->description }}</p>

        @guest
            <a href="{{ route('login') }}" class="btn btn-primary">Apply (Login First)</a>
        @else
            <form action="{{ route('jobs.apply', $job->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Apply</button>
            </form>
        @endguest
    </div>
@endforeach

<!-- Pagination Links -->
{{ $jobs->links() }}
@endsection
