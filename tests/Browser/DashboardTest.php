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
     * @group path
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
                    ->assertSee('Update Password')
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
                    ->assertSeeIn('#user_details_tab > a.active', 'Your Details');
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
                    ->assertSeeIn('#update_password_tab > a.inactive', 'Update Password')
                    ->assertSeeIn('#your_calendar_tab > a.inactive', 'Your Calendar');
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
                ->visit('dashboard')
                ->on(new Dashboard)
                ->assertVisible('#user_details');
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

            $browser->loginAs(User::find(1))
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

            $browser->loginAs(User::find(1))
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Update Password')
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

            $browser->loginAs(User::find(1))
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Your Calendar')
                ->assertVisible('div#calendar');
        });
    }

    /**
     * @test
     * 
     * @group dashboard
     * @group nav
     * @group display_behaviour
     */
    public function clicking_your_details_tab_correctly_sets_active_state_while_deactivating_others() {

        $this->browse(function($browser) {

            $browser->loginAs(User::find(1))
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Your Details')
                ->assertSeeIn('#user_details_tab > a.active', 'Your Details')
                ->assertSeeIn('#update_password_tab > a.inactive', 'Update Password')
                ->assertSeeIn('#your_calendar_tab > a.inactive', 'Your Calendar');
        });
    }

    /**
     * @test
     * 
     * @group dashboard
     * @group nav
     * @group display_behaviour
     */
    public function clicking_update_password_tab_correctly_sets_active_state_while_deactivating_others() {

        $this->browse(function($browser) {

            $browser->loginAs(User::find(1))
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Update Password')
                ->assertSeeIn('#user_details_tab > a.inactive', 'Your Details')
                ->assertSeeIn('#update_password_tab > a.active', 'Update Password')
                ->assertSeeIn('#your_calendar_tab > a.inactive', 'Your Calendar');
        });
    }

    /**
     * @test
     * 
     * @group dashboard
     * @group nav
     * @group display_behaviour
     */
    public function clicking_your_calendar_tab_correctly_sets_active_state_while_deactivating_others() {

        $this->browse(function($browser) {

            $browser->loginAs(User::find(1))
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Your Calendar')
                ->assertSeeIn('#user_details_tab > a.inactive', 'Your Details')
                ->assertSeeIn('#update_password_tab > a.inactive', 'Update Password')
                ->assertSeeIn('#your_calendar_tab > a.active', 'Your Calendar');
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
            
            $browser->loginAs(User::find(1))
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Your Details')
                ->assertSeeIn('div#user_details > form > div.form-group > label.fullname', 'Full Name')
                ->assertSeeIn('div#user_details > form > div.form-group > label.nickname', 'Nickname')
                ->assertSeeIn('div#user_details > form > div.form-group > label.email', 'Email address')
                ->assertSeeIn('div#user_details > form > div.form-group > label.gender_id', 'Gender');
       });
    }

    /**
     * @test
     * 
     * @group dashboard
     * @group user
     * @group form
     */
    public function gender_select_in_user_details_form_has_correct_options() {

        $this->browse(function($browser) {
            $browser->loginAs(User::find(1))
                ->visit('dashboard')
                ->on(new Dashboard)
                ->assertSelectHasOptions('gender_id',['1', '2', '3']);
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
                ->assertInputValue('name', $user->name)
                ->assertInputValue('nickname', $user->nickname)
                ->assertInputValue('email', $user->email)
                ->assertSelected('#gender_id',$user->gender_id);
        });
    }

    /**
     * @test
     * 
     * @group dashboard
     * @group user
     * @group form
     * @group validation
     * @group flash
     * @group notification
     * @group success
     */
    public function successful_name_update_displays_success_flash() {

        $this->browse(function($browser) {

            $browser->loginAs(User::find(1))
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Your Details')
                ->type('name', 'New User Name')
                ->press('Update Details')
                ->assertSeeIn('div.alert-success', 'Details successfully updated!');
        });
    }

    /**
     * @test
     * 
     * @group dashboard
     * @group user
     * @group form
     * @group validation
     * @group flash
     * @group notification
     * @group success
     */
    public function successful_nickname_update_displays_success_flash() {

        $this->browse(function($browser) {

            $browser->loginAs(User::find(1))
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Your Details')
                ->type('nickname', 'New Nick Name')
                ->press('Update Details')
                ->assertSeeIn('div.alert-success', 'Details successfully updated!');
        });
    }

    /**
     * @test
     * 
     * @group dashboard
     * @group user
     * @group form
     * @group validation
     * @group flash
     * @group notification
     * @group success
     */
    public function successful_email_update_displays_success_flash() {

        $this->browse(function($browser) {

            $browser->loginAs(User::find(1))
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Your Details')
                ->type('email', 'new@email.com')
                ->press('Update Details')
                ->assertSeeIn('div.alert-success', 'Details successfully updated!');
        });
    }

    /**
     * @test
     * 
     * @group dashboard
     * @group user
     * @group form
     * @group validation
     * @group flash
     * @group notification
     * @group success
     */
    public function successful_gender_update_displays_success_flash() {

        $this->browse(function($browser) {

            $browser->loginAs(User::find(1))
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Your Details')
                ->select('gender_id', '3')
                ->press('Update Details')
                ->assertSeeIn('div.alert-success', 'Details successfully updated!');
        });
    }

    /**
     * @test
     * 
     * @group dashboard
     * @group user
     * @group form
     * @group validation
     * @group flash
     * @group notification
     * @group error
     */
    public function unsuccessful_update_due_to_missing_fullname_displays_correct_error_flash() {

        $this->browse(function($browser) {

            $browser->loginAs(User::find(1))
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Your Details')
                ->type('name', '')
                ->press('Update Details')
                ->assertSeeIn('div.alert-danger', 'Full name cannot be left empty');
        });
    }

    /**
     * @test
     * 
     * @group dashboard
     * @group user
     * @group form
     * @group validation
     * @group flash
     * @group notification
     * @group error
     */
    public function unsuccessful_update_due_to_missing_nickname_displays_correct_error_flash() {

        $this->browse(function($browser) {

            $browser->loginAs(User::find(1))
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Your Details')
                ->type('nickname', '')
                ->press('Update Details')
                ->assertSeeIn('div.alert-danger', 'Nickname cannot be left empty');
        });
    }

    /**
     * @test
     * 
     * @group dashboard
     * @group user
     * @group form
     * @group validation
     * @group flash
     * @group notification
     * @group error
     */
    public function unsuccessful_update_due_to_missing_email_displays_correct_error_flash() {

        $this->browse(function($browser) {

            $browser->loginAs(User::find(1))
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Your Details')
                ->type('email', '')
                ->press('Update Details')
                ->assertSeeIn('div.alert-danger', 'Email address cannot be left empty');
        });
    }

    /**
     * @test
     * 
     * @group dashboard
     * @group user
     * @group form
     * @group validation
     * @group flash
     * @group notification
     * @group error
     */
    public function unsuccessful_update_due_to_malformed_email_displays_correct_error_flash() {

        $this->browse(function($browser) {

            $browser->loginAs(User::find(1))
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Your Details')
                ->type('email', 'bademailatdomian.com')
                ->press('Update Details')
                ->assertSeeIn('div.alert-danger', 'Please supply a valid email address');
        });
    }

    /**
     * @test
     * 
     * @group dashboard
     * @group user
     * @group form
     * @group validation
     * @group flash
     * @group notification
     * @group success
     */
    public function updating_user_details_correctly_displays_updated_data() {
        
        $this->browse(function($browser) {

            $updateData = [
                'name'      => 'Jack Jones',
                'nickname'  => 'Jackie',
                'email'     => 'jack@email.com',
                'gender_id' => 3
            ];

            $browser->loginAs(User::find(1))
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Your Details')
                ->assertSee('Full Name')
                ->type('name', $updateData['name'])
                ->type('nickname', $updateData['nickname'])
                ->type('email', $updateData['email'])
                ->select('gender_id', $updateData['gender_id'])
                ->press('Update Details')
                ->on(new Dashboard)
                ->assertInputValue('name', $updateData['name'])
                ->assertInputValue('nickname', $updateData['nickname'])
                ->assertInputValue('email', $updateData['email'])
                ->assertSelected('#gender_id', $updateData['gender_id']);
        });
    }

    /**
     * @test
     * 
     * @group dashboard
     * @group user
     * @group password
     * @group form
     * @group password
     * @group validation
     * @group flash
     * @group notification
     * @group error
     */
    public function updating_password_form_shows_correct_validation_error_when_new_password_is_too_short() {

        $this->browse(function($browser) {

            $browser->loginAs(User::find(1))
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Update Password')
                ->type('password', '2short')
                ->type('password_confirmation', '2short')
                ->press('Update Password')
                ->on(new Dashboard)
                ->assertSeeIn('span.invalid-feedback', 'The password must be at least 8 characters');
        });
    }

    /**
     * @test
     * 
     * @group dashboard
     * @group user
     * @group password
     * @group form
     * @group password
     * @group validation
     * @group flash
     * @group notification
     * @group error
     */
    public function updating_password_form_shows_correct_error_flash_when_new_password_is_too_short() {

        $this->browse(function($browser) {

            $user = User::find(1);

            $browser->loginAs($user)
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Update Password')
                ->type('password', '2short')
                ->type('password_confirmation', '2short')
                ->press('Update Password')
                ->on(new Dashboard)
                ->assertSeeIn('div.alert-danger', 'Sorry, '.$user->nickname.'. Please fix the error below!');
        });
    }

    /**
     * @test
     * 
     * @group dashboard
     * @group user
     * @group password
     * @group form
     * @group password
     * @group validation
     * @group flash
     * @group notification
     * @group error
     */
    public function updating_password_form_shows_correct_panel_when_new_password_is_too_short() {
        
        $this->browse(function($browser) {

            $browser->loginAs(User::find(1))
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Update Password')
                ->type('password', '2short')
                ->type('password_confirmation', '2short')
                ->press('Update Password')
                ->on(new Dashboard)
                ->assertVisible('#update_password');
        });
    }

    /**
     * @test
     * 
     * @group dashboard
     * @group user
     * @group password
     * @group form
     * @group password
     * @group validation
     * @group flash
     * @group notification
     * @group error
     */
    public function updating_password_form_shows_correct_active_tab_when_new_password_is_too_short() {
        
        $this->browse(function($browser) {

            $browser->loginAs(User::find(1))
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Update Password')
                ->type('password', '2short')
                ->type('password_confirmation', '2short')
                ->press('Update Password')
                ->on(new Dashboard)
                ->assertSeeIn('li.nav-item > a.active', 'Update Password');
        });
    }

    /**
     * @test
     * 
     * @group dashboard
     * @group user
     * @group password
     * @group form
     * @group password
     * @group validation
     * @group flash
     * @group notification
     * @group error
     */
    public function updating_password_form_shows_correct_validation_error_when_new_password_confirmation_does_not_match() {

        $this->browse(function($browser) {

            $browser->loginAs(User::find(1))
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Update Password')
                ->type('password', 'password_one')
                ->type('password_confirmation', 'password_two')
                ->press('Update Password')
                ->on(new Dashboard)
                ->assertSeeIn('span.invalid-feedback', 'The password confirmation does not match.');
        });
    }

    /**
     * @test
     * 
     * @group dashboard
     * @group user
     * @group password
     * @group form
     * @group password
     * @group validation
     * @group flash
     * @group notification
     * @group error
     */
    public function updating_password_form_shows_correct_error_flash_when_new_password_confirmation_does_not_match() {

        $this->browse(function($browser) {

            $user = User::find(1);

            $browser->loginAs($user)
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Update Password')
                ->type('password', 'password_one')
                ->type('password_confirmation', 'password_two')
                ->press('Update Password')
                ->on(new Dashboard)
                ->assertSeeIn('div.alert-danger', 'Sorry, '.$user->nickname.'. Please fix the error below!');
        });
    }

    /**
     * @test
     * 
     * @group dashboard
     * @group user
     * @group password
     * @group form
     * @group password
     * @group validation
     * @group flash
     * @group notification
     * @group error
     */
    public function updating_password_form_shows_correct_panel_when_new_password_confirmation_does_not_match() {
        
        $this->browse(function($browser) {

            $browser->loginAs(User::find(1))
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Update Password')
                ->type('password', 'password_one')
                ->type('password_confirmation', 'password_two')
                ->press('Update Password')
                ->on(new Dashboard)
                ->assertVisible('#update_password');
        });
    }

    /**
     * @test
     * 
     * @group dashboard
     * @group user
     * @group password
     * @group form
     * @group password
     * @group validation
     * @group flash
     * @group notification
     * @group error
     */
    public function updating_password_form_shows_correct_active_tab_when_new_password_confirmation_does_not_match() {
        
        $this->browse(function($browser) {

            $browser->loginAs(User::find(1))
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Update Password')
                ->type('password', 'password_one')
                ->type('password_confirmation', 'password_two')
                ->press('Update Password')
                ->on(new Dashboard)
                ->assertSeeIn('li.nav-item > a.active', 'Update Password');
        });
    }

    /**
     * @test
     * 
     * @group dashboard
     * @group user
     * @group password
     * @group form
     * @group password
     * @group validation
     * @group flash
     * @group notification
     * @group success
     */
    public function updating_password_form_correctly_redirects_after_successful_update() {
        
        $this->browse(function($browser) {

            $browser->loginAs(User::find(1))
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Update Password')
                ->type('password', 'newpassword')
                ->type('password_confirmation', 'newpassword')
                ->press('Update Password')
                ->on(new Dashboard);
        });
    }

    /**
     * @test
     * 
     * @group dashboard
     * @group user
     * @group password
     * @group form
     * @group password
     * @group validation
     * @group flash
     * @group notification
     * @group success
     */
    public function updating_password_form_correctly_displays_success_flash() {

        $this->browse(function($browser) {

            $user = User::find(1);

            $browser->loginAs($user)
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Update Password')
                ->type('password', 'newpassword')
                ->type('password_confirmation', 'newpassword')
                ->press('Update Password')
                ->on(new Dashboard)
                ->assertSeeIn('div.alert-success', 'Congratulations, '.$user->nickname.'. Your password has been successfully updated!');
        });
    }

    /**
     * @test
     * 
     * @group dashboard
     * @group user
     * @group password
     * @group form
     * @group password
     * @group validation
     * @group flash
     * @group notification
     * @group success
     * @group login
     * @group auth
     */
    public function user_can_succesfully_login_after_password_update() {

        $this->browse(function($browser) {

            $user = User::find(1);

            $browser->loginAs($user)
                ->visit('dashboard')
                ->on(new Dashboard)
                ->clickLink('Update Password')
                ->type('password', 'newpassword')
                ->type('password_confirmation', 'newpassword')
                ->press('Update Password')
                ->on(new Dashboard)
                ->clickLink('Logout')
                ->clickLink('Login')
                ->on(new Login)
                ->type('email', $user->email)
                ->type('password', 'newpassword')
                ->press('Login')
                ->waitFortext('Welcome back')
                ->assertSeeIn('div.alert-success', 'Welcome back '.$user->nickname)
                ->logout();
        });
    }

}
