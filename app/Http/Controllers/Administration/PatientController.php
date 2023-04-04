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
                    $request->contact_address_postalCode[$i]!= '' ? $tmp_contact['address']['postalCode']= $request->contact_address_postalCode[$i] : null;

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
                array_push($identifier, $i);
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
                array_push($name, $i);
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
                array_push($telecom, $i);
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
            ]
        ];

        if($data->address){
            foreach($data->address as $i){
                array_push($address, $i);
            }
        }
        //-----------------------------------------------------------
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
        ];
        return $json;
    }

}
