<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organizations;
use App\Models\Jobs;

class JobCreationController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Only organizations can access
        $organization = Organizations::where('user_id', $user->id)->first();
        if (!$organization) {
            return redirect()->route('profile.page')
                ->with('error', 'You must be an organization to access this page.');
        }

        // Get jobs for this organization
        $jobs = Jobs::where('organization_id', $organization->id)->get();

        return view('job_creation.index', compact('organization', 'jobs'));
    }

    public function storeJob(Request $request)
    {
        $organization = Organizations::where('user_id', auth()->id())->firstOrFail();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'salary' => 'nullable|string|max:255',
            'employment_type' => 'required|in:full-time,part-time,internship',
            'deadline' => 'required|date|after:today',
        ]);

        $validated['organization_id'] = $organization->id;
        $validated['status'] = 'enlisted'; // default

        Jobs::create($validated);

        return redirect()->route('job_creation.index')
            ->with('success', 'Job posted successfully!');
    }

    public function updateJob(Request $request, $id)
    {
        $organization = Organizations::where('user_id', auth()->id())->firstOrFail();
        $job = Jobs::where('organization_id', $organization->id)->findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'location' => 'sometimes|required|string|max:255',
            'salary' => 'sometimes|nullable|string|max:255',
            'employment_type' => 'sometimes|required|in:full-time,part-time,internship',
            'deadline' => 'sometimes|required|date|after:today',
        ]);

        $job->update($validated);

        return redirect()->route('job_creation.index')
            ->with('success', 'Job updated successfully!');
    }

    public function deleteJob($id)
    {
        $organization = Organizations::where('user_id', auth()->id())->firstOrFail();
        $job = Jobs::where('organization_id', $organization->id)->findOrFail($id);

        $job->delete();

        return redirect()->route('job_creation.index')
            ->with('success', 'Job deleted successfully!');
    }
}
