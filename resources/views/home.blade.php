@extends('layouts.app')

@section('content')
<section class="relative w-full min-h-screen flex flex-col items-center justify-center text-center bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 text-white px-6">
    
    {{-- Title --}}
    <h1 class="text-5xl sm:text-6xl md:text-7xl font-extrabold tracking-tight leading-tight drop-shadow-lg">
        Welcome to <span class="text-yellow-400">Job Axis</span>
    </h1>

    {{-- Subtitle --}}
    <p class="mt-6 text-xl sm:text-2xl text-gray-200 max-w-2xl">
        Your gateway to finding the <span class="font-bold text-white">perfect job</span>. 🚀
    </p>

    {{-- Button --}}
    <div class="mt-10">
        <a href="{{ route('jobs.index') }}"
           class="inline-block px-8 py-4 text-lg font-semibold rounded-full bg-white text-indigo-700 hover:bg-yellow-400 hover:text-gray-900 shadow-lg transform hover:scale-105 transition-all">
            Explore Jobs →
        </a>
    </div>

</section>
@endsection
