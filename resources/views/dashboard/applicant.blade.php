@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-10">
    <!-- Page Header -->
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-extrabold text-gray-800">Applicant Dashboard</h1>
        <p class="mt-2 text-gray-500">Manage your job applications and stay on track</p>
    </div>

    <!-- Dashboard Grid -->
    <div class="grid gap-6 md:grid-cols-3">
        <!-- Job Cart -->
        <a href="{{ route('job-cart.index') }}" 
           class="group bg-white rounded-2xl shadow hover:shadow-lg transition p-6 border border-gray-100">
            <div class="flex items-center justify-center w-12 h-12 bg-indigo-100 rounded-full mb-4 group-hover:bg-indigo-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-indigo-600 group-hover:text-indigo-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7A1 1 0 007 17h10m-5-4v4m-2-4h4" />
                </svg>
            </div>
            <h2 class="text-lg font-semibold text-gray-800">Job Cart</h2>
            <p class="text-sm text-gray-500 mt-1">View and manage jobs saved to your cart.</p>
        </a>

        <!-- Applied Jobs -->
        <a href="{{ route('applied-jobs.index') }}" 
           class="group bg-white rounded-2xl shadow hover:shadow-lg transition p-6 border border-gray-100">
            <div class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-full mb-4 group-hover:bg-green-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600 group-hover:text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4-4m6 2a9 9 0 11-18 0a9 9 0 0118 0z" />
                </svg>
            </div>
            <h2 class="text-lg font-semibold text-gray-800">Applied Jobs</h2>
            <p class="text-sm text-gray-500 mt-1">Track the jobs you’ve applied for.</p>
        </a>

        <!-- Current Jobs -->
        <a href="{{ route('applicant.current-jobs.index') }}" 
           class="group bg-white rounded-2xl shadow hover:shadow-lg transition p-6 border border-gray-100">
            <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full mb-4 group-hover:bg-blue-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600 group-hover:text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c.88 0 1.67.39 2.22 1H19v9a2 2 0 01-2 2H7a2 2 0 01-2-2V9h4.78A2.99 2.99 0 0112 8z" />
                </svg>
            </div>
            <h2 class="text-lg font-semibold text-gray-800">Current Jobs</h2>
            <p class="text-sm text-gray-500 mt-1">See your ongoing job opportunities.</p>
        </a>

        <!-- Finished Works -->
        <a href="{{ route('finished-works.index') }}" 
           class="group bg-white rounded-2xl shadow hover:shadow-lg transition p-6 border border-gray-100">
            <div class="flex items-center justify-center w-12 h-12 bg-pink-100 rounded-full mb-4 group-hover:bg-pink-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-pink-600 group-hover:text-pink-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20l9-5-9-5-9 5 9 5zm0-7V4m0 9l-9 5" />
                </svg>
            </div>
            <h2 class="text-lg font-semibold text-gray-800">Finished Works</h2>
            <p class="text-sm text-gray-500 mt-1">Review your completed jobs and feedback.</p>
        </a>
    </div>
</div>
@endsection
