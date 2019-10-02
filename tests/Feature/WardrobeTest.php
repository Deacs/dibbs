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
    public function wardrobe_home_path_redirects_for_anon() {

        $response = $this->get('wardrobe');

        $response->assertStatus(302);
    }
}
