<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();


//admin==================================================================================================
require_once __DIR__.'/w_admin.php';
//admin==================================================================================================

//PROFILE================================================================================================
require_once __DIR__.'/w_profile.php'; 
//PROFILE================================================================================================

//attribute===============================================================================================
require_once __DIR__.'/w_attribute.php'; 
//attribute===============================================================================================



//administration================================================================================================
require_once __DIR__.'/w_administration.php'; 
//administration================================================================================================



Route::group(['namespace' => 'App\Http\Controllers'], function(){
    Route::get('/home', 'HomeController@index')->name('home');

    //role in conteoller------------------------------------------------------------------------------------------
    //---------------------------------PostTestController---------------------------------------------------------
    Route::resource('post_test', PostTestController::class);
    //---------------------------------PostTestController---------------------------------------------------------
    //role in conteoller------------------------------------------------------------------------------------------
});