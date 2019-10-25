<?php

namespace App\Http\Controllers;

use View;
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
        return view('dashboard.index')
                ->with('user', $user)
                ->with('active_panel', 'user_details');
    }
}
