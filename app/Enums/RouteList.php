<?php

namespace App\Enums;

enum RouteList {
    /**
     * @return mixed
     */
    public static function getAll(): object
    {
        $route_list = [
            (object) [
                'name'       => __('Dashboard'),
                'route'      => route('admin.dashboard'),
                'permission' => 'dashboard.view',
            ],
            (object) [
                'name'       => __('Menu Builder'),
                'route'      => route('admin.custom-menu.index'),
                'permission' => 'menu.view',
            ],
            (object) [
                'name'       => __('Customizable Page'),
                'route'      => route('admin.custom-pages.index'),
                'permission' => 'page.view',
            ],
            (object) [
                'name'       => __('Social Links'),
                'route'      => route('admin.social-link.index'),
                'permission' => 'social.link.management',
            ],
            (object) [
                'name'       => __('Subscriber List'),
                'route'      => route('admin.subscriber-list'),
                'permission' => 'newsletter.view',
            ],
            (object) [
                'name'       => __('Subscriber Send bulk mail'),
                'route'      => route('admin.send-mail-to-newsletter'),
                'permission' => 'newsletter.view',
            ],
            (object) [
                'name'       => __('General Settings'),
                'route'      => route('admin.general-setting'),
                'permission' => 'setting.view',
                'tab'        => 'general_tab',
            ],
            (object) [
                'name'       => __('Time & Date Setting'),
                'route'      => route('admin.general-setting'),
                'permission' => 'setting.view',
                'tab'        => 'website_tab',
            ],
            (object) [
                'name'       => __('Logo & Favicon'),
                'route'      => route('admin.general-setting'),
                'permission' => 'setting.view',
                'tab'        => 'logo_favicon_tab',
            ],
            (object) [
                'name'       => __('Cookie Consent'),
                'route'      => route('admin.general-setting'),
                'permission' => 'setting.view',
                'tab'        => 'custom_pagination_tab',
            ],
            (object) [
                'name'       => __('Default avatar'),
                'route'      => route('admin.general-setting'),
                'permission' => 'setting.view',
                'tab'        => 'default_avatar_tab',
            ],
            (object) [
                'name'       => __('Breadcrumb image'),
                'route'      => route('admin.general-setting'),
                'permission' => 'setting.view',
                'tab'        => 'breadcrump_img_tab',
            ],
            (object) [
                'name'       => __('Copyright Text'),
                'route'      => route('admin.general-setting'),
                'permission' => 'setting.view',
                'tab'        => 'copyright_text_tab',
            ],
            (object) [
                'name'       => __('Maintenance Mode'),
                'route'      => route('admin.general-setting'),
                'permission' => 'setting.view',
                'tab'        => 'mmaintenance_mode_tab',
            ],
            (object) [
                'name'       => __('Credential Settings'),
                'route'      => route('admin.crediential-setting'),
                'permission' => 'setting.view',
                'tab'        => 'google_recaptcha_tab',
            ],
            (object) [
                'name'       => __('Google reCaptcha'),
                'route'      => route('admin.crediential-setting'),
                'permission' => 'setting.view',
                'tab'        => 'google_recaptcha_tab'],
            (object) [
                'name'       => __('Google Tag Manager'),
                'route'      => route('admin.crediential-setting'),
                'permission' => 'setting.view',
                'tab'        => 'googel_tag_tab',
            ],
            (object) [
                'name'       => __('Google Analytic'),
                'route'      => route('admin.crediential-setting'),
                'permission' => 'setting.view',
                'tab'        => 'google_analytic_tab',
            ],
            (object) [
                'name'       => __('Facebook Pixel'),
                'route'      => route('admin.crediential-setting'),
                'permission' => 'setting.view',
                'tab'        => 'facebook_pixel_tab',
            ],
            (object) [
                'name'       => __('Social Login'),
                'route'      => route('admin.crediential-setting'),
                'permission' => 'setting.view',
                'tab'        => 'social_login_tab',
            ],
            (object) [
                'name'       => __('Tawk Chat'),
                'route'      => route('admin.crediential-setting'),
                'permission' => 'setting.view',
                'tab'        => 'tawk_chat_tab',
            ],
            (object) [
                'name'       => __('Pusher'),
                'route'      => route('admin.crediential-setting'),
                'permission' => 'setting.view',
                'tab'        => 'pusher_tab',
            ],
            (object) [
                'name'       => __('Email Configuration'),
                'route'      => route('admin.email-configuration'),
                'permission' => 'setting.view',
                'tab'        => 'setting_tab',
            ],
            (object) [
                'name'       => __('Email Template'),
                'route'      => route('admin.email-configuration'),
                'permission' => 'setting.view',
                'tab'        => 'email_template_tab',
            ],
            (object) [
                'name'       => __('SEO Setup'),
                'route'      => route('admin.seo-setting'),
                'permission' => 'setting.view',
            ],
            (object) [
                'name'       => __('Sitemap'),
                'route'      => route('admin.sitemap.index'),
                'permission' => 'sitemap.management',
            ],
            (object) [
                'name'       => __('Custom CSS'),
                'route'      => route('admin.custom-code', ['type' => 'css']),
                'permission' => 'setting.view',
            ],
            (object) [
                'name'       => __('Custom JS'),
                'route'      => route('admin.custom-code', ['type' => 'js']),
                'permission' => 'setting.view',
            ],
            (object) [
                'name'       => __('Clear cache'),
                'route'      => route('admin.cache-clear'),
                'permission' => 'setting.view',
            ],
            (object) [
                'name'       => __('Database Clear'),
                'route'      => route('admin.database-clear'),
                'permission' => 'setting.view',
            ],
            (object) [
                'name'       => __('System Update'),
                'route'      => route('admin.system-update.index'),
                'permission' => 'setting.view',
            ],
            (object) [
                'name'       => __('Manage Addons'),
                'route'      => route('admin.addons.view'),
                'permission' => 'setting.view',
            ],
            (object) [
                'name'       => __('Manage Language'),
                'route'      => route('admin.languages.index'),
                'permission' => 'language.view',
            ],
            (object) [
                'name'       => __('Basic Payment'),
                'route'      => route('admin.basicpayment'),
                'permission' => 'basic.payment.view',
            ],
            (object) [
                'name'       => __('Multi Currency'),
                'route'      => route('admin.currency.index'),
                'permission' => 'currency.view',
            ],
            (object) [
                'name'       => __('Manage Admin'),
                'route'      => route('admin.admin.index'),
                'permission' => 'admin.view',
            ],
            (object) [
                'name'       => __('Role & Permissions'),
                'route'      => route('admin.role.index'),
                'permission' => 'role.view',
            ],
            (object) [
                'name'       => __('About US'),
                'route'      => route('admin.about-us.index'),
                'permission' => 'dashboard.view',
            ],
            (object) ['name' => 'Active Booking', 'route' => route('admin.active-booking'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Active Service', 'route' => route('admin.active-service'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Admin', 'route' => route('admin.admin.index'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'All Booking', 'route' => route('admin.all-booking'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Awaiting Booking', 'route' => route('admin.awaiting-booking'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Banned Service', 'route' => route('admin.banned-service'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Banner Image', 'route' => route('admin.banner-image.index'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Blog', 'route' => route('admin.blog.index'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Blog Category', 'route' => route('admin.blog-category.index'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Cache Clear', 'route' => route('admin.cache-clear'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Category', 'route' => route('admin.category.index'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'City', 'route' => route('admin.city.index'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Complete Request', 'route' => route('admin.complete-request'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Completed Booking', 'route' => route('admin.completed-booking'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Contact Message', 'route' => route('admin.contact-message'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Contact Us', 'route' => route('admin.contact-us.index'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Counter', 'route' => route('admin.counter.index'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Country', 'route' => route('admin.country.index'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Coupon', 'route' => route('admin.coupon.index'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Credential Setting', 'route' => route('admin.crediential-setting'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Currency', 'route' => route('admin.currency.index'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Custom Pages', 'route' => route('admin.custom-pages.index'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Customer List', 'route' => route('admin.customer-list'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Dashboard', 'route' => route('admin.dashboard'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Database Clear', 'route' => route('admin.database-clear'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Declined Booking', 'route' => route('admin.declined-booking'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Default Avatar', 'route' => route('admin.default-avatar'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Email Configuration', 'route' => route('admin.email-configuration'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Error Page', 'route' => route('admin.error-page.index'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'FAQ', 'route' => route('admin.faq.index'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Footer', 'route' => route('admin.footer.index'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'General Setting', 'route' => route('admin.general-setting'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Home2 Contact', 'route' => route('admin.home2-contact'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'How It Works', 'route' => route('admin.how-it-work'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Job Post', 'route' => route('admin.jobpost.index'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Join as a Provider', 'route' => route('admin.join-as-a-provider'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'KYC', 'route' => route('admin.kyc.index'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Languages', 'route' => route('admin.languages.index'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Login Page', 'route' => route('admin.login-page'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Custom Menu', 'route' => route('admin.custom-menu.index'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Mobile App', 'route' => route('admin.mobile-app'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Mobile Slider', 'route' => route('admin.mobile-slider.index'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Partner', 'route' => route('admin.partner.index'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Pending Customer List', 'route' => route('admin.pending-customer-list'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Pending Plan Payment', 'route' => route('admin.pending-plan-payment'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Pending Provider', 'route' => route('admin.pending-provider'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Pending Provider Withdraw', 'route' => route('admin.pending-provider-withdraw'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Popular Blog', 'route' => route('admin.popular-blog.index'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Privacy Policy', 'route' => route('admin.privacy-policy.index'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Provider', 'route' => route('admin.provider'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Provider Withdraw', 'route' => route('admin.provider-withdraw'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Purchase History', 'route' => route('admin.purchase-history'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Refund Request', 'route' => route('admin.refund-request'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Reports', 'route' => route('admin.reports'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Review List', 'route' => route('admin.review-list'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Second Column Footer Link', 'route' => route('admin.second-col-footer-link'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Section Content', 'route' => route('admin.section-content'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Section Control', 'route' => route('admin.section-control'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'SEO Setting', 'route' => route('admin.seo-setting'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'SEO Setup', 'route' => route('admin.seo-setup'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Service', 'route' => route('admin.service.index'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Slider', 'route' => route('admin.slider.index'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Social Link', 'route' => route('admin.social-link.index'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'State', 'route' => route('admin.state.index'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Subscriber List', 'route' => route('admin.subscriber-list'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Subscriber Section', 'route' => route('admin.subscriber-section'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Subscription Plan', 'route' => route('admin.subscription-plan.index'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Terms and Conditions', 'route' => route('admin.terms-and-condition.index'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Testimonial', 'route' => route('admin.testimonial.index'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Third Column Footer Link', 'route' => route('admin.third-col-footer-link'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Ticket', 'route' => route('admin.ticket'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Topbar Contact', 'route' => route('admin.topbar-contact'), 'permission' => 'dashboard.view'],
            (object) ['name' => 'Withdraw Method', 'route' => route('admin.withdraw-method.index'), 'permission' => 'dashboard.view'],
        ];

        usort($route_list, function ($a, $b) {
            return strcmp($a->name, $b->name);
        });

        $route_list = collect($route_list)
            ->unique('name')
            ->values();

        return (object) $route_list;
    }
}
