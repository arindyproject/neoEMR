<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'App\Http\Controllers\Administration'], function(){

    Route::get('/administration', 'AdministrationController@index')->name('administration');

    Route::get('/patient', 'PatientController@index')->name('patient.index');

});