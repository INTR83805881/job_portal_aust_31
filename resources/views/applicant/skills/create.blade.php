@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Skill</h2>
    <form action="{{ route('skills.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="skill_name" class="form-label">Skill Name</label>
            <input type="text" name="skill_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="proficiency" class="form-label">Proficiency (optional)</label>
            <input type="text" name="proficiency" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Add Skill</button>
    </form>
</div>
@endsection
