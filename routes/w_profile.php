<?php
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'App\Http\Controllers'], function(){
    //file--------------------------------------------------------------------
    Route::get('/profile/{id}/file', 'ProfileController@file')->name('profile.file');
    Route::get('/profile/file/create/{id}', 'ProfileController@create_file')->name('profile.file.create');
    Route::get('/profile/file/edit/{id}', 'ProfileController@edit_file')->name('profile.file.edit');
    Route::put('/profile/file/update/{id}', 'ProfileController@update_file')->name('profile.file.update');
    Route::post('/profile/file/store/{id}', 'ProfileController@store_file')->name('profile.file.store');
    Route::delete('/profile/file/delete/{id}', 'ProfileController@file_delete')->name('profile.file.delete');
    //file--------------------------------------------------------------------

    //signature--------------------------------------------------------------------
    Route::get('/profile/signature/{id}', 'ProfileController@signature')->name('profile.signature');
    Route::put('/profile/signature/{id}', 'ProfileController@signature_store')->name('profile.signature.store');
    //signature--------------------------------------------------------------------

    Route::get('/profile', 'ProfileController@list')->name('profile.list');
    Route::get('/profile/{id}', 'ProfileController@index')->name('profile');
    Route::get('/profile/edit/{id}', 'ProfileController@edit')->name('profile.edit');
    Route::get('/profile/edit/advance/{id}', 'ProfileController@edit_advance')->name('profile.edit.advance');

    Route::put('/profile/edit_submit/{id}', 'ProfileController@edit_submit')->name('profile.edit_submit');
    Route::put('/profile/edit_advance_identifier/{id}', 'ProfileController@edit_advance_identifier')->name('profile.edit_advance_identifier');
    Route::put('/profile/edit_advance_telecom/{id}', 'ProfileController@edit_advance_telecom')->name('profile.edit_advance_telecom');
    Route::put('/profile/edit_advance_address/{id}', 'ProfileController@edit_advance_address')->name('profile.edit_advance_address');
    Route::put('/profile/edit_advance_communication/{id}', 'ProfileController@edit_advance_communication')->name('profile.edit_advance_communication');

    Route::get('/profile/ganti_password/{id}', 'ProfileController@ganti_password')->name('profile.ganti_password');
    Route::put('/profile/ganti_password_submit/{id}', 'ProfileController@ganti_password_submit')->name('profile.ganti_password_submit');

    Route::get('/profile/edit_role/{id}', 'ProfileController@edit_role')->name('profile.edit.role');
    Route::put('/profile/edit_role/{id}', 'ProfileController@store_role')->name('profile.store.role');
});