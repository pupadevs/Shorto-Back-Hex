<?php

namespace Tests\Traits;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;

trait RefreshMultipleDatabases
{
    
    public function refreshMultipleDatabases()
    {
        $this->artisan('migrate:fresh', [
            '--database' => 'mysql',
            '--drop-views' => true,
            '--drop-types' => true,
        ]);

        $this->artisan('migrate:fresh', [
            '--database' => 'mysql_read',
            '--drop-views' => true,
            '--drop-types' => true,
        ]);

        $this->beforeApplicationDestroyed(function () {
            $this->artisan('migrate:rollback', [
                '--database' => 'mysql',
            ]);

            $this->artisan('migrate:rollback', [
                '--database' => 'mysql_read',
            ]);
        });
    }

    /**
     * Bootstrap database setup for tests.
     *
     * @return void
     */
    protected function setUpTraits()
    {
        parent::setUpTraits();

        if (isset($uses[RefreshDatabase::class])) {
            $this->refreshMultipleDatabases();
        }
    }
}
