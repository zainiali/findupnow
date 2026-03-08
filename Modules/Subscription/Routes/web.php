<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

use Illuminate\Support\Facades\Route;
use Modules\Subscription\Http\Controllers\Admin\PurchaseController;
use Modules\Subscription\Http\Controllers\Admin\SubscriptionController;
use Modules\Subscription\Http\Controllers\Provider\PaymentGatewayController;
use Modules\Subscription\Http\Controllers\Provider\PurchaseController as ProviderPurchaseController;
use Modules\Subscription\Http\Controllers\SubscriptionController as FrontendSubscriptionController;
use Modules\Subscription\Http\Controllers\User\PaymentController;

Route::middleware('demo')->group(function () {
    Route::get('subscription/plan', [FrontendSubscriptionController::class, 'subscription_plan'])->name('subscription-plan');

    Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
        Route::resource('/subscription-plan', SubscriptionController::class);

        Route::get('/purchase-history', [PurchaseController::class, 'index'])->name('purchase-history');
        Route::get('/pending-plan-payment', [PurchaseController::class, 'pending_payment'])->name('pending-plan-payment');
        Route::get('/assign-plan', [PurchaseController::class, 'create'])->name('assign-plan');
        Route::post('/store-assign-plan', [PurchaseController::class, 'store'])->name('store-assign-plan');
        Route::get('/purchase-history-show/{id}', [PurchaseController::class, 'show'])->name('purchase-history-show');
        Route::put('/approved-plan-payment/{id}', [PurchaseController::class, 'approved_plan_payment'])->name('approved-plan-payment');
        Route::delete('/delete-plan-payment/{id}', [PurchaseController::class, 'delete_plan_payment'])->name('delete-plan-payment');

    });

    Route::group(['as' => 'provider.', 'prefix' => 'provider', 'middleware' => ['demo', 'maintenance.mode']], function () {
        Route::get('/subscription-plan', [ProviderPurchaseController::class, 'subscription_plan'])->name('subscription-plan');
        Route::get('/subscription-payment/{id}', [ProviderPurchaseController::class, 'subscription_payment'])->name('subscription-payment');
        Route::post('/subscription-payment/{id}', [ProviderPurchaseController::class, 'subscriptionOrderStore'])->name('subscription-order-store');
        Route::group(['as' => 'subscription.', 'prefix' => 'subscription'], function () {
            Route::get('/free-enroll/{id}', [ProviderPurchaseController::class, 'free_enroll'])->name('free-enroll');
        });

        Route::get('/purchase-history', [ProviderPurchaseController::class, 'index'])->name('purchase-history');
        Route::get('/pending-plan-payment', [ProviderPurchaseController::class, 'pending_payment'])->name('pending-plan-payment');
        Route::get('/purchase-history-show/{id}', [ProviderPurchaseController::class, 'show'])->name('purchase-history-show');

        Route::get('/paypal-gateway', [PaymentGatewayController::class, 'paypal_gateway'])->name('paypal-gateway');
        Route::post('/store-paypal-gateway', [PaymentGatewayController::class, 'store_paypal_gateway'])->name('store-paypal-gateway');

        Route::get('/stripe-gateway', [PaymentGatewayController::class, 'stripe_gateway'])->name('stripe-gateway');
        Route::post('/store-stripe-gateway', [PaymentGatewayController::class, 'store_stripe_gateway'])->name('store-stripe-gateway');

        Route::get('/razorpay-gateway', [PaymentGatewayController::class, 'razorpay_gateway'])->name('razorpay-gateway');
        Route::post('/store-razorpay-gateway', [PaymentGatewayController::class, 'store_razorpay_gateway'])->name('store-razorpay-gateway');

        Route::get('/flutterwave-gateway', [PaymentGatewayController::class, 'flutterwave_gateway'])->name('flutterwave-gateway');
        Route::post('/store-flutterwave-gateway', [PaymentGatewayController::class, 'store_flutterwave_gateway'])->name('store-flutterwave-gateway');

        Route::get('/paystack-gateway', [PaymentGatewayController::class, 'paystack_gateway'])->name('paystack-gateway');
        Route::post('/store-paystack-gateway', [PaymentGatewayController::class, 'store_paystack_gateway'])->name('store-paystack-gateway');

        Route::get('/mollie-gateway', [PaymentGatewayController::class, 'mollie_gateway'])->name('mollie-gateway');
        Route::post('/store-mollie-gateway', [PaymentGatewayController::class, 'store_mollie_gateway'])->name('store-mollie-gateway');

        Route::get('/instamojo-gateway', [PaymentGatewayController::class, 'instamojo_gateway'])->name('instamojo-gateway');
        Route::post('/store-instamojo-gateway', [PaymentGatewayController::class, 'store_instamojo_gateway'])->name('store-instamojo-gateway');

        Route::get('/bank-handcash-gateway', [PaymentGatewayController::class, 'bank_handcash_gateway'])->name('bank-handcash-gateway');
        Route::post('/store-bank-handcash-gateway', [PaymentGatewayController::class, 'store_bank_handcash_gateway'])->name('store-bank-handcash-gateway');

        Route::get('/sslcommerz-gateway', [PaymentGatewayController::class, 'sslcommerzGateway'])->name('sslcommerz-gateway');
        Route::post('/store-sslcommerz-gateway', [PaymentGatewayController::class, 'storeSslcommerzGateway'])->name('store-sslcommerz-gateway');

        Route::get('/coin-gate-gateway', [PaymentGatewayController::class, 'coinGateGateway'])->name('coin-gate-gateway');
        Route::post('/store-coin-gate-gateway', [PaymentGatewayController::class, 'storeCoinGateGateway'])->name('store-coin-gate-gateway');

        Route::get('manual/payments', [PaymentController::class, 'manualPayment'])->name('manual-payment');
        Route::get('manual/payments/{trx}', [PaymentController::class, 'manualPaymentDetails'])->name('manual.trx');
        Route::post('manual/payments/accept/{trx}', [PaymentController::class, 'manualPaymentAccept'])->name('manual.accept');
        Route::post('manual/payments/reject/{trx}', [PaymentController::class, 'manualPaymentReject'])->name('manual.reject');

    });

    Route::group(['as' => 'user.', 'prefix' => 'user', 'middleware' => ['demo', 'maintenance.mode']], function () {
        Route::group(['as' => 'sub.', 'prefix' => 'sub'], function () {
            Route::get('/payment/{slug}', [PaymentController::class, 'payment'])->name('payment');
            Route::post('/complete-booking', [PaymentController::class, 'completeBooking'])->name('complete.booking');
            Route::get('/complete-payment/{id}/{type?}', [PaymentController::class, 'completePayment'])->name('complete.payment');
            Route::post('/get-amount-conversion', [PaymentController::class, 'getAmountConversion'])->name('get-amount-conversion');
        });
    });

});
