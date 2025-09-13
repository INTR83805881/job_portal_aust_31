@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-sm p-6">
        {{-- Job Title --}}
        <h1 class="text-2xl font-bold mb-2">{{ $job->title }}</h1>
        
        {{-- Company Name --}}
        <p class="text-sm text-slate-500 mb-4">
            {{ $job->organization?->company_name ?? 'N/A' }}
        </p>

        {{-- Job Description --}}
        <div class="mb-4">
            <h2 class="font-semibold mb-1">Description</h2>
            <p class="text-slate-700">{{ $job->description }}</p>
        </div>

        {{-- Job Info Grid --}}
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <h3 class="font-semibold mb-1">Location</h3>
                <p>{{ $job->location }}</p>
            </div>
            <div>
                <h3 class="font-semibold mb-1">Employment Type</h3>
                <p>{{ ucfirst($job->employment_type) }}</p>
            </div>
            <div>
                <h3 class="font-semibold mb-1">Salary</h3>
                <p>{{ $job->salary ?? 'Negotiable' }}</p>
            </div>
            <div>
                <h3 class="font-semibold mb-1">Deadline</h3>
                <p>{{ $job->deadline }}</p>
            </div>
        </div>

        {{-- Skills Required --}}
        <div class="mb-4">
            <h3 class="font-semibold mb-2">Skills Required</h3>
            <div class="flex flex-wrap gap-2">
                @forelse($job->jobSkillsets as $jobSkill)
                    <span class="text-xs px-2 py-1 rounded-full bg-slate-100 text-slate-800">
                        {{ $jobSkill->skill?->skill_name ?? 'Unnamed Skill' }}
                    </span>
                @empty
                    <span class="text-xs px-2 py-1 rounded-full bg-slate-100 text-slate-500">
                        No skills listed
                    </span>
                @endforelse
            </div>
        </div>

        {{-- Buttons --}}
<div class="mt-6 flex gap-3">
    <form action="{{ route('jobs.apply') }}" method="POST">
        @csrf
        <input type="hidden" name="job_id" value="{{ $job->id }}">
        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
            Apply
        </button>
    </form>

    <form action="{{ route('jobs.addToCart') }}" method="POST">
        @csrf
        <input type="hidden" name="job_id" value="{{ $job->id }}">
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Add to Cart
        </button>
    </form>
</div>

{{-- Flash Messages --}}
@if(session('success'))
    <div class="mt-4 p-2 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="mt-4 p-2 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
@endif
        
@endsection
