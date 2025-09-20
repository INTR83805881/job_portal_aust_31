<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Applicants;
use App\Models\Organizations;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Check if user is an applicant
        if (Applicants::where('user_id', $userId)->exists()) {
            return view('dashboard.applicant');
        }

        // Check if user is an organization
        if (Organizations::where('user_id', $userId)->exists()) {
            return view('dashboard.organization');
        }

        // Default fallback (optional)
        return view('dashboard');
    }
}
