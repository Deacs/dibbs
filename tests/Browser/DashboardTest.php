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
     * @group redirect
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
                    ->on(new Dashboard)
                    ->assertSee('Your Details')
                    ->assertSee('Reset Password')
                    ->assertSee('Your Calendar');
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
                    ->on(new Dashboard)
                    ->assertSeeIn('li.nav-item > a.active', 'Your Details');
        });
    }

    /**
     * @test
     * 
     * @group dashboard
     * @group nav
     */
    public function dashboard_shows_correct_default_inactive_tabs() {
        
        $this->browse(function($browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/dashboard')
                    ->on(new Dashboard)
                    ->assertDontSeeIn('li.nav-item > a.active', 'Reset Password')
                    ->assertDontSeeIn('li.nav-item > a.active', 'Your Calendar');
        });
    }

    /**
     * @test
     * 
     * @group dashboard
     * @group nav
     */
    public function dashboard_displays_correct_default_panel() {

        $this->browse(function($browser) {
            $browser->loginAs(User::find(1))
                ->visit('/dashboard')
                ->on(new Dashboard)
                ->assertVisible('#user_details');
        });
    }

    /**
     * @test
     * 
     * @group dashboard
     * @group user
     * @group form
     */
    public function user_details_edit_form_shows_correct_fields() {

        $this->browse(function($browser) {
            
            $user = User::find(1);

            $browser->loginAs($user)
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Your Details')
                ->assertSeeIn('div#user_details > form > div.form-group > label.fullname', 'Full Name')
                ->assertSeeIn('div#user_details > form > div.form-group > label.nickname', 'Nickname')
                ->assertSeeIn('div#user_details > form > div.form-group label.email', 'Email address')
                ->assertSeeIn('div#user_details > form > div.form-group label.gender', 'Gender')
                ->assertSelectHasOptions('userGenderId', ['1', '2', '3']);
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
                ->on(new Dashboard)
                ->assertInputValue('userName', $user->name)
                ->assertInputValue('userNickname', $user->nickname)
                ->assertInputValue('userEmail', $user->email)
                ->assertSelected('#userGenderId', $user->gender_id);
        });
    }

    /**
     * @test
     * 
     * @group dashboard
     * @group user
     * @group form
     * @group flash
     * @group notification
     */
    public function successful_update_displays_success_alert() {

        $this->browse(function($browser) {

            $user = User::find(1);

            $browser->loginAs($user)
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Your Details')
                ->type('userName', 'New User Name')
                ->press('Update Details')
                ->assertSeeIn('div.alert-success', 'Profile successfully updated!');
        });
    }

    /**
     * @test
     * 
     * @group dashboard
     * @group user
     * @group form
     */
    public function updating_user_details_correctly_stores_data() {
        
        $this->browse(function($browser) {

            $user = User::find(1);

            $updateData = [
                'userName'      => 'Jack Jones',
                'userNickname'  => 'Jackie',
                'userEmail'     => 'jack@email.com',
                'userGenderId'  => 3
            ];

            $browser->loginAs($user)
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Your Details')
                ->assertSee('Full Name')
                ->type('userName', $updateData['userName'])
                ->type('userNickname', $updateData['userNickname'])
                ->type('userEmail', $updateData['userEmail'])
                ->select('userGenderId', $updateData['userGenderId'])
                ->press('Update Details')
                ->on(new Dashboard)
                ->assertInputValue('userName', $updateData['userName'])
                ->assertInputValue('userNickname', $updateData['userNickname'])
                ->assertInputValue('userEmail', $updateData['userEmail'])
                ->assertSelected('#userGenderId', $updateData['userGenderId']);
        });
    }

    /**
     * @test
     * 
     * @group dashboard
     * @group nav
     */
    public function clicking_your_details_tab_opens_correct_panel() {

        $this->browse(function($browser) {

            $user = User::find(1);

            $browser->loginAs($user)
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Your Details')
                ->assertVisible('div#user_details');
        });
    }

    /**
     * @test
     * 
     * @group dashboard
     * @group nav
     */
    public function clicking_update_password_tab_opens_correct_panel() {

        $this->browse(function($browser) {

            $user = User::find(1);

            $browser->loginAs($user)
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Reset Password')
                ->assertVisible('div#update_password');
        });
    }

    /**
     * @test
     * 
     * @group dashboard
     * @group nav
     */
    public function clicking_your_calendar_tab_opens_correct_panel() {

        $this->browse(function($browser) {

            $user = User::find(1);

            $browser->loginAs($user)
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Your Calendar')
                ->assertVisible('div#calendar');
        });
    }

}
