<?php

namespace Tests\Browser;

use App\User;
use App\Avatar;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Login;
use Tests\Browser\Pages\Dashboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function setUp(): void {
        parent::setUp();

        factory('App\User')->create();
        $avatar = factory(Avatar::class)->create([
            'user_id' => 1
        ]);
    }

    /**
     * @test
     * 
     * @group login
     * @group auth
     */
    public function dashboard_shows_correct_error_message_on_incorrect_email_address() {

        $this->browse(function($browser) {

            $browser->visit('login')
                ->type('email', 'wrong@email.com')
                ->type('password', 'test_password')
                ->press('Login')
                ->assertSeeIn('span.invalid-feedback', 'These credentials do not match our records.');
        });
    }
    
    /**
     * @test
     * 
     * @group login
     * @group auth
     */
    public function dashboard_shows_correct_error_message_on_incorrect_password() {

        $this->browse(function($browser) {

            $user = User::find(1);

            $browser->visit('login')
                ->type('email', $user->email)
                ->type('password', 'fail_password')
                ->press('Login')
                ->assertSeeIn('span.invalid-feedback', 'These credentials do not match our records.');
        });
    }

    /**
     * @test
     * 
     * @group login
     * @group auth
     */
    public function dashboard_shows_success_alert_with_correct_username_on_login() {

        $this->browse(function($browser) {

            $user = User::find(1);

            $browser->visit('login')
                ->on(new Login)
                ->type('email', $user->email)
                ->type('password', 'test_password')
                ->press('Login')
                ->waitFortext('Welcome back')
                ->assertSeeIn('div.alert-success', 'Welcome back '.$user->name)
                ->logout();
        });
    }

    /**
     * @test
     * 
     * @group login
     * @group auth
     */
    public function user_successfully_redirected_to_dashboard_on_successful_login() {

        $this->browse(function($browser) {

            $user = User::find(1);

            $browser->visit('/login')
                ->on(new Login)
                ->type('email', $user->email)
                ->type('password', 'test_password')
                ->press('Login')
                ->waitFortext('Dashboard')
                ->on(new Dashboard)
                ->logout();
        });
    }
}
