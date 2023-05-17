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
use Carbon\Carbon;

class AdministrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:administration|admin']);

        $this->title = "Administration";
        $this->conf  = Config::get();
        $this->to_return = [
            'title'     => $this->title,
            'bg'        => $this->conf['navbar_variants'],
        ];
    }


    public function index(){
        return view('administration.index', $this->to_return);
    }

    public function pendaftaran($id){
        $itm = Patient::find($id);
        if($itm){
            if($itm->active){
                $now =  Carbon::now();

                $att = new ATT();
                $this->to_return['data']            = $itm;
                $this->to_return['title']           = $itm->no_rm .' : '. $itm->full_name; 
                $this->to_return['tgl_sekarang']    = $now->format('Y-m-d');
                $this->to_return['tgl_maksimal']    = $now->addDays($this->conf['setting']['default']['def_administration']['max_day_pendaftaran'])->format('Y-m-d');
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

        //jika sudah terdaftar pada tgl dan poli yang sama tidak bisa
        $cek = AdministrationKunjungan::where('tgl_pemeriksaan', $request->tgl_pemeriksaan)->where('patient_id',  $request->patient_id)->first();
        if($cek){
            $pasien = $cek->patient;
            return redirect()->back()->with('warning', 'Pasien '.$pasien->full_name.' Sudah Terdaftar dengan nomor antrian ' . $cek->antrian_urut . ' pada ' . $cek->tgl_pemeriksaan );
        }else{
            $now                = Carbon::now();
            $tgl_pemeriksaan    = Carbon::parse($request->tgl_pemeriksaan)->format('Y-m-d');

            //cek get nomor antrian
            $antrian = 1;
            $kunjungan_last = AdministrationKunjungan::where('tgl_pemeriksaan', $request->tgl_pemeriksaan)->orderBy('id', 'DESC')->first();
          
            if($kunjungan_last){
                $antrian = intval($kunjungan_last->antrian_urut) + 1;
            }

            $to_store = [
                'antrian_urut'      => $antrian,
                'patient_id'        => $request->patient_id,
                'type_kunjungan'    => $request->type_kunjungan,
                'type_layanan'      => $request->type_layanan, 
                'tgl_pemeriksaan'   => $request->tgl_pemeriksaan,
                'payment_id'        => $request->payment_id, 
                'tgl_mendaftar'     => $now->format('Y-m-d h:i:s'),
                'author_id'         => Auth::user()->id,
                'is_cekin'          => 0,
            ];

            //check in
            if($now->format('Y-m-d') == $tgl_pemeriksaan ){
                $to_store['is_cekin'] = 1;
                $to_store['cekin_at'] = $now->format('Y-m-d h:i:s');
            }

            $a = AdministrationKunjungan::create($to_store);
            return $a;
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
