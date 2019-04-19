<?php

Route::group(['prefix' => 'auth'], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});


Route::group(['middleware' => 'jwt.auth'], function ($router) {
    Route::get('content-model/all', 'ContentModelController@all');
    Route::resource('content-model', 'ContentModelController');
    Route::post('content-field/validate', 'ContentFieldController@validateFields');
});