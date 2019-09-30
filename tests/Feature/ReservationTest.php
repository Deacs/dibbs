<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReservationTest extends TestCase
{
    /**
     * @test
     */
    public function correct_reservations_home_path() {
        $response = $this->get('/reservations');

        $response->assertStatus(200);
    }
}
