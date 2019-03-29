<?php
/**
 * Created by PhpStorm.
 * User: lloric
 * Date: 3/28/19
 * Time: 12:05 PM
 */

namespace HalcyonLaravel\AuditHistory\Tests\App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;

class TestModel extends Model implements \OwenIt\Auditing\Contracts\Auditable
{
    use Auditable;


    protected $table = 'test_model';
    protected $fillable = [
        'first_name',
        'last_name',
    ];
}