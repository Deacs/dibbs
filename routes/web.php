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

Route::post('user/password/update', 'Auth\ResetPasswordController@update')->name('update_user_password')->middleware('auth');

Route::post('user/update', 'UserController@update')->name('update_user')->middleware('auth');

Route::get('user/avatar/update', 'AvatarController@edit')->name('update_avatar')->middleware('auth');

Route::get('wardrobe', 'WardrobeController@index')->name('wardrobes')->middleware('auth');

Route::get('wardrobe/{id}', 'WardrobeController@show')->name('get_wardrobe')->middleware('auth');

Route::get('wardrobe/add', 'WardrobeController@create')->name('add_new_wardrobe')->middleware('auth');

Route::post('wardrobe/add', 'WardrobeController@store')->name('store_new_wardrobe')->middleware('auth');

Route::post('wardrobe/delete/{id}', 'WardrobeController@delete')->name('delete_wardrobe')->middleware('auth');

Route::post('wardrobe/item/add', 'WardrobeController@addItem')->name('add_item_to_wardrobe')->middleware('auth');

Route::post('wardrobe/item/delete/{id}', 'WardrobeController@removeItem')->name('remove_item_from_wardrobe')->middleware('auth');

Route::get('wardrobe/history', 'WardrobeHistoryController@index')->name('view_wardobe_history')->middleware('auth');

Route::get('reservations', 'WardrobeReservationController@index')->name('view_reservations')->middleware('auth');

Route::get('reservations/{id}', 'WardrobeReservationController@show')->name('get_reservation')->middleware('auth');
