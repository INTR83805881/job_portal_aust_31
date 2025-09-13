<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Jobs;

class JobViewController extends Controller
{
    /**
     * Show a single job details with organization and skillsets
     */
    public function show($id)
    {
        // Fetch the job with organization and jobSkillsets including linked skills
        $job = Jobs::with([
            'organization',        // organization info
            'jobSkillsets.skill'   // eager load each jobSkillset's skill
        ])->findOrFail($id);

        return view('job_view.index', compact('job'));
    }

    
}
