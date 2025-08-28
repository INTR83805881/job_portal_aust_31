<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\JobCart;
use App\Http\Requests\V1\StoreJobCartRequest;
use App\Http\Requests\V1\UpdateJobCartRequest;
use Illuminate\Validation\Rule;

class JobCartController extends Controller
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
    public function store(StoreJobCartRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(JobCart $jobCart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobCart $jobCart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobCartRequest $request, JobCart $jobCart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobCart $jobCart)
    {
        //
    }
}
