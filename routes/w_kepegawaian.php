<?php
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'App\Http\Controllers'], function(){
    Route::get('kepegawaian', 'Kepegawaian\KepegawaianController@index')->name('kepegawaian.index');
});