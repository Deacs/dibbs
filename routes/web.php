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

Route::get('dashboard', 'DashboardController@index')->name('dashboard')->middleware('auth');

Route::get('wardrobe', 'WardrobeController@index')->name('wardrobes')->middleware('auth');

Route::get('wardrobe/{id}', 'WardrobeController@show')->name('get_wardrobe')->middleware('auth');

Route::get('wardrobe/add', 'WardrobeController@create')->name('add_wardrobe_item')->middleware('auth');

Route::post('wardrobe/add', 'WardrobeController@store')->name('add_to_wardrobe')->middleware('auth');

Route::post('wardrobe/delete/{id}', 'WardrobeController@delete')->name('delete_from_wardrobe')->middleware('auth');

Route::get('reservations', 'WardrobeReservationController@index')->name('view_reservations')->middleware('auth');

Route::get('reservations/{id}', 'WardrobeReservationController@show')->name('get_reservation')->middleware('auth');

Route::get('wardrobe/history', 'WardrobeHistoryController@index')->name('view_wardobe_history')->middleware('auth');

// --------- TEST routes -------------

Route::get('seasons', 'SeasonController@index');

Route::get('user/new/{name}/{email}/{password}', 'Auth\RegisterController@quickUser');

Route::get('pusher', function () {
    return view('pusher');
});
