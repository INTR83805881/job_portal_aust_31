<?php

namespace App\Http\Controllers\FinishedWorks;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Applicants;
use App\Models\JobCompletion;
use App\Models\WorkSubmit;

class FinishedWorksController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Check if user is an applicant
        $applicant = Applicants::where('user_id', $user->id)->first();
        if (!$applicant) {
            return redirect()->route('home')->with('error', 'You are not authorized to view this page.');
        }

        // Get all job completions for this applicant
        $completions = JobCompletion::with('job')
            ->where('applicant_id', $applicant->id)
            ->get();

        // Attach related work submissions
        foreach ($completions as $completion) {
            $completion->work = WorkSubmit::where('job_id', $completion->job_id)
                ->where('applicant_id', $completion->applicant_id)
                ->first();
        }

        return view('applicant-finished-works.index', compact('completions'));
    }
}
