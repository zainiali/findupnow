<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Provider\AppointmentScheduleController;
use App\Http\Controllers\Provider\CouponController;
use App\Http\Controllers\Provider\MessageController;
use App\Http\Controllers\Provider\ProviderDashboardController;
use App\Http\Controllers\Provider\ProviderOrderController;
use App\Http\Controllers\Provider\ProviderProfileController;
use App\Http\Controllers\Provider\ProviderTicketController;
use App\Http\Controllers\Provider\ServiceController;
use App\Http\Controllers\Provider\WithdrawController;
use App\Http\Controllers\User\MessageController as UserMessageController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\UserProfileController;

// ⭐ ADD THIS NEW IMPORT
use App\Http\Controllers\Provider\ProviderLeadController;
use App\Http\Controllers\OTPController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'maintenance.mode', 'translation'])->group(function () {

    Broadcast::routes(['middleware' => 'auth:web']);

    Route::get('/set-locale', function (Request $request) {
        $locale = $request->input('locale');

        setLanguage($locale);

        $notification = __('Language Changed Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    })->name('set-locale');

    Route::get('set-currency', function (Request $request) {
        $currency = $request->get('currency');

        $currency = allCurrencies()->where('currency_code', $currency)->first();

        if (session()->has('currency_code')) {
            session()->forget('currency_code');
            session()->forget('currency_position');
            session()->forget('currency_icon');
            session()->forget('currency_rate');
        }
        if ($currency) {
            session()->put('currency_code', $currency->currency_code);
            session()->put('currency_position', $currency->currency_position);
            session()->put('currency_icon', $currency->currency_icon);
            session()->put('currency_rate', $currency->currency_rate);

            $notification = __('Currency Changed Successfully');
            $notification = ['message' => $notification, 'alert-type' => 'success'];

            return redirect()->back()->with($notification);
        }
        getSessionCurrency();
        $notification = __('Currency Changed Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    })->name('set-currency');

    Route::get('/download-file/{file}', [HomeController::class, 'downloadListingFile'])->name('download-file');

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/join-as-a-provider', [HomeController::class, 'join_as_a_provider'])->name('join-as-a-provider');
    Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('about-us');
    Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contact-us');
    Route::post('/send-contact-message', [HomeController::class, 'sendContactMessage'])->name('send-contact-message');
    Route::get('/blogs', [HomeController::class, 'blogs'])->name('blogs');
    Route::get('/blog/{slug}', [HomeController::class, 'single_blog'])->name('blog');
    Route::post('/blog-comment', [HomeController::class, 'blogComment'])->name('blog-comment');
    Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
    Route::get('/terms-and-conditions', [HomeController::class, 'termsAndCondition'])->name('terms-and-conditions');
    Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy-policy');
    Route::get('/page/{slug}', [HomeController::class, 'customPage'])->name('page');
    Route::get('/services', [HomeController::class, 'services'])->name('services');
    Route::get('/service/{slug}', [HomeController::class, 'service'])->name('service');
    Route::get('/providers/{user_name}', [HomeController::class, 'provider'])->name('providers');
    Route::post('/store-service-review', [HomeController::class, 'storeServiceReview'])->name('store-service-review');

    Route::post('/subscribe-request', [HomeController::class, 'subscribeRequest'])->name('subscribe-request');
    Route::get('/subscriber-verification/{token}', [HomeController::class, 'subscriberVerifcation'])->name('subscriber-verification');

    Route::post('/request-provider', [HomeController::class, 'request_provider'])->name('request-provider');
    Route::post('/provider-registration/create-account', [HomeController::class, 'createProviderAccount'])->name('provider.registration.create-account');
    Route::post('/provider-registration/store-plan', [HomeController::class, 'storeProviderPlan'])->name('provider.registration.store-plan');
    Route::post('/check-username', [HomeController::class, 'checkUserName'])->name('check-username');
    Route::get('state-by-country/{id}', [HomeController::class, 'stateByCountry'])->name('state-by-country');
    Route::get('city-by-state/{id}', [HomeController::class, 'cityByState'])->name('city-by-state');

    Route::get('/check-provider-schedule', [PaymentController::class, 'check_provider_schedule'])->name('check-provider-schedule');

    Route::get('/ready-to-booking/{slug}', [PaymentController::class, 'ready_to_booking'])->name('ready-to-booking');

    Route::get('/get-available-schedule', [PaymentController::class, 'get_available_schedule'])->name('get-available-schedule');

    Route::get('/check-schedule-during-payment/{slug}', [PaymentController::class, 'check_schedule_during_payment'])->name('check-schedule-during-payment');

    Route::get('/apply-coupon', [PaymentController::class, 'apply_coupon'])->name('apply-coupon');
    Route::get('/remove-coupon', [PaymentController::class, 'removeCoupon'])->name('remove-coupon');

    Route::get('/booking-information/{slug}', [PaymentController::class, 'booking_information'])->name('booking-information');
    Route::get('/payment/{slug}', [PaymentController::class, 'payment'])->name('payment');

    // ⭐⭐⭐ NEW SERVICE LEADS ROUTES (PUBLIC) ⭐⭐⭐
    Route::post('/submit-service-lead', [HomeController::class, 'submitServiceLead'])->name('submit-service-lead');
    Route::get('/get-service-categories', [HomeController::class, 'getServiceCategories'])->name('get-service-categories');
    Route::post('/get-service-type-options', [HomeController::class, 'getServiceTypeOptions'])->name('get-service-type-options');

    // OTP Routes
    Route::post('/send-otp', [OTPController::class, 'sendOTP'])->name('send-otp');
    Route::post('/verify-otp', [OTPController::class, 'verifyOTP'])->name('verify-otp');

    Route::get('/login', [LoginController::class, 'loginPage'])->name('login');
    Route::post('/store-login', [LoginController::class, 'storeLogin'])->name('store-login');
    Route::get('/register', [RegisterController::class, 'loginPage'])->name('register');
    Route::post('/store-register', [RegisterController::class, 'storeRegister'])->name('store-register');
    Route::get('/user-verification/{token}', [RegisterController::class, 'userVerification'])->name('user-verification');
    Route::get('/forget-password', [LoginController::class, 'forgetPage'])->name('forget-password');
    Route::post('/send-forget-password', [LoginController::class, 'sendForgetPassword'])->name('send-forget-password');
    Route::get('/reset-password/{token}', [LoginController::class, 'resetPasswordPage'])->name('reset-password');
    Route::post('/store-reset-password/{token}', [LoginController::class, 'storeResetPasswordPage'])->name('store-reset-password');

    Route::get('login/google', [LoginController::class, 'redirectToGoogle'])->name('login-google');
    Route::get('/callback/google', [LoginController::class, 'googleCallBack'])->name('callback-google');

    Route::get('login/facebook', [LoginController::class, 'redirectToFacebook'])->name('login-facebook');
    Route::get('/callback/facebook', [LoginController::class, 'facebookCallBack'])->name('callback-facebook');

    Route::get('dashboard', [UserProfileController::class, 'dashboard'])->name('dashboard');

    Route::get('/user/logout', [LoginController::class, 'userLogout'])->name('user.logout');
    Route::get('/user/delete-account', [UserProfileController::class, 'delete_account'])->name('user.delete-account');
    Route::post('update-profile', [UserProfileController::class, 'updateProfile'])->name('update-profile');
    Route::post('update-password', [UserProfileController::class, 'updatePassword'])->name('update-password');
    Route::get('get-invoice/{id}', [UserProfileController::class, 'get_invoice'])->name('get-invoice');
    Route::get('mark-as-a-complete/{id}', [UserProfileController::class, 'mark_as_a_complete'])->name('mark-as-a-complete');
    Route::get('mark-as-a-declined/{id}', [UserProfileController::class, 'mark_as_a_declined'])->name('mark-as-a-declined');
    Route::post('send-refund-request', [UserProfileController::class, 'send_refund_request'])->name('send-refund-request');
    Route::post('ticket-request', [UserProfileController::class, 'ticket_request'])->name('ticket-request');
    Route::get('show-ticket/{id}', [UserProfileController::class, 'show_ticket'])->name('show-ticket');
    Route::post('send-ticket-message', [UserProfileController::class, 'send_ticket_message'])->name('send-ticket-message');

    Route::get('live-chat', [UserMessageController::class, 'index'])->name('live-chat');
    Route::get('load-chat-box/{id}', [UserMessageController::class, 'load_chat_box'])->name('load-chat-box');
    Route::post('send-message-to-provider', [UserMessageController::class, 'send_message_to_provider'])->name('send-message-to-provider');

    Route::group(['as' => 'provider.', 'prefix' => 'provider', 'middleware' => ['auth:web', 'checkprovider']], function () {
        Route::get('dashboard', [ProviderDashboardController::class, 'index'])->name('dashboard');
        Route::get('my-profile', [ProviderProfileController::class, 'index'])->name('my-profile');
        Route::get('state-by-country/{id}', [ProviderProfileController::class, 'stateByCountry'])->name('state-by-country');
        Route::get('city-by-state/{id}', [ProviderProfileController::class, 'cityByState'])->name('city-by-state');
        Route::get('change-password', [ProviderProfileController::class, 'changePassword'])->name('change-password');
        Route::put('password-update', [ProviderProfileController::class, 'updatePassword'])->name('password-update');
        Route::put('update-provider-profile', [ProviderProfileController::class, 'updateSellerProfile'])->name('update-provider-profile');

        Route::get('export-service-area/{state_id}', [ProviderProfileController::class, 'export_service_area'])->name('export-service-area');
        Route::get('export-selected-area', [ProviderProfileController::class, 'export_selected_area'])->name('export-selected-area');
        Route::post('store-import-service-area', [ProviderProfileController::class, 'store_import_service_area'])->name('store-import-service-area');
        Route::post('store-single-area', [ProviderProfileController::class, 'store_single_area'])->name('store-single-area');
        Route::delete('remove-single-area/{id}', [ProviderProfileController::class, 'remove_single_area'])->name('remove-single-area');

        Route::resource('my-withdraw', WithdrawController::class);
        Route::get('get-withdraw-account-info/{id}', [WithdrawController::class, 'getWithDrawAccountInfo'])->name('get-withdraw-account-info');

        Route::resource('service', ServiceController::class);
        Route::get('review-list', [ServiceController::class, 'reviewList'])->name('review-list');
        Route::get('show-review/{id}', [ServiceController::class, 'showReview'])->name('show-review');
        Route::get('awaiting-for-approval-service', [ServiceController::class, 'awaitingForApproval'])->name('awaiting-for-approval-service');
        Route::get('active-service', [ServiceController::class, 'activeService'])->name('active-service');
        Route::get('banned-service', [ServiceController::class, 'bannedService'])->name('banned-service');

        Route::resource('appointment-schedule', AppointmentScheduleController::class);

        Route::get('ticket', [ProviderTicketController::class, 'index'])->name('ticket');
        Route::get('ticket-show/{id}', [ProviderTicketController::class, 'show'])->name('ticket-show');
        Route::post('store-ticket-message', [ProviderTicketController::class, 'storeMessage'])->name('store-ticket-message');
        Route::get('create-new-ticket', [ProviderTicketController::class, 'createNewTicket'])->name('create-new-ticket');
        Route::post('store-new-ticket', [ProviderTicketController::class, 'storeNewTicket'])->name('store-new-ticket');

        Route::get('all-booking', [ProviderOrderController::class, 'index'])->name('all-booking');
        Route::get('awaiting-booking', [ProviderOrderController::class, 'awaitingBooking'])->name('awaiting-booking');
        Route::get('active-booking', [ProviderOrderController::class, 'activeBooking'])->name('active-booking');
        Route::get('completed-booking', [ProviderOrderController::class, 'completeBooking'])->name('completed-booking');
        Route::get('declined-booking', [ProviderOrderController::class, 'declineBooking'])->name('declined-booking');
        Route::put('booking-declined/{id}', [ProviderOrderController::class, 'bookingDecilendRequest'])->name('booking-declined');
        Route::put('booking-approved/{id}', [ProviderOrderController::class, 'bookingApprovedRequest'])->name('booking-approved');
        Route::put('payment-approved/{id}', [ProviderOrderController::class, 'paymentApproved'])->name('payment-approved');
        Route::get('booking-show/{id}', [ProviderOrderController::class, 'show'])->name('booking-show');

        Route::get('complete-request', [ProviderOrderController::class, 'completeRequest'])->name('complete-request');
        Route::post('send-order-complete-request', [ProviderOrderController::class, 'sendCompleteRequest'])->name('send-order-complete-request');

        Route::resource('coupon', CouponController::class);
        Route::get('coupon-history', [CouponController::class, 'coupon_history'])->name('coupon-history');

        Route::get('live-chat', [MessageController::class, 'index'])->name('live-chat');
        Route::get('load-chat-box/{id}', [MessageController::class, 'load_chat_box'])->name('load-chat-box');
        Route::post('send-message-to-buyer', [MessageController::class, 'send_message_to_buyer'])->name('send-message-to-buyer');

        Route::get('find-new-buyer/{id}', [MessageController::class, 'find_new_buyer'])->name('find-new-buyer');

        // ⭐⭐⭐ NEW SERVICE LEADS ROUTES (PROVIDER PANEL) ⭐⭐⭐
        Route::get('service-leads', [ProviderLeadController::class, 'index'])->name('leads');
        Route::get('service-leads/{leadId}', [ProviderLeadController::class, 'show'])->name('leads.show');
        Route::post('service-leads/{id}/update-status', [ProviderLeadController::class, 'updateStatus'])->name('leads.update-status');
        Route::post('service-leads/{id}/contacted', [ProviderLeadController::class, 'markAsContacted'])->name('leads.contacted');
        Route::post('service-leads/{id}/converted', [ProviderLeadController::class, 'markAsConverted'])->name('leads.converted');
        Route::get('api/new-leads-count', [ProviderLeadController::class, 'getNewLeadsCount'])->name('leads.count');

    });
});

require __DIR__ . '/admin.php';

Route::fallback(function () {
    abort(404);
});