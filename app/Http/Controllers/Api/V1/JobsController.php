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
        //
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
    public function update(UpdateJobsRequest $request, Jobs $jobs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jobs $jobs)
    {
        //
    }
}
