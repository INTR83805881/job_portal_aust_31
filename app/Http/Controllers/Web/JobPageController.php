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

        // Fetch only jobs with status 'enlisted', include organization relation
        $jobs = Jobs::with('organization')
                    ->where('status', 'enlisted')
                    ->paginate(10);

        return view('jobs.index', compact('jobs'));
    }

    /**
     * Apply for a specific job (only for logged-in users).
     */
   
    
}
