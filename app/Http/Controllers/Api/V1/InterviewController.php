<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Interview;
use App\Http\Requests\V1\StoreInterviewRequest;
use App\Http\Requests\V1\UpdateInterviewRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\InterviewResource; // Assuming you have a resource for interviews
use App\Http\Resources\V1\InterviewCollection; // Assuming you have a resource collection for interviews
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InterviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return Interview::all(); // Example implementation
        // --- IGNORE ---
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
    public function store(StoreInterviewRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Interview $interview)
    {
        return $interview;//
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Interview $interview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInterviewRequest $request, Interview $interview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Interview $interview)
    {
        //
    }
}
