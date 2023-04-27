<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'App\Http\Controllers\Administration'], function(){

    //administration-------------------------------------------------------------------------
    Route::get('/administration', 'AdministrationController@index')->name('administration');
    Route::get('/administration/pendaftaran/{rm}', 'AdministrationController@pendaftaran')->name('administration.pendaftaran');
    Route::get('/administration/history/{rm}', 'AdministrationController@history')->name('administration.history');
    //administration-------------------------------------------------------------------------

    //patient-------------------------------------------------------------------------
    Route::get('/patient', 'PatientController@index')->name('patient.index');
    Route::get('/patient2', 'PatientController@index2')->name('patient.index2');
    Route::get('/patient/json', 'PatientController@data_json')->name('patient.data_json');
    Route::get('/patient/fhir/{id}/json', 'PatientController@fhir_json')->name('patient.fhir.json');
    Route::get('/patient/show/{rm}', 'PatientController@show')->name('patient.show');
    Route::get('/patient/create', 'PatientController@create')->name('patient.create');
    Route::get('/patient/edit/{id}', 'PatientController@edit')->name('patient.edit');
    Route::get('/patient/edit/advance/{type}/{id}', 'PatientController@edit_advance')->name('patient.edit_advance');
    Route::post('/patient/store', 'PatientController@store')->name('patient.store');
    Route::put('/patient/update/{id}', 'PatientController@update')->name('patient.update');
    Route::put('/patient/update/advance/{type}/{id}', 'PatientController@update_advance')->name('patient.update_advance');
    //patient-------------------------------------------------------------------------

    //patient_file-------------------------------------------------------------------------
    Route::get('/file/patient/{rm}', 'PatientFileController@index')->name('file.patient.index');
    //patient_file-------------------------------------------------------------------------

});