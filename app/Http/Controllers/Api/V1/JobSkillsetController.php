<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\JobSkillset;
use App\Http\Requests\V1\StoreJobSkillsetRequest;
use App\Http\Requests\V1\UpdateJobSkillsetRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Resources\V1\JobsSkillsetsResource;
use App\Http\Resources\V1\JobsSkillsetsCollection; // Assuming you have a resource collection for applicant skillsets
use App\Filters\V1\JobSkillsetsFilter;

class JobSkillsetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       $filter = new JobSkillsetsFilter();
         $filterItems = $filter->transform($request);

         if(count($filterItems) === 0) {
            return new JobsSkillsetsCollection(JobSkillset::paginate()); // Example implementation
         }
         else {
           $jobSkillset = JobSkillset::where($filterItems)->paginate();
            return new JobsSkillsetsCollection($jobSkillset->appends($request->query())); // Example implementation
         }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobSkillsetRequest $request)
    {
        return new JobsSkillsetsResource(JobSkillset::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
   public function show(JobSkillset $job_skill)
{
    return new JobsSkillsetsResource($job_skill);
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobSkillset $jobSkillset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobSkillsetRequest $request, JobSkillset $job_skill)
    {
         \Log::info('Raw update request data for JobSkillset ID '.$job_skill->id.':', $request->all());

    // Get validated data
    $validated = $request->validated();

    // Manually map camelCase fields to snake_case for DB columns
    if ($request->has('jobId')) {
        $validated['job_id'] = $request->jobId;
    }
    if ($request->has('skillId')) {
        $validated['skill_id'] = $request->skillId;
    }

    \Log::info('Final data being updated for JobSkillset ID '.$job_skill->id.':', $validated);

    try {
        $job_skill->update($validated);
        \Log::info('JobSkillset updated successfully:', $job_skill->toArray());

        return response()->json([
            'message' => 'JobSkillset updated successfully',
            'data' => new JobsSkillsetsResource($job_skill)
        ], 200);

    } catch (\Exception $e) {
        \Log::error('JobSkillset update failed:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ]);

        return response()->json([
            'error' => 'JobSkillset update failed',
            'message' => $e->getMessage()
        ], 500);
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobSkillset $jobSkillset)
    {
        //
    }
}
