<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jobs;
use App\Models\Applicaion_Form;
use App\Models\JobCart;

class JobActionController extends Controller
{
    /**
     * Apply for a job: store in application_forms table
     */
    public function apply(Request $request)
    {
        $request->validate([
            'job_id' => 'required|exists:jobs,id',
        ]);

        $user = $request->user();

       $applicant = \App\Models\Applicants::where('user_id', $user->id)->first();

if (!$applicant) {
    return back()->with('error', 'You are not registered as an applicant yet.');
}

        // Prevent duplicate applications
       $exists = Applicaion_Form::where('jobs_id', $request->job_id)
                          ->where('applicant_id', $applicant->id)
                          ->exists();

                          if ($exists) {
            return back()->with('error', 'You already applied for this job.');
        }

Applicaion_Form::create([
    'jobs_id' => $request->job_id,
    'applicant_id' => $applicant->id,
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

        $applicant = \App\Models\Applicants::where('user_id', $user->id)->first();

if (!$applicant) {
    return back()->with('error', 'You are not registered as an applicant yet.');
}
        // Prevent duplicates in cart
          $exists = JobCart::where('jobs_id', $request->job_id)
                          ->where('applicant_id', $applicant->id)
                          ->exists();

                          if ($exists) {
            return back()->with('error', 'This job is already in your cart.');
        }

JobCart::create([
    'jobs_id' => $request->job_id,
    'applicant_id' => $applicant->id,
]);

        return back()->with('success', 'Job added to your cart.');
    }
}
