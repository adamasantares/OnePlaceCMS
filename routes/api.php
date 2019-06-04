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
    Route::resource('entry', 'EntryController');
    Route::get('entry/{model_id}/get-by-model', 'EntryController@getByModel');
    Route::post('media', 'MediaController@store');
    Route::resource('project', 'ProjectController');
});

