<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;

use App\Models\Administration\Patient;

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
        return view('administration.patient.create', $this->to_return);
    }

}
