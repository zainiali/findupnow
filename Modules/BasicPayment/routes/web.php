<?php

use App\Http\Middleware\CheckExtraTokenMiddleware;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;
use Modules\BasicPayment\app\Http\Controllers\AddonPaymentController;
use Modules\BasicPayment\app\Http\Controllers\API\PaymentController as PaymentApiController;
use Modules\BasicPayment\app\Http\Controllers\BasicPaymentController;
use Modules\BasicPayment\app\Http\Controllers\FrontPaymentController;
use Modules\BasicPayment\app\Http\Controllers\PaymentGatewayController;

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth:admin', 'translation', 'demo']], function () {

    Route::controller(BasicPaymentController::class)->group(function () {
        Route::get('basicpayment', 'basicpayment')->name('basicpayment');
        Route::put('update-stripe', 'update_stripe')->name('update-stripe');
        Route::put('update-paypal', 'update_paypal')->name('update-paypal');
        Route::put('update-bank-payment', 'update_bank_payment')->name('update-bank-payment');
    });

    Route::controller(PaymentGatewayController::class)->group(function () {
        Route::put('razorpay-update', 'razorpay_update')->name('razorpay-update');
        Route::put('flutterwave-update', 'flutterwave_update')->name('flutterwave-update');
        Route::put('paystack-update', 'paystack_update')->name('paystack-update');
        Route::put('mollie-update', 'mollie_update')->name('mollie-update');
        Route::put('instamojo-update', 'instamojo_update')->name('instamojo-update');
        Route::put('sslcommerz-update', 'sslcommerz_update')->name('sslcommerz-update');
        Route::put('crypto-update', 'crypto_update')->name('crypto-update');
    });
});

Route::middleware('auth:web')->controller(FrontPaymentController::class)->prefix('payment')->name('pay.')->group(function () {
    Route::post('/pay-via-stripe', 'payWithStripe')->name('via-stripe');
    Route::get('/pay-via-paypal/{id}/{type}', 'payWithPaypal')->name('via-paypal');
    Route::get('/paypal-success-payment/{uuid}/{type}', 'paypalSuccess')->name('paypal-success');
    Route::post('/pay-via-bank', 'payWithBank')->name('via-bank');

    Route::controller(AddonPaymentController::class)->group(function () {
        Route::post('/pay-via-razorpay/{uuid}/{type}', 'payWithRazorpay')->name('via-razorpay');
        Route::get('/pay-via-mollie/{uuid}/{type}', 'payWithMollie')->name('via-mollie');
        Route::get('/mollie-success-payment/{uuid}/{type}', 'mollieSuccess')->name('mollie-success');
        Route::post('/pay-via-paystack/{uuid}/{type}', 'payWithPaystack')->name('via-paystack');
        Route::post('/pay-via-flutterwave/{uuid}/{type}', 'payWithFlutterwave')->name('via-flutterwave');
        Route::get('/pay-via-instamojo/{uuid}/{type}', 'payWithInstamojo')->name('via-instamojo');
        Route::get('/response-instamojo/{uuid}/{type}', 'instamojoSuccess')->name('instamojo-success');
        Route::post('/pay-via-sslcommerz/{uuid}/{type}', 'payWithSslcommerz')->name('via-sslcommerz')->withoutMiddleware(VerifyCsrfToken::class);
        Route::post('/sslcommerz-success-payment/{uuid}/{type}', 'sslcommerzSuccess')->name('sslcommerz-success')->withoutMiddleware(VerifyCsrfToken::class);

        Route::get('/pay-via-crypto/{uuid}/{type}', 'createCryptoPayment')->name('via-crypto');
        Route::get('/coin-gate/callback/{c_token}', 'handleCryptoCallback')->name('coin-gate-callback')->withoutMiddleware('auth:web');
        Route::get('/coin-gate/success/{uuid}/{type}', 'cryptoSuccess')->name('coin-gate-success');
    });
});

Route::middleware(['payment.api', CheckExtraTokenMiddleware::class])->name('payment-api.')->group(function () {
    Route::get('app/payment/{id}/{token}/{type?}', [PaymentApiController::class, 'payment'])->name('payment')->withoutMiddleware('payment.api');

    Route::get('webview-success-payment', [PaymentApiController::class, 'payment_success'])->name('webview-success-payment');
    Route::get('webview-failed-payment', [PaymentApiController::class, 'payment_failed'])->name('webview-failed-payment')->withoutMiddleware('payment.api');

    Route::post('stripe-webview', [FrontPaymentController::class, 'payWithStripe'])->name('stripe-webview');
    Route::get('paypal-webview/{id}/{type?}', [FrontPaymentController::class, 'payWithPaypal'])->name('paypal-webview');
    Route::get('paypal-success', [FrontPaymentController::class, 'paypalSuccess'])->name('paypal-success')->withoutMiddleware(CheckExtraTokenMiddleware::class);
    Route::post('bank-webview', [FrontPaymentController::class, 'payWithBank'])->name('bank-webview');

    Route::get('mollie-webview/{uuid}/{type}', [AddonPaymentController::class, 'payWithMollie'])->name('mollie-webview');
    Route::get('mollie-success/{uuid}/{type}', [AddonPaymentController::class, 'mollieSuccess'])->name('mollie-success');
    Route::post('razorpay-webview/{uuid}/{type}', [AddonPaymentController::class, 'payWithRazorpay'])->name('razorpay-webview');
    Route::post('flutterwave-webview/{uuid}/{type}', [AddonPaymentController::class, 'payWithFlutterwave'])->name('flutterwave-webview');

    Route::get('instamojo-webview/{uuid}/{type}', [AddonPaymentController::class, 'payWithInstamojo'])->name('instamojo-webview');
    Route::get('instamojo-webview-success/{uuid}/{type}', [AddonPaymentController::class, 'instamojoSuccess'])->name('instamojo-success');

    Route::post('paystack-webview/{uuid}/{type}', [AddonPaymentController::class, 'payWithPaystack'])->name('paystack-webview');

    Route::post('/pay-via-sslcommerz/{uuid}/{type}', [AddonPaymentController::class, 'payWithSslcommerz'])->name('via-sslcommerz')->withoutMiddleware(VerifyCsrfToken::class);
    Route::post('/sslcommerz-success-payment/{uuid}/{type}', [AddonPaymentController::class, 'sslcommerzSuccess'])->name('sslcommerz-success')->withoutMiddleware(VerifyCsrfToken::class);

    Route::get('/pay-via-crypto/{uuid}/{type}', [AddonPaymentController::class, 'createCryptoPayment'])->name('via-crypto');
    Route::get('/coin-gate/success/{uuid}/{type}', [AddonPaymentController::class, 'cryptoSuccess'])->name('coin-gate-success');

});
