<?php
/**
 * Created by PhpStorm.
 * User: lloric
 * Date: 3/28/19
 * Time: 12:05 PM
 */

namespace HalcyonLaravel\AuditHistory\Tests\App\Models;

use HalcyonLaravel\AuditHistory\AuditHistoryOptions;
use HalcyonLaravel\AuditHistory\Models\Contracts\AuditHistoryInterface;
use HalcyonLaravel\AuditHistory\Models\Traits\AuditableTrait;
use HalcyonLaravel\AuditHistory\Models\Traits\AuditHistoryTrait;
use Illuminate\Database\Eloquent\Model;

class TestModel extends Model implements AuditHistoryInterface
{
    use AuditHistoryTrait;


    protected $table = 'test_model';
    protected $fillable = [
        'first_name',
        'last_name',
    ];


    /**
     * @return \HalcyonLaravel\AuditHistory\AuditHistoryOptions
     */
    public function getAuditHistoryOptions(): AuditHistoryOptions
    {
        return AuditHistoryOptions::create()
            ->fieldName('first_name');
    }
}