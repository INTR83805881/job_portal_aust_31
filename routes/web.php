<?php

use App\Http\Controllers\ProfileController;
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
// Profile Routes
    Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/jobs', [JobPageController::class, 'index'])->name('jobs.index');
Route::post('/jobs/apply/{job}', [JobPageController::class, 'apply'])->middleware('auth')->name('jobs.apply');

// Profile Page (custom view)
// routes/web.php


Route::middleware('auth')->group(function () {
   Route::get('/profile-page', [ProfilePageController::class, 'index'])->name('profile.page');

    Route::post('/profile-page/applicant', [ProfilePageController::class, 'storeApplicant'])->name('profile.applicant.store');
    Route::patch('/profile-page/applicant', [ProfilePageController::class, 'updateApplicant'])->name('profile.applicant.update');

    Route::post('/profile-page/organization', [ProfilePageController::class, 'storeOrganization'])->name('profile.organization.store');
    Route::patch('/profile-page/organization', [ProfilePageController::class, 'updateOrganization'])->name('profile.organization.update');

    // Contacts
    Route::post('/profile-page/applicant/contact', [ProfilePageController::class, 'storeApplicantContact'])->name('profile.applicant.contact.store');
    Route::patch('/profile-page/applicant/contact/{id}', [ProfilePageController::class, 'updateApplicantContact'])->name('profile.applicant.contact.update');

    Route::post('/profile-page/organization/contact', [ProfilePageController::class, 'storeOrganizationContact'])->name('profile.organization.contact.store');
    Route::patch('/profile-page/organization/contact/{id}', [ProfilePageController::class, 'updateOrganizationContact'])->name('profile.organization.contact.update');

    Route::post('/profile/applicant/skills/store', [ProfilePageController::class, 'storeApplicantSkill'])
    ->name('profile.applicant.skill.store');

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
});



