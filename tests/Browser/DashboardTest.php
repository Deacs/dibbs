<?php

namespace Tests\Browser;

use App\User;
use App\Avatar;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Login;
use Tests\Browser\Pages\Dashboard;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DashboardTest extends DuskTestCase
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
     * @group dashboard
     * @group auth
     */
    public function dashboard_request_for_anon_user_redirected_to_login()
    {
        $this->browse(function ($browser) {
            $browser->visit('dashboard')
                    ->on(new Login);
        });
    }
    
    /**
     * @test
     * 
     * @group dashboard
     * @group nav
     */
    public function dashboard_displays_correct_tabs() {
        
        $this->browse(function($browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/dashboard')
                    ->assertSee('Your Details');
        });
    }

    /**
     * @test
     * 
     * @group dashboard
     * @group nav
     */
    public function dashboard_shows_correct_default_tab() {

        $this->browse(function($browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/dashboard')
                    ->assertSeeIn('li.nav-item > a.active', 'Your Details');
        });
    }

    /**
     * @test
     */
    public function dashboard_shows_correct_default_inactive_tabs() {
        
        $this->browse(function($browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/dashboard')
                    ->assertDontSeeIn('li.nav-item > a.active', 'Reset Password')
                    ->assertDontSeeIn('li.nav-item > a.active', 'Your Calendar');
        });
    }

    /**
     * @test
     * 
     * @group dashboard
     * @group user
     * @group form
     */
    public function dashboard_shows_correct_user_details_to_edit() {

        $this->browse(function($browser) {

            $user = User::find(1);

            $browser->loginAs($user)
                ->visit('dashboard')
                ->assertInputValue('userName', $user->name)
                ->assertInputValue('userEmail', $user->email)
                ->assertSelected('#userGenderId', $user->gender_id);
        });
    }
}
