<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\CurrentJobs;
use App\Http\Requests\V1\StoreCurrentJobsRequest;
use App\Http\Requests\V1\UpdateCurrentJobsRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Resources\V1\CurrentJobsResource;
use App\Filters\V1\CurrentJobsFilter;
use App\Http\Resources\V1\CurrentJobsCollection;

class CurrentJobsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filter = new CurrentJobsFilter();
         $filterItems = $filter->transform($request);

         if(count($filterItems) === 0) {
            return new CurrentJobsCollection(CurrentJobs::paginate()); // Example implementation
         }
         else {
           $currentjobs = CurrentJobs::where($filterItems)->paginate();
            return new CurrentJobsCollection($currentjobs->appends($request->query())); // Example implementation
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
    public function store(StoreCurrentJobsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CurrentJobs $currentJob)
    {
        return new  CurrentJobsResource($currentJob);////
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CurrentJobs $currentJobs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCurrentJobsRequest $request, CurrentJobs $currentJobs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CurrentJobs $currentJobs)
    {
        //
    }
}
