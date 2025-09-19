<?php

namespace App\Http\Controllers\Applications;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Organizations;
use App\Models\Jobs;
use App\Models\Applicants;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\Applicaion_Form;
use App\Models\CurrentJobs;

class AppliedCandidatesController extends Controller
{
    /**
     * Show jobs for the logged-in organization.
     */

        protected $candidatePdfs;

        public function __construct(
        CandidatePdfsController $candidatePdfs
    ) {
        $this->candidatePdfs = $candidatePdfs;
    }
    public function jobs()
{
    $user = Auth::user();

    // Find the organization profile for logged-in user
    $organization = Organizations::where('user_id', $user->id)->first();

    if (!$organization) {
        return redirect()->route('jobs')->with('error', 'Organization profile not found.');
    }

    // Fetch jobs that belong to this organization AND have applicants in the application forms table
    $jobs = Jobs::where('organization_id', $organization->id)
                ->whereHas('applications') // only jobs that have at least one application
                ->with(['skills', 'organization'])
                ->get();

    return view('applied-candidates.index', compact('jobs'));
}
    /**
     * Show applicants for a specific job.
     */
     public function candidates($jobId)
    {
        $user = Auth::user();

        $organization = Organizations::where('user_id', $user->id)->first();

        if (!$organization) {
            return redirect()->route('home')->with('error', 'Organization profile not found.');
        }

        $job = Jobs::with(['applications.applicant.user', 'applications.applicant.skills', 'applications.applicant.contacts'])
            ->where('organization_id', $organization->id)
            ->findOrFail($jobId);

        $applicants = $job->applications->map(fn($app) => $app->applicant);

        return view('candidates-info.index', compact('job', 'applicants'));
    }

    /**
     * View applicant pdfs (resume/cover letter).
     */
    public function viewResume($applicantId)
    {
        return $this->candidatePdfs->viewResume($applicantId);
    }

    public function downloadResume($applicantId)
    {
        return $this->candidatePdfs->downloadResume($applicantId);
    }

    public function viewCoverLetter($applicantId)
    {
        return $this->candidatePdfs->viewCoverLetter($applicantId);
    }

    public function downloadCoverLetter($applicantId)
    {
        return $this->candidatePdfs->downloadCoverLetter($applicantId);
    }


    

     public function accept($jobId, $applicantId)
    {
        $job = Jobs::findOrFail($jobId);

        // 1) Update job status to in_progress if it was enlisted
        if ($job->status === 'enlisted') {
            $job->status = 'in_progress';
            $job->save();
        }

        // 2) Insert into current_jobs if not exists
        $exists = CurrentJobs::where('job_id', $jobId)
                             ->where('applicant_id', $applicantId)
                             ->exists();

        if (!$exists) {
            CurrentJobs::create([
                'job_id' => $jobId,
                'applicant_id' => $applicantId,
                'assigned_at' => now(),
                'status' => 'in_progress',
            ]);
        }

        // 3) Delete all application forms for this job
        Applicaion_Form::where('jobs_id', $jobId)->delete();

        return redirect()->back()->with('success', 'Candidate accepted and job updated.');
    }

    /**
     * Reject a candidate
     */
    public function reject($jobId, $applicantId)
    {
        Applicaion_Form::where('jobs_id', $jobId)
                        ->where('applicant_id', $applicantId)
                        ->delete();

        return redirect()->back()->with('success', 'Candidate rejected.');
    }
}
