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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(JobSkillset $jobSkillset)
    {
        //
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
    public function update(UpdateJobSkillsetRequest $request, JobSkillset $jobSkillset)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobSkillset $jobSkillset)
    {
        //
    }
}
