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
     * Helper function to allow users ans associated avatars to be created 
     * with specific values set. By default, avatars will be saved with a 
     * type of gravatar. Users will be saved with a gender type of non-binary
     * 
     * A standard user is created within the setUp so this is only required 
     * if you need to create a user with non default values
     */
    private function createUser(array $user_options, array $avatar_options) {
        
        $user   = factory('App\User')->create($user_options);

        $avatar_options['user_id'] = $user->id;

        $avatar = factory(Avatar::class)->create($avatar_options);

        return $user;
    }

    /**
     * @test
     * 
     * @group avatar
     * @group dashboard
     * @group link
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
     * @group dashboard
     * @group nav
     * @group link
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

    /**
     * @test
     * 
     * @group avatar
     * @group dashboard
     * @group preferences
     * @group display_behaviour
     */
    public function user_with_gravatar_selected_as_preference_sees_correct_setting() {

        $this->browse(function($browser) {
            $browser->loginAs(User::find(1))
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Manage your avatar')
                ->assertSeeIn('h5#current_setting', 'Current setting: Gravatar');
        });
    }

    /**
     * @test
     * 
     * @group avatar
     * @group dashboard
     * @group preferences
     * @group display_behaviour
     */
    public function user_with_custom_selected_as_preference_sees_correct_setting() {

        $this->browse(function($browser) {
            $avatar_options = [
                'type' => 'custom',
            ];
            
            $user = $this->createUser([], $avatar_options);

            $browser->loginAs($user)
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Manage your avatar')
                ->assertSeeIn('h5#current_setting', 'Current setting: Custom');
        });
    }

    /**
     * @test
     * 
     * @group avatar
     * @group dashboard
     * @group preferences
     * @group display_behaviour
     */
    public function user_with_custom_selected_as_preference_sees_link_to_update_via_gravatar_website() {

        $this->browse(function($browser) {
            $browser->loginAs(User::find(1))
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Manage your avatar')
                ->assertSeeIn('a#visit_gravatar', 'Update via the Gravatar website');
        });
    }

    /**
     * @test
     * 
     * @group avatar
     * @group dashboard
     * @group preferences
     * @group display_behaviour
     * @group link
     */
    public function gravatar_link_correctly_opens_gravatar_site() {

        $this->browse(function($browser) {
            $browser->loginAs(User::find(1))
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Manage your avatar')
                ->clickLink('Update via the Gravatar website')
                ->assertUrlIs('https://en.gravatar.com/');
        });
    }

}
