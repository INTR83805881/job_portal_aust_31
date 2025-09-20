<?php

namespace App\Http\Controllers\WorkSubmission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Organizations;
use App\Models\WorkSubmit;
use App\Models\CurrentJobs;
use App\Models\Jobs;
use App\Models\JobCompletion;

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

public function acceptJob($jobId, $applicantId)
{
    $user = Auth::user();

    $organization = Organizations::where('user_id', $user->id)->first();
    if (!$organization) {
        return redirect()->route('profile.page')->with('error', 'Unauthorized access.');
    }

    $job = Jobs::findOrFail($jobId);

    // 1) Update job status to completed if it was in_progress
    if ($job->status === 'in_progress') {
        $job->status = 'completed';
        $job->save();
    }

    // 2) Always insert into job_completions
    JobCompletion::create([
        'job_id'       => $jobId,
        'applicant_id' => $applicantId,
        'completed_at' => now(),
    ]);

    // 3) Delete from current_jobs
    CurrentJobs::where('job_id', $jobId)
        ->where('applicant_id', $applicantId)
        ->delete();

    return redirect()->back()->with('success', 'Job accepted, marked as completed, and moved to job completions.');
}

    // Terminate Employee
   public function terminateEmployee($jobId, $applicantId)
{
    $user = Auth::user();
    $organization = Organizations::where('user_id', $user->id)->first();

    if (!$organization) {
        return redirect()->route('profile.page')->with('error', 'Unauthorized access.');
    }

    // 1) Update job status back to enlisted if it was in_progress
    $job = Jobs::findOrFail($jobId);
    if ($job->status === 'in_progress') {
        $job->status = 'enlisted';
        $job->save();
    }

    // 2) Remove the applicant from current_jobs
    CurrentJobs::where('job_id', $jobId)
        ->where('applicant_id', $applicantId)
        ->delete();

    return back()->with('success', 'Employee terminated and job status reverted to enlisted.');
}

}
