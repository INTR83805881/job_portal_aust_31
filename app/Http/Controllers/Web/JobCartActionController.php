<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobCart;
use App\Models\Applicants;
use App\Models\Applicaion_Form;

class JobCartActionController extends Controller
{
    // Apply for a job from cart
    public function apply(Request $request, $jobId)
    {
        $user = $request->user();

        $applicant = Applicants::where('user_id', $user->id)->first();

        if (!$applicant) {
            return back()->with('error', 'You are not registered as an applicant yet.');
        }

        // Prevent duplicate applications
        $exists = Applicaion_Form::where('jobs_id', $jobId)
            ->where('applicant_id', $applicant->id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'You already applied for this job.');
        }

        // Store in application_forms
        Applicaion_Form::create([
            'jobs_id' => $jobId,
            'applicant_id' => $applicant->id,
        ]);

        // Remove from job cart if exists
        JobCart::where('jobs_id', $jobId)
            ->where('applicant_id', $applicant->id)
            ->delete();

        return back()->with('success', 'Successfully applied for this job.');
    }
}
