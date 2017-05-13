<?php

Route::group(['namespace' => 'Eugen\Cstat\Controllers', 'prefix'=>'cstat'], function() {
    Route::get('/', 'CstatController@index');
    Route::get('foo', 'CstatController@foo');
});