<?php

namespace App\Http\Controllers\JobCreation;

use App\Http\Controllers\Controller;
use App\Models\Organizations;
use App\Models\Jobs;

class JobCreationDeleteController extends Controller
{
    public function __invoke($id)
    {
        $organization = Organizations::where('user_id', auth()->id())->firstOrFail();
        $job = Jobs::where('organization_id', $organization->id)->findOrFail($id);

        $job->delete();

        return redirect()->route('job_creation.index')
            ->with('success', 'Job deleted successfully!');
    }
}
