<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardTest extends TestCase
{
   /**
     * @test
     */
    public function dashboard_home_path_redirects_for_anon() {
        $response = $this->get('dashboard');

        $response->assertStatus(302);
    }
}
