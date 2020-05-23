<?php

Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});


Route::group([
    'middleware' => 'jwt.auth',
    'namespace' => 'Api'
], function ($router) {
    Route::get('meta-content/all', 'MetaContentController@all');
    Route::resource('meta-content', 'MetaContentController');
    Route::resource('content', 'ContentController');
//    Route::get('entry/{model_id}/get-by-model', 'EntryController@getByModel');
});

