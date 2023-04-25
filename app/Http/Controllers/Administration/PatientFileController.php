<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Administration\Patient;
use App\Models\Config;

class PatientFileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:administration|admin']);

        $this->title = "Patient File";
        $this->to_return = [
            'title'     => $this->title,
            'bg'        => Config::get()['navbar_variants'],
        ];
    }


    public function index($rm){
        $itm = Patient::where('no_rm', $rm)->first();
        if($itm){
            $this->to_return['data']         = $itm;
            $this->to_return['title']   = $itm->no_rm .' : '. $itm->full_name; 
            return view('administration.patient_file.index', $this->to_return);
        }else{
            return redirect()->route('patient.index')->with('error', 'Data NOT FOUND!!');
        }
    }
}
