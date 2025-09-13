<?php

namespace App\Http\Controllers\JobCreation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organizations;
use App\Models\Jobs;

class JobCreationSkillController extends Controller
{
    public function __invoke(Request $request, $id)
    {
        $request->validate([
            'skill_id' => 'required|exists:skills,id',
        ]);

        $organization = Organizations::where('user_id', auth()->id())->firstOrFail();
        $job = Jobs::where('organization_id', $organization->id)->findOrFail($id);

        if ($job->skills()->where('skill_id', $request->skill_id)->exists()) {
            return redirect()->route('job_creation.index')->with('error', 'Skill already added!');
        }

        $job->skills()->attach($request->skill_id);

        return redirect()->route('job_creation.index')->with('success', 'Skill added!');
    }
}
