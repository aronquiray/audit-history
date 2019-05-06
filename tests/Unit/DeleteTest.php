<?php

namespace HalcyonLaravel\AuditHistory\Tests\Unit;

use HalcyonLaravel\AuditHistory\Tests\App\Models\TestSoftDeleteModel;
use HalcyonLaravel\AuditHistory\Tests\TestCase;

class DeleteTest extends TestCase
{
    /**
     * @test
     */
    public function delete_soft_delete_data_then_show()
    {
        $this->actingAs($this->user);
        $model = TestSoftDeleteModel::create([
            'first_name' => 'test first name to delete',
            'last_name' => 'test last name to delete',
        ]);
        $model->delete();

//        dd((string) app('audit-history')->buildClass(get_class($this->testSoftDeleteModel))->render(10));
        $this->assertNotNull((string) app('audit-history')->buildClass(get_class($this->testSoftDeleteModel))->render(10));
    }
}