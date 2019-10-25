<?php

namespace App\Http\Controllers\Auth;

use View;
use Session;
use Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'      => ['required', 'string', 'max:255'],
            'nickname'  => ['required', 'string', 'max:32'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'gender_id' => ['required', 'string', Rule::in(['1', '2', '3'])],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
        ],
        [
            'gender_id.required'    => 'Please specify a gender for your account',
            'gender_id.in'          => 'Invalid gender selected',
        ]);
    }

    /**
     * Update the current user's password
     * 
     * @param  array  $data
     * @return \App\User
     */
    public function update(Request $request) {
        
        $user = \Auth::user();

        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('error','Sorry, '.$user->nickname.'. Please fix the error below!');
            return redirect('dashboard')
                        ->withErrors($validator)
                        ->withInput()
                        ->with('active_panel', 'update_password');
        }

        // Validation passed - update the user record
        $user->password = Hash::make($request->password);
        $user->save();

        Session::flash('success','Congratulations, '.$user->nickname.'. Your password has been successfully updated!');

        return redirect('dashboard')
                        ->with('active_panel', 'user_details');
    }
}
