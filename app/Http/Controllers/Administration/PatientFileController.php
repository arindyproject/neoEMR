<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use App\Models\Administration\Patient;
use App\Models\Administration\PatientFile;
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


    public function index($id){
        $itm = Patient::find($id);
        if($itm){
            $this->to_return['data']    = $itm;
            $this->to_return['title']   = 'FILE : ' . $itm->no_rm .' : '. $itm->full_name; 
            $this->to_return['files']   = PatientFile::where('patient_id', $itm->id)->paginate(25);
            return view('administration.patient_file.index', $this->to_return);
        }else{
            return redirect()->route('patient.index')->with('error', 'Data NOT FOUND!!');
        }
    }

    public function create($id){
        $itm = Patient::find($id);
        if($itm){
            $this->to_return['data']         = $itm;
            $this->to_return['title']   = 'Upload FILE : ' . $itm->no_rm .' : '. $itm->full_name; 
            return view('administration.patient_file.create', $this->to_return);
        }else{
            return redirect()->route('patient.index')->with('error', 'Data NOT FOUND!!');
        }
    }

    public function edit($id, $slug){
        $itm = Patient::find($id);
        $file= PatientFile::where('slug', $slug)->where('patient_id', $itm->id)->first();
        if($itm){
            $this->to_return['data']        = $itm;
            $this->to_return['title']       = 'Edit FILE : ' . $slug; 
            $this->to_return['file']        = $file;
            return view('administration.patient_file.edit', $this->to_return);
        }else{
            return redirect()->route('patient.index')->with('error', 'Data NOT FOUND!!');
        }
    }

    public function store(Request $request, $id){
        $request->validate([
            'title'     => 'required|string|max:255',
            'file'      => 'required|mimes:jpeg,png,PNG,jpg,pdf,doc,docx|max:5000',
            'ket'       => 'nullable',
        ]);
        $patient = Patient::find($id);
        $file = '';

        $destinationPath = public_path('/files/patient');
        $files = $request->file('file');
        $name = $patient->no_rm .'_'. time().'.'.$files->getClientOriginalExtension();
        $files->move($destinationPath, $name);

        $q = PatientFile::create([
            'patient_id' => $id,
            'title' => $request->title,
            'ket' => $request->ket,
            'file' => $name,
            'author_id' => Auth::user()->id,
        ]);
        if($q){
            return redirect()->route('file.patient.index', $patient->id)->with('success', 'File Berhasil di Upload!!');
        }

        return redirect()->route('home')->with('error', 'Anda tidak memiliki izin!!');
    }

    public function update(Request $request, $id){
        $request->validate([
            'title'     => 'required|string|max:255',
            'file'      => 'nullable|mimes:jpeg,png,PNG,jpg,pdf,doc,docx|max:5000',
            'ket'       => 'nullable',
        ]);
        $q = PatientFile::find($id);
        
        $to_store = [
            'title' => $request->title,
            'ket' => $request->ket,
            'edithor_id' => Auth::user()->id,
        ];

        if ($request->hasFile('file')) {
            $destinationPath = public_path('/files/patient');
            File::delete($destinationPath.'/'.$q->file);

            $files = $request->file('file');
            $name = $q->patient->no_rm .'_'. time().'.'.$files->getClientOriginalExtension();
            $files->move($destinationPath, $name);
            $to_store['file'] = $name;
        }

        $x = $q->update($to_store);
        if($x){
            return redirect()->route('file.patient.index', $q->patient->id)->with('success', 'File Berhasil di Update!!');
        }

        return redirect()->route('home')->with('error', 'Anda tidak memiliki izin!!');
    }

    public function delete($id){
        $file = PatientFile::find($id);
        $destinationPath = public_path('/files/patient');
        File::delete($destinationPath.'/'.$file->file);
        $file->delete();
        return redirect()->back()->with('success', 'File Berhasil Di Hapus!!');
    }
}
