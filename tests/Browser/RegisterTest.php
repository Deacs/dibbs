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

    public function setUp(): void {
        parent::setUp();
    
        foreach(static::$browsers as $browser) {
            $browser->driver->manage()->deleteAllCookies();
        }
    }

    var $user_data = [
        'name'      => 'Barry Chuckle',
        'nickname'  => 'Baz',
        'email'     => 'baz@email.com',
        'password'  => 'bazza_pass',
        'gender_id' => 3,
    ];
    
    /**
     * @test
     * 
     * @group path
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

        $user = factory('App\User')->create();
        $avatar = factory(Avatar::class)->create([
            'user_id' => $user->id
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
     * @group notification
     * @group error
     */
    public function unsuccessful_register_due_to_missing_fullname_displays_correct_inline_error_message() {

        $this->browse(function($browser) {
            $browser->visit('register')
                ->on(new Register)
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

    /**
     * @test
     * 
     * @group register
     * @group notification
     * @group form
     * @group notification
     * @group error
     */
    public function unsuccessful_register_due_to_missing_nickname_displays_correct_inline_error_message() {

        $this->browse(function($browser) {
            $browser->visit('register')
                ->on(new Register)
                ->type('name', $this->user_data['name'])
                ->type('email', $this->user_data['email'])
                ->select('gender_id', $this->user_data['gender_id'])
                ->type('password', $this->user_data['password'])
                ->type('password_confirmation', $this->user_data['password'])
                ->press('Register')
                ->on(new Register)
                ->assertSeeIn('span.invalid-feedback', 'The nickname field is required.');
        });
    }

    /**
     * @test
     * 
     * @group register
     * @group notification
     * @group form
     * @group notification
     * @group error
     * 
     * @group broken
     */
    public function unsuccessful_register_due_to_missing_email_displays_correct_inline_error_message() {

        $this->browse(function($browser) {
            $browser->visit('register')
                ->on(new Register)
                ->type('name', $this->user_data['name'])
                ->type('nickname', $this->user_data['nickname'])
                ->select('gender_id', $this->user_data['gender_id'])
                ->type('password', $this->user_data['password'])
                ->type('password_confirmation', $this->user_data['password'])
                ->press('Register')
                ->on(new Register)
                ->assertSeeIn('span.invalid-feedback', 'The email field is required.');
        });
    }

    /**
     * @test
     * 
     * @group register
     * @group notification
     * @group form
     * @group notification
     * @group error
     * 
     * @group broken
     */
    public function unsuccessful_register_due_to_taken_email_displays_correct_inline_error_message() {
        
        $this->browse(function($browser) {

            $user = factory('App\User')->create([
                'email' => 'duplicate@email.com'
            ]);
            factory(Avatar::class)->create([
                'user_id' => 1
            ]);

            $browser->visit('register')
                ->on(new Register)
                ->type('name', $this->user_data['name'])
                ->type('nickname', $this->user_data['nickname'])
                ->type('email', User::find(1)->email)
                ->select('gender_id', $this->user_data['gender_id'])
                ->type('password', $this->user_data['password'])
                ->type('password_confirmation', $this->user_data['password'])
                ->press('Register')
                ->on(new Register)
                ->assertSeeIn('span.invalid-feedback', 'The email has already been taken.');
        });
    }

    /**
     * @test
     * 
     * @group register
     * @group notification
     * @group form
     * @group notification
     * @group error
     */
    public function unsuccessful_register_due_to_unselected_gender_displays_correct_inline_error_message() {

        $this->browse(function($browser) {
            $browser->visit('register')
                ->on(new Register)
                ->type('name', $this->user_data['name'])
                ->type('nickname', $this->user_data['nickname'])
                ->type('email', $this->user_data['email'])
                ->type('password', $this->user_data['password'])
                ->type('password_confirmation', $this->user_data['password'])
                ->press('Register')
                ->on(new Register)
                ->assertSeeIn('span.invalid-feedback', 'Please specify a gender for your account');
        });
    }

    /**
     * @test
     * 
     * @group register
     * @group notification
     * @group form
     * @group notification
     * @group error
     */
    public function unsuccessful_register_due_to_missing_password_displays_correct_inline_error_message() {

        $this->browse(function($browser) {
            $browser->visit('register')
                ->on(new Register)
                ->type('name', $this->user_data['name'])
                ->type('nickname', $this->user_data['nickname'])
                ->type('email', $this->user_data['email'])
                ->select('gender_id', $this->user_data['gender_id'])
                ->press('Register')
                ->on(new Register)
                ->assertSeeIn('span.invalid-feedback', 'The password field is required.');
        });
    }

    /**
     * @test
     * 
     * @group register
     * @group notification
     * @group form
     * @group notification
     * @group error
     */
    public function unsuccessful_register_due_to_password_not_matching_min_length_displays_correct_inline_error_message() {

        $this->browse(function($browser) {
            $browser->visit('register')
                ->on(new Register)
                ->type('name', $this->user_data['name'])
                ->type('nickname', $this->user_data['nickname'])
                ->type('email', $this->user_data['email'])
                ->select('gender_id', $this->user_data['gender_id'])
                ->type('password', '2short')
                ->press('Register')
                ->on(new Register)
                ->assertSeeIn('span.invalid-feedback', 'The password must be at least 8 characters.');
        });
    }

    /**
     * @test
     * 
     * @group register
     * @group notification
     * @group form
     * @group notification
     * @group error
     */
    public function unsuccessful_register_due_to_password_and_confirmation_not_matching_displays_correct_inline_error_message() {

        $this->browse(function($browser) {
            $browser->visit('register')
                ->on(new Register)
                ->type('name', $this->user_data['name'])
                ->type('nickname', $this->user_data['nickname'])
                ->type('email', $this->user_data['email'])
                ->select('gender_id', $this->user_data['gender_id'])
                ->type('password', $this->user_data['password'])
                ->type('password_confirmation', 'doesnotmatch')
                ->press('Register')
                ->on(new Register)
                ->assertSeeIn('span.invalid-feedback', 'The password confirmation does not match.');
        });
    }
}
