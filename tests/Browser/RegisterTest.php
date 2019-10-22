<?php

namespace Tests\Browser;

use App\User;
use App\Avatar;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Register;
use Tests\Browser\Pages\Dashboard;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterTest extends DuskTestCase
{
    use DatabaseMigrations;
    
    /**
     * @test
     * 
     * @group register
     */
    public function register_request_returns_correct_page()
    {
        $this->browse(function ($browser) {
            $browser->visit('register')
                    ->on(new Register);
        });
    }

    /**
     * @test
     * 
     * @group register
     * @group redirect
     */
    public function request_to_register_for_logged_in_user_successfully_redirects_to_dashboard() {

        factory('App\User')->create();
        $avatar = factory(Avatar::class)->create([
            'user_id' => 1
        ]);
        
        $this->browse(function($browser) {
            $browser->loginAs(User::find(1))
                ->visit('/register')
                ->on(new Dashboard);
        });
    }
}
