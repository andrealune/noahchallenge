<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DealRoomImportCommandTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $artisan = \Artisan::call('dealroom:import', ['max' => 20]);

        // Check if we reach the final string ouptut
        $resultAsText = \Artisan::output();
        $this->assertContains("companies were successfully inserted", $resultAsText);

        $artisan = \Artisan::call('dealroom:import');
        $resultAsText = \Artisan::output();

        $this->assertTrue();
    }
}
