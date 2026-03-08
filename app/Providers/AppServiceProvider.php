<?php

namespace App\Providers;

use Exception;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Modules\GlobalSetting\app\Models\CustomPagination;
use Modules\GlobalSetting\app\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Replace the original commands with custom ones
        $this->app->singleton(\Illuminate\Database\Console\Migrations\RefreshCommand::class, function () {
            return new \App\Console\Commands\PreventMigrateRefresh();
        });

        $this->app->singleton(\Illuminate\Database\Console\Migrations\FreshCommand::class, function () {
            return new \App\Console\Commands\PreventMigrateFresh();
        });

        $this->app->singleton(\Illuminate\Database\Console\Migrations\RollbackCommand::class, function () {
            return new \App\Console\Commands\PreventMigrateDrop();
        });

        $this->app->singleton(\Illuminate\Database\Console\Migrations\ResetCommand::class, function () {
            return new \App\Console\Commands\PreventMigrateReset();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            $setting = Cache::rememberForever('setting', function () {
                $setting_info = Setting::all();
                $setting      = [];
                foreach ($setting_info as $setting_item) {
                    $setting[$setting_item->key] = $setting_item->value;
                }

                $setting = (object) $setting;

                return $setting;
            });

            $this->setMailCredentials($setting);

            $this->setPagination();

            $this->setPusherCredentials($setting);

        } catch (Exception $ex) {
            $setting = null;
            Log::error($ex->getMessage());
        }

        $this->shareSettings();

        $this->shareNavCache();

        $this->registerBladeDirectives();

        Paginator::useBootstrapFour();
    }

    /**
     * @param $setting
     */
    private function setMailCredentials($setting): void
    {
        // Setup mail configuration
        $mailConfig = [
            'transport'  => 'smtp',
            'host'       => $setting?->mail_host,
            'port'       => $setting?->mail_port,
            'encryption' => $setting?->mail_encryption,
            'username'   => $setting?->mail_username,
            'password'   => $setting?->mail_password,
            'timeout'    => null,
        ];

        config(['mail.mailers.smtp' => $mailConfig]);
        config(['mail.from.address' => $setting?->mail_sender_email]);
        config(['mail.from.name' => $setting?->mail_sender_name]);

        // setup timezone globally
        config(['app.timezone' => $setting?->timezone]);
    }

    /**
     * @return mixed
     */
    private function setPagination(): void
    {
        Cache::rememberForever('CustomPagination', function () {
            $custom_pagination = CustomPagination::all();
            $pagination        = [];
            foreach ($custom_pagination as $item) {
                $pagination[str_replace(' ', '_', strtolower($item?->section_name))] = $item?->item_qty;
            }
            $pagination = (object) $pagination;

            return $pagination;
        });
    }

    private function shareSettings(): void
    {
        View::composer('*', function ($view) {

            $setting = Cache::get('setting');

            $view->with('setting', $setting);
        });
    }

    private function shareNavCache(): void
    {
        try {
            if (!request()->is('admin*')) {
                View::composer('*', function ($view) {
                    $view->with('nav_menu', menuGetBySlug('main-menu'));
                });

                View::composer('*', function ($view) {
                    $view->with('quickLink', menuGetBySlug('quick-link'));
                });

                View::composer('*', function ($view) {
                    $view->with('importantLink', menuGetBySlug('important-link'));
                });
            }
        } catch (Exception $e) {
            logger($e->getMessage());

            View::composer('*', function ($view) {
                $view->with('nav_menu', []);
            });

            View::composer('*', function ($view) {
                $view->with('quickLink', []);
            });

            View::composer('*', function ($view) {
                $view->with('importantLink', []);
            });
        }
    }

    protected function registerBladeDirectives()
    {
        Blade::directive('adminCan', function ($permission) {
            return "<?php if(auth()->guard('admin')->user()->can({$permission})): ?>";
        });

        Blade::directive('endadminCan', function () {
            return '<?php endif; ?>';
        });
    }

    /**
     * @param $setting
     */
    private function setPusherCredentials($setting): void
    {
        if ($setting?->pusher_status == 'active') {
            config(['broadcasting.connections.pusher.key' => $setting?->pusher_app_key]);
            config(['broadcasting.connections.pusher.secret' => $setting?->pusher_app_secret]);
            config(['broadcasting.connections.pusher.app_id' => $setting?->pusher_app_id]);
            config(['broadcasting.connections.pusher.options.cluster' => $setting?->pusher_app_cluster]);
            config(['broadcasting.connections.pusher.options.host' => 'api-' . $setting?->pusher_app_cluster . '.pusher.com']);
        }
    }
}
