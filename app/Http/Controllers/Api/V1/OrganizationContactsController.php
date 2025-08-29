<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Organization_contacts;
use App\Http\Requests\V1\StoreOrganization_contactsRequest;
use App\Http\Requests\V1\UpdateOrganization_contactsRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\OrganizationContactsResource;
use App\Http\Resources\V1\OrganizationContactsCollection; // Assuming you have a resource collection for organization contacts
use Illuminate\Http\Request;
use App\Filters\V1\OrganizationContactsFilter; // Assuming you have a filter class for organization contacts
use Illuminate\Validation\Rule;

class OrganizationContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new OrganizationContactsFilter();
         $filterItems = $filter->transform($request);

         if(count($filterItems) === 0) {
            return new OrganizationContactsCollection(Organization_contacts::paginate()); // Example implementation
         }
         else {
           $organizationcontacts = Organization_contacts::where($filterItems)->paginate();
            return new OrganizationContactsCollection($organizationcontacts->appends($request->query())); // Example implementation
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
    public function store(StoreOrganization_contactsRequest $request, UserRoleService $roleService)
    {
         $organization = $roleService->createOrganization($request->userId, $request->all());
    return new OrganizationsResource($organization);
    }

    /**
     * Display the specified resource.
     */
    public function show(Organization_contacts $organization_contact)
    {
        return new OrganizationContactsResource($organization_contact);//
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Organization_contacts $organization_contacts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrganization_contactsRequest $request, Organization_contacts $organization_contacts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organization_contacts $organization_contacts)
    {
        //
    }
}
