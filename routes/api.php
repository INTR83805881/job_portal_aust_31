<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\JobsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// api/v1
Route::group(['prefix' => 'v1','namespace'=>'App\Http\Controllers\Api\V1'], function () {
    //Route::apiResource('customers', CustomerController::class);
    //Route::apiResource('invoices', InvoiceController::class);
    Route::apiResource('organizations', OrganizationsController::class);
    Route::apiResource('jobs', JobsController::class);
    Route::apiResource('applicants', ApplicantsController::class);
    Route::apiResource('applicaion_forms', ApplicaionFormController::class);
    Route::apiResource('applicant_contacts', ApplicantContactsController::class);
    Route::apiResource('interviews', InterviewController::class);
    Route::apiResource('organization_contacts', OrganizationContactsController::class);
    Route::apiResource('job_completions', JobCompletionsController::class);
     Route::apiResource('applicant_skills', ApplicantSkillsetController::class);
    

 Route::apiResource('skills', SkillsController::class);
 Route::get('/applicants/{id}/files', [ApplicantsController::class, 'getFiles']);

    
    
});
