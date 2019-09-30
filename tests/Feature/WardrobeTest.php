<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WardrobeTest extends TestCase
{
    /**
     * @test
     */
    public function correct_wardrobe_root_path() {

        $response = $this->get('/wardrobe');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function correct_wardrobe_history_path() {
        $response = $this->get('/wardrobe/history');

        $response->assertStatus(200);
    }
}
