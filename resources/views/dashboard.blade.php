@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10">
    <h1 class="text-3xl font-bold">Welcome, {{ Auth::user()->name }} 🎉</h1>
    <p class="mt-4 text-gray-600">This is your dashboard.</p>
</div>
@endsection
