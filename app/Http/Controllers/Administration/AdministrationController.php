<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;

use App\Models\Administration\Patient;
use App\Models\Administration\ATT;
use App\Models\Administration\AdministrationPayment;

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
                $att = new ATT();
                $this->to_return['data']            = $itm;
                $this->to_return['title']           = $itm->no_rm .' : '. $itm->full_name; 
                $this->to_return['tgl_sekarang']    = date('Y-m-d');
                $this->to_return['type_kunjungan']  = $att->TYPE_KUNJUNGAN;

                $payment = AdministrationPayment::where(function($q) use($itm){
                    if(strlen($itm->no_bpjs) != 13){
                        $q->where('type', '!=', 'BPJS');
                    }
                })
                ->get();

                $this->to_return['payment']  = $payment;



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
            return view('administration.patient.history', $this->to_return);
        }else{
            return redirect()->route('patient.index')->with('error', 'Data NOT FOUND!!');
        }
    }
}
