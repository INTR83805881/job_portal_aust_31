<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ApplicantSkill;
use Illuminate\Support\Facades\Auth;

class SkillController extends Controller
{
    public function index()
    {
        return response()->json([
            'skills' => ApplicantSkill::where('user_id', Auth::id())->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'skill_name' => 'required|string|max:255',
            'proficiency' => 'nullable|string|max:255'
        ]);

        $skill = ApplicantSkill::create([
            'user_id' => Auth::id(),
            'skill_name' => $request->skill_name,
            'proficiency' => $request->proficiency,
        ]);

        return response()->json([
            'message' => 'Skill added successfully',
            'data' => $skill
        ], 201);
    }

    public function destroy($id)
    {
        $skill = ApplicantSkill::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$skill) {
            return response()->json(['message' => 'Skill not found'], 404);
        }

        $skill->delete();

        return response()->json(['message' => 'Skill deleted successfully'], 200);
    }
}
