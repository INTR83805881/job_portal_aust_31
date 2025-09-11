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

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/auth', function () {
    return view('auth.index');
})->name('auth');

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

// Profile (default from Breeze/Jetstream)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Jobs
Route::get('/jobs', [JobPageController::class, 'index'])->name('jobs.index');
Route::post('/jobs/apply/{job}', [JobPageController::class, 'apply'])
    ->middleware('auth')
    ->name('jobs.apply');

// Profile Page (custom)
Route::middleware('auth')->group(function () {
    Route::get('/profile-page', [ProfilePageController::class, 'index'])->name('profile.page');
    Route::post('/profile-page/applicant', [ProfilePageController::class, 'storeApplicant'])->name('profile.applicant.store');
    Route::post('/profile-page/organization', [ProfilePageController::class, 'storeOrganization'])->name('profile.organization.store');
});
