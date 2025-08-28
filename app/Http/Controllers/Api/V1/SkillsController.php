<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Skills;
use App\Http\Requests\V1\StoreSkillsRequest;
use App\Http\Requests\V1\UpdateSkillsRequest;
use App\Http\Resources\V1\SkillsResource;
use App\Http\Resources\V1\SkillsCollection;
use App\Filters\V1\SkillsFilter;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SkillsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         $filter = new SkillsFilter();
         
         $filterItems = $filter->transform($request);

         if(count($filterItems) === 0) {
            return new SkillsCollection(Skills::paginate()); // Example implementation
         }
         else {
            $skills = Skills::where($filterItems)->paginate();
            return new SkillsCollection($skills->appends($request->query())); // Example implementation
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
    public function store(StoreSkillsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Skills $skill)
    {
       return new SkillsResource($skill); //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skills $skills)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSkillsRequest $request, Skills $skills)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skills $skills)
    {
        //
    }
}
