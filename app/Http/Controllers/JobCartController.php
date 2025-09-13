<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JobCart;
use App\Models\Applicants;
use App\Models\Applicaion_Form;

class JobCartController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $applicant = Applicants::where('user_id', $user->id)->first();

        if (!$applicant) {
            return redirect()->route('profile.page')->with('error', 'Applicant profile not found.');
        }

        // Eager load job and filter out null jobs
        $jobsInCart = JobCart::where('applicant_id', $applicant->id)
            ->with('job')
            ->get()
            ->filter(function($cartItem) {
                return $cartItem->job !== null;
            });

        return view('job-cart.index', compact('jobsInCart'));
    }
     public function apply(Request $request, $jobId)
    {
        $user = $request->user();

        $applicant = Applicants::where('user_id', $user->id)->first();

        if (!$applicant) {
            return back()->with('error', 'You are not registered as an applicant yet.');
        }

        // Prevent duplicate applications
        $exists = Applicaion_Form::where('jobs_id', $jobId)
            ->where('applicant_id', $applicant->id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'You already applied for this job.');
        }

        // Store in application_forms
        Applicaion_Form::create([
            'jobs_id' => $jobId,
            'applicant_id' => $applicant->id,
        ]);

        // Remove from job cart if exists
        JobCart::where('jobs_id', $jobId)
            ->where('applicant_id', $applicant->id)
            ->delete();

        return back()->with('success', 'Successfully applied for this job.');
    }

    // Remove a job from cart
    public function remove($cartId)
    {
        $cartItem = JobCart::find($cartId);

        if (!$cartItem) {
            return back()->with('error', 'Job not found in your cart.');
        }

        $cartItem->delete();

        return back()->with('success', 'Job removed from your cart.');
    }
}
