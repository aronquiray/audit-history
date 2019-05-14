<?php

namespace HalcyonLaravel\AuditHistory;

use Illuminate\Database\Eloquent\SoftDeletes;

class Helpers
{
    public static function getAuditableName($history): string
    {
        $fieldValues = 'old_values';
        if (in_array($history->event, ['updated', 'created', 'restored'])) {
            $fieldValues = 'new_values';
        }

        $auditable = $history->auditable;
        if (!empty($auditable)) {
            return $history->{$fieldValues}[$auditable->getAuditHistoryOptions()->fieldName];
        }

        $auditable = app($history->auditable_type);

        $isHasSoftDelete = is_class_uses_deep($auditable, SoftDeletes::class);

//        $key = $auditable->getKey();
        if ($isHasSoftDelete) {
            $model = $auditable->where('id', $history->auditable_id)->onlyTrashed()->first();
            if (!empty($model)) {
                return $model->{$auditable->getAuditHistoryOptions()->fieldName};
            }
        }

        return $history->{$fieldValues}[$auditable->getAuditHistoryOptions()->fieldName];
    }
}