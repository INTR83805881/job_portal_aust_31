<?php

namespace App\Http\Controllers\FinishedWorks;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Organizations;
use App\Models\Jobs;
use App\Models\JobCompletion;
use App\Models\WorkSubmit;

class OrganizationFinishedWorksController extends Controller
{
    public function index()
    {
        $user = Auth::user();

       
        $organization = Organizations::where('user_id', $user->id)->first();
        if (!$organization) {
            return redirect()->route('home')->with('error', 'You are not authorized to view this page.');
        }

       
        $jobIds = Jobs::where('organization_id', $organization->id)->pluck('id');

        
        $completions = JobCompletion::with(['job', 'applicant.user'])
            ->whereIn('job_id', $jobIds)
            ->get();

       
        foreach ($completions as $completion) {
            $completion->work = WorkSubmit::where('job_id', $completion->job_id)->first();
        }

        return view('organization-finished-works.index', compact('completions'));
    }
}
