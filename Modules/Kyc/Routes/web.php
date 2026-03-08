<?php

use Illuminate\Support\Facades\Route;
use Modules\Kyc\Http\Controllers\KycController;
use Modules\Kyc\Http\Controllers\KycTypeController;

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['maintenance.mode', 'translation', 'demo']], function () {

    Route::resource('kyc', KycTypeController::class);

    Route::controller(KycTypeController::class)->group(function () {
        Route::get('kyc-list', 'kycList')->name('kyc-list');
        Route::delete('delete-kyc-info/{id}', 'DestroyKyc')->name('delete-kyc-info');
        Route::put('update-kyc-status/{id}', 'UpdateKycStatus')->name('update-kyc-status');
    });

});

Route::group(['as' => 'provider.', 'prefix' => 'provider', 'middleware' => ['maintenance.mode', 'translation', 'demo']], function () {

    Route::controller(KycController::class)->group(function () {
        Route::get('kyc', 'kyc')->name('kyc');
        Route::post('kyc-submit', 'kycSubmit')->name('kyc-submit');
    });

});
