<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Config;

use App\Models\Administration\Patient;

use App\Models\attJenisKartuIdentitas;
use App\Models\attJenisKelamin;
use App\Models\attJenisPernikahan;

use Illuminate\Support\Str;
class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:administration|admin'])->except(['index','show']);

        $this->title = "Patients";
        $this->to_return = [
            'title'     => $this->title,
            'bg'        => Config::get()['navbar_variants'],
        ];
    }


    public function index(){
        $qr = request('q');
      
        if(Patient::where('no_rm', $qr)->first()){
            return redirect()->route('patient.show', $qr);
        }else{
            $this->to_return['data'] = Patient::where(function($q) use($qr) {
                $q->where('full_name', 'LIKE', '%'.$qr.'%');
            } )
            ->paginate(30);
            return view('administration.patient.index', $this->to_return);
        }
    }


    public function show($rm){
        $itm = Patient::where('no_rm', $rm)->first();
        if($itm){
            $this->to_return['data']         = $itm;
            $this->to_return['title']   = $itm->no_rm .' : '. $itm->full_name; 
            return view('administration.patient.show', $this->to_return);
        }else{
            return redirect()->route('patient.index')->with('error', 'Data NOT FOUND!!');
        }
    }

    public function create(){
        $this->to_return['title']   = "Add New Patient"; 
        $this->to_return['identity_type']   = attJenisKartuIdentitas::get();
        $this->to_return['gender']          = attJenisKelamin::get();
        $this->to_return['status_nikah']    = attJenisPernikahan::get();
        return view('administration.patient.create', $this->to_return);
    }

    public function store(Request $request ){
        $to_val = [
            'full_name'         => "required|string|max:255",
            'place_of_birth'    => "nullable|string|max:255",
            'birthDate'         => "nullable|date",
            'identity_type_id'  => "nullable",
            'identity_number'   => "nullable|unique:patients",
            'gender_id'         => "required",
            'maritalStatus_id'  => "nullable",
            'no_tlp'            => "nullable",
            'no_bpjs'           => "nullable|unique:patients",
            'address_alamat'    => "required",
            'postalCode'        => "nullable",

        ];
        $request->validate($to_val);

        $to_store = [
            'no_rm'             => Str::uuid()->toString(),
            'full_name'         => $request->full_name,
            'place_of_birth'    => $request->place_of_birth ,
            'birthDate'         => $request->birthDate ,
            'identity_type_id'  => $request->identity_type_id ,
            'identity_number'   => $request->identity_number ,
            'gender_id'         => $request->gender_id ,
            'maritalStatus_id'  => $request->maritalStatus_id ,
            'no_tlp'            => $request->no_tlp ,
            'no_bpjs'           => $request->no_bpjs ,
            'address_alamat'    => $request->address_alamat ,
            'postalCode'        => $request->postalCode ,


            'author_id' => Auth::user()->id
        ];
       
        $pasien = Patient::create($to_store);
        if($pasien){
            return redirect()->route('patient.show', $pasien->no_rm)->with('success', 'Data Berhasil Di Upload!!');
        }
        return redirect()->route('patient.create')->with('error', 'Data Gagal Di Upload!!');
    }

}
