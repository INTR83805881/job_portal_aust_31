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

      public function apply(Request $request)
    {
        $request->validate([
            'job_id' => 'required|exists:jobs,id',
        ]);

        $user = $request->user();

        // Prevent duplicate applications
        $exists = Applicaion_Form::where('job_id', $request->job_id)
                                  ->where('applicant_id', $user->id)
                                  ->exists();
        if ($exists) {
            return back()->with('error', 'You have already applied for this job.');
        }

        Applicaion_Form::create([
            'job_id' => $request->job_id,
            'applicant_id' => $user->id,
        ]);

        return back()->with('success', 'Successfully applied for this job.');
    }

    /**
     * Add a job to cart: store in job_carts table
     */
    public function addToCart(Request $request)
    {
        $request->validate([
            'job_id' => 'required|exists:jobs,id',
        ]);

        $user = $request->user();

        // Prevent duplicates in cart
        $exists = JobCart::where('job_id', $request->job_id)
                         ->where('applicant_id', $user->id)
                         ->exists();
        if ($exists) {
            return back()->with('error', 'This job is already in your cart.');
        }

        JobCart::create([
            'job_id' => $request->job_id,
            'applicant_id' => $user->id,
        ]);

        return back()->with('success', 'Job added to your cart.');
    }
}
