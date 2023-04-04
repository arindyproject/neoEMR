<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'App\Http\Controllers'], function(){
    Route::group(['middleware' => ['role:admin'] ], function() {
        //---------------------------------ADMIN------------------------------------------------------------
        Route::get('/admin', 'AdminController@index')->name('admin');
        //===========>
        Route::post('/admin/add_user', 'AdminController@add_user')->name('admin.add_user');
        Route::get('/admin/list_aktif', 'AdminController@list_aktif')->name('admin.list_aktif');
        Route::get('/admin/list_non_aktif', 'AdminController@list_non_aktif')->name('admin.list_non_aktif');
        Route::get('/admin/list_admin', 'AdminController@list_admin')->name('admin.list_admin');
        //===========>
        Route::put('/admin/set_admin/{id}', 'AdminController@set_admin')->name('admin.set_admin');
        Route::put('/admin/set_aktif/{id}', 'AdminController@set_aktif')->name('admin.set_aktif');
        Route::delete('/admin/delete/{id}', 'AdminController@delete')->name('admin.delete');
        //===========>
        Route::get('/admin/web_setting', 'AdminController@web_setting')->name('admin.web_setting');
        Route::post('/admin/web_setting_submit', 'AdminController@web_setting_submit')->name('admin.web_setting_submit');
        //===========>
        Route::get('/admin/roles', 'AdminController@roles_index')->name('admin.roles');
        Route::get('/admin/roles/{id}', 'AdminController@roles_edit')->name('admin.roles.edit');
        Route::post('/admin/roles', 'AdminController@roles_store')->name('admin.roles.store');
        Route::put('/admin/roles/{id}', 'AdminController@roles_update')->name('admin.roles.update');
        Route::delete('/admin/roles/{id}', 'AdminController@role_delete')->name('admin.roles.delete');
        //===========>
        Route::get('/admin/permissions', 'AdminController@permissions_index')->name('admin.permissions');
        Route::get('/admin/permissions/{id}', 'AdminController@permissions_edit')->name('admin.permissions.edit');
        Route::post('/admin/permissions', 'AdminController@permissions_store')->name('admin.permissions.store');
        Route::put('/admin/permissions/{id}', 'AdminController@permissions_update')->name('admin.permissions.update');
        Route::delete('/admin/permissions/{id}', 'AdminController@permissions_delete')->name('admin.permissions.delete');
        //===========>
        Route::get('/admin/setting/form/mode', 'AdminController@setting_form_mode_index')->name('admin.setting.form.mode');
        Route::post('/admin/setting/form/mode', 'AdminController@setting_form_mode_store')->name('admin.setting.form.mode');
        //---------------------------------ADMIN------------------------------------------------------------
    });
});