<?php

namespace HalcyonLaravel\AuditHistory\Providers;

use HalcyonLaravel\AuditHistory\Listeners\AuditedListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use OwenIt\Auditing\Events\Audited;

class AuditHistoryEventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Audited::class => [
            AuditedListener::class,
        ],
    ];
    protected $subscribe = [
    ];

    public function boot()
    {
        parent::boot();
        //
    }
}