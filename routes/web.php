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

/*
 * Here routes for personal user pages live
 */
Route::group(['prefix' => 'personal', 'namespace' => 'Personal', 'middleware' => ['auth'], 'as' => 'personal.'], function () {

    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::get('profile', function() {
        return View::make('personal.profile');
    })->name('profile');

    Route::post('profile', 'UserController@update');

    Route::get('team', function() {
        return View::make('personal.team');
    })->name('team');
});
