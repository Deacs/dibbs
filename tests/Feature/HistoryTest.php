<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HistoryTest extends TestCase
{
    /**
     * @test
     */
    public function wardrobe_history_path_redirects_for_anon() {
        $response = $this->get('wardrobe/history');

        $response->assertStatus(302);
    }
}
