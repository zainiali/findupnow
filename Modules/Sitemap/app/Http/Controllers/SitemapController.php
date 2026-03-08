<?php

namespace Modules\Sitemap\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Service;
use App\Models\User;
use Exception;
use Modules\JobPost\Entities\JobPost;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('sitemap::index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        try {
            $sitemap = Sitemap::create();

            $sitemap->add(Url::create('/')->setLastModificationDate(now())->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_ALWAYS));

            foreach (customPages() as $page) {
                $sitemap->add(Url::create("/page/{$page->slug}")->setLastModificationDate($page?->updated_at ?? now())->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_ALWAYS));
            }

            foreach (Service::all() as $page) {
                $sitemap->add(Url::create("/service/{$page->slug}")->setLastModificationDate($page?->updated_at ?? now())->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_ALWAYS));
            }

            foreach (Blog::all() as $page) {
                $sitemap->add(Url::create("/blog/{$page->slug}")->setLastModificationDate($page?->updated_at ?? now())->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_ALWAYS));
            }

            foreach (JobPost::all() as $page) {
                $sitemap->add(Url::create("/job-detils/{$page->slug}")->setLastModificationDate($page?->updated_at ?? now())->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_ALWAYS));
            }

            foreach (User::where([
                'kyc_status'     => 1,
                'status'         => 1,
                'is_provider'    => 1,
                'email_verified' => 1,
                'agree_policy'   => 1,
            ])->get() as $page) {
                $sitemap->add(Url::create("/providers/{$page->user_name}")->setLastModificationDate($page?->updated_at ?? now())->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_ALWAYS));
            }

            $sitemap->writeToFile(public_path('sitemap.xml'));

            return back()->with(['message' => 'Sitemap generated!', 'alert-type' => 'success']);
        } catch (Exception $e) {
            logger()->error($e->getMessage());
            return back()->with(['message' => 'Unable to generate sitemap!', 'alert-type' => 'error']);
        }
    }
}
