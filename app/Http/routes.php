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

Route::get('/', 'HomeController@showIndex');

// Auth
Route::get('/login', 'Auth\AuthController@login');
Route::post('/user/authenticate','Auth\AuthController@authenticate');

Route::get('/register', 'Auth\AuthController@register');
Route::post('/user/create','Auth\AuthController@create');

Route::get('/logout','Auth\AuthController@logout');

// TODO:: Implement all these routes
Route::get('/register/verify/{code}', 'UserController@verifyUser');

Route::get('/password/forgot','UserController@forgotPassword');
Route::post('/password/forgot','UserController@requestPassword');

Route::get('/password/reset/{token}','UserController@resetPassword');
Route::post('/password/reset/{token}','UserController@postResetPassword');


/* Disable Facebook Login for the meantime */
Route::get('login/fb', 'HomeController@fbLogin');
Route::get('login/fb/callback', 'HomeController@fbLoginCallback');


Route::group(array('middleware' => 'auth'), function()
{
    Route::get('/user/{profile}','UserController@getProfile');
    Route::post('/cubemeets/{cubemeets}/join', 'CubemeetController@join');
    Route::post('/cubemeets/{cubemeets}/canceljoin', 'CubemeetController@canceljoin');
    Route::resource('cubemeets', 'CubemeetController');
    
    /* Market */
    Route::get('/market', 'MarketController@showIndex');
    Route::get('/market/item/{slug}', 'MarketController@getItem');
    Route::get('/market/add', 'MarketController@getAddItem');
    Route::post('/market/add', 'MarketController@postAddItem');
    Route::get('/market/{slug}/edit', 'MarketController@getEditItem');
    Route::post('/market/{slug}/edit', ['as' => 'postEditItem', 'uses' => 'MarketController@postEditItem']);
    Route::post('/market/comment/{id}', 'MarketController@postComment');

    /* Users */
    Route::get('/users', 'UserController@showUsers');

    /* Profile */
    Route::get('/{profile}','UserController@getProfile');

    Route::get('/edit/profile','UserController@getEditProfile');
    Route::post('/edit/profile','UserController@postEditProfile');
});
