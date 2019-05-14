<?php

namespace HalcyonLaravel\AuditHistory\Listeners;

use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Events\Audited;

class AuditedListener
{
    /**
     * Create the Audited event listener.
     */
    public function __construct()
    {
        // ...
    }

    /**
     * Handle the Audited event.
     *
     * @param  \OwenIt\Auditing\Events\Audited  $event
     *
     * @return void
     */
    public function handle(Audited $event)
    {
        $audit = $event->audit;

        if ($audit->event != 'deleted') {
            return;
        }

        $model = $event->model;

        if (is_class_uses_deep($model, SoftDeletes::class)) {
            $model = app($audit->auditable_type)->where('id', $audit->auditable_id)->onlyTrashed()->first();
            if (empty($model)) {
                $audit->event = 'purged';
                $audit->save();

            }
        }

    }
}