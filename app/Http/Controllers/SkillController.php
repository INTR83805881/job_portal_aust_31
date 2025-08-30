<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApplicantSkill;
use Illuminate\Support\Facades\Auth;

class SkillController extends Controller
{
    public function index()
    {
        $skills = ApplicantSkill::where('user_id', Auth::id())->get();
        return view('skills.index', compact('skills'));
    }

    public function create()
    {
        return view('skills.create'); // A form to add skills
    }

    public function store(Request $request)
    {
        $request->validate([
            'skill_name' => 'required|string|max:255',
            'proficiency' => 'nullable|string|max:255'
        ]);

        ApplicantSkill::create([
            'user_id' => Auth::id(),
            'skill_name' => $request->skill_name,
            'proficiency' => $request->proficiency,
        ]);

        return redirect()->route('skills.index')->with('success', 'Skill added successfully!');
    }
}
