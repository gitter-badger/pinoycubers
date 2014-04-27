<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@showIndex');
Route::get('login/fb', 'HomeController@fbLogin');
Route::get('login/fb/callback', 'HomeController@fbLoginCallback');
Route::get('logout', 'HomeController@logout');

Route::group(array('before' => 'auth'), function()
{
    Route::get('/user/{profile}','UserController@getProfile');
    Route::get('/{profile}','UserController@getProfile');
});