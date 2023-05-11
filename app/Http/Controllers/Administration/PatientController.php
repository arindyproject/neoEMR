<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File; 

use App\Models\Config;

use App\Models\Administration\Patient;

use App\Models\Attributes\attJenisKartuIdentitas;
use App\Models\Attributes\attJenisKelamin;
use App\Models\Attributes\attJenisPernikahan;
use App\Models\Attributes\attJenisPendidikan;
use App\Models\Attributes\attJenisPekerjaan;
use App\Models\Attributes\attJenisAgama;
use App\Models\Attributes\attJenisBpjs;
use App\Models\Attributes\attAlamatCountry;

use App\Models\Attributes\attAlamatProvinsi;
use App\Models\Attributes\attAlamatKota;
use App\Models\Attributes\attAlamatKecamatan;
use App\Models\Attributes\attAlamatKelurahan;


use DataTables;

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

    public function index2(){
        $qr = request('q');
        if(Patient::where('no_rm', $qr)->first()){
            return redirect()->route('patient.show', $qr);
        }else{
            $this->to_return['title']           = "Patients V2";

            $this->to_return['identity_type']   = attJenisKartuIdentitas::get();
            $this->to_return['gender']          = attJenisKelamin::get();
            $this->to_return['status_nikah']    = attJenisPernikahan::get();
            $this->to_return['pendidikan']      = attJenisPendidikan::get();
            $this->to_return['pekerjaan']       = attJenisPekerjaan::get();
            $this->to_return['agama']           = attJenisAgama::get();
            $this->to_return['country']         = attAlamatCountry::get();

            return view('administration.patient.index2', $this->to_return);
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
        $this->to_return['jenis_bpjs']      = attJenisBpjs::get();
        $this->to_return['country']         = attAlamatCountry::get();

        $this->to_return['default']         = Config::get_setting_default();
        //return Config::get_fhair_cs_name('patient-contact-relationship');
        if($this->mode_form == 'advance'){
            $this->to_return['name_use']            = Config::get_fhair_cs_name('name-use');
            $this->to_return['identifier_use']      = Config::get_fhair_cs_name('identifier-use');
            $this->to_return['identifier_type']     = Config::get_fhair_cs_name('identifier-type');
            $this->to_return['administrative_gender']     = Config::get_fhair_cs_name('administrative-gender');
            
            $this->to_return['address_use']         = Config::get_fhair_cs_name('address-use');
            $this->to_return['address_type']        = Config::get_fhair_cs_name('address-type');

            $this->to_return['telecom_use']         = Config::get_fhair_cs_name('contact-point-use');
            $this->to_return['telecom_system']      = Config::get_fhair_cs_name('contact-point-system');

            $this->to_return['valueset_languages']  = Config::get_fhair_vs_name('valueset-languages');

            $this->to_return['contact_relationship']= Config::get_fhair_cs_name('patient-contact-relationship');
        }

        return view('administration.patient.create', $this->to_return);
    }

    public function edit($id){
        $data = Patient::find($id);
        $this->to_return['data']            = $data;
        $this->to_return['title']           = "Edit : " . $data->full_name . " : " . $data->no_rm; 
        $this->to_return['identity_type']   = attJenisKartuIdentitas::get();
        $this->to_return['gender']          = attJenisKelamin::get();
        $this->to_return['status_nikah']    = attJenisPernikahan::get();
        $this->to_return['pendidikan']      = attJenisPendidikan::get();
        $this->to_return['pekerjaan']       = attJenisPekerjaan::get();
        $this->to_return['jenis_bpjs']      = attJenisBpjs::get();
        $this->to_return['agama']           = attJenisAgama::get();
        $this->to_return['country']         = attAlamatCountry::get();

        $this->to_return['provinsi']        = attAlamatProvinsi::find($data->address_provinsi_id);
        $this->to_return['kota']            = attAlamatKota::find($data->address_kota_id);
        $this->to_return['kecamatan']       = attAlamatKecamatan::find($data->address_kecamatan_id);
        $this->to_return['kelurahan']       = attAlamatKelurahan::find($data->address_kelurahan_id);

        $this->to_return['default']         = Config::get_setting_default();
        //return Config::get_fhair_cs_name('patient-contact-relationship');
        return view('administration.patient.edit', $this->to_return);
    }

    public function edit_advance($type, $id){
        $data = Patient::find($id);
        $this->to_return['data']            = $data;
        $this->to_return['title']           = "Edit Advance (".$type.") : " . $data->full_name . " : " . $data->no_rm; 
        $this->to_return['type']            = $type;
        switch ($type) {
            case 'name':
                $this->to_return['name_use']    = Config::get_fhair_cs_name('name-use');
                break;
            case 'identifier':
                $this->to_return['identifier_use']      = Config::get_fhair_cs_name('identifier-use');
                $this->to_return['identifier_type']     = Config::get_fhair_cs_name('identifier-type');
                break;
            case 'communication':
                $this->to_return['valueset_languages']  = Config::get_fhair_vs_name('valueset-languages');
                break;
            case 'address':
                $this->to_return['address_use']         = Config::get_fhair_cs_name('address-use');
                $this->to_return['address_type']        = Config::get_fhair_cs_name('address-type');
                break;
            case 'telecom':
                $this->to_return['telecom_use']         = Config::get_fhair_cs_name('contact-point-use');
                $this->to_return['telecom_system']      = Config::get_fhair_cs_name('contact-point-system');
                break;
            case 'contact':
                $this->to_return['name_use']            = Config::get_fhair_cs_name('name-use');
                $this->to_return['identifier_use']      = Config::get_fhair_cs_name('identifier-use');
                $this->to_return['identifier_type']     = Config::get_fhair_cs_name('identifier-type');
                $this->to_return['administrative_gender']     = Config::get_fhair_cs_name('administrative-gender');
                $this->to_return['address_use']         = Config::get_fhair_cs_name('address-use');
                $this->to_return['address_type']        = Config::get_fhair_cs_name('address-type');
                $this->to_return['telecom_use']         = Config::get_fhair_cs_name('contact-point-use');
                $this->to_return['telecom_system']      = Config::get_fhair_cs_name('contact-point-system');
                $this->to_return['valueset_languages']  = Config::get_fhair_vs_name('valueset-languages');
                $this->to_return['contact_relationship']= Config::get_fhair_cs_name('patient-contact-relationship');
                break;
            default:
                return redirect()->route('patient.show', $data->no_rm)->with('error', '404!!');
        }

        return view('administration.patient.edit_advance.' .$type , $this->to_return);
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

            'title'             => "nullable",
            'kelas_bpjs'        => "nullable",
            'jenis_bpjs_id'     => "nullable",
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
            'full_name'         => $request->full_name,
            'place_of_birth'    => $request->place_of_birth ,
            'birthDate'         => $request->birthDate ,
            'identity_type_id'  => $request->identity_type_id ,
            'identity_number'   => $request->identity_number ,
            'gender_id'         => $request->gender_id ,
            'maritalStatus_id'  => $request->maritalStatus_id ,
            'no_tlp'            => $request->no_tlp ,

            'title'             => $request->title,
            'kelas_bpjs'        => $request->kelas_bpjs,
            'jenis_bpjs_id'     => $request->jenis_bpjs_id,
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

        //--------------------------advance--------------------------------------
        if($this->mode_form == 'advance'){
            //name---------------------------------------------------------------
            $v_name = [];
            if($request->name_use){
                foreach($request->name_use as $i=>$itm){
                    $tmp_name = [];
                    $itm != '' ? $tmp_name['use'] = $itm : null;

                    $request->name_text[$i]     != '' ? $tmp_name['text']   = $request->name_text[$i] : null;
                    $request->name_family[$i]   != '' ? $tmp_name['family'] = $request->name_family[$i] : null;
                    $request->name_given[$i]    != '' ? $tmp_name['given']  = $request->name_given[$i] : null;
                    $request->name_prefix[$i]   != '' ? $tmp_name['prefix'] = $request->name_prefix[$i] : null;
                    $request->name_suffix[$i]   != '' ? $tmp_name['suffix'] = $request->name_suffix[$i] : null;
                    $request->name_peroide_start[$i] != '' ? $tmp_name['period']['start'] = $request->name_peroide_start[$i] : null;
                    $request->name_peroide_end[$i]   != '' ? $tmp_name['period']['end']   = $request->name_peroide_end[$i] : null;

                    array_push($v_name, $tmp_name);
                }
                $to_store['name'] = $v_name; 
            }
            //name---------------------------------------------------------------


            //identifier---------------------------------------------------------
            $v_identifier = [];
            if($request->identifier_use ){
                foreach($request->identifier_use as $i=>$itm){
                    $tmp_identifier = [];
                    $itm != '' ? $tmp_identifier['use'] = $itm : null;

                    $request->identifier_type[$i]   != '' ? $tmp_identifier['type']   = Config::get_fhair_cs_name_code('identifier-type', $request->identifier_type[$i]) : null;
                    $request->identifier_system[$i] != '' ? $tmp_identifier['system'] = $request->identifier_system[$i] : '';
                    $request->identifier_value[$i]  != '' ? $tmp_identifier['value']  = $request->identifier_value[$i]  : '';
                    $request->identifier_peroide_start[$i] != '' ? $tmp_identifier['period']['start'] = $request->identifier_peroide_start[$i] : null;
                    $request->identifier_peroide_end[$i]   != '' ? $tmp_identifier['period']['end']   = $request->identifier_peroide_end[$i] : null;

                    array_push($v_identifier, $tmp_identifier);
                }
                $to_store['identifier'] = $v_identifier; 
            }
            //identifier---------------------------------------------------------



            //communication---------------------------------------------------------
            $v_communication = [];
            if($request->language ){
                foreach($request->language as $i=>$itm){
                    $tmp_communication = [];

                    $itm != '' ? $tmp_communication['language'] = Config::get_fhair_vs_name_code('valueset-languages', $itm) : null;

                    array_push($v_communication, $tmp_communication);
                }
                $to_store['communication'] = $v_communication; 
            }
            //communication---------------------------------------------------------



            //address---------------------------------------------------------
            $v_address = [];
            if($request->address_use ){
                foreach($request->address_use as $i=>$itm){
                    $tmp_address = [];

                    $itm != '' ? $tmp_address['use'] = $itm : null;
                    $request->address_type[$i]      != '' ? $tmp_address['type']   = $request->address_type[$i] : null;
                    $request->address_text[$i]      != '' ? $tmp_address['text']   = $request->address_text[$i] : null;
                    $request->address_line[$i]      != '' ? $tmp_address['line']   = $request->address_line[$i] : null;
                    $request->address_city[$i]      != '' ? $tmp_address['city']   = $request->address_city[$i] : null;
                    $request->address_district[$i]  != '' ? $tmp_address['district']   = $request->address_district[$i] : null;
                    $request->address_state[$i]     != '' ? $tmp_address['state']   = $request->address_state[$i] : null;
                    $request->address_postalCode[$i]!= '' ? $tmp_address['postalCode']   = $request->address_postalCode[$i] : null;
                    $request->address_country[$i]   != '' ? $tmp_address['country']   = $request->address_country[$i] : null;
                    $request->address_peroide_start[$i] != '' ? $tmp_address['period']['start'] = $request->address_peroide_start[$i] : null;
                    $request->address_peroide_end[$i]   != '' ? $tmp_address['period']['end']   = $request->address_peroide_end[$i] : null;

                    array_push($v_address, $tmp_address);
                }
                $to_store['address'] = $v_address; 
            }
            //address---------------------------------------------------------



            //telecom---------------------------------------------------------
            $v_telecom = [];
            if($request->telecom_use ){
                foreach($request->telecom_use as $i=>$itm){
                    $tmp_telecom = [];

                    $itm != '' ? $tmp_telecom['use'] = $itm : null;
                    $request->telecom_system[$i]    != '' ? $tmp_telecom['system']   = $request->telecom_system[$i] : null;
                    $request->telecom_value[$i]     != '' ? $tmp_telecom['value']    = $request->telecom_value[$i] : null;
                    $request->telecom_rank[$i]      != '' ? $tmp_telecom['rank']     = $request->telecom_rank[$i] : null;
                    $request->telecom_peroide_start[$i] != '' ? $tmp_telecom['period']['start'] = $request->telecom_peroide_start[$i] : null;
                    $request->telecom_peroide_end[$i]   != '' ? $tmp_telecom['period']['end']   = $request->telecom_peroide_end[$i] : null;

                    array_push($v_telecom, $tmp_telecom);
                }
                $to_store['telecom'] = $v_telecom; 
            }
            //telecom---------------------------------------------------------



            //contact---------------------------------------------------------
            $v_contact = [];
            if($request->contact_relationship ){
                foreach($request->contact_relationship as $i=>$itm){
                    $tmp_contact = [];
                    $itm != '' ? $tmp_contact['relationship'] = Config::get_fhair_cs_name_code('patient-contact-relationship', $itm) : null;

                    $request->contact_name_use[$i]    != '' ? $tmp_contact['name']['use']   = $request->contact_name_use[$i] : null;
                    $request->contact_name_text[$i]   != '' ? $tmp_contact['name']['text']   = $request->contact_name_text[$i] : null;

                    $request->contact_gender[$i]      != '' ? $tmp_contact['gender']   = $request->contact_gender[$i] : null;

                    $request->contact_organization[$i]!= '' ? $tmp_contact['organization']   = $request->contact_organization[$i] : null;

                    $request->contact_telecom_use[$i]       != '' ? $tmp_contact['telecom']['use']   = $request->contact_telecom_use[$i] : null;
                    $request->contact_telecom_system[$i]    != '' ? $tmp_contact['telecom']['system']= $request->contact_telecom_system[$i] : null;
                    $request->contact_telecom_value[$i]     != '' ? $tmp_contact['telecom']['value'] = $request->contact_telecom_value[$i] : null;

                    $request->contact_address_use[$i]       != '' ? $tmp_contact['address']['use']   = $request->contact_address_use[$i] : null;
                    $request->contact_address_type[$i]      != '' ? $tmp_contact['address']['type']  = $request->contact_address_type[$i] : null;
                    $request->contact_address_text[$i]      != '' ? $tmp_contact['address']['text']  = $request->contact_address_text[$i] : null;
                    $request->contact_address_line[$i]      != '' ? $tmp_contact['address']['line']  = $request->contact_address_line[$i] : null;
                    $request->contact_address_city[$i]      != '' ? $tmp_contact['address']['city']  = $request->contact_address_city[$i] : null;
                    $request->contact_address_district[$i]  != '' ? $tmp_contact['address']['district']  = $request->contact_address_district[$i] : null;
                    $request->contact_address_state[$i]     != '' ? $tmp_contact['address']['state'] = $request->contact_address_state[$i] : null;
                    $request->contact_address_postalCode[$i]!= '' ? $tmp_contact['address']['postalCode']= $request->contact_address_postalCode[$i] : null;
                    $request->contact_address_country[$i]!= '' ? $tmp_contact['address']['country']= $request->contact_address_country[$i] : null;

                    $request->contact_peroide_start[$i] != '' ? $tmp_contact['period']['start'] = $request->contact_peroide_start[$i] : null;
                    $request->contact_peroide_end[$i]   != '' ? $tmp_contact['period']['end']   = $request->contact_peroide_end[$i] : null;


                    array_push($v_contact, $tmp_contact);
                }
                $to_store['contact'] = $v_contact; 
            }
            //contact---------------------------------------------------------
        }
        //--------------------------advance--------------------------------------
       
        $pasien = Patient::create($to_store);
        if($pasien){
            return redirect()->route('patient.show', $pasien->no_rm)->with('success', 'Data Berhasil Di Upload!!');
        }
        return redirect()->route('patient.create')->with('error', 'Data Gagal Di Upload!!');
    }

    public function update(Request $request, $id ){
        $pasien = Patient::find($id);
        //----------------------------------------------------------------
        $to_val = [
            'full_name'         => "required|string|max:255",
            'place_of_birth'    => "nullable|string|max:255",
            'birthDate'         => "nullable|date",
            'identity_type_id'  => "nullable",
            'identity_number'   => "nullable|unique:patients,identity_number,".$id.",id",
            'gender_id'         => "required",
            'maritalStatus_id'  => "nullable",
            'no_tlp'            => "nullable",

            'title'             => "nullable",
            'kelas_bpjs'        => "nullable",
            'jenis_bpjs_id'     => "nullable",
            'no_bpjs'           => "nullable|unique:patients,no_bpjs,".$id.",id",

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
         $to_store = [
          
            'full_name'         => $request->full_name,
            'place_of_birth'    => $request->place_of_birth ,
            'birthDate'         => $request->birthDate ,
            'identity_type_id'  => $request->identity_type_id ,
            'identity_number'   => $request->identity_number ,
            'gender_id'         => $request->gender_id ,
            'maritalStatus_id'  => $request->maritalStatus_id ,
            'no_tlp'            => $request->no_tlp ,

            'title'             => $request->title,
            'kelas_bpjs'        => $request->kelas_bpjs,
            'jenis_bpjs_id'     => $request->jenis_bpjs_id,
            'no_bpjs'           => $request->no_bpjs ,

            'address_alamat'        => $request->address_alamat ,
            'postalCode'            => $request->postalCode ,
            'address_provinsi_id'   => $request->address_provinsi_id,
            'address_kota_id'       => $request->address_kota_id,
            'address_kecamatan_id'  => $request->address_kecamatan_id,
            'address_kelurahan_id'  => $request->address_kelurahan_id,

            'note'              => $request->note ,
            
            'edithor_id'        => Auth::user()->id
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


        //----------------------------------------------------------------
        if ($request->hasFile('photo')) {
            $destinationPath = public_path('/images/dp_patient');

            if($pasien->photo != ''){
                File::delete($destinationPath.'/'.$pasien->photo);
            }
            $image = $request->file('photo');
            $name = time().'.'.$image->getClientOriginalExtension();
            $image->move($destinationPath, $name);
            $to_store['photo'] = $name;
        }
        //----------------------------------------------------------------


        if($pasien->update($to_store)){
            return redirect()->route('patient.show', $pasien->no_rm)->with('success', 'Data Berhasil Di Update!!');
        }
        return redirect()->route('patient.create')->with('error', 'Data Gagal Di Update!!');
    }

    public function update_advance(Request $request, $type, $id){
        $to_store = [];
        $pasien   = Patient::find($id);
        if($type == 'name'){
            //name---------------------------------------------------------------
            $out = [];
            if($request->use){
                foreach($request->use as $i=>$itm){
                    $tmp_name = [];
                    $itm != '' ? $tmp_name['use'] = $itm : null;
                    $request->text[$i]     != '' ? $tmp_name['text']   = $request->text[$i] : null;
                    $request->family[$i]   != '' ? $tmp_name['family'] = $request->family[$i] : null;
                    $request->given[$i]    != '' ? $tmp_name['given']  = $request->given[$i] : null;
                    $request->prefix[$i]   != '' ? $tmp_name['prefix'] = $request->prefix[$i] : null;
                    $request->suffix[$i]   != '' ? $tmp_name['suffix'] = $request->suffix[$i] : null;
                    $request->period_start[$i] != '' ? $tmp_name['period']['start'] = $request->period_start[$i] : null;
                    $request->period_end[$i]   != '' ? $tmp_name['period']['end']   = $request->period_end[$i] : null;

                    array_push($out, $tmp_name);
                }
                $to_store[$type] = $out; 
            }
            //name---------------------------------------------------------------
        }else if($type == 'identifier'){
            //identifier---------------------------------------------------------
            $v_identifier = [];
            if($request->use ){
                foreach($request->use as $i=>$itm){
                    $tmp_identifier = [];
                    $itm != '' ? $tmp_identifier['use'] = $itm : null;

                    $request->type[$i]   != '' ? $tmp_identifier['type']   = Config::get_fhair_cs_name_code('identifier-type', $request->type[$i]) : null;
                    $request->system[$i] != '' ? $tmp_identifier['system'] = $request->system[$i] : '';
                    $request->value[$i]  != '' ? $tmp_identifier['value']  = $request->value[$i]  : '';
                    $request->period_start[$i] != '' ? $tmp_identifier['period']['start'] = $request->period_start[$i] : null;
                    $request->period_end[$i]   != '' ? $tmp_identifier['period']['end']   = $request->period_end[$i] : null;

                    array_push($v_identifier, $tmp_identifier);
                }
                $to_store[$type] = $v_identifier; 
            }
            //identifier---------------------------------------------------------
        }else if($type == 'communication'){
            //communication---------------------------------------------------------
            $v_communication = [];
            if($request->language ){
                foreach($request->language as $i=>$itm){
                    $tmp_communication = [];

                    $itm != '' ? $tmp_communication['language'] = Config::get_fhair_vs_name_code('valueset-languages', $itm) : null;

                    array_push($v_communication, $tmp_communication);
                }
                $to_store[$type] = $v_communication; 
            }
            //communication---------------------------------------------------------
        }else if($type == 'telecom'){
            //telecom---------------------------------------------------------
            $v_telecom = [];
            if($request->use ){
                foreach($request->use as $i=>$itm){
                    $tmp_telecom = [];

                    $itm != '' ? $tmp_telecom['use'] = $itm : null;
                    $request->system[$i]    != '' ? $tmp_telecom['system']   = $request->system[$i] : null;
                    $request->value[$i]     != '' ? $tmp_telecom['value']    = $request->value[$i] : null;
                    $request->rank[$i]      != '' ? $tmp_telecom['rank']     = $request->rank[$i] : null;
                    $request->period_start[$i] != '' ? $tmp_telecom['period']['start'] = $request->period_start[$i] : null;
                    $request->period_end[$i]   != '' ? $tmp_telecom['period']['end']   = $request->period_end[$i] : null;

                    array_push($v_telecom, $tmp_telecom);
                }
                $to_store[$type] = $v_telecom; 
            }
            //telecom---------------------------------------------------------
        }else if($type == 'address'){
            //address---------------------------------------------------------
            $v_address = [];
            if($request->use ){
                foreach($request->use as $i=>$itm){
                    $tmp_address = [];

                    $itm != '' ? $tmp_address['use'] = $itm : null;
                    $request->type[$i]      != '' ? $tmp_address['type']   = $request->type[$i] : null;
                    $request->text[$i]      != '' ? $tmp_address['text']   = $request->text[$i] : null;
                    $request->line[$i]      != '' ? $tmp_address['line']   = $request->line[$i] : null;
                    $request->city[$i]      != '' ? $tmp_address['city']   = $request->city[$i] : null;
                    $request->district[$i]  != '' ? $tmp_address['district']   = $request->district[$i] : null;
                    $request->state[$i]     != '' ? $tmp_address['state']   = $request->state[$i] : null;
                    $request->postalCode[$i]!= '' ? $tmp_address['postalCode']   = $request->postalCode[$i] : null;
                    $request->country[$i]   != '' ? $tmp_address['country']   = $request->country[$i] : null;
                    $request->period_start[$i] != '' ? $tmp_address['period']['start'] = $request->period_start[$i] : null;
                    $request->period_end[$i]   != '' ? $tmp_address['period']['end']   = $request->period_end[$i] : null;

                    array_push($v_address, $tmp_address);
                }
                $to_store['address'] = $v_address; 
            }
            //address---------------------------------------------------------
        }else if($type == 'contact'){
            $v_contact = [];
            if($request->contact_relationship ){
                foreach($request->contact_relationship as $i=>$itm){
                    $tmp_contact = [];
                    $itm != '' ? $tmp_contact['relationship'] = Config::get_fhair_cs_name_code('patient-contact-relationship', $itm) : null;

                    $request->contact_name_use[$i]    != '' ? $tmp_contact['name']['use']   = $request->contact_name_use[$i] : null;
                    $request->contact_name_text[$i]   != '' ? $tmp_contact['name']['text']   = $request->contact_name_text[$i] : null;

                    $request->contact_gender[$i]      != '' ? $tmp_contact['gender']   = $request->contact_gender[$i] : null;

                    $request->contact_organization[$i]!= '' ? $tmp_contact['organization']   = $request->contact_organization[$i] : null;

                    $request->contact_telecom_use[$i]       != '' ? $tmp_contact['telecom']['use']   = $request->contact_telecom_use[$i] : null;
                    $request->contact_telecom_system[$i]    != '' ? $tmp_contact['telecom']['system']= $request->contact_telecom_system[$i] : null;
                    $request->contact_telecom_value[$i]     != '' ? $tmp_contact['telecom']['value'] = $request->contact_telecom_value[$i] : null;

                    $request->contact_address_use[$i]       != '' ? $tmp_contact['address']['use']   = $request->contact_address_use[$i] : null;
                    $request->contact_address_type[$i]      != '' ? $tmp_contact['address']['type']  = $request->contact_address_type[$i] : null;
                    $request->contact_address_text[$i]      != '' ? $tmp_contact['address']['text']  = $request->contact_address_text[$i] : null;
                    $request->contact_address_line[$i]      != '' ? $tmp_contact['address']['line']  = $request->contact_address_line[$i] : null;
                    $request->contact_address_city[$i]      != '' ? $tmp_contact['address']['city']  = $request->contact_address_city[$i] : null;
                    $request->contact_address_district[$i]  != '' ? $tmp_contact['address']['district']  = $request->contact_address_district[$i] : null;
                    $request->contact_address_state[$i]     != '' ? $tmp_contact['address']['state'] = $request->contact_address_state[$i] : null;
                    $request->contact_address_postalCode[$i]!= '' ? $tmp_contact['address']['postalCode']= $request->contact_address_postalCode[$i] : null;
                    $request->contact_address_country[$i]!= '' ? $tmp_contact['address']['country']= $request->contact_address_country[$i] : null;

                    $request->period_start[$i] != '' ? $tmp_contact['period']['start'] = $request->period_start[$i] : null;
                    $request->period_end[$i]   != '' ? $tmp_contact['period']['end']   = $request->period_end[$i] : null;


                    array_push($v_contact, $tmp_contact);
                }
                $to_store['contact'] = $v_contact; 
                
            }
            //contact---------------------------------------------------------
        }

        if($pasien->update($to_store)){
            //return redirect()->route('patient.show', $pasien->no_rm)->with('success', 'Data Berhasil Di Update!!');
            return redirect()->back()->with('success', 'Data Berhasil Di Update!!');
        }
        return redirect()->route('patient.create')->with('error', 'Data Gagal Di Update!!');
    }

    public function set_activator($id){
        $pasien   = Patient::find($id);
        $msg = '';
        if($pasien){
            if($pasien->active){
                $pasien->active = 0;
                $msg = 'Pasien ' . $pasien->full_name . ' berhasil NON AKTIFKAN!!';
            }else{
                $pasien->active = 1;
                $msg = 'Pasien ' . $pasien->full_name . ' berhasil DI AKTIFKAN!!';
            }
            $pasien->activated_by = Auth::user()->id;
            $pasien->save();
            return redirect()->back()->with('seccess', $msg);
        }
        return redirect()->back()->with('error', 'Data Todak Ditemukan!!');
    }

    public function fhir_json($id){
        $data = Patient::find($id);
        //-----------------------------------------------------------
        $identifier = [];
        if($data->identity_number != ''){
            array_push($identifier, [
                "use"   => "usual",
                "type"  => [
                    "text" => $data->identity_type_id != '' ? $data->identityType->nama  : ''
                ],
                "value" => $data->identity_number
            ]);
        }
        if($data->no_bpjs != ''){
            array_push($identifier, [
                "use"   => "usual",
                "type"  => [
                    "text" => "BPJS"
                ],
                "value" => $data->no_bpjs
            ]);
        }
        if($data->identifier){
            foreach($data->identifier as $i){
                if($i['use'] != ''){
                    array_push($identifier, $i);
                }
            }
        }
        //-----------------------------------------------------------
        $name = [
            [
                "use"   => "official",
                "text"  => $data->full_name,
            ]
        ];
        if($data->name){
            foreach($data->name as $i){
                if($i['use'] != ''){
                    array_push($name, $i);
                }
            }
        }
        //-----------------------------------------------------------
        $telecom = [];
        if($data->no_tlp != ''){
            array_push($telecom, [
                "system" => "phone",
                "value"  => $data->no_tlp,   
            ]);
        }
        if($data->telecom){
            foreach($data->telecom as $i){
                if($i['use'] != ''){
                    array_push($telecom, $i);
                }
            }
        }
        //-----------------------------------------------------------
        $text_address    = $data->address_alamat . ', ';
        $text_address   .= $data->address_kelurahan_id   != '' ? $data->kelurahan->nama : '' . ', ';
        $text_address   .= $data->address_kecamatan_id   != '' ? $data->kecamatan->nama : '' . ', ';
        $text_address   .= $data->address_kota_id        != '' ? $data->kota->nama : '' . ', ';
        $text_address   .= $data->address_provinsi_id    != '' ? $data->provinsi->nama : '' . ', ';
        $address = [
            [
                'use'       => 'home',
                'type'      => 'both',
                'text'      => $text_address,
                'line'      => [$data->address_alamat, $data->address_kelurahan_id   != '' ? $data->kelurahan->nama : ''],
                'district'  => $data->address_kecamatan_id   != '' ? $data->kecamatan->nama : '',
                'city'      => $data->address_kota_id != '' ? $data->kota->nama : '',
                'state'     => $data->address_provinsi_id    != '' ? $data->provinsi->nama : '',
                'postalCode'=> $data->postalCode
            ]
        ];
        if($data->address){
            foreach($data->address as $i){
                if($i['use'] != ''){
                    array_push($address, $i);
                }
            }
        }
        //-----------------------------------------------------------
        $communication = [];
        if($data->bahasa != ''){ 
            $communication = ['language' => ['text' => $data->bahasa]];
        }
        if($data->communication){
            foreach($data->communication as $i){
                if($i['language']['text'] != ''){
                    array_push($communication, $i);
                }
            }
        }
        //-----------------------------------------------------------
        $contact = [];
        if($data->contact){
            foreach($data->contact as $i){
                if($i['name']['text'] != ''){
                    array_push($contact, $i);
                }
            }
        }
        //-----------------------------------------------------------
        //-----------------------------------------------------------
        //-----------------------------------------------------------
        

        //-----------------------------------------------------------
        $json = [
            "resourceType"  => "Patient",
            "id"            => $data->id,
            "active"        => $data->active ? true : false,
            "identifier"    => $identifier,
            "name"          => $name,
            "telecom"       => $telecom,
            "gender"        => $data->gender_id ? $data->gender->nama : '',
            "birthDate"     => $data->birthDate,
            "address"       => $address,
            "communication" => $communication,
            "contact"       => $contact,
        ];
        //-----------------------------------------------------------
        if($data->maritalStatus_id != '' ){
            $json['maritalStatus'] = [['value' => $data->maritalStatus->nama]];
        }
        //-----------------------------------------------------------
        if($data->photo != '' ){
            $json['photo'] = $data->photo;
        }
        //-----------------------------------------------------------
        if(@$data->deceased){
            if($data->deceased['deceasedBoolean'] ){
                $json['deceased'] = $data->deceased;
            }
        }
        //-----------------------------------------------------------
        if($data->suku != ''){
            $json['ethnicGroup'] = $data->suku;
        }
        //-----------------------------------------------------------
        if($data->agama_id != ''){
            $json['religion'] = $data->agama->nama;
        }
        //-----------------------------------------------------------
        if($data->pendidikan_id != ''){
            $json['education'] = [['value' => $data->pendidikan->nama]];
        }
        //-----------------------------------------------------------
        if($data->pekerjaan_id != ''){
            $json['work'] = [['value' => $data->pekerjaan->nama]];
        }
        //-----------------------------------------------------------




        //-----------------------------------------------------------
        //-----------------------------------------------------------
        $html   = "<table>";
        $html  .= "<tr><td>Active</td><td><ul><li>". ($data->active ? "true" : "false") ."</li></ul></td></tr>";
        //---------------------------------------
        $html  .= "<tr><td>Name</td>  <td><ul>";
        foreach($json['name'] as $i=>$itm){
            $t_name = (@$itm['prefix'] ? $itm['prefix'] . '. ' : '');
            $t_name .= (@$itm['given'] ? $itm['given'] . ' ' : '');
            $t_name .= (@$itm['family'] ? $itm['family'] . ' .' : '') ;
            $t_name .= (@$itm['suffix'] ? $itm['suffix'] . ' ' : '') ;
            $t_name .= $itm['text'];
            $html  .= "<li>". $t_name . " (".$itm['use'] .") " . "</li>";
        }
        $html  .= "</ul><td></tr>";
        //---------------------------------------
        if(@$json['gender']){
        $html  .= "<tr><td>Gender</td><td><ul><li>". ($json['gender']) ."</li></ul></td></tr>";
        }
        //---------------------------------------
        if(@$json['birthDate']){
            $html  .= "<tr><td>birthDate</td><td><ul><li>". ($json['birthDate']) ."</li></ul></td></tr>";
        }
        //---------------------------------------
        if(@$json['maritalStatus']){
            $html  .= "<tr><td>maritalStatus</td><td><ul>"; 
            foreach($json['maritalStatus'] as $i){
                $html  .= "<li>" .$i['value']. "</li>";
            }
            $html  .= "</ul></td></tr>";
        }
        //---------------------------------------
        if(@$json['religion']){
            $html  .= "<tr><td>religion</td><td><ul><li>". (@$json['religion'] ? $json['religion'] : '') ."</li></ul></td></tr>";
        }
        //---------------------------------------
        if(@$json['education']){
            $html  .= "<tr><td>education</td><td><ul>"; 
            foreach($json['education'] as $i){
                $html  .= "<li>" .$i['value']. "</li>";
            }
            $html  .= "</ul></td></tr>";
        }
        //---------------------------------------
        if(@$json['work']){
            $html  .= "<tr><td>work</td><td><ul>"; 
            foreach($json['work'] as $i){
                $html  .= "<li>" .$i['value']. "</li>";
            }
            $html  .= "</ul></td></tr>";
        }
        //---------------------------------------
        $html  .= "<tr><td>telecom</td><td><ul>"; 
        foreach($json['telecom'] as $i){
            $t_telecom = (@$i['system'] ? $i['system'] . ' : ' : '');
            $t_telecom .= (@$i['value'] ? $i['value'] : '');
            $t_telecom .= (@$i['use'] ? ' ('. $i['use'] . ')' : '');
            $t_telecom .= (@$i['rank'] ? $i['rank'] : '');
            $html  .= "<li>". $t_telecom . "</li>";
        }
        $html  .= "</ul></td></tr>";
        //---------------------------------------
        $html  .= "<tr><td>address</td><td><ul>"; 
        foreach($json['address'] as $i){
            $t_address = (@$i['type'] ? $i['type'] . ' : ' : '');
            $t_address .= (@$i['text'] ? $i['text'] . ' - ' : '');
            $t_address .= (@$i['use'] ? ' ('. $i['use'] . ') ' : '');
            $t_address .= '<br>';
            $t_address .= (@$i['line'] ? json_encode($i['line']) . ', ' : '');
            $t_address .= (@$i['district'] ? $i['district'] . ', ' : '');
            $t_address .= (@$i['city'] ? $i['city'] . ', ' : '');
            $t_address .= (@$i['state'] ? $i['state'] . ', ' : '');
            $t_address .= (@$i['country'] ? $i['country'] . ', ' : '');
            $t_address .= (@$i['postalCode'] ? $i['postalCode'] . ', ' : '');
            $html  .= "<li>". $t_address . "</li>";
        }
        $html  .= "</ul></td></tr>";
        //---------------------------------------
        if(@$json['communication']){
            $html  .= "<tr><td>communication</td><td><ul>"; 
            foreach($json['communication'] as $i){
                $t_communication = (@$i['text'] ? $i['text'] . ' - ' : '');
                $t_communication .= (@$i['language']['text'] ? $i['language']['text']  : '');
                $html  .= "<li>". $t_communication . "</li>";
            }
            $html  .= "</ul></td></tr>";
        }
        //---------------------------------------
        if(@$json['contact']){
            $html  .= "<tr><td>contact</td><td><ul>"; 
            foreach($json['contact'] as $i){
                $t_contact = (@$i['relationship']['text'] ? 'relationship : ' . $i['relationship']['text'] : '');
                $html  .= "<li>". $t_contact . "</li>";

                $t_name = (@$i['name']['prefix'] ? $i['name']['prefix'] . '. ' : '');
                $t_name .= (@$i['name']['given'] ? $i['name']['given'] . ' ' : '');
                $t_name .= (@$i['name']['family'] ? $i['name']['family'] . ' .' : '') ;
                $t_name .= (@$i['name']['suffix'] ? $i['name']['suffix'] . ' ' : '') ;
                $t_name .= $i['name']['text'];
                $html  .= "<li>". 'name : ' . $t_name . "</li>";

                $html  .= "<li>". 'gender : ' . (@$i['gender'] ? $i['gender']  : '') . "</li>";

                $t_telecom = (@$i['telecom']['system'] ? $i['telecom']['system'] . ' : ' : '');
                $t_telecom .= (@$i['telecom']['value'] ? $i['telecom']['value'] : '');
                $t_telecom .= (@$i['telecom']['use'] ? ' ('. $i['telecom']['use'] . ')' : '');
                $t_telecom .= (@$i['telecom']['rank'] ? $i['telecom']['rank'] : '');
                $html  .= "<li>". 'telecom : ' . $t_telecom . "</li>";

                $t_address = (@$i['address']['type'] ? $i['address']['type'] . ' : ' : '');
                $t_address .= (@$i['address']['text'] ? $i['address']['text'] . ' - ' : '');
                $t_address .= (@$i['address']['use'] ? ' ('. $i['address']['use'] . ') ' : '');
                $t_address .= '<br>';
                $t_address .= (@$i['address']['line'] ? json_encode($i['address']['line']) . ', ' : '');
                $t_address .= (@$i['address']['district'] ? $i['address']['district'] . ', ' : '');
                $t_address .= (@$i['address']['city'] ? $i['address']['city'] . ', ' : '');
                $t_address .= (@$i['address']['state'] ? $i['address']['state'] . ', ' : '');
                $t_address .= (@$i['address']['country'] ? $i['address']['country'] . ', ' : '');
                $t_address .= (@$i['address']['postalCode'] ? $i['address']['postalCode'] . ', ' : '');
                $html  .= "<li>". 'address : '. $t_address . "</li>";

                $html  .= "<li>". ' organization : ' . (@$i[' organization'] ? $i[' organization']  : '') . "</li>";
            }
            $html  .= "</ul></td></tr>";
        }
        //---------------------------------------
        if(@$json['deceased'] && $json['deceased']['deceasedBoolean']){
            $html  .= "<tr><td>deceased</td><td><ul><li>". (@$json['deceased']['deceasedDateTime']) ."</li></ul></td></tr>";
        }
        //---------------------------------------
        $html  .= "<table>";
        //-----------------------------------------------------------
        
        //-----------------------------------------------------------
        $json['text'] = [
            "status" => "generated",
            "div"    => $html
        ];

        return $json;
    }

    public function data_json(){
        $full_name          = request('full_name');
        $place_of_birth     = request('place_of_birth');

        $birthDate_samadengan   = request('birthDate_samadengan');
        $birthDate_kurandari    = request('birthDate_kurandari');
        $birthDate_lebihdari    = request('birthDate_lebihdari');

        $gender_id = request('gender_id');

        $address_provinsi_id   = request('address_provinsi_id');
        $address_kota_id       = request('address_kota_id');
        $address_kecamatan_id  = request('address_kecamatan_id');
        $address_kelurahan_id  = request('address_kelurahan_id');
        $address_alamat        = request('address_alamat');

        $identity_type_id  = request('identity_type_id');
        $identity_number   = request('identity_number');

        $no_bpjs            = request('no_bpjs');
        $no_tlp             = request('no_tlp');

        $maritalStatus_id   = request('maritalStatus_id');

        $agama_id           = request('agama_id');

        $pendidikan_id      = request('pendidikan_id');
        $pekerjaan_id       = request('pekerjaan_id');

        $kewarganegaraan_id = request('kewarganegaraan_id');
        $bahasa             = request('bahasa');
        $suku               = request('suku');

        $blood              = request('blood');

        $data = Patient::where(function($q) use($full_name){
            if($full_name != ''){
                $q->where('full_name', 'LIKE', '%'.$full_name.'%');
            }
        })
        ->where(function($q) use($place_of_birth){
            if($place_of_birth != ''){
                $q->where('place_of_birth', 'LIKE', '%'.$place_of_birth.'%');
            }
        })
        //---------------------------------------------------------------------------------------------
        ->where(function($q) use($birthDate_samadengan, $birthDate_kurandari, $birthDate_lebihdari){
            if($birthDate_samadengan != '' && $birthDate_kurandari == '' && $birthDate_lebihdari == ''){
                $q->whereDate('birthDate', $birthDate_samadengan);
            }

            if($birthDate_kurandari != ''){
                $q->whereDate('birthDate', '<=', $birthDate_kurandari);
            }

            if($birthDate_lebihdari != ''){
                $q->whereDate('birthDate', '>=', $birthDate_lebihdari);
            }
        })
        //---------------------------------------------------------------------------------------------
        ->where(function($q) use($gender_id){
            if($gender_id != ''){
                $q->where('gender_id', $gender_id);
            }
        })
        //---------------------------------------------------------------------------------------------
        ->where(function($q) use($address_provinsi_id, $address_kota_id, $address_kecamatan_id, $address_kelurahan_id, $address_alamat){
            if($address_provinsi_id != ''){
                $q->where('address_provinsi_id', $address_provinsi_id);
            }
            if($address_kota_id != ''){
                $q->where('address_kota_id', $address_kota_id);
            }
            if($address_kecamatan_id != ''){
                $q->where('address_kecamatan_id', $address_kecamatan_id);
            }
            if($address_kelurahan_id != ''){
                $q->where('address_kelurahan_id', $address_kelurahan_id);
            }
            if($address_alamat != ''){
                $q->where('address_alamat', 'LIKE',  '%'.$address_alamat.'%');
            }
        })
        //---------------------------------------------------------------------------------------------
        ->where(function($q) use($identity_type_id, $identity_number){
            if($identity_type_id != ''){
                $q->where('identity_type_id', $identity_type_id);
            }
            if($identity_number != ''){
                $q->where('identity_number', 'LIKE',  '%'. $identity_number . '%');
            }
        })
        //---------------------------------------------------------------------------------------------
        ->where(function($q) use($no_bpjs){
            if($no_bpjs != ''){
                $q->where('no_bpjs', 'LIKE',  '%'. $no_bpjs . '%');
            }
        })
        //---------------------------------------------------------------------------------------------
        ->where(function($q) use($no_tlp){
            if($no_tlp != ''){
                $q->where('no_tlp', 'LIKE',  '%'. $no_tlp . '%');
            }
        })
        //---------------------------------------------------------------------------------------------
        ->where(function($q) use($maritalStatus_id){
            if($maritalStatus_id != ''){
                $q->where('maritalStatus_id', $maritalStatus_id);
            }
        })
        //---------------------------------------------------------------------------------------------
        ->where(function($q) use($agama_id){
            if($agama_id != ''){
                $q->where('agama_id', $agama_id);
            }
        })
        //---------------------------------------------------------------------------------------------
        ->where(function($q) use($pendidikan_id){
            if($pendidikan_id != ''){
                $q->where('pendidikan_id', $pendidikan_id);
            }
        })
        //---------------------------------------------------------------------------------------------
        ->where(function($q) use($pekerjaan_id){
            if($pekerjaan_id != ''){
                $q->where('pekerjaan_id', $pekerjaan_id);
            }
        })
        //---------------------------------------------------------------------------------------------
        ->where(function($q) use($kewarganegaraan_id, $bahasa, $suku){
            if($kewarganegaraan_id != ''){
                $q->where('kewarganegaraan_id', $kewarganegaraan_id);
            }
            if($bahasa != ''){
                $q->where('bahasa', 'LIKE',  '%'. $bahasa . '%');
            }
            if($suku != ''){
                $q->where('suku', 'LIKE',  '%'. $suku . '%');
            }
        })
        //---------------------------------------------------------------------------------------------
        ->where(function($q) use($blood){
            if($blood != ''){
                $q->where('blood', $blood);
            }
        })
        //---------------------------------------------------------------------------------------------
        ->get();

        return Datatables::of($data)
        ->addColumn('action', function($item){
            return "<a target='_blank' href='" .route('patient.show', $item->no_rm).  "' class='btn btn-sm btn-info'><i class='fas fa-eye'></i></a>";
        })
        ->addColumn('gender', function($item){
            if($item->gender_id != ''){
                return $item->gender->nama;
            }
            return '--';
        })
        ->addColumn('usia', function($item){
            return $item->usia();
        })
        ->addColumn('full_address', function($item){
            return $item->address_alamat ;
            //  .' '. ($item->address_kelurahan_id   != '' ? $item->kelurahan->nama : '')
            //  .' '. ($item->address_kecamatan_id   != '' ? $item->kecamatan->nama : '')
            //  .' '. ($item->address_kota_id        != '' ? $item->kota->nama : '')
            //  .' '. ($item->address_provinsi_id    != '' ? $item->provinsi->nama : '');
        })
        ->addColumn('kelurahan', function($item){
            return $item->address_kelurahan_id   != '' ? $item->kelurahan->nama : '';
        })
        ->addColumn('kecamatan', function($item){
            return $item->address_kecamatan_id   != '' ? $item->kecamatan->nama : '';
        })
        ->addColumn('kota', function($item){
            return $item->address_kota_id        != '' ? $item->kota->nama : '';
        })
        ->addColumn('provinsi', function($item){
            return $item->address_provinsi_id    != '' ? $item->provinsi->nama : '';
        })
        ->addColumn('kartu_identitas', function($item){
            return ($item->identity_type_id != '' ? $item->identityType->nama . ' : ' : '') . $item->identity_number;
        })
        ->addColumn('status_nikah', function($item){
            return $item->maritalStatus_id    != '' ? $item->maritalStatus->nama : '';
        })
        ->addColumn('agama', function($item){
            return $item->agama_id    != '' ? $item->agama->nama : '';
        })
        ->addColumn('pendidikan', function($item){
            return $item->pendidikan_id    != '' ? $item->pendidikan->nama : '';
        })
        ->addColumn('pekerjaan', function($item){
            return $item->pekerjaan_id    != '' ? $item->pekerjaan->nama : '';
        })
        ->addColumn('kewarganegaraan', function($item){
            return $item->kewarganegaraan_id    != '' ? $item->kewarganegaraan->nama : '';
        })
        ->addColumn('author', function($item){
            return $item->author->name;
        })
        
        ->rawColumns(['action'])
        ->make(true);
    }

}
