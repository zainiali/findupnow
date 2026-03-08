<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('provider.dashboard') }}">{{ $setting->sidebar_lg_header }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('provider.dashboard') }}">{{ $setting->sidebar_sm_header }}</a>
        </div>

        @php
            $provider = Auth::guard('web')->user();
            $isPaymentComplete = $provider->payment_status === 'paid';
            $isProfileComplete = $provider->profile_completed;
            $isFullyActive = $isPaymentComplete && $isProfileComplete;
        @endphp

        <ul class="sidebar-menu">
            
            @if(!$isPaymentComplete)
                {{-- Only show subscription plan when payment is not complete --}}
                <li class="{{ Route::is('provider.subscription-plan') || Route::is('provider.subscription-payment') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('provider.subscription-plan') }}">
                        <i class="fas fa-credit-card"></i>
                        <span>{{ __('Complete Payment') }}</span>
                        <span class="badge badge-danger">{{ __('Required') }}</span>
                    </a>
                </li>

                {{-- Payment Gateway Options --}}
                @if($setting->commission_type == 'subscription')
                    @php
                        $json_module_data = file_get_contents(base_path('modules_statuses.json'));
                        $module_status = json_decode($json_module_data);
                    @endphp

                    @if($module_status->Subscription)
                        <li class="nav-item dropdown {{ Route::is('provider.paypal-gateway') || Route::is('provider.stripe-gateway') || Route::is('provider.razorpay-gateway') || Route::is('provider.flutterwave-gateway') || Route::is('provider.paystack-gateway') || Route::is('provider.mollie-gateway') || Route::is('provider.instamojo-gateway') || Route::is('provider.bank-handcash-gateway') || Route::is('provider.sslcommerz-gateway') || Route::is('provider.coin-gate-gateway') ? 'active' : '' }}">
                            <a class="nav-link has-dropdown" data-toggle="dropdown" href="#"><i class="fas fa-wallet"></i> <span>{{ __('Payment Methods') }}</span></a>
                            <ul class="dropdown-menu">
                                <li class="{{ Route::is('provider.paypal-gateway') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('provider.paypal-gateway') }}">{{ __('Paypal') }}</a>
                                </li>
                                <li class="{{ Route::is('provider.stripe-gateway') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('provider.stripe-gateway') }}">{{ __('Stripe') }}</a>
                                </li>
                                <li class="{{ Route::is('provider.razorpay-gateway') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('provider.razorpay-gateway') }}">{{ __('Razorpay') }}</a>
                                </li>
                                <li class="{{ Route::is('provider.flutterwave-gateway') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('provider.flutterwave-gateway') }}">{{ __('Flutterwave') }}</a>
                                </li>
                                <li class="{{ Route::is('provider.paystack-gateway') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('provider.paystack-gateway') }}">{{ __('Paystack') }}</a>
                                </li>
                                <li class="{{ Route::is('provider.mollie-gateway') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('provider.mollie-gateway') }}">{{ __('Mollie') }}</a>
                                </li>
                                <li class="{{ Route::is('provider.instamojo-gateway') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('provider.instamojo-gateway') }}">{{ __('Instamojo') }}</a>
                                </li>
                                <li class="{{ Route::is('provider.bank-handcash-gateway') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('provider.bank-handcash-gateway') }}">{{ __('Bank & Handcash') }}</a>
                                </li>
                                <li class="{{ Route::is('provider.sslcommerz-gateway') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('provider.sslcommerz-gateway') }}">{{ __('Sslcommerz') }}</a>
                                </li>
                                <li class="{{ Route::is('provider.coin-gate-gateway') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('provider.coin-gate-gateway') }}">{{ __('Crypto Gateway') }}</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                @endif

            @elseif($isPaymentComplete && !$isProfileComplete)
                {{-- Show profile completion when payment is done but profile is not --}}
                <li class="{{ Route::is('provider.complete-profile') || Route::is('provider.profile') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('provider.complete-profile') }}">
                        <i class="fas fa-user-edit"></i>
                        <span>{{ __('Complete Your Profile') }}</span>
                        <span class="badge badge-warning">{{ __('Required') }}</span>
                    </a>
                </li>

            @else
                {{-- Show full menu when everything is complete --}}
                <li class="{{ Route::is('provider.dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('provider.dashboard') }}">
                        <i class="fas fa-home"></i>
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                </li>

                <li class="nav-item dropdown {{ Route::is('provider.all-booking') || Route::is('provider.pending-booking') || Route::is('provider.booking-show') || Route::is('provider.awaiting-booking') || Route::is('provider.active-booking') || Route::is('provider.completed-booking') || Route::is('provider.declined-booking') || Route::is('provider.complete-request') ? 'active' : '' }}">
                    <a class="nav-link has-dropdown" href="#"><i class="fas fa-shopping-cart"></i><span>{{ __('My Bookings') }}</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ Route::is('provider.all-booking') || Route::is('provider.booking-show') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('provider.all-booking') }}">{{ __('All Bookings') }}</a>
                        </li>
                        <li class="{{ Route::is('provider.awaiting-booking') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('provider.awaiting-booking') }}">{{ __('Awaiting Approval') }}</a>
                        </li>
                        <li class="{{ Route::is('provider.active-booking') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('provider.active-booking') }}">{{ __('Active Bookings') }}</a>
                        </li>
                        <li class="{{ Route::is('provider.completed-booking') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('provider.completed-booking') }}">{{ __('Completed Bookings') }}</a>
                        </li>
                        <li class="{{ Route::is('provider.complete-request') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('provider.complete-request') }}">{{ __('Complete Request') }}</a>
                        </li>
                        <li class="{{ Route::is('provider.declined-booking') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('provider.declined-booking') }}">{{ __('Declined Bookings') }}</a>
                        </li>
                    </ul>
                </li>

                @php
                    $unseenMessages = App\Models\TicketMessage::where(['unseen_user' => 0, 'user_id' => $provider->id])
                        ->groupBy('ticket_id')
                        ->get();
                    $count = $unseenMessages->count();
                @endphp

                <li class="{{ Route::is('provider.ticket') || Route::is('provider.ticket-show') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('provider.ticket') }}">
                        <i class="fas fa-envelope-open-text"></i>
                        <span>{{ __('Support Ticket') }} <sup class="badge badge-danger">{{ $count }}</sup></span>
                    </a>
                </li>

                <li class="nav-item dropdown {{ Route::is('provider.service.*') || Route::is('provider.awaiting-for-approval-service') || Route::is('provider.active-service') || Route::is('provider.banned-service') || Route::is('provider.review-list') || Route::is('provider.show-review') ? 'active' : '' }}">
                    <a class="nav-link has-dropdown" href="#"><i class="fas fa-th-large"></i><span>{{ __('Manage Services') }}</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ Route::is('provider.service.*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('provider.service.index') }}">{{ __('All Service') }}</a>
                        </li>
                        <li class="{{ Route::is('provider.awaiting-for-approval-service') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('provider.awaiting-for-approval-service') }}">{{ __('Awaiting for Approval') }}</a>
                        </li>
                        <li class="{{ Route::is('provider.active-service') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('provider.active-service') }}">{{ __('Active Service') }}</a>
                        </li>
                        <li class="{{ Route::is('provider.banned-service') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('provider.banned-service') }}">{{ __('Banned Service') }}</a>
                        </li>
                        <li class="{{ Route::is('provider.review-list') || Route::is('provider.show-review') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('provider.review-list') }}">{{ __('Service Review') }}</a>
                        </li>
                    </ul>
                </li>

                <li class="{{ Route::is('provider.appointment-schedule.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('provider.appointment-schedule.index') }}">
                        <i class="far fa-newspaper"></i>
                        <span>{{ __('Appointment Schedule') }}</span>
                    </a>
                </li>

                <li class="{{ Route::is('provider.live-chat') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('provider.live-chat') }}">
                        <i class="far fa-newspaper"></i>
                        <span>{{ __('Live Chat') }}</span>
                    </a>
                </li>

                {{-- SERVICE LEADS MENU - ONLY FOR PAID PROVIDERS --}}
                @php
                    $newLeadsCount = App\Models\ServiceLead::forProvider(Auth::id())->where('status', 'new')->count();
                @endphp
                <li class="{{ Route::is('provider.leads*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('provider.leads') }}">
                        <i class="fas fa-bullhorn"></i>
                        <span>{{ __('Service Leads') }}</span>
                        @if($newLeadsCount > 0)
                            <sup class="badge badge-danger">{{ $newLeadsCount }}</sup>
                        @endif
                    </a>
                </li>
                {{-- END SERVICE LEADS MENU --}}

                <li class="nav-item dropdown {{ Route::is('provider.coupon.*') || Route::is('provider.coupon-history') ? 'active' : '' }}">
                    <a class="nav-link has-dropdown" href="#"><i class="fas fa-th-large"></i><span>{{ __('Manage Coupon') }}</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ Route::is('provider.coupon.*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('provider.coupon.index') }}">{{ __('Coupon') }}</a>
                        </li>
                        <li class="{{ Route::is('provider.coupon-history') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('provider.coupon-history') }}">{{ __('Coupon Histories') }}</a>
                        </li>
                    </ul>
                </li>

                @if($setting->commission_type == 'commission')
                    <li class="{{ Route::is('seller.my-withdraw.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('provider.my-withdraw.index') }}">
                            <i class="far fa-newspaper"></i>
                            <span>{{ __('My Withdraw') }}</span>
                        </a>
                    </li>
                @endif

                @if($setting->commission_type == 'subscription')
                    @php
                        $json_module_data = file_get_contents(base_path('modules_statuses.json'));
                        $module_status = json_decode($json_module_data);
                    @endphp

                    @if($module_status->Subscription)
                        <li class="nav-item dropdown {{ Route::is('provider.subscription-plan') || Route::is('provider.purchase-history') || Route::is('provider.purchase-history-show') || Route::is('provider.pending-plan-payment') || Route::is('provider.subscription-payment') ? 'active' : '' }}">
                            <a class="nav-link has-dropdown" data-toggle="dropdown" href="#"><i class="fas fa-user"></i> <span>{{ __('Subscription Plan') }}</span></a>
                            <ul class="dropdown-menu">
                                <li class="{{ Route::is('provider.subscription-plan') || Route::is('provider.subscription-payment') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('provider.subscription-plan') }}">{{ __('Subscription Plan') }}</a>
                                </li>
                                <li class="{{ Route::is('provider.purchase-history') || Route::is('provider.purchase-history-show') || Route::is('provider.pending-plan-payment') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('provider.purchase-history') }}">{{ __('Purchase History') }}</a>
                                </li>
                                <li class="{{ Route::is('provider.pending-plan-payment') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('provider.pending-plan-payment') }}">{{ __('Pending Payment') }}</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                @endif

                @if(Module::isEnabled('Kyc'))
                    <li class="{{ Route::is('provider.kyc') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('provider.kyc') }}">
                            <i class="far fa-newspaper"></i>
                            <span>{{ __('KYC Verifaction') }}</span>
                        </a>
                    </li>
                @endif
            @endif
        </ul>
    </aside>
</div>