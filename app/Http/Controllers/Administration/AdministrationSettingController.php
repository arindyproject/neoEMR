<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 

use App\Models\Config;

class AdministrationSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:admin']);

        $this->title = "Administration Setting";
        $this->to_return = [
            'title'     => $this->title,
            'bg'        => Config::get()['navbar_variants'],
        ];
    }

    public function index(){
        $this->to_return['data'] = Config::get()['setting']['form'];
        return view('administration.setting.index', $this->to_return);
    }

    //                                      PRINT
    //===================================================================================
    function save_json_print($tmp, $template){
        $jsonString = file_get_contents(base_path('resources/json/config.json'));
        $data =  json_decode($jsonString, true);
        $data['setting']['template']['pasien'][$tmp]  = $template;
        $newJsonString = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents(base_path('resources/json/config.json'), stripslashes($newJsonString));
        return redirect()->back()->with('success', 'Berhasil, template ' .$tmp. ' DiUpdate!!!');
    }

    function set_json_print($tmp){
        $this->to_return['data'] = Config::get()['setting']['template']['pasien'][$tmp];
        $this->to_return['list'] = File::allFiles(resource_path('views/administration/setting/print/template/'. $tmp));
        return view('administration.setting.print.print_pasien_'. $tmp, $this->to_return);
    }

    public function print_pasien_profil(){
        return $this->set_json_print('profil'); 
    }
    public function print_pasien_profil_store(Request $request){
        return $this->save_json_print('profil', $request->template);
    }
    //===================================================================================
    public function print_pasien_card(){
        return $this->set_json_print('card'); 
    }
    public function print_pasien_card_store(Request $request){
        return $this->save_json_print('card', $request->template);
    }
    //===================================================================================
    public function print_pasien_label(){
        return $this->set_json_print('label'); 
    }

    public function print_pasien_label_store(Request $request){
        return $this->save_json_print('label', $request->template);
    }
    //===================================================================================



    //                       Payment
    //===================================================================================
    public function payment(){
        return view('administration.setting.payment.index', $this->to_return);
    }
    //===================================================================================
}
