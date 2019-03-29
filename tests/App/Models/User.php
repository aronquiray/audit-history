<?php
/**
 * Created by PhpStorm.
 * User: lloric
 * Date: 3/28/19
 * Time: 12:05 PM
 */

namespace HalcyonLaravel\AuditHistory\Tests\App\Models;

class User extends \Illuminate\Foundation\Auth\User
{
    protected $table = 'users';

    protected $fillable = [
        'first_name',
        'last_name',
    ];
}