<?php

use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\AddonsController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
/*  Start Admin panel Controller  */
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogCommentController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BreadcrumbController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\ContactPageController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CountryStateController;
use App\Http\Controllers\Admin\CouponController as AdminCouponController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ErrorPageController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FooterController;
use App\Http\Controllers\Admin\FooterLinkController;
use App\Http\Controllers\Admin\FooterSocialLinkController;
use App\Http\Controllers\Admin\MobileSliderController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\PopularBlogController;
use App\Http\Controllers\Admin\PrivacyPolicyController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\ProviderController;
use App\Http\Controllers\Admin\ProviderWithdrawController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TermsAndConditionController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\WithdrawMethodController;
use Illuminate\Support\Facades\Route;

/*  End Admin panel Controller  */

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['translation', 'demo']], function () {
    /* Start admin auth route */
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('store-login', [AuthenticatedSessionController::class, 'store'])->name('store-login');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forget-password', [PasswordResetLinkController::class, 'custom_forget_password'])->name('forget-password');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'custom_reset_password_page'])->name('password.reset');
    Route::post('/reset-password-store/{token}', [NewPasswordController::class, 'custom_reset_password_store'])->name('password.reset-store');
    /* End admin auth route */

    Route::middleware(['auth:admin', 'demo'])->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard']);
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

        Route::controller(AdminProfileController::class)->group(function () {
            Route::get('edit-profile', 'edit_profile')->name('edit-profile');
            Route::put('profile-update', 'profile_update')->name('profile-update');
            Route::put('update-password', 'update_password')->name('update-password');
        });

        Route::get('role/assign', [RolesController::class, 'assignRoleView'])->name('role.assign');
        Route::post('role/assign/{id}', [RolesController::class, 'getAdminRoles'])->name('role.assign.admin');
        Route::put('role/assign', [RolesController::class, 'assignRoleUpdate'])->name('role.assign.update');
        Route::resource('/role', RolesController::class);
        Route::resource('/role', RolesController::class);

        Route::resource('admin', AdminController::class)->except('show');
        Route::put('admin-status/{id}', [AdminController::class, 'changeStatus'])->name('admin.status');
        Route::get('settings', [SettingController::class, 'settings'])->name('settings');
        Route::get('sync-modules', [AddonsController::class, 'syncModules'])->name('addons.sync');

        // about us routes
        Route::resource('about-us', AboutUsController::class);
        Route::post('store-how-it-work', [AboutUsController::class, 'addNewHotItWork'])->name('store-how-it-work');
        Route::put('update-how-it-work/{id}', [AboutUsController::class, 'updateHotItWork'])->name('update-how-it-work');
        Route::delete('delete-how-it-work/{id}', [AboutUsController::class, 'deleteHotItWork'])->name('delete-how-it-work');

        Route::put('update-header', [AboutUsController::class, 'updateHeader'])->name('update-header');
        Route::put('update-about-us', [AboutUsController::class, 'updateAboutUs'])->name('update-about-us');
        Route::put('update-why-choose-use', [AboutUsController::class, 'updateWhyChooseUs'])->name('update-why-choose-use');

        Route::resource('service', AdminServiceController::class);
        Route::get('awaiting-for-approval-service', [AdminServiceController::class, 'awaitingForApproval'])->name('awaiting-for-approval-service');
        Route::get('active-service', [AdminServiceController::class, 'activeService'])->name('active-service');
        Route::get('banned-service', [AdminServiceController::class, 'bannedService'])->name('banned-service');

        Route::get('review-list', [AdminServiceController::class, 'reviewList'])->name('review-list');
        Route::get('show-review/{id}', [AdminServiceController::class, 'showReview'])->name('show-review');
        Route::delete('delete-service-review/{id}', [AdminServiceController::class, 'deleteReview'])->name('delete-service-review');
        Route::put('update-review/{id}', [AdminServiceController::class, 'updateReview'])->name('update-review');

        Route::get('provider', [ProviderController::class, 'index'])->name('provider');
        Route::get('pending-provider', [ProviderController::class, 'pendingProvider'])->name('pending-provider');
        Route::get('provider-show/{id}', [ProviderController::class, 'show'])->name('provider-show');
        Route::put('provider-update/{id}', [ProviderController::class, 'updateProvider'])->name('provider-update');
        Route::delete('provider-delete/{id}', [ProviderController::class, 'destroy'])->name('provider-delete');
        Route::put('provider-status/{id}', [ProviderController::class, 'changeStatus'])->name('provider-status');

        Route::get('send-email-to-all-provider', [ProviderController::class, 'sendEmailToAllProvider'])->name('send-email-to-all-provider');
        Route::post('send-mail-to-all-provider', [ProviderController::class, 'sendMailToAllProvider'])->name('send-mail-to-all-provider');
        Route::get('send-email-to-provider/{id}', [ProviderController::class, 'sendEmailToProvider'])->name('send-email-to-provider');
        Route::post('send-mail-to-single-provider/{id}', [ProviderController::class, 'sendMailtoSingleProvider'])->name('send-mail-to-single-provider');

        Route::resource('withdraw-method', WithdrawMethodController::class);
        Route::put('withdraw-method-status/{id}', [WithdrawMethodController::class, 'changeStatus'])->name('withdraw-method-status');

        Route::get('provider-withdraw', [ProviderWithdrawController::class, 'index'])->name('provider-withdraw');
        Route::get('pending-provider-withdraw', [ProviderWithdrawController::class, 'pendingProviderWithdraw'])->name('pending-provider-withdraw');

        Route::get('show-provider-withdraw/{id}', [ProviderWithdrawController::class, 'show'])->name('show-provider-withdraw');
        Route::delete('delete-provider-withdraw/{id}', [ProviderWithdrawController::class, 'destroy'])->name('delete-provider-withdraw');
        Route::put('approved-provider-withdraw/{id}', [ProviderWithdrawController::class, 'approvedWithdraw'])->name('approved-provider-withdraw');

        Route::get('all-booking', [OrderController::class, 'index'])->name('all-booking');
        Route::get('active-booking', [OrderController::class, 'activeBooking'])->name('active-booking');
        Route::get('awaiting-booking', [OrderController::class, 'awaitingBooking'])->name('awaiting-booking');
        Route::get('completed-booking', [OrderController::class, 'completeBooking'])->name('completed-booking');
        Route::get('declined-booking', [OrderController::class, 'declineBooking'])->name('declined-booking');
        Route::put('booking-declined/{id}', [OrderController::class, 'bookingDecilendRequest'])->name('booking-declined');
        Route::put('booking-approved/{id}', [OrderController::class, 'bookingApprovedRequest'])->name('booking-approved');
        Route::put('payment-approved/{id}', [OrderController::class, 'paymentApproved'])->name('payment-approved');

        Route::put('booking-mark-as-complete/{id}', [OrderController::class, 'bookingCompleteRequest'])->name('booking-mark-as-complete');
        Route::get('complete-request', [OrderController::class, 'completeRequest'])->name('complete-request');
        Route::put('refund-request-declined/{id}', [OrderController::class, 'RefundRequestDecilend'])->name('refund-request-declined');
        Route::put('refund-request-approved/{id}', [OrderController::class, 'RefundRequestApproved'])->name('refund-request-approved');
        Route::get('refund-request', [OrderController::class, 'refundRequest'])->name('refund-request');
        Route::get('booking-show/{id}', [OrderController::class, 'show'])->name('booking-show');
        Route::delete('delete-order/{id}', [OrderController::class, 'destroy'])->name('delete-order');

        Route::get('reports', [OrderController::class, 'providerClientReport'])->name('reports');
        Route::delete('delete-client-provider-report/{id}', [OrderController::class, 'deleteProviderClientReport'])->name('delete-client-provider-report');

        Route::resource('coupon', AdminCouponController::class);
        Route::get('coupon-history', [AdminCouponController::class, 'coupon_history'])->name('coupon-history');

        Route::resource('category', CategoryController::class);
        Route::put('category-status/{id}', [CategoryController::class, 'changeStatus'])->name('category.status');

        Route::get('customer-list', [CustomerController::class, 'index'])->name('customer-list');
        Route::get('customer-show/{id}', [CustomerController::class, 'show'])->name('customer-show');
        Route::put('customer-status/{id}', [CustomerController::class, 'changeStatus'])->name('customer-status');
        Route::delete('customer-delete/{id}', [CustomerController::class, 'destroy'])->name('customer-delete');
        Route::get('pending-customer-list', [CustomerController::class, 'pendingCustomerList'])->name('pending-customer-list');
        Route::get('send-email-to-all-customer', [CustomerController::class, 'sendEmailToAllUser'])->name('send-email-to-all-customer');
        Route::post('send-mail-to-all-user', [CustomerController::class, 'sendMailToAllUser'])->name('send-mail-to-all-user');
        Route::post('send-mail-to-single-user/{id}', [CustomerController::class, 'sendMailToSingleUser'])->name('send-mail-to-single-user');

        Route::get('ticket', [TicketController::class, 'index'])->name('ticket');
        Route::get('ticket-show/{id}', [TicketController::class, 'show'])->name('ticket-show');
        Route::delete('ticket-delete/{id}', [TicketController::class, 'destroy'])->name('ticket-delete');
        Route::put('ticket-closed/{id}', [TicketController::class, 'closed'])->name('ticket-closed');
        Route::post('store-ticket-message', [TicketController::class, 'storeMessage'])->name('store-ticket-message');

        Route::get('default-avatar', [ContentController::class, 'defaultAvatar'])->name('default-avatar');
        Route::put('update-default-avatars', [ContentController::class, 'updateDefaultAvatar'])->name('update-default-avatars');

        Route::get('login-page', [ContentController::class, 'login_page'])->name('login-page');
        Route::put('update-login-page', [ContentController::class, 'update_login_page'])->name('update-login-page');

        Route::get('seo-setup', [ContentController::class, 'seoSetup'])->name('seo-setup');
        Route::put('update-seo-setup/{id}', [ContentController::class, 'updateSeoSetup'])->name('update-seo-setup');

        Route::resource('banner-image', BreadcrumbController::class);

        Route::get('section-content', [ContentController::class, 'sectionContent'])->name('section-content');
        Route::put('update-section-content/{id}', [ContentController::class, 'updateSectionContent'])->name('update-section-content');

        Route::get('section-control', [ContentController::class, 'sectionControl'])->name('section-control');
        Route::put('update-section-control', [ContentController::class, 'updateSectionControl'])->name('update-section-control');

        Route::resource('slider', SliderController::class);
        Route::put('slider-status/{id}', [SliderController::class, 'changeStatus'])->name('slider-status');

        Route::resource('mobile-slider', MobileSliderController::class);

        Route::resource('counter', CounterController::class);
        Route::put('counter-status/{id}', [CounterController::class, 'changeStatus'])->name('counter.status');
        Route::put('update-counter-bg', [CounterController::class, 'updateCounterBg'])->name('update-counter-bg');

        Route::resource('testimonial', TestimonialController::class);
        Route::put('testimonial-status/{id}', [TestimonialController::class, 'changeStatus'])->name('testimonial.status');

        Route::get('join-as-a-provider', [ContentController::class, 'joinAsAProvider'])->name('join-as-a-provider');
        Route::put('update-join-as-a-provider', [ContentController::class, 'updatejoinAsAProvider'])->name('update-join-as-a-provider');

        Route::get('mobile-app', [ContentController::class, 'mobileApp'])->name('mobile-app');
        Route::put('update-mobile-app', [ContentController::class, 'updateMobileApp'])->name('update-mobile-app');

        Route::get('subscriber-section', [ContentController::class, 'subscriberSection'])->name('subscriber-section');
        Route::put('update-subscriber-section', [ContentController::class, 'updateSubscriberSection'])->name('update-subscriber-section');

        Route::get('home2-contact', [ContentController::class, 'home2Contact'])->name('home2-contact');
        Route::put('update-home2-contact', [ContentController::class, 'updateHome2Contact'])->name('update-home2-contact');

        Route::resource('partner', PartnerController::class);
        Route::put('partner-status/{id}', [PartnerController::class, 'changeStatus'])->name('partner-status');

        Route::get('how-it-work', [ContentController::class, 'howItWork'])->name('how-it-work');
        Route::put('update-how-it-work', [ContentController::class, 'updateHowItWork'])->name('home-update-how-it-work');

        Route::resource('footer', FooterController::class);
        Route::resource('social-link', FooterSocialLinkController::class);
        Route::resource('footer-link', FooterLinkController::class);
        Route::get('second-col-footer-link', [FooterLinkController::class, 'secondColFooterLink'])->name('second-col-footer-link');
        Route::get('third-col-footer-link', [FooterLinkController::class, 'thirdColFooterLink'])->name('third-col-footer-link');
        Route::put('update-col-title/{id}', [FooterLinkController::class, 'updateColTitle'])->name('update-col-title');

        Route::get('topbar-contact', [ContentController::class, 'headerPhoneNumber'])->name('topbar-contact');
        Route::put('update-topbar-contact', [ContentController::class, 'updateHeaderPhoneNumber'])->name('update-topbar-contact');

        Route::resource('country', CountryController::class);
        Route::put('country-status/{id}', [CountryController::class, 'changeStatus'])->name('country-status');

        Route::resource('state', CountryStateController::class);
        Route::put('state-status/{id}', [CountryStateController::class, 'changeStatus'])->name('state-status');

        Route::resource('city', CityController::class);
        Route::put('city-status/{id}', [CityController::class, 'changeStatus'])->name('city-status');

        Route::get('state-by-country/{id}', [CityController::class, 'stateByCountry'])->name('state-by-country');
        Route::get('city-by-state/{id}', [CityController::class, 'cityByState'])->name('city-by-state');

        Route::get('reports', [OrderController::class, 'providerClientReport'])->name('reports');
        Route::delete('delete-client-provider-report/{id}', [OrderController::class, 'deleteProviderClientReport'])->name('delete-client-provider-report');

        Route::resource('about-us', AboutUsController::class);

        Route::resource('contact-us', ContactPageController::class);

        // Route::resource('custom-page', CustomPageController::class);
        // Route::put('custom-page-status/{id}', [CustomPageController::class, 'changeStatus'])->name('custom-page.status');

        Route::resource('terms-and-condition', TermsAndConditionController::class);
        Route::resource('privacy-policy', PrivacyPolicyController::class);

        Route::resource('faq', FaqController::class);
        Route::put('faq-status/{id}', [FaqController::class, 'changeStatus'])->name('faq-status');

        Route::resource('error-page', ErrorPageController::class);

        Route::resource('blog-category', BlogCategoryController::class);
        Route::put('blog-category-status/{id}', [BlogCategoryController::class, 'changeStatus'])->name('blog.category.status');

        Route::resource('blog', BlogController::class);
        Route::put('blog-status/{id}', [BlogController::class, 'changeStatus'])->name('blog.status');

        Route::resource('popular-blog', PopularBlogController::class);
        Route::put('popular-blog-status/{id}', [PopularBlogController::class, 'changeStatus'])->name('popular-blog.status');

        Route::resource('blog-comment', BlogCommentController::class);
        Route::put('blog-comment-status/{id}', [BlogCommentController::class, 'changeStatus'])->name('blog-comment.status');

        Route::get('contact-message', [ContactMessageController::class, 'index'])->name('contact-message');
        Route::delete('delete-contact-message/{id}', [ContactMessageController::class, 'destroy'])->name('delete-contact-message');
        Route::put('enable-save-contact-message', [ContactMessageController::class, 'handleSaveContactMessage'])->name('enable-save-contact-message');
    });
});
