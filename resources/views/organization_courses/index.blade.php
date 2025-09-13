@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Organization Courses</h1>

    <div class="mb-6">
        <a href="{{ route('organization_courses.create') }}" 
           class="inline-block bg-blue-600 text-white px-5 py-2 rounded-lg shadow hover:bg-blue-700 transition">
            Add New Course
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 shadow rounded-lg">
            <thead class="bg-gray-100">
                <tr>
                    <th class="text-left px-4 py-2 font-semibold text-gray-700">ID</th>
                    <th class="text-left px-4 py-2 font-semibold text-gray-700">Organization</th>
                    <th class="text-left px-4 py-2 font-semibold text-gray-700">Applicant</th>
                    <th class="text-left px-4 py-2 font-semibold text-gray-700">Course Name</th>
                    <th class="text-left px-4 py-2 font-semibold text-gray-700">Course Title</th>
                    <th class="text-left px-4 py-2 font-semibold text-gray-700">Description</th>
                    <th class="text-left px-4 py-2 font-semibold text-gray-700">Apply</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                <tr class="border-t border-gray-200 hover:bg-gray-50 transition">
                    <td class="px-4 py-2">{{ $course->id }}</td>
                    <td class="px-4 py-2">{{ $course->organization->name ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $course->applicant->name ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $course->course_name }}</td>
                    <td class="px-4 py-2">{{ $course->course_title }}</td>
                    <td class="px-4 py-2">{{ $course->course_description }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('organization_courses.apply', $course->id) }}" 
                           class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition">
                            Apply
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
