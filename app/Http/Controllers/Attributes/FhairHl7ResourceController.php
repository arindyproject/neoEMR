<?php

namespace App\Http\Controllers\Attributes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Config;

class FhairHl7ResourceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:attribute|admin'])->except(['autocomplete']);

        $this->title        = "FHAIR HL7 : ";
        $this->conf_cs      = Config::get_fhair_cs();
  
        $this->view_index   = 'attributes.jenis.fhair_hl7.index';

        

        $this->to_return    = [
            'title'     => $this->title,
            'bg'        => Config::get()['navbar_variants'],
        ];
    }

    public function index(){
        return view($this->view_index, $this->to_return);
    }

    public function CodeSystem_name_use(){
        $name       = 'name-use';
        $data       = $this->conf_cs[$name];
        $jsonString = file_get_contents(base_path('resources/json/fhir/' . $data['file']));
        $json       = json_decode($jsonString, true);

        $url_name_use    = 'attributes.fhair_hl7.CodeSystem_name_use';
        

        $this->to_return['title']          .= 'CodeSystem - name use';
        $this->to_return['data']            = $data;
        $this->to_return['json']            = $json;
        $this->to_return['url_name_use']    = $url_name_use;


        return view($this->view_index, $this->to_return);
    }

    public function CodeSystem_name_use_store(Request $request){
        $name       = 'name-use';
        Config::put_fhair_cs_url($name, $request->url);
        return redirect()->back()->with('success', $this->title .' URL Berhasil DiUpdate!!');
    }
}
