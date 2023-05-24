<?php
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'App\Http\Controllers'], function(){
    //role admin & attribute========================================================================================
    //role in class controller
    //Route::group(['middleware' => ['role:admin|attribute'] ], function() {
        //---------------------------------Attributes----------------------------------------------------------

        //--------------alamat---------------------------------------------------------------------------------
        //setting---------------------------------------------------------------------------------------------
        Route::get('attributes/alamat/setting', 'Attributes\AlamatSettingController@index')->name('attributes.alamat.setting.index');
        Route::put('attributes/alamat/setting', 'Attributes\AlamatSettingController@update')->name('attributes.alamat.setting.update');
        //setting---------------------------------------------------------------------------------------------

        //country---------------------------------------------------------------------------------------------
        Route::get('attributes/alamat/country/autocomplete', 'Attributes\AlamatCountryController@autocomplete')->name('attributes.alamat.country.autocomplete');
        Route::resource('attributes/alamat/country', 'Attributes\AlamatCountryController',  ['as' => 'attributes.alamat']);
        //country---------------------------------------------------------------------------------------------

        //provinsi---------------------------------------------------------------------------------------------
        Route::get('attributes/alamat/provinsi/autocomplete', 'Attributes\AlamatProvinsiController@autocomplete')->name('attributes.alamat.provinsi.autocomplete');
        Route::resource('attributes/alamat/provinsi', 'Attributes\AlamatProvinsiController',  ['as' => 'attributes.alamat']);
        //provinsi---------------------------------------------------------------------------------------------


        //kota---------------------------------------------------------------------------------------------
        Route::get('attributes/alamat/kota/autocomplete', 'Attributes\AlamatKotaController@autocomplete')->name('attributes.alamat.kota.autocomplete');
        Route::resource('attributes/alamat/kota', 'Attributes\AlamatKotaController',  ['as' => 'attributes.alamat']);
        //kota---------------------------------------------------------------------------------------------


        //kecamtan---------------------------------------------------------------------------------------------
        Route::get('attributes/alamat/kecamatan/autocomplete', 'Attributes\AlamatKecamatanController@autocomplete')->name('attributes.alamat.kecamatan.autocomplete');
        Route::resource('attributes/alamat/kecamatan', 'Attributes\AlamatKecamatanController',  ['as' => 'attributes.alamat']);
        //kecamtan---------------------------------------------------------------------------------------------


        //kelurahan---------------------------------------------------------------------------------------------
        Route::get('attributes/alamat/kelurahan/autocomplete', 'Attributes\AlamatKelurahanController@autocomplete')->name('attributes.alamat.kelurahan.autocomplete');
        Route::resource('attributes/alamat/kelurahan', 'Attributes\AlamatKelurahanController',  ['as' => 'attributes.alamat']);
        //kelurahan---------------------------------------------------------------------------------------------
        //--------------alamat---------------------------------------------------------------------------------


        //--------------jenis---------------------------------------------------------------------------------
        //index------------------------------------------------------------------------------------------------
        Route::get('/attributes/jenis', function(){
            return view('attributes.jenis.index');
        } )->name('attributes.jenis.index');
        //index------------------------------------------------------------------------------------------------


        //agama-----------------------------------------------------------------------------------------------
        Route::resource('attributes/jenis/agama', 'Attributes\JenisAgamaController',  ['as' => 'attributes.jenis']);
        //agama-----------------------------------------------------------------------------------------------


        //kartu_identitas-----------------------------------------------------------------------------------------------
        Route::resource('attributes/jenis/kartu_identitas', 'Attributes\JenisKartuIdentitasController',  ['as' => 'attributes.jenis']);
        //kartu_identitas-----------------------------------------------------------------------------------------------

        //kelamin-----------------------------------------------------------------------------------------------
        Route::resource('attributes/jenis/kelamin', 'Attributes\JenisKelaminController',  ['as' => 'attributes.jenis']);
        //kelamin-----------------------------------------------------------------------------------------------


        //pekerjaan-----------------------------------------------------------------------------------------------
        Route::resource('attributes/jenis/pekerjaan', 'Attributes\JenisPekerjaanController',  ['as' => 'attributes.jenis']);
        //pekerjaan-----------------------------------------------------------------------------------------------

        //pendidikan-----------------------------------------------------------------------------------------------
        Route::resource('attributes/jenis/pendidikan', 'Attributes\JenisPendidikanController',  ['as' => 'attributes.jenis']);
        //pendidikan-----------------------------------------------------------------------------------------------

        //pernikahan-----------------------------------------------------------------------------------------------
        Route::resource('attributes/jenis/pernikahan', 'Attributes\JenisPernikahanController',  ['as' => 'attributes.jenis']);
        //pernikahan-----------------------------------------------------------------------------------------------


        //pernikahan-----------------------------------------------------------------------------------------------
        Route::resource('attributes/jenis/pernikahan', 'Attributes\JenisPernikahanController',  ['as' => 'attributes.jenis']);
        //pernikahan-----------------------------------------------------------------------------------------------

        //--------------jenis---------------------------------------------------------------------------------




        //--------------fhair_hl7---------------------------------------------------------------------------------
        Route::get('attributes/fhair_hl7/setting', 'Attributes\FhairHl7ResourceController@setting')->name('attributes.fhair_hl7.setting');
        Route::post('attributes/fhair_hl7/setting', 'Attributes\FhairHl7ResourceController@setting_store')->name('attributes.fhair_hl7.setting');
        Route::delete('attributes/fhair_hl7/setting/delete/{name}', 'Attributes\FhairHl7ResourceController@setting_delete')->name('attributes.fhair_hl7.setting.delete');

        Route::get('attributes/fhair_hl7/CodeSystem/{name}', 'Attributes\FhairHl7ResourceController@CodeSystem')->name('attributes.fhair_hl7.CodeSystem');
        Route::put('attributes/fhair_hl7/CodeSystem/{name}', 'Attributes\FhairHl7ResourceController@CodeSystemStore')->name('attributes.fhair_hl7.CodeSystem');
        //--------------fhair_hl7---------------------------------------------------------------------------------


        //---------------------------------Attributes----------------------------------------------------------
    //});
    //role admin & attribute========================================================================================
});