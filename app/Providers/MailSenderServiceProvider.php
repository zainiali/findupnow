<?php

namespace App\Providers;

use App\Services\MailSenderService;
use Illuminate\Support\ServiceProvider;

class MailSenderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(MailSenderService::class, function ($app) {
            return new MailSenderService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
