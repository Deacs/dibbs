<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/', 'MainController@index');

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('dashboard', 'DashboardController@index');

Route::get('wardrobe', 'WardrobeController@index');

Route::get('wardrobe/add', 'WardrobeController@create');

Route::post('wardrobe/add', 'WardrobeController@store');

Route::post('wardrobe/delete', 'WardrobeController@delete');

Route::get('reservations', 'WardrobeReservationController@index');

Route::get('reservations/{id}', 'WardrobeReservationController@show');

Route::get('wardrobe/history', 'WardrobeHistoryController@index');

// --------- TEST routes -------------

Route::get('seasons', 'SeasonController@index');

Route::get('user/new/{name}/{email}/{password}', 'Auth\RegisterController@quickUser');

Route::get('pusher', function () {
    return view('pusher');
});
