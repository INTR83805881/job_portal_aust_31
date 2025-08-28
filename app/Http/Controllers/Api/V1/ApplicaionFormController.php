<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Applicaion_Form;
use App\Http\Requests\StoreApplicaion_FormRequest;
use App\Http\Requests\UpdateApplicaion_FormRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ApplicaionFormResource;
use App\Http\Resources\V1\ApplicaionFormCollection; // Assuming you have a resource collection for application forms
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Filters\V1\ApplicationFormFilter; // Assuming you have a filter class for application forms

class ApplicaionFormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       $filter = new ApplicationFormFilter();
         $filterItems = $filter->transform($request);

         if(count($filterItems) === 0) {
            return new ApplicaionFormCollection(Applicaion_Form::paginate()); // Example implementation
         }
         else {
            $applicationform = Applicaion_Form::where($filterItems)->paginate();
            return new ApplicaionFormCollection($applicationform->appends($request->query())); // Example implementation
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
    public function store(StoreApplicaion_FormRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Applicaion_Form $applicaion_Form)
    {
        return new ApplicaionFormResource($applicaion_Form);//
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Applicaion_Form $applicaion_Form)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApplicaion_FormRequest $request, Applicaion_Form $applicaion_Form)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Applicaion_Form $applicaion_Form)
    {
        //
    }
}
