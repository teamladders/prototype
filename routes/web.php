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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('register/verify/{token}', 'Auth\RegisterController@verify');

Route::group(['prefix' => 'personal', 'namespace' => 'Personal'], function () {
    Route::get('/', 'DashboardController@index');
    Route::post('/user/edit', 'DashboardController@editProfile')->name('user.edit');
});


Route::get('home', function() {
    return View::make('dashboard.home');
})->name('home');

Route::get('profile', function() {
    return View::make('dashboard.profile');
})->name('profile');

Route::get('team', function() {
    return View::make('dashboard.team');
})->name('team');
