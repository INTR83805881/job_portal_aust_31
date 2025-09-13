@extends('layouts.app')

@section('title', 'About Us - Job Axis')

@section('content')
<div class="container mx-auto py-16 px-4 sm:px-6 lg:px-20">
    <div class="text-center max-w-3xl mx-auto">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-6">About Us</h1>
        <p class="text-lg text-gray-700 mb-6">
            <span class="font-semibold text-indigo-600">Job Axis</span> is a platform created with a mission to help individuals connect with job opportunities efficiently and effectively. Whether you're a fresh graduate or a seasoned professional, Job Axis bridges the gap between job seekers and the right employers.
        </p>
        <p class="text-gray-600 mb-12">
            This project is developed by a passionate group of students dedicated to making a difference in the job market landscape.
        </p>
    </div>

    <div class="text-center mb-10">
        <h2 class="text-3xl font-bold text-gray-900">Meet Our Team</h2>
        <p class="mt-2 text-gray-600">The brilliant minds behind Job Axis</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <!-- Team Member Card -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
            <div class="p-6">
                <div class="h-32 w-32 mx-auto rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-3xl font-bold mb-4">
                    JT
                </div>
                <h3 class="text-xl font-semibold text-gray-900 text-center">Jabin Tasnim</h3>
                <p class="text-gray-500 text-center mt-1">ID: 58</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
            <div class="p-6">
                <div class="h-32 w-32 mx-auto rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-3xl font-bold mb-4">
                    FN
                </div>
                <h3 class="text-xl font-semibold text-gray-900 text-center">Faiad Nakib</h3>
                <p class="text-gray-500 text-center mt-1">ID: 80</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
            <div class="p-6">
                <div class="h-32 w-32 mx-auto rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-3xl font-bold mb-4">
                    SR
                </div>
                <h3 class="text-xl font-semibold text-gray-900 text-center">Sadeed Rahman</h3>
                <p class="text-gray-500 text-center mt-1">ID: 81</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
            <div class="p-6">
                <div class="h-32 w-32 mx-auto rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-3xl font-bold mb-4">
                    AI
                </div>
                <h3 class="text-xl font-semibold text-gray-900 text-center">Ariyan Islam</h3>
                <p class="text-gray-500 text-center mt-1">ID: 83</p>
            </div>
        </div>
    </div>
</div>
@endsection
