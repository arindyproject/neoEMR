<?php

namespace App\Http\Controllers\Attributes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
        $this->view_setting = 'attributes.jenis.fhair_hl7.setting';
        $this->urls_        = 'attributes.fhair_hl7.CodeSystem';
        $this->to_return    = [
            'title'     => $this->title,
            'bg'        => Config::get()['navbar_variants'],
            'urls_'     => $this->urls_,
        ];
    }

    //==========================================================================================
    public function get_cs($name){
        $data       = $this->conf_cs[$name];
        $jsonString = @file_get_contents(base_path('resources/json/fhir/' . $data['file']));
        if($jsonString  === FALSE){
            File::put(base_path('resources/json/fhir/' . $data['file']) , '');
        }
        $json       = json_decode($jsonString, true);

        
        
        $this->to_return['title']          .= 'CodeSystem : '. $name;
        $this->to_return['data']            = $data;
        $this->to_return['json']            = $json;
        
        $this->to_return['name']            = $name;
        return view($this->view_index, $this->to_return);
    }

    public function put_cs($name,$request){
        $data       = $this->conf_cs[$name];
        $response = @file_get_contents($request->url);
        if($response  === FALSE){
            return redirect()->back()->with('error', $this->title .' JSON file gagal di Download');
        }else{
            Config::put_fhair_cs_url($name, $request->url);
            $newsData = json_decode($response);
            $json     = response()->json($newsData)->getData();
            $newJsonString = json_encode($json, JSON_PRETTY_PRINT);
            file_put_contents(base_path('resources/json/fhir/' . $data['file']), $newJsonString);
            return redirect()->back()->with('success', $this->title .' URL Berhasil DiUpdate!!');
        }
    }
    //==========================================================================================


    //==========================================================================================
    public function CodeSystem($name){
        return self::get_cs($name);
    }

    public function CodeSystemStore($name, Request $request){
        return self::put_cs($name,$request);
    }
    //==========================================================================================


    //==========================================================================================
    public function setting(){
        $this->to_return['title']      .= ' SETTING';
        $this->to_return['list']        = $this->conf_cs;
        $this->to_return['url_setting'] = 'attributes.fhair_hl7.setting';
        return view($this->view_setting, $this->to_return);
    }

    public function setting_store(Request $request){
        $jsonString = file_get_contents(base_path('resources/json/config.json'));
        $data = json_decode($jsonString, true);
        $data['fhair_hl7']['CodeSystem'][$request->name] = [
            'url' => $request->url,
            'file'=> $request->file
        ];
        $newJsonString = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents(base_path('resources/json/config.json'), stripslashes($newJsonString));
        return redirect()->back()->with('success', $this->title .' Berhasil DiTambahkan!!');
    }
    //==========================================================================================


}
