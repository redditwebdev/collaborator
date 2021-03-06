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

Route::get('/', 'PagesController@getIndex');

Route::group(['middleware' => 'guest'], function() {
  Route::get('auth/github', 'Auth\AuthController@redirectToProvider');
  Route::get('auth/github/callback', 'Auth\AuthController@handleProviderCallback');
});

Route::group(['middleware' => 'auth'], function() {
  Route::get('/new/project', 'ProjectController@getNew');
});

Route::group(['middleware' => 'auth', 'prefix' => 'api/v1/me'], function() {
  Route::get('/repos', 'MeController@repos');
});

Route::group(['middleware' => 'auth', 'prefix' => 'api/v1/project'], function() {
  Route::post('/new', 'ProjectController@create');
  Route::get('/{owner}/{repo}/comments', 'CommentController@comments');
  Route::post('/{owner}/{repo}/new-comment', 'CommentController@newComment');
});


Route::get('/project/{owner}/{name}', 'ProjectController@getProject');
Route::get('/tagged', 'TagController@getTag');
Route::get('/search', 'SearchController@getSearch');
Route::get('/logout', 'Auth\AuthController@getLogout');
