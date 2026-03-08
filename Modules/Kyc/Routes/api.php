<?php

use Illuminate\Support\Facades\Route;
use Modules\Kyc\Http\Controllers\API\KycController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::controller(KycController::class)->name('provider.')->prefix('provider')->middleware(['auth:api', 'maintenance.mode.api', 'demo.api'])->group(function () {
    Route::get('kyc', 'kyc')->name('kyc');
    Route::post('kyc-submit', 'kycSubmit')->name('kyc-submit');
});
