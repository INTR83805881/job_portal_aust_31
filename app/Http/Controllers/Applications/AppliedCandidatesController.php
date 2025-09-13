<?php

namespace App\Http\Controllers\Applications;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Organizations;
use App\Models\Applicaion_Form;

class AppliedCandidatesController extends Controller
{
    // Show applications for jobs posted by this organization
    public function index()
    {
        $user = Auth::user();

        // Find the organization belonging to logged-in user
        $organization = Organizations::where('user_id', $user->id)->first();

        if (!$organization) {
            return redirect()->route('home')->with('error', 'Organization profile not found.');
        }

        // Get applications only for jobs posted by this organization
        $applications = Applicaion_Form::whereHas('job', function ($q) use ($organization) {
                $q->where('organization_id', $organization->id);
            })
            ->with([
                'job.organization',
                'job.jobSkillsets.skill',   // load job skills
                'applicant.user',           // applicant's user (name/email)
                'applicant.applicantSkillsets.skill' // applicant skills
            ])
            ->get();

        return view('applied-candidates.index', compact('applications'));
    }
    }

