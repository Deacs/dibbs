<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Register;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterTest extends DuskTestCase
{
    /**
     * @test
     * 
     * @group register
     * @group redirect
     * 
     * @group new
     */
    public function register_request_returns_correct_page()
    {
        $this->browse(function ($browser) {
            $browser->visit('register')
                    ->on(new Register);
        });
    }
}
