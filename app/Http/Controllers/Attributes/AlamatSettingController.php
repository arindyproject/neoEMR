<?php

namespace App\Http\Controllers\Attributes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Config;

use App\Models\attAlamatCountry;
use App\Models\attAlamatProvinsi;
use App\Models\attAlamatKota;
use App\Models\attAlamatKecamatan;
use App\Models\attAlamatKelurahan;

class AlamatSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:attribute|admin']);

        $this->view_index   = 'attributes.alamat.setting.index';

        $this->url_index    = 'attributes.alamat.setting.index';
        $this->url_update   = 'attributes.alamat.setting.update';

        $this->title        = "ATT Setting Alamat";

        $this->to_return    = [
            'title'      => $this->title,
            'url_index'  => $this->url_index,
            'url_update' => $this->url_update,

            'bg'        => \App\Models\Config::get()['navbar_variants'],
        ];
        
    }

    public function index(){
        $this->to_return['data'] = Config::get_setting_default();
        return view($this->view_index,$this->to_return);
    }

    public function update(Request $request){
        $country = attAlamatCountry::find($request->country_id);
        $provinsi = attAlamatProvinsi::find($request->att_alamat_provinsis_id);
        $kota = attAlamatKota::find($request->att_alamat_kotas_id);
        $kecamatan = attAlamatKecamatan::find($request->att_alamat_kecamatans_id);
        $kelurahan = attAlamatKelurahan::find($request->att_alamat_kelurahans_id);

        Config::put_setting_default_alamat(
            $country  , 
            $provinsi , 
            $kota     , 
            $kecamatan, 
            $kelurahan, 
        );
        return redirect()->route($this->url_index)->with('success', $this->title . ' berhasil diUpdate!!');

    }
}
