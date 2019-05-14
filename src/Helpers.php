<?php

namespace HalcyonLaravel\AuditHistory;

use Illuminate\Database\Eloquent\SoftDeletes;

class Helpers
{
    public static function getAuditableName($history): array
    {
        $fieldValues = 'old_values';
        if (in_array($history->event, ['updated', 'created'])) {
            $fieldValues = 'new_values';
        }

        $auditable = $history->auditable;
        if (!empty($auditable)) {
            return self::returnValue(
                $history->event,
                $history->{$fieldValues}[$auditable->getAuditHistoryOptions()->fieldName],
                );
        }


        $auditable = app($history->auditable_type);

        $isHasSoftDelete = is_class_uses_deep($auditable, SoftDeletes::class);

//        $key = $auditable->getKey();
        if ($isHasSoftDelete) {
            $model = $auditable->where('id', $history->auditable_id)->onlyTrashed()->first();
            if (!empty($model)) {
                return self::returnValue(
                    $history->event,
                    $model->{$auditable->getAuditHistoryOptions()->fieldName},
                );
            }
        }

        return self::returnValue(
            'purged',//$history->event,
            $history->old_values[$auditable->getAuditHistoryOptions()->fieldName],
        );
    }

    private static function returnValue(string $event, string $label): array
    {
        return [
            'event' => $event,
            'label' => $label,
        ];
    }
}