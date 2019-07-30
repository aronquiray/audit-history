<?php

namespace HalcyonLaravel\AuditHistory;

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
        if (!empty($auditable)) {
            return $auditable->{$auditable->getAuditHistoryOptions()->fieldName};
        }

        $auditable = app($history->auditable_type);

        if (is_class_uses_deep($auditable, SoftDeletes::class)) {
            $model = $auditable->where('id', $history->auditable_id)->onlyTrashed()->first();
            if (!empty($model)) {
                return $model->{$auditable->getAuditHistoryOptions()->fieldName};
            }
        }

        return $history->{$fieldValues}[$auditable->getAuditHistoryOptions()->fieldName];
    }

    /**
     * @param $history
     *
     * @return string
     */
    public function getUserName($history): string
    {
        return $history->user ? $history->user->{config('audit-history.user.name_attribute')} : 'unknown';
    }
}