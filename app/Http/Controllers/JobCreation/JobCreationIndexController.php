<?php

namespace App\Http\Controllers\JobCreation;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Organizations;
use App\Models\Jobs;

class JobCreationIndexController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();

        $organization = Organizations::where('user_id', $user->id)->first();
        if (!$organization) {
            return redirect()->route('profile.page')
                ->with('error', 'You must be an organization to access this page.');
        }

        $jobs = Jobs::where('organization_id', $organization->id)->get();

        return view('job_creation.index', compact('organization', 'jobs'));
    }
}
