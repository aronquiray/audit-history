<?php

namespace HalcyonLaravel\AuditHistory;

class AuditHistoryOptions
{
    public $fieldName;

    /**
     * @return \HalcyonLaravel\AuditHistory\AuditHistoryOptions
     */
    public static function create(): self
    {
        return (new static())->reset();
    }

    /**
     * @return \HalcyonLaravel\AuditHistory\AuditHistoryOptions
     */
    public function reset(): self
    {
        $this->fieldName = null;

        return $this;
    }

    /**
     * @param  string  $fieldName
     *
     * @return \HalcyonLaravel\AuditHistory\AuditHistoryOptions
     */
    public function fieldName(string $fieldName): self
    {
        $this->fieldName = $fieldName;

        return $this;
    }
}