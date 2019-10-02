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

    /**
     * @test
     */
    public function wardrobe_get_instance_path_redirects_for_anon() {

        $response = $this->get('wardrobe/1');

        $response->assertStatus(302);
    }

    /**
     * @test
     */
    public function wardrobe_get_add_path_redirects_for_anon() {

        $response = $this->get('wardrobe/add');

        $response->assertStatus(302);
    }

    /**
     * @test
     */
    public function wardrobe_post_add_path_redirects_for_anon() {

        $response = $this->post('wardrobe/add');

        $response->assertStatus(302);
    }

    /**
     * @test
     */
    public function wardrobe_post_delete_path_redirects_for_anon() {

        $response = $this->post('wardrobe/delete/1');

        $response->assertStatus(302);
    }
}
