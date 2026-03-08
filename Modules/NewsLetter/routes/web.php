<?php

use Illuminate\Support\Facades\Route;
use Modules\NewsLetter\app\Http\Controllers\Admin\NewsLetterController as AdminNewsLetterController;

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth:admin', 'translation', 'demo']], function () {
    Route::get('subscriber-list', [AdminNewsLetterController::class, 'index'])->name('subscriber-list');
    Route::delete('subscriber-delete/{id}', [AdminNewsLetterController::class, 'destroy'])->name('subscriber-delete');
    Route::get('send-mail-to-newsletter', [AdminNewsLetterController::class, 'create'])->name('send-mail-to-newsletter');
    Route::post('send-mail-to-subscriber', [AdminNewsLetterController::class, 'store'])->name('send-mail-to-subscriber');
});
