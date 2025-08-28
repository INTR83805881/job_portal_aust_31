<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Organizations;
use App\Http\Requests\V1\StoreOrganizationsRequest;
use App\Http\Requests\V1\UpdateOrganizationsRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\OrganizationsResource;
use App\Http\Resources\V1\OrganizationsCollection; // Assuming you have a resource collection for organizations
use Illuminate\Http\Request;
use App\Filters\V1\OrganizationsFilter; // Assuming you have a filter class for organizations
use Illuminate\Validation\Rule;

class OrganizationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       $filter = new OrganizationsFilter();
         $filterItems = $filter->transform($request);

         $includeOrganizationContacts = $request->query('includeOrganizationContacts');
         $includeEnlistedJobs = $request->query('includeEnlistedJobs');

         $organizations = Organizations::where($filterItems);

      if ($includeOrganizationContacts) {
    $organizations = $organizations->with(['contacts' => function ($query) use ($request) {
        if ($request->has('type.eq')) {
            $query->where('type', $request->query('type')['eq']);
        }
    }]);
}
            if($includeEnlistedJobs)
                $organizations = $organizations->with('jobs'); // Eager load enlisted jobs if requested

           return new OrganizationsCollection($organizations->paginate()->appends($request->query()));


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
    public function store(StoreOrganizationsRequest $request)
    {
        return new OrganizationsResource(Organizations::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Organizations $organization)
    {
        return new OrganizationsResource($organization); // Example implementation
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Organizations $organizations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrganizationsRequest $request, Organizations $organizations)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organizations $organizations)
    {
        //
    }
}
