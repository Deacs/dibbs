<?php

namespace Tests\Browser;

use App\User;
use App\Avatar;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Dashboard;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AvatarTest extends DuskTestCase
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
     * @group avatar
     * @group layout
     */
    public function clicking_manage_avatar_link_displays_correct_tab() {

        $this->browse(function($browser) {

            $browser->loginAs(User::find(1))
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Manage your avatar')
                ->assertVisible('#manage_avatar');
        });
    }

    /**
     * @test
     * 
     * @group avatar
     * @group nav
     * @group layout
     */
    public function opening_manage_avatar_panel_correctly_deactivates_other_dashboard_navigation_tabs() {

        $this->browse(function($browser) {

            $browser->loginAs(User::find(1))
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Manage your avatar')
                ->assertSeeIn('#user_details_tab > a.inactive', 'Your Details')
                ->assertSeeIn('#update_password_tab > a.inactive', 'Update Password')
                ->assertSeeIn('#your_calendar_tab > a.inactive', 'Your Calendar');
        });
    }
}
