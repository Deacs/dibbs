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
    public function reservations_home_path_redirects_for_anon() {
        $response = $this->get('reservations');

        $response->assertStatus(302);
    }

     /**
     * @test
     */
    public function reservations_get_item_path_redirects_for_anon() {
        $response = $this->get('reservations/1');

        $response->assertStatus(302);
    }
}

