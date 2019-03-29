<?php
/**
 * Created by PhpStorm.
 * User: lloric
 * Date: 3/26/19
 * Time: 12:48 PM
 */

namespace HalcyonLaravel\AuditHistory\Tests\Unit;

use HalcyonLaravel\AuditHistory\Tests\TestCase;

class SampleTest extends TestCase
{
    /**
     * @test
     */
    public function sample()
    {
        $this->actingAs($this->user);
        $this->testModel->update([
            'first_name' => 'new name',
        ]);
        $this->assertEquals('test', app('audit-history')->buildClass(get_class($this->testModel))->render(10));
    }
}