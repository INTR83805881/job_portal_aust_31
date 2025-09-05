<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\JobsController;
use App\Http\Controllers\Api\V1\ApplicantsController;
use App\Http\Controllers\Api\V1\OrganizationsController;
use App\Http\Controllers\Api\V1\ApplicantContactsController;
use App\Http\Controllers\Api\V1\OrganizationContactsController;
use App\Http\Controllers\Api\V1\JobCompletionsController;
use App\Http\Controllers\Api\V1\ApplicantSkillsetController;
use App\Http\Controllers\Api\V1\JobSkillsetController;
use App\Http\Controllers\Api\V1\SkillsController;



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
     Route::apiResource('job_skills', JobSkillsetController::class);

 Route::apiResource('skills', SkillsController::class);
//Route::get('/applicants/{id}/files', [ApplicantsController::class, 'getFiles']);

Route::delete('/applicants/{id}', [ApplicantsController::class, 'destroy']);
Route::delete('/organizations/{id}', [OrganizationsController::class, 'destroy']);
Route::delete('/jobs/{id}', [JobsController::class, 'destroy']);
Route::delete('/applicant_contacts/{id}', [ApplicantContactsController::class, 'destroy']);
Route::delete('/organization_contacts/{id}', [OrganizationContactsController::class, 'destroy']);
Route::delete('job_skills/{id}', [JobSkillsetController::class, 'destroy']);
Route::delete('applicant_skills/{id}', [ApplicantSkillsetController::class, 'destroy']);


    
    
});
