<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Applicant_contacts;
use App\Http\Requests\V1\StoreApplicant_contactsRequest;
use App\Http\Requests\V1\UpdateApplicant_contactsRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ApplicantContactsResource;
use App\Http\Resources\V1\ApplicantContactsCollection; // Assuming you have a resource collection for applicant contacts
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Filters\V1\ApplicantContactsFilter; // Assuming you have a filter class for applicant contacts

class ApplicantContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new ApplicantContactsFilter();
         $filterItems = $filter->transform($request);

         if(count($filterItems) === 0) {
            return new ApplicantContactsCollection(Applicant_contacts::paginate()); // Example implementation
         }
         else {
           $applicantcontacts = Applicant_contacts::where($filterItems)->paginate();
            return new ApplicantContactsCollection($applicantcontacts->appends($request->query())); // Example implementation
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
    public function store(StoreApplicant_contactsRequest $request)
    {
        return new ApplicantContactsResource(Applicant_contacts::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Applicant_contacts $applicant_contact)
    {
        return new ApplicantContactsResource($applicant_contact);//
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Applicant_contacts $applicant_contacts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApplicant_contactsRequest $request, Applicant_contacts $applicant_contact)
    {
       $applicant_contact->update($request->all());

        return new ApplicantContactsResource($applicant_contact);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Applicant_contacts $applicant_contacts)
    {
        //
    }
}
