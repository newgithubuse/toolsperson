<?php

use Illuminate\Http\Request;

Route::group(['prefix' => 'user'], function(){
    Route::post('registered', 'UserController@registered');
    Route::post('login', 'UserController@login');    
    Route::post('submit', 'UserController@submitObject');
});
    
