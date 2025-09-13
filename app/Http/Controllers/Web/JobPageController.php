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
    public function index(Request $request)
    {
         $user = $request->user();

        // If logged-in user is an organization, redirect to job creation
        if ($user && $user->role === 'organization') {
            return redirect()->route('job_creation.index')
                ->with('error', 'Organizations cannot view job listings. You can create jobs here.');
        }
        // Fetch all jobs, include organization relation for company name
        $jobs = Jobs::with('organization')->paginate(10);

        // If you want to debug what jobs are being fetched, uncomment:
        // dd($jobs);

        return view('jobs.index', compact('jobs'));
    }

    /**
     * Apply for a specific job (only for logged-in users).
     */
   
    
}
