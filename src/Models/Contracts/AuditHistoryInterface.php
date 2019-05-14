<?php

namespace HalcyonLaravel\AuditHistory\Models\Contracts;

use HalcyonLaravel\AuditHistory\AuditHistoryOptions;
use OwenIt\Auditing\Contracts\Auditable;

interface AuditHistoryInterface extends Auditable
{
    /**
     * @return \HalcyonLaravel\AuditHistory\AuditHistoryOptions
     */
    public function getAuditHistoryOptions(): AuditHistoryOptions;
}