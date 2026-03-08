<?php

use Illuminate\Support\Facades\Route;
use Modules\JobPost\Http\Controllers\API\FontendHomeController;
use Modules\JobPost\Http\Controllers\API\UserHomeController;

Route::middleware(['maintenance.mode.api', 'demo.api'])->group(function () {
    Route::controller(FontendHomeController::class)->group(function () {
        Route::get('/job-list', 'jobList')->name('job-list');
        Route::get('/serch-job', 'SerchJob')->name('serch-job');
        Route::get('/job-detils/{slug}', 'JobDetils')->name('job-detils');
        Route::post('/apply-job', 'ApplyJob')->name('apply-job');
    });

    Route::resource('jobpost', UserHomeController::class);

    Route::controller(UserHomeController::class)->group(function () {
        Route::get('/job-post-applicants/{id}', 'job_post_applicants')->name('job-post-applicants');
        Route::put('/job-application-approval/{id}', 'job_application_approval')->name('job-application-approval');
    });
});
