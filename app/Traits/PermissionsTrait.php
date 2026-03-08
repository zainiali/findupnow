<?php

namespace App\Traits;

use ReflectionClass;

trait PermissionsTrait
{
    public static array $dashboardPermissions = [
        'group_name'  => 'dashboard',
        'permissions' => [
            'dashboard.view',
        ],
    ];

    public static array $adminProfilePermissions = [
        'group_name'  => 'admin profile',
        'permissions' => [
            'admin.profile.view',
            'admin.profile.update',
        ],
    ];

    public static array $adminPermissions = [
        'group_name'  => 'admin',
        'permissions' => [
            'admin.view',
            'admin.create',
            'admin.store',
            'admin.edit',
            'admin.update',
            'admin.delete',
        ],
    ];

    public static array $rolePermissions = [
        'group_name'  => 'role',
        'permissions' => [
            'role.view',
            'role.create',
            'role.store',
            'role.assign',
            'role.edit',
            'role.update',
            'role.delete',
        ],
    ];

    public static array $settingPermissions = [
        'group_name'  => 'setting',
        'permissions' => [
            'setting.view',
            'setting.update',
        ],
    ];

    public static array $basicPaymentPermissions = [
        'group_name'  => 'basic payment',
        'permissions' => [
            'basic.payment.view',
            'basic.payment.update',
        ],
    ];

    public static array $currencyPermissions = [
        'group_name'  => 'currency',
        'permissions' => [
            'currency.view',
            'currency.create',
            'currency.store',
            'currency.edit',
            'currency.update',
            'currency.delete',
        ],
    ];

    public static array $customerPermissions = [
        'group_name'  => 'customer',
        'permissions' => [
            'customer.view',
            'customer.bulk.mail',
            'customer.create',
            'customer.store',
            'customer.edit',
            'customer.update',
            'customer.delete',
        ],
    ];

    public static array $languagePermissions = [
        'group_name'  => 'language',
        'permissions' => [
            'language.view',
            'language.create',
            'language.store',
            'language.edit',
            'language.update',
            'language.delete',
            'language.translate',
            'language.single.translate',
        ],
    ];

    public static array $menuPermissions = [
        'group_name'  => 'menu builder',
        'permissions' => [
            'menu.view',
            'menu.create',
            'menu.update',
            'menu.delete',
        ],
    ];

    public static array $pagePermissions = [
        'group_name'  => 'page builder',
        'permissions' => [
            'page.view',
            'page.create',
            'page.store',
            'page.edit',
            'page.component.add',
            'page.update',
            'page.delete',
        ],
    ];

    public static array $subscriptionPermissions = [
        'group_name'  => 'subscription',
        'permissions' => [
            'subscription.view',
            'subscription.create',
            'subscription.store',
            'subscription.edit',
            'subscription.update',
            'subscription.delete',
        ],
    ];

    public static array $paymentPermissions = [
        'group_name'  => 'payment',
        'permissions' => [
            'payment.view',
            'payment.update',
        ],
    ];

    public static array $socialPermission = [
        'group_name'  => 'social link management',
        'permissions' => [
            'social.link.management',
        ],
    ];

    public static array $sitemapPermission = [
        'group_name'  => 'sitemap management',
        'permissions' => [
            'sitemap.management',
        ],
    ];

    public static array $taxPermission = [
        'group_name'  => 'tax management',
        'permissions' => [
            'tax.view',
            'tax.create',
            'tax.translate',
            'tax.store',
            'tax.edit',
            'tax.update',
            'tax.delete',
        ],
    ];

    public static array $newsletterPermissions = [
        'group_name'  => 'newsletter',
        'permissions' => [
            'newsletter.view',
            'newsletter.mail',
            'newsletter.delete',
        ],
    ];

    public static array $addonsPermissions = [
        'group_name'  => 'Addons',
        'permissions' => [
            'addon.view',
            'addon.install',
            'addon.update',
            'addon.status.change',
            'addon.remove',
        ],
    ];

    public static array $websitePermissions = [
        'group_name'  => 'Website Permissions',
        'permissions' => [
            'manage.booking',
            'manage.services',
            'manage.coupon',
            'manage.category',
            'manage.provider',
            'manage.kyc',
            'manage.job',
            'manage.user',
            'manage.refund',
            'manage.support.ticket',
            'manage.withdraw',
            'manage.website',
            'manage.sections',
            'manage.header.footer',
            'manage.location',
            'manage.report',
            'manage.blog',
            'manage.contact.message',
            'manage.menu.builder',
            'manage.page.builder',
        ],
    ];

    /**
     * @return mixed
     */
    private static function getSuperAdminPermissions(): array
    {
        $reflection = new ReflectionClass(__TRAIT__);
        $properties = $reflection->getStaticProperties();

        $permissions = [];
        foreach ($properties as $value) {
            if (is_array($value)) {
                $permissions[] = [
                    'group_name'  => $value['group_name'],
                    'permissions' => (array) $value['permissions'],
                ];
            }
        }

        return $permissions;
    }
}
