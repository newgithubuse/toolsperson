<?php

use Illuminate\Http\Request;

Route::group(['prefix' => 'user'], function(){
    Route::post('registered', 'UserController@registered');
    Route::post('login', 'UserController@login');    
    Route::post('submit', 'UserController@submitObject');
});

Route::group(['prefix' => 'auth'], function(){
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('logout', 'AuthController@logout');
    });
});
