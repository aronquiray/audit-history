<?php

namespace HalcyonLaravel\AuditHistory\Tests;

use CreateAuditsTable;
use HalcyonLaravel\AuditHistory\Tests\App\Models\TestModel;
use HalcyonLaravel\AuditHistory\Tests\App\Models\TestSoftDeleteModel;
use HalcyonLaravel\AuditHistory\Tests\App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected $testModel;
    protected $user;
    protected $testSoftDeleteModel;

    /**
     *{@inheritdoc}
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->setUpDatabase();
        $this->setUpSeed();
    }

    /**
     * Set up the database.
     *
     */
    protected function setUpDatabase()
    {
        include_once __DIR__.'/../vendor/owen-it/laravel-auditing/database/migrations/audits.stub';
        (new CreateAuditsTable())->up();


        $this->app['db']->connection()->getSchemaBuilder()->create('test_model', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->timestamps();
        });
        $this->app['db']->connection()->getSchemaBuilder()->create('test_soft_delete_model',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('first_name');
                $table->string('last_name');
                $table->softDeletes();
                $table->timestamps();
            });

        $this->app['db']->connection()->getSchemaBuilder()->create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('timezone')->default('Asia/Manila');
            $table->timestamps();
        });
    }

    protected function setUpSeed()
    {
        $this->testModel = TestModel::create([
            'first_name' => 'test first name',
            'last_name' => 'test last name',
        ]);
        $this->testSoftDeleteModel = TestSoftDeleteModel::create([
            'first_name' => 'test first name sd',
            'last_name' => 'test last name sd',
        ]);
        $this->user = User::create([
            'first_name' => 'test first name',
            'last_name' => 'test last name',
        ]);
    }


    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        $app['config']->set('halcyon-laravel.audit-history', include __DIR__.'/../config/audit-history.php');
        $app['config']->set('audit.console', true);
    }


    protected function getPackageAliases($app)
    {
        return [
        ];
    }

    protected function getPackageProviders($app)
    {
        return [
            "HalcyonLaravel\\AuditHistory\\Providers\\AuditHistoryServiceProvider",
            "OwenIt\\Auditing\\AuditingServiceProvider",
        ];
    }
}
