<?php

namespace App\Http\Controllers\WorkSubmission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Organizations;
use App\Models\WorkSubmit;
use App\Models\CurrentJobs;

class WorkCheckController extends Controller
{
    // Show work submissions for a specific job
    public function index($jobId)
    {
        $user = Auth::user();

        // Ensure user is an organization
        $organization = Organizations::where('user_id', $user->id)->first();
        if (!$organization) {
            return redirect()->route('profile.page')->with('error', 'Unauthorized access.');
        }

        // Get all applicants assigned to this job
        $currentJobEntries = CurrentJobs::with('applicant')
            ->where('job_id', $jobId)
            ->get();

        // Load work submissions for these applicants
        $workSubmissions = WorkSubmit::where('job_id', $jobId)
            ->whereIn('applicant_id', $currentJobEntries->pluck('applicant_id'))
            ->get()
            ->keyBy('applicant_id'); // So we can quickly access submission per applicant

        return view('work-check.index', compact('currentJobEntries', 'workSubmissions', 'jobId'));
    }

    // Update feedback and rating for a submission
    public function updateFeedback(Request $request, $submissionId)
    {
        $request->validate([
            'feedback' => 'nullable|string|max:1000',
            'rating'   => 'nullable|integer|min:1|max:5',
        ]);

        $user = Auth::user();
        $organization = Organizations::where('user_id', $user->id)->first();
        if (!$organization) {
            return redirect()->route('profile.page')->with('error', 'Unauthorized access.');
        }

        $workSubmit = WorkSubmit::findOrFail($submissionId);
        $workSubmit->update([
            'feedback' => $request->feedback,
            'rating'   => $request->rating,
        ]);

        return back()->with('success', 'Feedback and rating updated successfully.');
    }
}
