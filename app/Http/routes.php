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
Route::group(['middleware' => 'auth', 'namespace' => 'Cubemeets'], function() {
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

    Route::get('/cubemeets/comments/delete/{id}', 'CubemeetCommentController@getDelete');
    Route::post('/cubemeets/comments/delete/{id}', 'CubemeetCommentController@postDelete');
});

// Market
Route::group(['middleware' => 'auth', 'namespace' => 'Market'], function() {
    Route::get('/market', 'ItemController@index');

    Route::get('/market/item/{slug}', 'ItemController@show');

    Route::get('/market/add/item', 'ItemController@getAdd');
    Route::post('/market/add/item', 'ItemController@postAdd');

    Route::get('/market/item/{slug}/edit', 'ItemController@getEdit');
    Route::post('/market/item/{slug}/edit', 'ItemController@postEdit');

    Route::post('/market/item/{slug}/comment', 'CommentController@postComment');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/user/{profile}','UserController@getProfile');

    /* Users */
    Route::get('/users', 'UserController@showUsers');

    Route::get('/{username}','UserController@showUser');

    Route::get('/edit/profile','UserController@getEditProfile');
    Route::post('/update/profile','UserController@updateProfile');
    Route::post('/update/email','UserController@updateEmail');
    Route::post('/update/password','UserController@updatePassword');
    Route::post('/update/avatar', 'UserController@updateAvatar');
});
