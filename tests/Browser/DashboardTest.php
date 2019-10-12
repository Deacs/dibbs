<?php

namespace Tests\Browser;

use App\User;
use App\Avatar;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Login;
use Tests\Browser\Pages\Dashboard;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DashboardTest extends DuskTestCase
{
    use DatabaseMigrations;
    // use DatabaseTransactions;
    
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
        
        $user = factory(User::class)->create([
            'email'     => 'jo@email.com',
            'name'      => 'Jo',
            'password'  => bcrypt('jo_pass'),
        ]);

        $avatar = Avatar::create([
            'user_id' => $user->id,
        ]);

        // dd($user);

        // $user = User::find(1);

        // dd($user);

        $this->browse(function($browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/dashboard')
                    ->assertSee('Your Details');
        });
    }

    /**
     * @-test
     */
    public function dashboard_shows_correct_default_tab() {

    }

    /**
     * @-test
     */
    public function dashboard_shows_correct_default_inactive_tabs() {

    }

    /**
     * @-test
     */
    public function dashboard_shows_correct_user_details_to_edit() {

    }
}
