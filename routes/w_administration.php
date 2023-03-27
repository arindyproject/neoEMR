<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'App\Http\Controllers\Administration'], function(){

    Route::get('/administration', 'AdministrationController@index')->name('administration');

    //patient-------------------------------------------------------------------------
    Route::get('/patient', 'PatientController@index')->name('patient.index');
    Route::get('/patient/show/{rm}', 'PatientController@show')->name('patient.show');
    Route::get('/patient/create', 'PatientController@create')->name('patient.create');
    //patient-------------------------------------------------------------------------

});