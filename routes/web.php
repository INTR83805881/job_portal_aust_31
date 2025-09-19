<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Web\JobPageController;
use App\Http\Controllers\ProfilePageController;
use App\Http\Controllers\JobCreationController;
use App\Http\Controllers\Web\JobViewController;

use App\Http\Controllers\OrganizationCourseController;
use App\Http\Controllers\Web\JobActionController;
use App\Http\Controllers\JobCartController;
use App\Http\Controllers\Applications\AppliedJobsController;
use App\Http\Controllers\MindController;
use App\Http\Controllers\Applications\AppliedCandidatesController;
use App\Http\Controllers\Profile\ApplicantResumeController;
use App\Http\Controllers\Profile\ApplicantCoverLetterController;
use App\Http\Controllers\Applications\CandidatePdfsController;
use App\Http\Controllers\CurrentJobs\ApplicantCurrentJobsController;    
use App\Http\Controllers\CurrentJobs\OrganizationCurrentJobsController;
use App\Http\Controllers\WorkSubmission\WorkSubmitController;
use App\Http\Controllers\WorkSubmission\WorkCheckController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/jobs', function () {
    return view('jobs');
})->name('jobs');



Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/auth', function () {
    return view('auth.index');
})->name('auth');

//Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');

// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Register Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

Route::get('/jobs', [JobPageController::class, 'index'])->name('jobs.index');
Route::get('/jobs/view/{id}', [JobViewController::class, 'show'])->name('jobs.view');


// Profile Page (custom view)
// routes/web.php


Route::middleware('auth')->group(function () {
    Route::get('/profile-page', [ProfilePageController::class, 'index'])->name('profile.page');

    // Applicant profile
    Route::post('/profile-page/applicant', [ProfilePageController::class, 'storeApplicant'])->name('profile.applicant.store');
    Route::patch('/profile-page/applicant', [ProfilePageController::class, 'updateApplicant'])->name('profile.applicant.update');

    // Organization profile
    Route::post('/profile-page/organization', [ProfilePageController::class, 'storeOrganization'])->name('profile.organization.store');
    Route::patch('/profile-page/organization', [ProfilePageController::class, 'updateOrganization'])->name('profile.organization.update');

    // Contacts
    Route::post('/profile-page/applicant/contact', [ProfilePageController::class, 'storeApplicantContact'])->name('profile.applicant.contact.store');
    Route::patch('/profile-page/applicant/contact/{id}', [ProfilePageController::class, 'updateApplicantContact'])->name('profile.applicant.contact.update');

    Route::post('/profile-page/organization/contact', [ProfilePageController::class, 'storeOrganizationContact'])->name('profile.organization.contact.store');
    Route::patch('/profile-page/organization/contact/{id}', [ProfilePageController::class, 'updateOrganizationContact'])->name('profile.organization.contact.update');

    // Applicant Skills
    Route::post('/profile/applicant/skills/store', [ProfilePageController::class, 'storeApplicantSkill'])
        ->name('profile.applicant.skill.store');

    // -----------------------------
    // Resume routes
    // -----------------------------
    Route::post('/profile/applicant/resume', [ApplicantResumeController::class, 'update'])->name('profile.applicant.resume.update');
    Route::get('/profile/applicant/resume/view', [ApplicantResumeController::class, 'view'])->name('profile.applicant.resume.view');
    Route::get('/profile/applicant/resume/download', [ApplicantResumeController::class, 'download'])->name('profile.applicant.resume.download');

    // -----------------------------
    // Cover Letter routes
    // -----------------------------
    Route::post('/profile/applicant/cover-letter', [ApplicantCoverLetterController::class, 'update'])->name('profile.applicant.cover_letter.update');
    Route::get('/profile/applicant/cover-letter/view', [ApplicantCoverLetterController::class, 'view'])->name('profile.applicant.cover_letter.view');
    Route::get('/profile/applicant/cover-letter/download', [ApplicantCoverLetterController::class, 'download'])->name('profile.applicant.cover_letter.download');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/job-creation', [JobCreationController::class, 'index'])
        ->name('job_creation.index');

    Route::post('/job-creation', [JobCreationController::class, 'storeJob'])
        ->name('job_creation.store');

    Route::patch('/job-creation/{id}', [JobCreationController::class, 'updateJob'])
        ->name('job_creation.update');

    Route::delete('/job-creation/{id}', [JobCreationController::class, 'deleteJob'])
        ->name('job_creation.delete');

    Route::post('/job-creation/{job}/skill', [JobCreationController::class, 'storeJobSkill'])
    ->name('job_creation.skill.store');
    //->middleware('auth');
     Route::post('/jobs/apply', [JobActionController::class, 'apply'])->name('jobs.apply');
    Route::post('/jobs/add-to-cart', [JobActionController::class, 'addToCart'])->name('jobs.addToCart');
});


Route::prefix('/')->group(function () {
    Route::get('/organization-course', [OrganizationCourseController::class, 'index'])->name('organization_courses.index');
    Route::get('/create', [OrganizationCourseController::class, 'create'])->name('organization_courses.create');
    Route::post('/store', [OrganizationCourseController::class, 'store'])->name('organization_courses.store');
    Route::get('/apply/{id}', [OrganizationCourseController::class, 'apply'])->name('organization_courses.apply');
});

Route::middleware('auth')->group(function () {

    // Job Cart - view & remove
    Route::get('/job-cart', [\App\Http\Controllers\Web\JobCartController::class, 'index'])->name('job-cart.index');
    Route::delete('/job-cart/remove/{id}', [\App\Http\Controllers\Web\JobCartController::class, 'remove'])->name('job-cart.remove');

    // Job Cart - apply
    Route::post('/job-cart/apply/{job}', [\App\Http\Controllers\Web\JobCartActionController::class, 'apply'])->name('job-cart.apply');
});

Route::middleware('auth')->group(function () {
    Route::get('/applied-jobs', [AppliedJobsController::class, 'index'])->name('applied-jobs.index');
    Route::delete('/applied-jobs/remove/{id}', [AppliedJobsController::class, 'remove'])->name('applied-jobs.remove');
});

Route::get('/minds', [MindController::class, 'index'])->name('minds.index');
Route::get('/create-minds', [MindController::class, 'create'])->name('minds.create');
Route::post('/create-minds', [MindController::class, 'store'])->name('minds.store');


Route::middleware(['auth'])->group(function () {
Route::get('/applied-candidates', [AppliedCandidatesController::class, 'jobs'])->name('applied.candidates.jobs');
Route::get('/applied-candidates/{id}', [AppliedCandidatesController::class, 'candidates'])->name('applied.candidates.candidates');

Route::get('/applied-candidates/{id}/resume/view', [AppliedCandidatesController::class, 'viewResume'])->name('appliedCandidates.viewResume');
Route::get('/applied-candidates/{id}/resume/download', [AppliedCandidatesController::class, 'downloadResume'])->name('appliedCandidates.downloadResume');

Route::get('/applied-candidates/{id}/cover-letter/view', [AppliedCandidatesController::class, 'viewCoverLetter'])->name('appliedCandidates.viewCoverLetter');
Route::get('/applied-candidates/{id}/cover-letter/download', [AppliedCandidatesController::class, 'downloadCoverLetter'])->name('appliedCandidates.downloadCoverLetter');

Route::post('/applied-candidates/{job}/{applicant}/accept', [AppliedCandidatesController::class, 'accept'])->name('appliedCandidates.accept');
    Route::post('/applied-candidates/{job}/{applicant}/reject', [AppliedCandidatesController::class, 'reject'])->name('appliedCandidates.reject');
    
});

Route::middleware('auth')->group(function () {
    Route::get('/applicant-current-jobs', [ApplicantCurrentJobsController::class, 'index'])
        ->name('applicant.current-jobs.index');

    Route::delete('/applicant-current-jobs/{id}', [ApplicantCurrentJobsController::class, 'destroy'])
        ->name('applicant.current.jobs.destroy');
});

Route::middleware('auth')->group(function() {
    Route::get('/work-submit/{jobId}', [WorkSubmitController::class, 'create'])
        ->name('work.submission.create');

    Route::post('/work-submit/{jobId}', [WorkSubmitController::class, 'store'])
        ->name('work.submission.store');

    Route::patch('/work-submit/{jobId}', [WorkSubmitController::class, 'update'])
        ->name('work.submission.update');

    Route::get('/work-submit/index/{jobId}', [WorkSubmitController::class, 'index'])
        ->name('work.submission.index');
});

Route::middleware('auth')->group(function(){
Route::get('/organization-current-jobs', [OrganizationCurrentJobsController::class, 'index'])
    ->name('organization-current-jobs.index');
});

Route::middleware('auth')->group(function() {

    // Show submissions for a specific job
    Route::get('/work-check/{jobId}', [WorkCheckController::class, 'index'])
        ->name('work-check.index');

    // Update feedback & rating for a submission
    Route::post('/work-check/{submissionId}/feedback', [WorkCheckController::class, 'updateFeedback'])
        ->name('work-check.feedback.update');
});

