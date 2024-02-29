<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OTPController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BasicDetailController;
use App\Http\Controllers\EducationQualificationController;
use App\Http\Controllers\ExperienceController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('role:admin')->group(function () {
    Route::get('/admin-dashboard', [App\Http\Controllers\AdminController::class, 'Admin'])->name('admin.dashboard');

});

Route::middleware('role:candidate')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/get-disability-types', [App\Http\Controllers\HomeController::class, 'getDisabilityTypes'])->name('getDisabilityTypes');
    Route::post('/application-form-submit', [HomeController::class, 'submitFormOne']);
    Route::get('/basic-details', [BasicDetailController::class, 'BasicDetails'])->name('basic.details');
    Route::post('/basic-details-submit', [BasicDetailController::class, 'BasicDetailsSubmit'])->name('basic.details.submit');
    Route::get('/educational-qualifications', [EducationQualificationController::class, 'EducationalQualifications'])->name('educational.qualifications');
    Route::post('/educational-qualifications-submit', [EducationQualificationController::class, 'EducationalQualificationSubmit'])->name('educational.qualifications.submit');
    Route::get('/get-qualifications', [EducationQualificationController::class, 'GetQualifications'])->name('get.qualifications');
    Route::post('/education-document-upload', [EducationQualificationController::class, 'EducationDocumentUpload'])->name('education.document.upload');
    Route::get('/experience-details', [ExperienceController::class, 'ExperienceDetails'])->name('experience.details');
    Route::get('/get-experience-details', [ExperienceController::class, 'GetExperienceDetails'])->name('get.experience.details');
    Route::delete('/get-experience-details/{id}', [ExperienceController::class, 'GetExperienceDetailsDelete'])->name('get.experience.details.delete');
    Route::post('/experience-details-submit', [ExperienceController::class, 'ExperienceDetailsSubmit'])->name('experience.details.submit');
});
Route::middleware('auth')->group(function () {
 
   
});
Route::post('/send-otp', [OTPController::class, 'sendOTP']);
Route::post('/send-email-otp', [OTPController::class, 'sendEmailOTP']);
Route::post('/verify-otp', [OTPController::class, 'verifyOTP']);
Route::post('/verify-email-otp', [OTPController::class, 'EmailverifyOTP']);
Route::get('/home2', [App\Http\Controllers\FrontendController::class, 'index'])->name('frontend');