<?php

namespace HalcyonLaravel\AuditHistory\Providers;

use HalcyonLaravel\AuditHistory\AuditHistory;
use HalcyonLaravel\AuditHistory\AuditHistoryHelpers;
use Illuminate\Support\ServiceProvider;

class AuditHistoryServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/audit-history.php' => config_path('audit-history.php'),
        ]);

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'audit-history');
    }

    public function register()
    {
        $this->app->bind('audit-history', function ($app) {
            return new AuditHistory;
        });

        $this->app->bind('audit-history.helpers', function () {
            return new AuditHistoryHelpers;
        });

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'audit-history');

        $this->mergeConfigFrom(
            __DIR__.'/../../config/audit-history.php',
            'audit-history'
        );
    }
}
