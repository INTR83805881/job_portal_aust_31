<?php

namespace App\Http\Controllers\CurrentJobs;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Organizations;
use App\Models\CurrentJobs;

class OrganizationCurrentJobsController extends Controller
{
  public function index()
{
    $user = Auth::user();

    $organization = Organizations::where('user_id', $user->id)->first();

    if (!$organization) {
        return redirect()->route('profile-page')->with('error', 'You are not an organization.');
    }

    // Get current jobs for this organization
    $currentJobs = CurrentJobs::with(['job', 'applicant'])
        ->whereHas('job', function ($query) use ($organization) {
            $query->where('organization_id', $organization->id);
        })
        ->get()
        ->groupBy('job_id'); // Group by job so each job appears once

    return view('organization-current-jobs.index', compact('currentJobs'));
}
}
