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
    return view('layouts.public');
});

Auth::routes();

Route::get('register/verify/{token}', 'Auth\RegisterController@verify');

/*
 * Here the routes for personal user pages live
 */
Route::group(['prefix' => 'personal', 'namespace' => 'Personal', 'middleware' => ['auth'], 'as' => 'personal.'], function () {

    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::get('profile', 'UserController@edit')->name('profile');

    Route::post('profile', 'UserController@update');
    
    Route::post('password', 'UserController@updatePassword')->name('password');

    Route::get('team', function() {
        return View::make('personal.team');
    })->name('team');
});
