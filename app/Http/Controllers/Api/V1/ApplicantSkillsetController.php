<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ApplicantSkillset;
use Illuminate\Validation\Rule;
use App\Http\Requests\V1\StoreApplicantSkillsetRequest;
use App\Http\Requests\V1\UpdateApplicantSkillsetRequest;
use Illuminate\Http\Request;
use App\Http\Resources\V1\ApplicantSkillsetsResource;
use App\Http\Resources\V1\ApplicantSkillsetsCollection; // Assuming you have a resource collection for applicant skillsets
use App\Filters\V1\ApplicantSkillsetsFilter;


class ApplicantSkillsetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         $filter = new ApplicantSkillsetsFilter();
         $filterItems = $filter->transform($request);

         if(count($filterItems) === 0) {
            return new ApplicantSkillsetsCollection(ApplicantSkillset::paginate()); // Example implementation
         }
         else {
           $applicantSkillset = ApplicantSkillset::where($filterItems)->paginate();
            return new ApplicantSkillsetsCollection($applicantSkillset->appends($request->query())); // Example implementation
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
    public function store(StoreApplicantSkillsetRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ApplicantSkillset $applicantSkillset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ApplicantSkillset $applicantSkillset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApplicantSkillsetRequest $request, ApplicantSkillset $applicantSkillset)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ApplicantSkillset $applicantSkillset)
    {
        //
    }
}
