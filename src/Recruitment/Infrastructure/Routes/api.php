<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Recruitment\Infrastructure\Controllers\AssignRecruiterController;
use Recruitment\Infrastructure\Controllers\CreateApplicantController;
use Recruitment\Infrastructure\Controllers\CreateRecruiterController;
use Recruitment\Infrastructure\Controllers\GetApplicantController;
use Recruitment\Infrastructure\Controllers\GetApplicantsByRecruiterController;
use Recruitment\Infrastructure\Controllers\ValidateApplicantController;

Route::post('/create-applicant', [CreateApplicantController::class, 'index']);
Route::post('/create-recruiter', [CreateRecruiterController::class, 'index']);
Route::post('/assign-recruiter', [AssignRecruiterController::class, 'index']);
Route::post('/validate-applicant', [ValidateApplicantController::class, 'index']);
Route::get('/applicant', [GetApplicantController::class, 'index']);
Route::get('/applicants-by-recruiter', [GetApplicantsByRecruiterController::class, 'index']);
