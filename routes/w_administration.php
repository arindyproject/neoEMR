<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'App\Http\Controllers\Administration'], function(){

    Route::get('/administration', 'AdministrationController@index')->name('administration');

    //patient-------------------------------------------------------------------------
    Route::get('/patient', 'PatientController@index')->name('patient.index');
    Route::get('/patient/fhir/{id}/json', 'PatientController@fhir_json')->name('patient.fhir.json');
    Route::get('/patient/show/{rm}', 'PatientController@show')->name('patient.show');
    Route::get('/patient/create', 'PatientController@create')->name('patient.create');
    Route::get('/patient/edit/{id}', 'PatientController@edit')->name('patient.edit');
    Route::post('/patient/store', 'PatientController@store')->name('patient.store');
    Route::put('/patient/update/{id}', 'PatientController@update')->name('patient.update');
    //patient-------------------------------------------------------------------------

});