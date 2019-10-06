<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
     /**
     * Update the user record
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // TODO
        // Check that teh authed user ID matches the value in the request
        // Throw an exception if this is not the case
        $user = \Auth::user();

        $user->name = $request->userName;
        $user->email = $request->userEmail;
        $user->gender_id = $request->userGenderId;

        $user->save();

        $request->session()->flash('status',__('Profile successfully updated!'));
        return redirect('/dashboard');
    }
}
