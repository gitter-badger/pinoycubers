<?php

Route::get('/', 'HomeController@showIndex');

// Auth
Route::group(['namespace' => 'Auth'], function() {
    Route::get('/login', 'AuthController@login');
    Route::post('/user/authenticate','AuthController@authenticate');

    Route::get('/register', 'AuthController@register');
    Route::post('/user/create','AuthController@create');

    Route::get('/register/verify/{code}', 'AuthController@verifyUser');

    Route::get('/resend/verification', 'AuthController@resendVerification');
    Route::post('/resend/verification', 'AuthController@resend');

    Route::get('/logout','AuthController@logout');
});

// TODO:: Implement all these routes
Route::get('/password/forgot','UserController@forgotPassword');
Route::post('/password/forgot','UserController@requestPassword');

Route::get('/password/reset/{token}','UserController@resetPassword');
Route::post('/password/reset/{token}','UserController@postResetPassword');


/* Disable Facebook Login for the meantime */
Route::get('login/fb', 'HomeController@fbLogin');
Route::get('login/fb/callback', 'HomeController@fbLoginCallback');


// Cubemeets
Route::group(['namespace' => 'Cubemeets'], function() {
    Route::post('/cubemeets/{cubemeets}/join', 'CubemeetAttendeesController@join');
    Route::post('/cubemeets/{cubemeets}/canceljoin', 'CubemeetAttendeesController@cancelJoin');

    Route::get('/cubemeets', 'CubemeetController@index');

    Route::get('/cubemeets/set', 'CubemeetController@create');
    Route::post('/cubemeets/set', 'CubemeetController@store');

    Route::get('/cubemeets/{slug}', 'CubemeetController@show');

    Route::get('/cubemeets/{slug}/edit', 'CubemeetController@edit');
    Route::post('/cubemeets/{slug}/edit', 'CubemeetController@update');

    Route::get('/cubemeets/{slug}/cancel', 'CubemeetController@getCancel');
    Route::post('/cubemeets/{slug}/cancel', 'CubemeetController@cancel');

    Route::post('/cubemeets/{slug}/comment', 'CubemeetCommentController@comment');

    Route::get('/cubemeets/comments/edit/{id}', 'CubemeetCommentController@edit');
    Route::post('/cubemeets/comments/edit/{id}', 'CubemeetCommentController@update');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/user/{profile}','UserController@getProfile');

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

    Route::get('/{username}','UserController@showUser');

    Route::get('/edit/profile','UserController@getEditProfile');
    Route::post('/update/profile','UserController@updateProfile');
    Route::post('/update/email','UserController@updateEmail');
    Route::post('/update/password','UserController@updatePassword');
});
