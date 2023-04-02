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
use App\Models\attJenisPendidikan;
use App\Models\attJenisPekerjaan;
use App\Models\attJenisAgama;
use App\Models\attAlamatCountry;

use Illuminate\Support\Str;
class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:administration|admin'])->except(['index','show']);

        $this->title     = "Patients";

        $this->mode_form = Config::get_setting_form()['form_new_pasien']['mode'];
        $this->default   = Config::get_setting_default();

        $this->to_return = [
            'title'     => $this->title,
            'bg'        => Config::get()['navbar_variants'],
            'mode_form' => $this->mode_form,
            'default'   => $this->default
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
        $this->to_return['pendidikan']      = attJenisPendidikan::get();
        $this->to_return['pekerjaan']       = attJenisPekerjaan::get();
        $this->to_return['agama']           = attJenisAgama::get();
        $this->to_return['country']         = attAlamatCountry::get();

        $this->to_return['default']         = Config::get_setting_default();
        //return Config::get_fhair_cs_name_code('identifier-type','AC');
        if($this->mode_form == 'advance'){
            $this->to_return['name_use']        = Config::get_fhair_cs_name('name-use');
            $this->to_return['identifier_use']  = Config::get_fhair_cs_name('identifier-use');
            $this->to_return['identifier_type']  = Config::get_fhair_cs_name('identifier-type');
        }

        return view('administration.patient.create', $this->to_return);
    }

    public function store(Request $request ){
        //----------------------------------------------------------------
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

            'address_alamat'        => "required",
            'postalCode'            => "nullable",
            'address_provinsi_id'   => "nullable",
            'address_kota_id'       => "nullable",
            'address_kecamatan_id'  => "nullable",
            'address_kelurahan_id'  => "nullable",

            'note'  => "nullable",
            'photo' => 'nullable|mimes:jpeg,png,jpg|max:4000',
        ];

        if ($this->mode_form == 'medium' || $this->mode_form == 'advance'){
            $to_val['nama_ibu']             = "nullable"; 
            $to_val['blood']                = "nullable"; 
            $to_val['pendidikan_id']        = "nullable"; 
            $to_val['pekerjaan_id']         = "nullable"; 
            $to_val['agama_id']             = "nullable"; 
            $to_val['kewarganegaraan_id']   = "nullable"; 
            $to_val['suku']                 = "nullable"; 
            $to_val['bahasa']               = "nullable"; 
        }


        $request->validate($to_val);
        //----------------------------------------------------------------


        //----------------------------------------------------------------
        $photo_name = $request->photo;
        if ($request->hasFile('photo')) {
            $destinationPath = public_path('/images/dp_patient');
            
            $image = $request->file('photo');
            $name = time().'.'.$image->getClientOriginalExtension();
            $image->move($destinationPath, $name);
            $photo_name = $name;
        }
        //----------------------------------------------------------------

        //----------------------------------------------------------------
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

            'address_alamat'        => $request->address_alamat ,
            'postalCode'            => $request->postalCode ,
            'address_provinsi_id'   => $request->address_provinsi_id,
            'address_kota_id'       => $request->address_kota_id,
            'address_kecamatan_id'  => $request->address_kecamatan_id,
            'address_kelurahan_id'  => $request->address_kelurahan_id,

            'note'              => $request->note ,
            'photo'             => $photo_name,
            

            'active'    => true,
            'author_id' => Auth::user()->id
        ];

        if ($this->mode_form == 'medium' || $this->mode_form == 'advance'){
            $to_store['nama_ibu']             = $request->nama_ibu; 
            $to_store['blood']                = $request->blood; 
            $to_store['pendidikan_id']        = $request->pendidikan_id; 
            $to_store['pekerjaan_id']         = $request->pekerjaan_id; 
            $to_store['agama_id']             = $request->agama_id; 
            $to_store['kewarganegaraan_id']   = $request->kewarganegaraan_id; 
            $to_store['suku']                 = $request->suku; 
            $to_store['bahasa']               = $request->bahasa; 
        }
        //----------------------------------------------------------------
       
        $pasien = Patient::create($to_store);
        if($pasien){
            return redirect()->route('patient.show', $pasien->no_rm)->with('success', 'Data Berhasil Di Upload!!');
        }
        return redirect()->route('patient.create')->with('error', 'Data Gagal Di Upload!!');
    }

}
