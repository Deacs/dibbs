<?php

namespace App\Http\Controllers;

use View;
use Session;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display  the home for the dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user = \Auth::user();

        $active_panel = Session::has('active_panel') ? Session::get('active_panel') : 'user_details';

        return view('dashboard.index')
                ->with('user', $user)
                ->with('active_panel', $active_panel);
    }
}
