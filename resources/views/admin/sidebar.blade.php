<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}"><img class="w-75" src="{{ asset($setting->logo) ?? '' }}"
                    alt="{{ $setting->app_name ?? '' }}"></a>
        </div>

        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}"><img src="{{ asset($setting->favicon) ?? '' }}"
                    alt="{{ $setting->app_name ?? '' }}"></a>
        </div>

        <ul class="sidebar-menu">
            @adminCan('dashboard.view')
                <li class="{{ isRoute('admin.dashboard', 'active') }}">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                </li>
            @endadminCan

            @adminCan('manage.booking')
                <li
                    class="nav-item dropdown {{ Route::is('admin.all-booking') || Route::is('admin.booking-show') || Route::is('admin.awaiting-booking') || Route::is('admin.complete-request') || Route::is('admin.active-booking') || Route::is('admin.completed-booking') || Route::is('admin.declined-booking') ? 'active' : '' }}">
                    <a class="nav-link has-dropdown" href="#"><i
                            class="fas fa-shopping-cart"></i><span>{{ __('All Bookings') }}</span></a>

                    <ul class="dropdown-menu">
                        <li
                            class="{{ Route::is('admin.all-booking') || Route::is('admin.booking-show') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.all-booking') }}">{{ __('All Bookings') }}</a>
                        </li>

                        <li class="{{ Route::is('admin.awaiting-booking') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.awaiting-booking') }}">{{ __('Awaiting Approval') }}</a></li>

                        <li class="{{ Route::is('admin.active-booking') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.active-booking') }}">{{ __('Active Bookings') }}</a></li>

                        <li class="{{ Route::is('admin.completed-booking') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.completed-booking') }}">{{ __('Completed Bookings') }}</a>
                        </li>

                        <li class="{{ Route::is('admin.complete-request') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.complete-request') }}">{{ __('Complete Request') }}</a></li>
                        <li class="{{ Route::is('admin.declined-booking') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.declined-booking') }}">{{ __('Declined Bookings') }}</a></li>

                    </ul>
                </li>
            @endadminCan

            @adminCan('subscription.view')
                @if ($setting->commission_type == 'subscription' && Module::isEnabled('Subscription'))
                    <li
                        class="nav-item dropdown {{ Route::is('admin.subscription-plan.*') || Route::is('admin.purchase-history') || Route::is('admin.assign-plan') || Route::is('admin.purchase-history-show') || Route::is('admin.pending-plan-payment') ? 'active' : '' }}">
                        <a class="nav-link has-dropdown" data-toggle="dropdown" href="#"><i class="fas fa-list"></i>
                            <span>{{ __('Subscription') }}
                                @if (env('APP_VERSION') == 'demo')
                                    <span class="badge badge-danger addon_text">{{ __('Addon') }}</span>
                                @endif
                            </span>

                        </a>
                        <ul class="dropdown-menu">
                            <li class="{{ Route::is('admin.subscription-plan.*') ? 'active' : '' }}"><a class="nav-link"
                                    href="{{ route('admin.subscription-plan.index') }}">{{ __('Subscription Plan') }}</a>
                            </li>

                            <li
                                class="{{ Route::is('admin.purchase-history') || Route::is('admin.purchase-history-show') ? 'active' : '' }}">
                                <a class="nav-link"
                                    href="{{ route('admin.purchase-history') }}">{{ __('Purchase History') }}</a>
                            </li>

                            <li class="{{ Route::is('admin.pending-plan-payment') ? 'active' : '' }}"><a class="nav-link"
                                    href="{{ route('admin.pending-plan-payment') }}">{{ __('Pending Payment') }}</a>
                            </li>

                            <li {{ Route::is('admin.assign-plan') ? 'active' : '' }}"><a class="nav-link"
                                    href="{{ route('admin.assign-plan') }}">{{ __('Assign Plan') }}</a></li>

                        </ul>
                    </li>
                @endif
            @endadminCan

            @adminCan('manage.services')
                <li
                    class="nav-item dropdown {{ Route::is('admin.service.*') || Route::is('admin.awaiting-for-approval-service') || Route::is('admin.active-service') || Route::is('admin.banned-service') || Route::is('admin.review-list') || Route::is('admin.show-review') ? 'active' : '' }}">
                    <a class="nav-link has-dropdown" href="#"><i
                            class="fas fa-th-large"></i><span>{{ __('Manage Services') }}</span></a>

                    <ul class="dropdown-menu">
                        <li class="{{ Route::is('admin.service.*') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.service.index') }}">{{ __('All Service') }}</a></li>

                        <li class="{{ Route::is('admin.awaiting-for-approval-service') ? 'active' : '' }}"><a
                                class="nav-link"
                                href="{{ route('admin.awaiting-for-approval-service') }}">{{ __('Awaiting for Approval') }}</a>
                        </li>

                        <li class="{{ Route::is('admin.active-service') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.active-service') }}">{{ __('Active Service') }}</a></li>

                        <li class="{{ Route::is('admin.banned-service') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.banned-service') }}">{{ __('Banned Service') }}</a></li>

                        <li class="{{ Route::is('admin.review-list') || Route::is('admin.show-review') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.review-list') }}">{{ __('Service Review') }}</a>
                        </li>
                    </ul>
                </li>
            @endadminCan

            @adminCan('manage.coupon')
                <li
                    class="nav-item dropdown {{ Route::is('admin.coupon.*') || Route::is('admin.coupon-history') ? 'active' : '' }}">
                    <a class="nav-link has-dropdown" href="#"><i
                            class="fas fa-th-large"></i><span>{{ __('Manage Coupon') }}</span></a>

                    <ul class="dropdown-menu">
                        <li class="{{ Route::is('admin.coupon.*') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.coupon.index') }}">{{ __('Coupon') }}</a></li>

                        <li class="{{ Route::is('admin.coupon-history') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.coupon-history') }}">{{ __('Coupon Histories') }}</a></li>

                    </ul>
                </li>
            @endadminCan

            @adminCan('manage.category')
                <li class="{{ Route::is('admin.category.*') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ route('admin.category.index') }}"><i class="fas fa-th-large"></i>
                        <span>{{ __('Categories') }}</span></a></li>
            @endadminCan

            @adminCan('manage.provider')
                <li
                    class="nav-item dropdown {{ Route::is('admin.provider') || Route::is('admin.send-email-to-all-provider') || Route::is('admin.send-email-to-provider') || Route::is('admin.pending-provider') || Route::is('admin.provider-show') ? 'active' : '' }}">
                    <a class="nav-link has-dropdown" href="#"><i
                            class="fas fa-users"></i><span>{{ __('Providers') }}</span></a>
                    <ul class="dropdown-menu">

                        <li class="{{ Route::is('admin.provider') || Route::is('admin.provider-show') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.provider') }}">{{ __('Provider List') }}</a>
                        </li>

                        <li class="{{ Route::is('admin.pending-provider') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.pending-provider') }}">{{ __('Pending Provider') }}</a></li>

                    </ul>
                </li>
            @endadminCan

            @adminCan('manage.kyc')
                @if (Module::isEnabled('Kyc'))
                    @include('kyc::Admin.sideber')
                @endif
            @endadminCan

            @adminCan('manage.job')
                @if (Module::isEnabled('JobPost'))
                    <li
                        class="{{ Route::is('admin.jobpost.*') || Route::is('admin.job-post-applicants') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.jobpost.index') }}"><i
                                class="fas fa-file-signature"></i> <span>{{ __('All Job Post') }}</span></a>
                    </li>
                @endif
            @endadminCan

            @adminCan('manage.user')
                <li
                    class="nav-item dropdown {{ Route::is('admin.customer-list') || Route::is('admin.customer-show') || Route::is('admin.pending-customer-list') || Route::is('admin.send-email-to-all-customer') ? 'active' : '' }}">
                    <a class="nav-link has-dropdown" href="#"><i
                            class="fas fa-users"></i><span>{{ __('Users') }}</span></a>
                    <ul class="dropdown-menu">
                        <li
                            class="{{ Route::is('admin.customer-list') || Route::is('admin.customer-show') || Route::is('admin.send-email-to-all-customer') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.customer-list') }}">{{ __('User List') }}</a>
                        </li>

                        <li class="{{ Route::is('admin.pending-customer-list') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.pending-customer-list') }}">{{ __('Pending User') }}</a></li>
                    </ul>
                </li>
            @endadminCan

            @adminCan('manage.refund')
                <li class="{{ Route::is('admin.refund-request') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ route('admin.refund-request') }}"><i class="fas fa-undo"></i>
                        <span>{{ __('Refund Request') }}</span></a>
                </li>
            @endadminCan

            @adminCan('manage.support.ticket')
                @php
                    $unseenMessages = \App\Models\TicketMessage::where('unseen_admin', 0)->groupBy('ticket_id')->get();
                    $count = $unseenMessages->count();
                @endphp

                <li class="{{ Route::is('admin.ticket') || Route::is('admin.ticket-show') ? 'active' : '' }}"><a
                        class="nav-link" href="{{ route('admin.ticket') }}"><i class="fas fa-envelope-open-text"></i>
                        <span>{{ __('Support Ticket') }} <sup
                                class="badge badge-danger">{{ $count }}</sup></span></a></li>
            @endadminCan

            @adminCan('manage.withdraw')
                <li
                    class="nav-item dropdown {{ Route::is('admin.withdraw-method.*') || Route::is('admin.provider-withdraw') || Route::is('admin.pending-provider-withdraw') || Route::is('admin.show-provider-withdraw') ? 'active' : '' }}">
                    <a class="nav-link has-dropdown" href="#"><i
                            class="far fa-newspaper"></i><span>{{ __('Withdraw Payment') }}</span></a>

                    <ul class="dropdown-menu">
                        <li class="{{ Route::is('admin.withdraw-method.*') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.withdraw-method.index') }}">{{ __('Withdraw Method') }}</a>
                        </li>

                        <li
                            class="{{ Route::is('admin.provider-withdraw') || Route::is('admin.show-provider-withdraw') ? 'active' : '' }}">
                            <a class="nav-link"
                                href="{{ route('admin.provider-withdraw') }}">{{ __('Provider Withdraw') }}</a>
                        </li>

                        <li class="{{ Route::is('admin.pending-provider-withdraw') ? 'active' : '' }}"><a
                                class="nav-link"
                                href="{{ route('admin.pending-provider-withdraw') }}">{{ __('Withdraw Request') }}</a>
                        </li>

                    </ul>
                </li>
            @endadminCan

            @adminCan('manage.website')
                <li
                    class="nav-item dropdown {{ Route::is('admin.mega-menu-category.*') || Route::is('admin.mega-menu-sub-category') || Route::is('admin.create-mega-menu-sub-category') || Route::is('admin.edit-mega-menu-sub-category') || Route::is('admin.mega-menu-banner') || Route::is('admin.banner-image.index') || Route::is('admin.cart-bottom-banner') || Route::is('admin.shop-page') || Route::is('admin.seo-setup') || Route::is('admin.product-detail-page') || Route::is('admin.default-avatar') || Route::is('admin.login-page') ? 'active' : '' }}">
                    <a class="nav-link has-dropdown" href="#"><i
                            class="fas fa-globe"></i><span>{{ __('Manage Website') }}</span></a>

                    <ul class="dropdown-menu">

                        <li class="{{ Route::is('admin.seo-setup') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.seo-setup') }}">{{ __('SEO Setup') }}</a></li>

                        <li class="{{ Route::is('admin.banner-image.index') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.banner-image.index') }}">{{ __('Banner Image') }}</a></li>

                        <li class="{{ Route::is('admin.login-page') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.login-page') }}">{{ __('Login Page') }}</a></li>

                        <li class="{{ Route::is('admin.default-avatar') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.default-avatar') }}">{{ __('Default Avatar') }}</a></li>

                    </ul>
                </li>
            @endadminCan

            @adminCan('manage.sections')
                <li
                    class="nav-item dropdown {{ Route::is('admin.mobile-slider.*') || Route::is('admin.slider.*') || Route::is('admin.counter.*') || Route::is('admin.testimonial.*') || Route::is('admin.join-as-a-provider') || Route::is('admin.mobile-app') || Route::is('admin.subscriber-section') || Route::is('admin.partner.*') || Route::is('admin.home2-contact') || Route::is('admin.how-it-work') || Route::is('admin.section-content') || Route::is('admin.section-control') ? 'active' : '' }}">
                    <a class="nav-link has-dropdown" href="#"><i
                            class="fas fa-th-large"></i><span>{{ __('All Section') }}</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ Route::is('admin.section-content') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.section-content') }}">{{ __('Section Content') }}</a></li>

                        <li class="{{ Route::is('admin.section-control') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.section-control') }}">{{ __('Section Control') }}</a></li>

                        <li class="{{ Route::is('admin.slider.*') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.slider.index') }}">{{ __('Intro section') }}</a></li>

                        <li class="{{ Route::is('admin.mobile-slider.*') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.mobile-slider.index') }}">{{ __('Mobile Slider') }}</a>
                        </li>

                        <li class="{{ Route::is('admin.counter.*') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.counter.index') }}">{{ __('Counter') }}</a></li>

                        <li class="{{ Route::is('admin.testimonial.*') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.testimonial.index') }}">{{ __('Testimonial') }}</a></li>

                        <li class="{{ Route::is('admin.join-as-a-provider') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.join-as-a-provider') }}">{{ __('Join as a Provider') }}</a>
                        </li>

                        <li class="{{ Route::is('admin.mobile-app') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.mobile-app') }}">{{ __('Mobile App') }}</a></li>

                        <li class="{{ Route::is('admin.subscriber-section') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.subscriber-section') }}">{{ __('Subscription Box') }}</a>
                        </li>

                        <li class="{{ Route::is('admin.partner.*') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.partner.index') }}">{{ __('Partner') }}</a></li>

                        @php
                            $selected_theme = $setting->selected_theme;
                        @endphp

                        @if ($selected_theme == 0 || $selected_theme == 2)
                            <li class="{{ Route::is('admin.home2-contact') ? 'active' : '' }}"><a class="nav-link"
                                    href="{{ route('admin.home2-contact') }}">{{ __('Home 2 Contact') }}</a></li>
                        @endif

                        @if ($selected_theme == 0 || $selected_theme == 3)
                            <li class="{{ Route::is('admin.how-it-work') ? 'active' : '' }}"><a class="nav-link"
                                    href="{{ route('admin.how-it-work') }}">{{ __('Home 3 How it work') }}</a>
                            </li>
                        @endif

                    </ul>
                </li>
            @endadminCan

            @adminCan('manage.header.footer')
                <li
                    class="nav-item dropdown {{ Route::is('admin.footer.*') || Route::is('admin.social-link.*') || Route::is('admin.footer-link.*') || Route::is('admin.second-col-footer-link') || Route::is('admin.third-col-footer-link') || Route::is('admin.topbar-contact') ? 'active' : '' }}">
                    <a class="nav-link has-dropdown" href="#"><i
                            class="fas fa-th-large"></i><span>{{ __('Header & Footer') }}</span></a>

                    <ul class="dropdown-menu">

                        <li class="{{ Route::is('admin.topbar-contact') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.topbar-contact') }}">{{ __('Header') }}</a></li>

                        <li class="{{ Route::is('admin.footer.*') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.footer.index') }}">{{ __('Footer') }}</a></li>

                        <li class="{{ Route::is('admin.social-link.*') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.social-link.index') }}">{{ __('Social Link') }}</a></li>

                        <li class="{{ Route::is('admin.footer-link.*') ? 'active' : '' }} d-none"><a class="nav-link"
                                href="{{ route('admin.footer-link.index') }}">{{ __('Footer First Column') }}</a>
                        </li>

                        <li class="{{ Route::is('admin.second-col-footer-link') ? 'active' : '' }} d-none"><a
                                class="nav-link"
                                href="{{ route('admin.second-col-footer-link') }}">{{ __('Footer Second Column') }}</a>
                        </li>

                    </ul>
                </li>
            @endadminCan

            @adminCan('manage.location')
                <li
                    class="nav-item dropdown {{ Route::is('admin.country.*') || Route::is('admin.state.*') || Route::is('admin.city.*') ? 'active' : '' }}">
                    <a class="nav-link has-dropdown" href="#"><i
                            class="fas fa-map-marker-alt"></i><span>{{ __('Locations') }}</span></a>

                    <ul class="dropdown-menu">
                        <li class="{{ Route::is('admin.country.*') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.country.index') }}">{{ __('Country / Region') }}</a></li>
                        <li class="{{ Route::is('admin.state.*') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.state.index') }}">{{ __('State / Province') }}</a></li>
                        <li class="{{ Route::is('admin.city.*') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.city.index') }}">{{ __('Service Area') }}</a></li>

                    </ul>
                </li>
            @endadminCan

            @adminCan('manage.report')
                <li class="{{ Route::is('admin.reports') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ route('admin.reports') }}"><i class="fas fa-file"></i>
                        <span>{{ __('Provider/Client Reports') }}</span></a></li>
            @endadminCan

            @adminCan('manage.website')
                <li
                    class="nav-item dropdown {{ Route::is('admin.about-us.*') || Route::is('admin.custom-page.*') || Route::is('admin.terms-and-condition.*') || Route::is('admin.privacy-policy.*') || Route::is('admin.faq.*') || Route::is('admin.error-page.*') || Route::is('admin.contact-us.*') ? 'active' : '' }}">
                    <a class="nav-link has-dropdown" href="#"><i
                            class="fas fa-columns"></i><span>{{ __('Pages') }}</span></a>

                    <ul class="dropdown-menu">
                        <li class="{{ Route::is('admin.about-us.*') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.about-us.index') }}">{{ __('About Us') }}</a></li>

                        <li class="{{ Route::is('admin.contact-us.*') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.contact-us.index') }}">{{ __('Contact Us') }}</a></li>

                        <li class="{{ Route::is('admin.terms-and-condition.*') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.terms-and-condition.index') }}">{{ __('Terms And Conditions') }}</a>
                        </li>

                        <li class="{{ Route::is('admin.privacy-policy.*') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.privacy-policy.index') }}">{{ __('Privacy Policy') }}</a>
                        </li>

                        <li class="{{ Route::is('admin.faq.*') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.faq.index') }}">{{ __('FAQ') }}</a></li>

                        <li class="{{ Route::is('admin.error-page.*') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.error-page.index') }}">{{ __('Error Page') }}</a></li>

                    </ul>
                </li>
            @endadminCan

            @adminCan('manage.blog')
                <li
                    class="nav-item dropdown {{ Route::is('admin.blog-category.*') || Route::is('admin.blog.*') || Route::is('admin.popular-blog.*') || Route::is('admin.blog-comment.*') ? 'active' : '' }}">
                    <a class="nav-link has-dropdown" href="#"><i
                            class="fas fa-th-large"></i><span>{{ __('Blogs') }}</span></a>

                    <ul class="dropdown-menu">
                        <li class="{{ Route::is('admin.blog-category.*') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.blog-category.index') }}">{{ __('Categories') }}</a></li>

                        <li class="{{ Route::is('admin.blog.*') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.blog.index') }}">{{ __('Blogs') }}</a></li>

                        <li class="{{ Route::is('admin.popular-blog.*') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.popular-blog.index') }}">{{ __('Popular Blogs') }}</a></li>

                        <li class="{{ Route::is('admin.blog-comment.*') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.blog-comment.index') }}">{{ __('Comments') }}</a></li>
                    </ul>
                </li>
            @endadminCan

            @adminCan('manage.contact.message')
                <li class="{{ Route::is('admin.contact-message') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ route('admin.contact-message') }}"><i class="fas fa-fa fa-envelope"></i>
                        <span>{{ __('Contact Message') }}</span></a></li>
            @endadminCan

            @if (checkAdminHasPermission('menu.view') ||
                    checkAdminHasPermission('page.view') ||
                    checkAdminHasPermission('social.link.management'))
                <li class="menu-header">{{ __('Manage Website') }}</li>

                @adminCan('manage.menu.builder')
                    @if (Module::isEnabled('CustomMenu') && checkAdminHasPermission('menu.view'))
                        @include('custommenu::sidebar')
                    @endif
                @endadminCan

                @adminCan('manage.page.builder')
                    @if (Module::isEnabled('PageBuilder') && checkAdminHasPermission('page.view'))
                        @include('pagebuilder::sidebar')
                    @endif
                @endadminCan
            @endif

            @if (checkAdminHasPermission('setting.view') ||
                    checkAdminHasPermission('basic.payment.view') ||
                    checkAdminHasPermission('payment.view') ||
                    checkAdminHasPermission('currency.view') ||
                    checkAdminHasPermission('tax.view') ||
                    checkAdminHasPermission('addon.view') ||
                    checkAdminHasPermission('language.view') ||
                    checkAdminHasPermission('role.view') ||
                    checkAdminHasPermission('admin.view'))
                <li class="menu-header">{{ __('Settings') }}</li>

                @if (Module::isEnabled('GlobalSetting'))
                    <li class="{{ isRoute('admin.settings', 'active') }}">
                        <a class="nav-link" href="{{ route('admin.settings') }}"><i class="fas fa-cog"></i>
                            <span>{{ __('Settings') }}</span>
                        </a>
                    </li>
                @endif
            @endif

            @if (checkAdminHasPermission('newsletter.view'))
                <li class="menu-header">{{ __('Utility') }}</li>

                @if (Module::isEnabled('NewsLetter') && checkAdminHasPermission('newsletter.view'))
                    @include('newsletter::sidebar')
                @endif
            @endif

            <li
                class="nav-item dropdown {{ isRoute('admin.addon.*') ? 'active' : '' }}" id="addon_sidemenu">
                <a class="nav-link has-dropdown" data-bs-toggle="dropdown" href="#"><i class="fas fa-gem"></i>
                    <span>{{ __('Manage Addon') }} </span>

                </a>
                <ul class="dropdown-menu addon_menu">

                    @includeIf('admin.addons')
                </ul>
            </li>
    </aside>
</div>
