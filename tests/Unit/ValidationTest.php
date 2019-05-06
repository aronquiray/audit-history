<?php
/**
 * Created by PhpStorm.
 * User: lloric
 * Date: 3/26/19
 * Time: 12:48 PM
 */

namespace HalcyonLaravel\AuditHistory\Tests\Unit;

use Exception;
use HalcyonLaravel\AuditHistory\Tests\TestCase;

class ValidationTest extends TestCase
{
    /**
     * @test
     */
    public function invalid_arg()
    {
        $this->expectException(Exception::class);
        app('audit-history')->buildClass(get_class($this->user))->render(10);

    }

    /**
     * @test
     */
    public function valid()
    {
        $this->assertNotNull((string) app('audit-history')->buildClass(get_class($this->testModel))->render(10));
    }
}