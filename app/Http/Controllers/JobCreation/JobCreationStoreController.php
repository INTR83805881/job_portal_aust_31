<?php

namespace App\Http\Controllers\JobCreation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organizations;
use App\Models\Jobs;

class JobCreationStoreController extends Controller
{
    public function __invoke(Request $request)
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
        $validated['status'] = 'enlisted';

        Jobs::create($validated);

        return redirect()->route('job_creation.index')
            ->with('success', 'Job posted successfully!');
    }
}
