<?php

namespace HalcyonLaravel\AuditHistory\Models\Contracts;

use OwenIt\Auditing\Contracts\Auditable;

interface AuditHistoryInterface extends Auditable
{
    /**
     * @return string
     */
    public function getHistoryLabelAttribute();
}