<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;

use App\Models\Administration\Patient;
use App\Models\Administration\ATT;
use App\Models\Administration\AdministrationPayment;
use App\Models\Administration\AdministrationKunjungan;
use Illuminate\Support\Facades\Auth;

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

                    if(!$itm->is_pasien_gratis){
                        $q->where('type', '!=', 'GRATIS');
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

    public function pendaftaran_store(Request $request){
        $request->validate([
            'patient_id'        => 'required',
            'type_kunjungan'    => 'required',
            'type_layanan'      => 'required', 
            'tgl_pemeriksaan'   => 'required|date',
            'payment_id'        => 'required', 
        ]);

        $request['tgl_mendaftar']   = date('Y-m-d H:i:s');
        $request['author_id']       = Auth::user()->id;

        $a=AdministrationKunjungan::create([
            
        ]);
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
