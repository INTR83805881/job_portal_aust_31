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
        return new ApplicantSkillsetsResource(ApplicantSkillset::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(ApplicantSkillset $applicant_skill)
    {
        return new ApplicantSkillsetsResource($applicant_skill);
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
    public function update(UpdateApplicantSkillsetRequest $request, ApplicantSkillset $applicant_skill)
{
    \Log::info('Raw update request data for ApplicantSkillset ID '.$applicant_skill->id.':', $request->all());

    // Get validated data
    $validated = $request->validated();

    // Map camelCase fields to snake_case for DB columns
    if ($request->has('applicantId')) {
        $validated['applicant_id'] = $request->input('applicantId');
    }
    if ($request->has('skillId')) {
        $validated['skill_id'] = $request->input('skillId');
    }

    \Log::info('Final data being updated for ApplicantSkillset ID '.$applicant_skill->id.':', $validated);

    try {
        $applicant_skill->update($validated);
        \Log::info('ApplicantSkillset updated successfully:', $applicant_skill->toArray());

        // Refresh and eager load skill relationship for resource
        $applicant_skill->refresh()->load('skill');

        return response()->json([
            'message' => 'ApplicantSkillset updated successfully',
            'data' => new ApplicantSkillsetsResource($applicant_skill)
        ], 200);

    } catch (\Exception $e) {
        \Log::error('ApplicantSkillset update failed:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ]);

        return response()->json([
            'error' => 'ApplicantSkillset update failed',
            'message' => $e->getMessage()
        ], 500);
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ApplicantSkillset $applicantSkillset)
    {
        //
    }
}
