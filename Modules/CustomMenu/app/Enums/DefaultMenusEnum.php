<?php

namespace Modules\CustomMenu\app\Enums;

use Illuminate\Support\Collection;
use Nwidart\Modules\Facades\Module;

enum DefaultMenusEnum: string {

    public static function getAll(): Collection
    {

        $all_default_menus = [
            (object) ['name' => __('Home'), 'url' => route('home')],
            (object) ['name' => __('About Us'), 'url' => route('about-us')],
            (object) ['name' => __('Services'), 'url' => route('services')],
            (object) ['name' => __('FAQ'), 'url' => route('faq')],
            (object) ['name' => __('Terms And Conditions'), 'url' => route('terms-and-conditions')],
            (object) ['name' => __('Privacy Policy'), 'url' => route('privacy-policy')],
            (object) ['name' => __('Blog'), 'url' => route('blogs')],
            (object) ['name' => __('Contact Us'), 'url' => route('contact-us')],
            (object) ['name' => __('Join as a Provider'), 'url' => route('join-as-a-provider')],
            (object) ['name' => __('Dashboard'), 'url' => route('dashboard')],
        ];

        foreach (customPages() as $page) {
            $all_default_menus[] = (object) ['name' => $page->title, 'url' => "/page/{$page->slug}"];
        }

        if (Module::isEnabled('Subscription')) {
            $all_default_menus[] = (object) ['name' => __('Subscription Plan'), 'url' => route('subscription-plan')];
        }

        if (Module::isEnabled('JobPost')) {
            $all_default_menus[] = (object) ['name' => __('Job List'), 'url' => route('job-list')];
        }

        // Sort the array by the 'name' property
        usort($all_default_menus, function ($a, $b) {
            return strcmp($a->name, $b->name);
        });

        // Convert the sorted array to a collection
        return collect($all_default_menus);
    }
}
