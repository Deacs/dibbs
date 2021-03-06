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
        $user = \Auth::user();

        $user->name = $request->name;
        $user->nickname = $request->nickname;
        $user->email = $request->email;
        $user->gender_id = $request->gender_id;

        $flash_msg = null;
        $flash_type = 'error';

        if (is_null($request->name) || $request->name == "") {
            $flash_msg = 'Full name cannot be left empty';
        } else if (is_null($request->nickname) || $request->nickname == "") {
            $flash_msg = 'Nickname cannot be left empty';
        } else if (is_null($request->email) || $request->email == "") {
            $flash_msg = 'Email address cannot be left empty';
        } elseif(!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $flash_msg = 'Please supply a valid email address';
        } else if (is_null($request->gender_id) || $request->gender_id == 0) {
            $flash_msg = 'A valid gender must be selected';
        }

        if (is_null($flash_msg)) {
            $flash_msg = 'Details successfully updated!';
            $flash_type = 'success';

            $user->save();
        }

        $request->session()->flash($flash_type,__($flash_msg));

        return redirect('/dashboard');
    }
}
