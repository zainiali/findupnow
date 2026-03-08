<?php

use Illuminate\Support\Facades\Route;
use Modules\BasicPayment\app\Http\Controllers\API\PaymentController as PaymentApiController;

Route::middleware('auth:api')->group(function () {
    Route::post('/active-methods', [PaymentApiController::class, 'getActiveMethods'])->name('get-active-methods');
});
