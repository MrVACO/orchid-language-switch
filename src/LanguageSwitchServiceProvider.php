<?php

declare(strict_types = 1);

namespace MrVaco\OrchidLanguageSwitch;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\View;
use MrVaco\OrchidLanguageSwitch\Controllers\LanguageController;
use MrVaco\OrchidLanguageSwitch\Middleware\LanguageSwitch;
use Orchid\Platform\Dashboard;
use Orchid\Platform\OrchidServiceProvider;

class LanguageSwitchServiceProvider extends OrchidServiceProvider
{
    public function boot(Dashboard $dashboard): void
    {
        Lang::addJsonPath(__DIR__ . '/../resources/lang');
        View::addNamespace('platform', __DIR__ . '/../resources/views');

        parent::boot($dashboard);

        $this->app->booted(function()
        {
            $this->router();
        });

        app('router')->pushMiddlewareToGroup('web', LanguageSwitch::class);
    }

    public function router(): void
    {
        if ($this->app->routesAreCached())
        {
            return;
        }

        app('router')
            ->domain((string) config('platform.domain'))
            ->middleware(config('platform.middleware.private'))
            ->name('orchid-language-switch')
            ->prefix(Dashboard::prefix('/orchid-language-switch'))
            ->get('{lang}', LanguageController::class);
    }
}
