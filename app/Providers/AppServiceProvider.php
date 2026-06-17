<?php

namespace App\Providers;

use App\Models\SiteSetting;
use App\Support\SeoData;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::share('setting', fn (string $key, ?string $default = '') => SiteSetting::get($key, $default) ?? $default);
        View::share('settingJson', fn (string $key, array $default = []) => SiteSetting::getJson($key, $default));

        View::composer('layouts.app', function ($view) {
            $data = $view->getData();

            $view->with('seoData', SeoData::resolve(
                request(),
                $data['seo'] ?? null,
                $data['post'] ?? null,
                $data['caseStudy'] ?? null,
            ));
        });
    }
}
