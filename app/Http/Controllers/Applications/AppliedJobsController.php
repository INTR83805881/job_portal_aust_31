<?php

namespace App\Http\Controllers\Applications;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Applicaion_Form;
use App\Models\Applicants;

class AppliedJobsController extends Controller
{
    /*
    public function __construct()
    {
        $this->middleware('auth');
    }
*/
    // Show applied jobs for logged-in applicant
    public function index()
    {
        $user = Auth::user();

        $applicant = Applicants::where('user_id', $user->id)->first();

        if (!$applicant) {
            return redirect()->route('profile.page')->with('error', 'Applicant profile not found.');
        }

        $appliedJobs = Applicaion_Form::where('applicant_id', $applicant->id)
            ->with('job.organization', 'job.jobSkillsets.skill')
            ->get();

        return view('applied-jobs.index', compact('appliedJobs'));
    }

    public function remove($applicationId)
{
    $user = Auth::user();
    $applicant = Applicants::where('user_id', $user->id)->first();

    if (!$applicant) {
        return redirect()->route('profile.page')->with('error', 'Applicant profile not found.');
    }

    $application = Applicaion_Form::where('id', $applicationId)
        ->where('applicant_id', $applicant->id)
        ->first();

    if (!$application) {
        return back()->with('error', 'Application not found.');
    }

    $application->delete();

    return back()->with('success', 'Application removed successfully.');
}

}
