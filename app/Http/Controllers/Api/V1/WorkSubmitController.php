<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\WorkSubmit;
use App\Http\Requests\V1\StoreWorkSubmitRequest;
use App\Http\Requests\V1\UpdateWorkSubmitRequest;
use Illuminate\Validation\Rule;

class WorkSubmitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreWorkSubmitRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(WorkSubmit $workSubmit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WorkSubmit $workSubmit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkSubmitRequest $request, WorkSubmit $workSubmit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkSubmit $workSubmit)
    {
        //
    }
}
