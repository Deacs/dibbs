<?php

namespace App\Http\Controllers\Auth;

use Session;
use App\User;
use App\Avatar;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
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
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data) {
        $user = User::create([
            'name'      => $data['name'],
            'nickname'  => $data['nickname'],
            'email'     => $data['email'],
            'gender_id' => $data['gender_id'],
            'password'  => Hash::make($data['password']),
        ]);

        $avatar = Avatar::create([
            'user_id' => $user->id,
        ]);

        Session::flash('success','Welcome, '.$data['nickname'].'. Your account has been successfully created!');

        return $user;
    }
}
