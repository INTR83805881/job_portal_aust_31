<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Applicants;
use App\Http\Requests\V1\StoreApplicantsRequest;
use App\Http\Requests\V1\UpdateApplicantsRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ApplicantsResource;
use App\Http\Resources\V1\ApplicantsCollection; // Assuming you have a resource collection for applicants
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Filters\V1\ApplicantsFilter; // Assuming you have a filter class for applicants

class ApplicantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new ApplicantsFilter();
         $filterItems = $filter->transform($request);

         $includeApplicantContacts = $request->query('includeApplicantContacts');
         $includeJobCompletions = $request->query('includeJobCompletions');
         $includeCurrentJobs = $request->query('includeCurrentJobs');
         $includeApplicantSkillsets = $request->query('includeApplicantSkillsets');

           $applicants = Applicants::where($filterItems);
           
    if ($includeApplicantContacts) {
        $applicants = $applicants->with(['contacts' => function ($query) use ($request) {
            if ($request->has('type.eq')) {
                $query->where('type', $request->query('type')['eq']);
            }
        }]);
    }
          if($includeJobCompletions){
            $applicants = $applicants->with('jobsCompleted'); // Eager load job completions if requested
          }
          if($includeCurrentJobs){
            $applicants = $applicants->with('currentJobs'); // Eager load job completions if requested
          }

            if($includeApplicantSkillsets){
                $applicants = $applicants->with('applicantSkillsets.skill'); // Eager load skills if requested
            }

        return new ApplicantsCollection($applicants->paginate()->appends($request->query()));

        // Applicants::where($filterItems);

    }


   

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApplicantsRequest $request)
    {
        \Log::info('Storing new applicant with data: ', $request->all());
       
        // Create the applicant
    $applicant = Applicants::create($request->validated());

    // Update associated user's name
    if ($request->filled('name')) {
        $applicant->user->update(['name' => $request->name]);
    }

    return new ApplicantsResource($applicant->load('user')); // optionally load user
}
    

    /**
     * Display the specified resource.
     */
    public function show(Applicants $applicant)
    {
       return new ApplicantsResource($applicant); // Example implementation
    }


    /**
     * Update the specified resource in storage.
     */
public function update(UpdateApplicantsRequest $request, Applicants $applicant)
{
    $validated = $request->validated();

    \Log::info('Validated Data:', $validated); // check what’s coming here

    if (empty($validated)) {
        return response()->json([
            'message' => 'No fields to update'
        ], 400);
    }

    $applicant->update($validated);

   if ($request->filled('name')) {
        $applicant->user->update(['name' => $request->name]);
    }

    return new ApplicantsResource($applicant->load('user'));
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Applicants $applicants)
    {
        //
    }

    public function getFiles($applicantId)
{
    $applicant = \App\Models\Applicants::find($applicantId);

    if (!$applicant) {
        return response()->json(['error' => 'Applicant not found'], 404);
    }

    $resumeUrl = $applicant->resume ? asset('storage/' . $applicant->resume) : null;
    $coverLetterUrl = $applicant->cover_letter ? asset('storage/' . $applicant->cover_letter) : null;

    return response()->json([
        'applicant_id' => $applicant->id,
        'resume' => $resumeUrl,
        'cover_letter' => $coverLetterUrl,
    ]);
}
}
