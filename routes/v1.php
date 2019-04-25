<?php

use Illuminate\Http\Request;


Route::group(['prefix' => 'user'], function() {
    Route::post('registered', 'UserController@registered');
    Route::post('submit', 'UserController@submitObject');    
    Route::get('get', 'UserController@getPostEvent');
    Route::group(['prefix' => 'profile'], function() {
        Route::patch('update', 'UserController@update');
    });
    Route::group(['prefix' => 'registration'], function() {
        Route::get('history', "UserController@getRegistrationHistory");
        Route::get('get/{id}', "UserController@getRegistrationUser");
        Route::post('update/{id}', "UserController@updateRegistrationStatus");
    });
});

Route::group(['prefix' => 'auth'], function() {
    Route::post('login', 'AuthController@login');
    Route::group(['middleware' => 'auth:api'], function() {        
        Route::get('logout', 'AuthController@logout');
    });  
});
Route::group(['prefix' => 'public'], function() {
    Route::get('get', 'PublicController@getAllPostEvent');
    Route::post('registration/{id}', 'PublicController@registrationEvent' );
});
