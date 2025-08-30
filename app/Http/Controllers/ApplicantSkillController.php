<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApplicantSkill;
use Illuminate\Support\Facades\Auth;

class ApplicantSkillController extends Controller
{
    // Show logged-in user's skills
    public function index()
    {
        $skills = ApplicantSkill::where('user_id', Auth::id())->get();
        return view('applicant.skills.index', compact('skills'));
    }

    // Show form to add new skill
    public function create()
    {
        return view('applicant.skills.create');
    }

    // Store new skill
    public function store(Request $request)
    {
        $request->validate([
            'skill_name' => 'required|string|max:255',
            'proficiency' => 'nullable|string|max:100'
        ]);

        ApplicantSkill::create([
            'user_id' => Auth::id(),
            'skill_name' => $request->skill_name,
            'proficiency' => $request->proficiency
        ]);

        return redirect()->route('applicant.skills.index')->with('success', 'Skill added successfully!');
    }
}
