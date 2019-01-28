<?php

Route::get('/', 'DashboardController@index')->name('dashboard');

Route::resource('content-model', 'ContentModelController');
