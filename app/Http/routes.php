<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index');
});

Route::group(['middleware' => 'guest'], function() {
  Route::get('auth/github', 'Auth\AuthController@redirectToProvider');
  Route::get('auth/github/callback', 'Auth\AuthController@handleProviderCallback');
});

Route::group(['middleware' => 'auth', 'prefix' => 'api/v1/me'], function() {
  Route::get('/repos', 'MeController@repos');
});

Route::get('/logout', 'Auth\AuthController@getLogout');
