<?php
namespace App\Http\Controllers\CurrentJobs;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Applicants;
use App\Models\CurrentJobs;

class ApplicantCurrentJobsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Check if logged-in user is an applicant
        $applicant = Applicants::where('user_id', $user->id)->first();

        if (!$applicant) {
            return redirect()->route('profile.page')->with('error', 'You are not an applicant.');
        }

        // Get current jobs for this applicant
        $currentJobs = CurrentJobs::with('job') // eager load the job
                        ->where('applicant_id', $applicant->id)
                        ->get();

        return view('applicant-current-jobs.index', compact('currentJobs'));
    }
    
public function destroy($id)
{
    $user = Auth::user();

    $applicant = Applicants::where('user_id', $user->id)->first();
    if (!$applicant) {
        return redirect()->route('profile.page')->with('error', 'You are not an applicant.');
    }

  
    $currentJob = CurrentJobs::where('id', $id)
                    ->where('applicant_id', $applicant->id)
                    ->first();

    if (!$currentJob) {
        return redirect()->route('applicant.current-jobs.index')->with('error', 'Job not found or not authorized.');
    }

  
    $job = $currentJob->job; 
    if ($job && $currentJob->status === 'in_progress') {
        $job->status = 'enlisted';
        $job->save();
    }

    // 2) Delete the current_jobs entry
    $currentJob->delete();

    return redirect()->route('applicant.current-jobs.index')->with('success', 'You have left the job and job status updated.');
}
}
