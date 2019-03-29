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

class SampleTest extends TestCase
{
    /**
     * @test
     */
    public function invalid_arg()
    {
        $this->expectException(Exception::class);
        $this->assertEquals('test', app('audit-history')->buildClass(get_class($this->user))->render(10));
    }

    /**
     * @test
     */
    public function valid()
    {
        $this->assertNotNull(app('audit-history')->buildClass(get_class($this->testModel))->render(10));
    }
}