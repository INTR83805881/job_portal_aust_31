@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Your Skills</h2>
    <a href="{{ route('skills.create') }}" class="btn btn-success mb-3">Add New Skill</a>
    <ul class="list-group">
        @foreach($skills as $skill)
            <li class="list-group-item">
                {{ $skill->skill_name }} - {{ $skill->proficiency ?? 'N/A' }}
            </li>
        @endforeach
    </ul>
</div>
@endsection
