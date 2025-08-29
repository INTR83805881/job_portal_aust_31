<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jobs;

class JobPageController extends Controller
{
    /**
     * Display all available jobs.
     */
    public function index()
    {
        // Fetch all jobs, include organization relation for company name
        $jobs = Jobs::with('organization')->paginate(12);

        // If you want to debug what jobs are being fetched, uncomment:
        // dd($jobs);

        return view('jobs.index', compact('jobs'));
    }

    /**
     * Apply for a specific job (only for logged-in users).
     */
    public function apply(Jobs $job)
    {
        $user = auth()->user();

        // Check if user already applied
        if ($user->applications()->where('job_id', $job->id)->exists()) {
            return redirect()->back()->with('error', 'You have already applied for this job.');
        }

        // Create application
        $user->applications()->create([
            'job_id' => $job->id,
            'status' => 'pending', // default status
        ]);

        return redirect()->back()->with('success', 'You have applied for ' . $job->title);
    }
    
}
