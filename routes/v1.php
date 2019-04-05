<?php

use Illuminate\Http\Request;


Route::group(['prefix' => 'user'], function(){
    Route::post('registered', 'UserController@registered');
    Route::post('submit', 'UserController@submitObject');
});

Route::group(['prefix' => 'auth'], function(){
    Route::post('login', 'AuthController@login');
    Route::group(['middleware' => 'auth:api'], function() {        
        Route::get('logout', 'AuthController@logout');
    });  
});
