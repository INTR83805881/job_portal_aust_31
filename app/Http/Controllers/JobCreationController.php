<?php

namespace App\Http\Controllers;

use App\Http\Controllers\JobCreation\JobCreationIndexController;
use App\Http\Controllers\JobCreation\JobCreationStoreController;
use App\Http\Controllers\JobCreation\JobCreationUpdateController;
use App\Http\Controllers\JobCreation\JobCreationDeleteController;
use App\Http\Controllers\JobCreation\JobCreationSkillController;
use Illuminate\Http\Request;

class JobCreationController extends Controller
{
    public function index() 
    { 
        return app(JobCreationIndexController::class)(); 
    }
    
    public function storeJob(Request $request) 
    { 
        return app(JobCreationStoreController::class)($request); 
    }
    
    public function updateJob(Request $request, $id) 
    { 
        return app(JobCreationUpdateController::class)($request, $id); 
    }
    
    public function deleteJob($id) 
    { 
        return app(JobCreationDeleteController::class)($id); 
    }
    
    public function storeJobSkill(Request $request, $id) 
    { 
        return app(JobCreationSkillController::class)($request, $id); 
    }
}
