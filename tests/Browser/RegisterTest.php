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

    var $user_data = [
        'name'      => 'Barry Chuckle',
        'nickname'  => 'Baz',
        'email'     => 'baz@email.com',
        'password'  => 'baz_pass',
        'gender_id' => 3,
    ];
    
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

    /**
     * @test
     * 
     * @group register
     * @group notification
     * @group form
     * @group flash
     * @group notification
     * @group error
     * 
     * @group new
     */
    public function unsuccessful_register_due_to_missing_fullname_displays_correct_inline_error_message() {

        $this->browse(function($browser) {
            $browser->visit('register')
                ->on(new Register)
                ->type('name', '')
                ->type('nickname', $this->user_data['nickname'])
                ->type('email', $this->user_data['email'])
                ->select('gender_id', $this->user_data['gender_id'])
                ->type('password', $this->user_data['password'])
                ->type('password_confirmation', $this->user_data['password'])
                ->press('Register')
                ->on(new Register)
                ->assertSeeIn('span.invalid-feedback', 'The name field is required.');
        });
    }
}
