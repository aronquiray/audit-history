<?php
/**
 * Created by PhpStorm.
 * User: lloric
 * Date: 3/28/19
 * Time: 12:05 PM
 */

namespace HalcyonLaravel\AuditHistory\Tests\App\Models;

use HalcyonLaravel\AuditHistory\Models\Contracts\AuditHistoryInterface;
use HalcyonLaravel\AuditHistory\Models\Traits\AuditableTrait;
use HalcyonLaravel\AuditHistory\Models\Traits\AuditHistoryTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestSoftDeleteModel extends Model implements AuditHistoryInterface
{
    use AuditHistoryTrait;
    use SoftDeletes;


    protected $table = 'test_soft_delete_model';
    protected $fillable = [
        'first_name',
        'last_name',
    ];

    /**
     * @return string
     */
    public function getHistoryLabelAttribute(): string
    {
        return $this->first_name;
    }
}