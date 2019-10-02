<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StandardTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function basicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    
}
