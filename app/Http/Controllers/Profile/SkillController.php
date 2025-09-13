<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Applicants;

class SkillController extends Controller
{
    public function storeApplicantSkill(Request $request)
    {
        $request->validate([
            'skill_id' => 'required|exists:skills,id',
        ]);

        $applicant = Applicants::where('user_id', auth()->id())->firstOrFail();

        if ($applicant->skills()->where('skill_id', $request->skill_id)->exists()) {
            return redirect()->route('profile.page')->with('error', 'Skill already added!');
        }

        $applicant->skills()->attach($request->skill_id);

        return redirect()->route('profile.page')->with('success', 'Skill added!');
    }
}
