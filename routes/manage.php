<?php

//Route::get('/', 'ManageController@index')->name('app');
//Route::resource('content-model', 'ContentModelController');

Route::get('{any}', function () {
    return view('manage.index');
})->where('any', '.*');