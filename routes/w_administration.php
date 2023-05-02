<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'App\Http\Controllers\Administration'], function(){

    //administration-------------------------------------------------------------------------
    Route::get('/administration', 'AdministrationController@index')->name('administration');
    Route::get('/administration/pendaftaran/{id}', 'AdministrationController@pendaftaran')->name('administration.pendaftaran');
    Route::get('/administration/history/{id}', 'AdministrationController@history')->name('administration.history');
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
    Route::get('/file/patient/{id}', 'PatientFileController@index')->name('file.patient.index');
    Route::get('/file/patient/{id}/create', 'PatientFileController@create')->name('file.patient.create');
    Route::get('/file/patient/{id}/edit/{slug}', 'PatientFileController@edit')->name('file.patient.edit');
    Route::put('/file/patient/{id}/store', 'PatientFileController@store')->name('file.patient.store');
    Route::put('/file/patient/{id}/update', 'PatientFileController@update')->name('file.patient.update');
    Route::delete('/file/patient/{id}/delete', 'PatientFileController@delete')->name('file.patient.delete');
    //patient_file-------------------------------------------------------------------------

});