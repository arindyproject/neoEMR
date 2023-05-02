<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;

use App\Models\Administration\Patient;

class AdministrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:administration|admin']);

        $this->title = "Administration";
        $this->to_return = [
            'title'     => $this->title,
            'bg'        => Config::get()['navbar_variants'],
        ];
    }


    public function index(){
        return view('administration.index', $this->to_return);
    }

    public function pendaftaran($id){
        $itm = Patient::find($id);
        if($itm){
            if($itm->active){
                $this->to_return['data']         = $itm;
                $this->to_return['title']        = $itm->no_rm .' : '. $itm->full_name; 
                return view('administration.pendaftaran', $this->to_return);
            }else{
                return redirect()->route('patient.index')->with('error', 'Pasien ' . $itm->full_name . ' Non Active Tidak Dapat DiDaftarkan!!');
            }
            
        }else{
            return redirect()->route('patient.index')->with('error', 'Data NOT FOUND!!');
        }
    }

    public function history($id){
        $itm = Patient::find($id);
        if($itm){
            $this->to_return['data']         = $itm;
            $this->to_return['title']        = $itm->no_rm .' : '. $itm->full_name; 
            return view('administration.pendaftaran', $this->to_return);
        }else{
            return redirect()->route('patient.index')->with('error', 'Data NOT FOUND!!');
        }
    }
}
