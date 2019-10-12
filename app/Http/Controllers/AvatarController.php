<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AvatarController extends Controller
{
    /**
     * Display  the home for the dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit() {
        $user = \Auth::user();
        return view('avatar.edit')->with('user', $user);
    }
}
