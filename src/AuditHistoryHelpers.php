<?php

namespace HalcyonLaravel\AuditHistory;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class AuditHistoryHelpers
{
    /**
     * @param $history
     *
     * @return string
     */
    public static function getAuditableName($history): string
    {
        $fieldValues = 'old_values';
        if (in_array($history->event, ['updated', 'created', 'restored'])) {
            $fieldValues = 'new_values';
        }

        $auditable = $history->auditable;
        if (!blank($auditable)) {
            return $auditable->{$auditable->getAuditHistoryOptions()->fieldName};
        }

        $auditable = app($history->auditable_type);

        if (is_class_uses_deep($auditable, SoftDeletes::class)) {
            $model = $auditable->where('id', $history->auditable_id)->onlyTrashed()->first();
            if (!blank($model)) {
                return $model->{$auditable->getAuditHistoryOptions()->fieldName};
            }
        }

        $fieldName = $auditable->getAuditHistoryOptions()->fieldName;
        $values = $history->{$fieldValues};

        return isset($values[$fieldName]) ? $values[$fieldName] : 'unknown';
    }

    /**
     * @param $history
     *
     * @return string
     */
    public function getUserName($history): string
    {
        return $history->user
            ? $history->user->{config('audit-history.user.name_attribute')}
            : 'unknown';
    }

    /**
     * @param $history
     *
     * @return \Carbon\Carbon
     */
    public function getUpdatedAtWithTimezone($history): Carbon
    {
        return $history->updated_at->timezone(
            auth()->check()
                ? app('auth')->user()->{config('audit-history.user.fields.timezone')}
                : config('app.timezone')
        );
    }
}