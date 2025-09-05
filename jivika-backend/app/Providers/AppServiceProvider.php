<?php

namespace App\Providers;

use App\Models\Notification;
use App\Models\Setting;
use App\Models\User;
use App\Observers\NotificationObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $settings = Setting::all();
        $favicon = $settings->where('key_name','favicon')->first();
        $site_name = $settings->where('key_name','site_name')->first();
        $logo = $settings->where('key_name','logo')->first();
        $bg_image = $settings->where('key_name','bg_image')->first();
        $data = [
            'site_name'=>!empty($site_name) ? $site_name->key_value : null,
            'bg_image'=>!empty($bg_image) ? $bg_image->key_value : null,
            'favicon'=>!empty($favicon) ? $favicon->key_value : null,
            'logo'=>!empty($logo) ? $logo->key_value : null
        ];
        view()->share('site_data', $data);
        Notification::observe(NotificationObserver::class);
        // User::observe(UserObserver::class);
    }
}
