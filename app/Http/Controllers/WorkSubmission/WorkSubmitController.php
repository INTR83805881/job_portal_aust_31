<?php

namespace App\Http\Controllers\WorkSubmission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Applicants;
use App\Models\WorkSubmit;
use App\Models\CurrentJobs;

class WorkSubmitController extends Controller
{
 public function create($jobId)
{
    $user = Auth::user();
    $applicant = Applicants::where('user_id', $user->id)->firstOrFail();

    // Fetch current job
    $currentJob = CurrentJobs::where('job_id', $jobId)
                    ->where('applicant_id', $applicant->id)
                    ->firstOrFail();

    // Check if a submission already exists
    $workSubmit = WorkSubmit::where('job_id', $jobId)
                    ->where('applicant_id', $applicant->id)
                    ->first();

    return view('work-submit.index', compact('currentJob', 'workSubmit'));
}


    public function index($jobId)
    {
        $user = Auth::user();
        $applicant = Applicants::where('user_id', $user->id)->first();

        if (!$applicant) {
            return redirect()->route('profile.page')->with('error', 'You are not an applicant.');
        }

        // Fetch work submit entry if exists
        $workSubmit = WorkSubmit::where('job_id', $jobId)
                                ->where('applicant_id', $applicant->id)
                                ->first();

        return view('work-submit.index', compact('workSubmit', 'jobId', 'applicant'));
    }

public function store(Request $request, $jobId)
{
    $request->validate([
        'work_file_path' => 'required|url',
    ]);

    $user = Auth::user();
    $applicant = Applicants::where('user_id', $user->id)->firstOrFail();

    $workSubmit = WorkSubmit::where('job_id', $jobId)
                            ->where('applicant_id', $applicant->id)
                            ->first();

    if ($workSubmit) {
        // Update existing
        $workSubmit->update([
            'work_file_path' => $request->work_file_path,
        ]);
        return back()->with('success', 'Work link updated successfully!');
    } else {
        // Create new
        WorkSubmit::create([
            'job_id' => $jobId,
            'applicant_id' => $applicant->id,
            'work_file_path' => $request->work_file_path,
        ]);
        return back()->with('success', 'Work link submitted successfully!');
    }
}

public function update(Request $request, $jobId)
{
    $request->validate([
        'work_file_path' => 'required|url',
    ]);

    $user = Auth::user();
    $applicant = Applicants::where('user_id', $user->id)->firstOrFail();

    $workSubmit = WorkSubmit::where('job_id', $jobId)
                            ->where('applicant_id', $applicant->id)
                            ->firstOrFail();

    $workSubmit->update([
        'work_file_path' => $request->work_file_path,
    ]);

    return back()->with('success', 'Work link updated successfully!');
}

}
