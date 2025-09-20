@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-10">
    <!-- Page Header -->
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-extrabold text-gray-800">Organization Dashboard</h1>
        <p class="mt-2 text-gray-500">Manage job postings, candidates, and courses all in one place</p>
    </div>

    <!-- Dashboard Grid -->
    <div class="grid gap-6 md:grid-cols-3">
        <!-- Job Creation -->
        <a href="{{ route('job_creation.index') }}" 
           class="group bg-white rounded-2xl shadow hover:shadow-lg transition p-6 border border-gray-100">
            <div class="flex items-center justify-center w-12 h-12 bg-indigo-100 rounded-full mb-4 group-hover:bg-indigo-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-indigo-600 group-hover:text-indigo-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </div>
            <h2 class="text-lg font-semibold text-gray-800">Job Creation</h2>
            <p class="text-sm text-gray-500 mt-1">Post new job openings for applicants.</p>
        </a>

        <!-- Organization Courses -->
        <a href="{{ route('organization_courses.index') }}" 
           class="group bg-white rounded-2xl shadow hover:shadow-lg transition p-6 border border-gray-100">
            <div class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-full mb-4 group-hover:bg-green-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600 group-hover:text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 7V14m0 0L3 9m9 5l9 5" />
                </svg>
            </div>
            <h2 class="text-lg font-semibold text-gray-800">Organization Courses</h2>
            <p class="text-sm text-gray-500 mt-1">Manage and create learning programs.</p>
        </a>

        <!-- Minds -->
        <a href="{{ route('minds.index') }}" 
           class="group bg-white rounded-2xl shadow hover:shadow-lg transition p-6 border border-gray-100">
            <div class="flex items-center justify-center w-12 h-12 bg-purple-100 rounded-full mb-4 group-hover:bg-purple-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-purple-600 group-hover:text-purple-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a8 8 0 00-8-8H6a8 8 0 00-8 8v2h5m6 0v-6" />
                </svg>
            </div>
            <h2 class="text-lg font-semibold text-gray-800">Minds</h2>
            <p class="text-sm text-gray-500 mt-1">Connect and collaborate with talent.</p>
        </a>

        <!-- Applied Candidates -->
        <a href="{{ route('applied.candidates.jobs') }}" 
           class="group bg-white rounded-2xl shadow hover:shadow-lg transition p-6 border border-gray-100">
            <div class="flex items-center justify-center w-12 h-12 bg-yellow-100 rounded-full mb-4 group-hover:bg-yellow-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-yellow-600 group-hover:text-yellow-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a8 8 0 00-8-8H6a8 8 0 00-8 8v2h5m6 0v-6" />
                </svg>
            </div>
            <h2 class="text-lg font-semibold text-gray-800">Applied Candidates</h2>
            <p class="text-sm text-gray-500 mt-1">Review and manage candidate applications.</p>
        </a>

        <!-- Current Jobs -->
        <a href="{{ route('organization-current-jobs.index') }}" 
           class="group bg-white rounded-2xl shadow hover:shadow-lg transition p-6 border border-gray-100">
            <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full mb-4 group-hover:bg-blue-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600 group-hover:text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c.88 0 1.67.39 2.22 1H19v9a2 2 0 01-2 2H7a2 2 0 01-2-2V9h4.78A2.99 2.99 0 0112 8z" />
                </svg>
            </div>
            <h2 class="text-lg font-semibold text-gray-800">Current Jobs</h2>
            <p class="text-sm text-gray-500 mt-1">Manage ongoing job postings.</p>
        </a>
    </div>
</div>
@endsection
