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
           if ($includeEnlistedJobs) {
    $organizations = $organizations->with(['jobs.jobSkillsets.skill']);
}
 // Eager load enlisted jobs if requested

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
         \Log::info('Storing new organization with data: ', $request->all());
         

          $organization = Organizations::create($request->validated());

        return new OrganizationsResource($organization);
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
    public function update(UpdateOrganizationsRequest $request, Organizations $organization)
    {
       $validated = $request->validated();

    \Log::info('Validated Data:', $validated); // check what’s coming here

    if (empty($validated)) {
        return response()->json([
            'message' => 'No fields to update'
        ], 400);
    }

    if(isset($validated['companyName'])) 
    {
       $validated['company_name'] = $validated['companyName'];
       unset($validated['companyName']);
    }

     $organization->update($validated);

      if ($request->has('companyName')) {
            $organization->user->update([
                'name' => $request->companyName
            ]);
        }

     return new OrganizationsResource($organization);
    

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organizations $organization)
    {
       \Log::info('Deleting organization ID: ' . $organization->id);

    try {
        $organization->delete();
        return response()->json(['message' => 'Organization deleted successfully'], 200);
    } catch (\Exception $e) {
        \Log::error('Delete failed: ' . $e->getMessage());
        return response()->json(['error' => 'Delete failed', 'details' => $e->getMessage()], 500);
    }
    }
}
