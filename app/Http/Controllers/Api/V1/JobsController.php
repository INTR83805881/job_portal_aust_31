<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Jobs;
use App\Http\Requests\V1\StoreJobsRequest;
use App\Http\Requests\V1\UpdateJobsRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\JobsResource;
use App\Http\Resources\V1\JobsCollection; // Assuming you have a resource collection for jobs
use Illuminate\Http\Request;
use App\Filters\V1\JobsFilter; // Assuming you have a filter class for jobs
use Illuminate\Validation\Rule;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new JobsFilter();
         $filterItems = $filter->transform($request);

         $includeJobSkillsets = $request->query('includeJobSkillsets');

         $jobs = Jobs::where($filterItems);

       if($includeJobSkillsets)
            {
                $jobs = $jobs->with('jobSkillsets.skill'); // Eager load skills if requested
            }

             return new JobsCollection($jobs->paginate()->appends($request->query()));
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
    public function store(StoreJobsRequest $request)
{
    \Log::info('Raw request data:', $request->all());
    
    // Get validated data
    $validated = $request->validated();
    
    // Manually add the converted fields
    $validated['organization_id'] = $request->organizationId;
    $validated['employment_type'] = $request->employmentType;
    
    \Log::info('Final data being inserted:', $validated);
    
    try {
        $job = Jobs::create($validated);
        \Log::info('Job created successfully:', $job->toArray());
        
        return response()->json([
            'message' => 'Job created successfully',
            'data' => new JobsResource($job)
        ], 201);
        
    } catch (\Exception $e) {
        \Log::error('Error details:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ]);
        
        return response()->json([
            'error' => 'Job creation failed',
            'message' => $e->getMessage()
        ], 500);
    }
}

    /**
     * Display the specified resource.
     */
    public function show(Jobs $job)
    {
        return new JobsResource($job);//
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jobs $jobs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobsRequest $request, Jobs $job)
{
    \Log::info('Raw update request data:', $request->all());
    
    // Get validated data
    $validated = $request->validated();
    
    // Manually add the converted fields if they exist in the request
    if ($request->has('organizationId')) {
        $validated['organization_id'] = $request->organizationId;
    }
    if ($request->has('employmentType')) {
        $validated['employment_type'] = $request->employmentType;
    }
    
    \Log::info('Final data being updated:', $validated);
    
    try {
        $job->update($validated);
        \Log::info('Job updated successfully:', $job->toArray());
        
        return response()->json([
            'message' => 'Job updated successfully',
            'data' => new JobsResource($job)
        ], 200);
        
    } catch (\Exception $e) {
        \Log::error('Error details:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ]);
        
        return response()->json([
            'error' => 'Job update failed',
            'message' => $e->getMessage()
        ], 500);
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jobs $job)
    {
          \Log::info('Deleting job ID: ' . $job->id);

    try {
        $job->delete();
        return response()->json(['message' => 'Job deleted successfully'], 200);
    } catch (\Exception $e) {
        \Log::error('Delete failed: ' . $e->getMessage());
        return response()->json(['error' => 'Delete failed', 'details' => $e->getMessage()], 500);
    }
    }
}
