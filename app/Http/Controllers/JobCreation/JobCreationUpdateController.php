<?php

namespace App\Http\Controllers\JobCreation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organizations;
use App\Models\Jobs;

class JobCreationUpdateController extends Controller
{
    public function __invoke(Request $request, $id)
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
}
