<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Jobs;

class JobViewController extends Controller
{
    /**
     * Show a single job details
     */
    public function show($id)
    {
        // Fetch the job with organization and skills
        $job = Jobs::with(['organization', 'jobSkillsets'])->findOrFail($id);

        return view('job_view.index', compact('job'));
    }
}
