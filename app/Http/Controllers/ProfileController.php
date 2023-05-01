<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserFile;
use App\Models\Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File; 

use Spatie\Permission\Models\Role;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

        $this->title    = 'Users';
        $this->bg       = Config::get()['navbar_variants'];

        $this->user_table = new User;
        $this->file_table = new UserFile;

        $this->v_list           = 'profile.list';
        $this->v_index          = 'profile.index';
        $this->v_edit           = 'profile.edit';
        $this->v_advance        = 'profile.advance';

        $this->v_signature      = 'profile.signature';

        $this->v_ganti_password = 'profile.ganti_password';

        $this->v_index_file     = 'profile.index_file';
        $this->v_create_file    = 'profile.create_file';
        $this->v_edit_file      = 'profile.edit_file';

        $this->v_role           = 'profile.role';


        $this->to_return = [
            'title'     => $this->title,
            'bg'        => $this->bg,
        ];
    }


    public function list()
    {
        $name = request('name');
        $this->to_return['data'] = $this->user_table::where(function($q) use($name){
            if($name != ''){
                $q->where('name', 'LIKE', '%'.$name.'%');
            }
        })->paginate(12);
        return view($this->v_list , $this->to_return);
    }


    public function index($id)
    {
        $data = $this->user_table::findOrFail($id);
        $this->to_return['id']      = $id;
        $this->to_return['data']    = $data;
        return view($this->v_index , $this->to_return );
    }


    //signature========================================================================================
    public function signature($id){
        if(Auth::user()->hasRole('admin') || Auth::user()['id'] == $id){
            $data = $this->user_table::findOrFail($id);
            $this->to_return['id']      = $id;
            $this->to_return['data']    = $data;
            return view($this->v_signature, $this->to_return );
        }else{
            return redirect()->route('home')->with('error', 'Anda tidak memiliki izin!!');
        }
    }

    public function signature_store($id, Request $request){
        $data = $this->user_table::findOrFail($id);
        $data->signature = $request->signature;
        if($data->save()){
            return [
                'status' => true,
                'msg'    => 'Signature Berhasil diUpload!!',
                'signature' => $data->signature
            ];
        }
        return [
            'status' => false,
            'msg'    => 'Signature Gagal diUpload!!',
            'signature' => ''
        ];
    }
    //signature========================================================================================


    //File=============================================================================================
    public function file($id)
    {
        $data = $this->user_table::findOrFail($id);
        $file = $this->file_table::where('user_id', $id)
        ->where(function($q) use($id){
            if(Auth::user()->id != $id && !Auth::user()->hasRole('admin')){
                $q->where('is_privat', 0);
            }
        })
        ->paginate(20);
        $this->to_return['id']      = $id;
        $this->to_return['data']    = $data;
        $this->to_return['file']    = $file;
        return view($this->v_index_file , $this->to_return );
    }


    public function create_file($id)
    {
        if(Auth::user()->hasRole('admin') || Auth::user()['id'] == $id){
            $data = $this->user_table::findOrFail($id);
            $this->to_return['id']      = $id;
            $this->to_return['data']    = $data;
            return view($this->v_create_file, $this->to_return );
        }else{
            return redirect()->route('home')->with('error', 'Anda tidak memiliki izin!!');
        }
    }

    public function edit_file($id)
    {
        $file = UserFile::find($id);
        if(Auth::user()->hasRole('admin') || Auth::user()['id'] == $file->user_id){
            $data = User::findOrFail($file->user_id);
            $this->to_return['id']      = $id;
            $this->to_return['data']    = $data;
            $this->to_return['file']    = $file;
            return view($this->v_edit_file , $this->to_return);
        }else{
            return redirect()->route('home')->with('error', 'Anda tidak memiliki izin!!');
        }
    }

    public function update_file($id, Request $request)
    {   
        $file = $this->file_table::find($id);
        if(Auth::user()->hasRole('admin') || Auth::user()['id'] == $file->user_id){
            $user = $this->user_table::findOrFail($file->user_id);
            $request->validate([
                'title' => "required|string",
                'ket' => "nullable", 
                'is_privat' => "required",
                'file' => 'nullable|mimes:jpeg,png,jpg,gif,svg,pdf,doc,docx|max:8048',
            ]);
            $name_file = $file->file;
            if ($request->hasFile('file')) {
                $destinationPath = public_path('/files/user');
                File::delete($destinationPath.'/'.$name_file);

                $files = $request->file('file');
                $name = $user->id .'_'. time().'.'.$files->getClientOriginalExtension();
                $files->move($destinationPath, $name);
                $name_file = $name;
            }
            $file->update([
                'title' => $request->title,
                'ket' => $request->ket,
                'is_privat' => $request->is_privat,
                'file' =>  $name_file
            ]);
            return redirect()->back()->with('success', 'File Berhasil di Update!!');
        }else{
            return redirect()->route('home')->with('error', 'Anda tidak memiliki izin!!');
        }
    }

    public function store_file($id, Request $request)
    {
        if(Auth::user()->hasRole('admin') || Auth::user()['id'] == $id){
            $request->validate([
                'title' => "required|string",
                'ket' => "nullable", 
                'is_privat' => "required",
                'file' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf,doc,docx|max:8048',
            ]);

            $destinationPath = public_path('/files/user');
            $files = $request->file('file');
            $name = $id .'_'. time().'.'.$files->getClientOriginalExtension();
            $files->move($destinationPath, $name);
            
            $this->file_table::create([
                'user_id' => $id,
                'title' => $request->title,
                'ket' => $request->ket,
                'is_privat' => $request->is_privat,
                'file' =>  $name
            ]);
            return redirect()->back()->with('success', 'File Berhasil diUpload!!');
        }else{
            return redirect()->route('home')->with('error', 'Anda tidak memiliki izin!!');
        }
    }

    public function file_delete($id)
    {
        $file = $this->file_table::find($id);
        if(Auth::user()->hasRole('admin') || Auth::user()['id'] == $file->user_id){
            $destinationPath = public_path('/files/user');
            File::delete($destinationPath.'/'.$file->file);
            $file->delete();
            return redirect()->back()->with('success', 'File Berhasil Di Hapus!!');
        }else{
            return redirect()->route('home')->with('error', 'Anda tidak memiliki izin!!');
        }
    }
    //File=============================================================================================

    public function edit($id)
    {
        if(Auth::user()->hasRole('admin') || Auth::user()['id'] == $id){
            $data = $this->user_table::findOrFail($id);
            $this->to_return['data'] = $data;
            return view($this->v_edit, $this->to_return);
        }else{
            return redirect()->route('home')->with('error', 'Anda tidak memiliki izin!!');
        }
        
    }


    public function edit_advance($id)
    {
        if(Auth::user()->hasRole('admin') || Auth::user()['id'] == $id){
            $data = $this->user_table::findOrFail($id);
            $this->to_return['data'] = $data;
            return view($this->v_advance , $this->to_return );
        }else{
            return redirect()->route('home')->with('error', 'Anda tidak memiliki izin!!');
        }
        
    }

    //=================================================================================================
    public function edit_advance_identifier(Request $request,$id)
    {
        if(Auth::user()->hasRole('admin') || Auth::user()['id'] == $id){
            $data = $this->user_table::findOrFail($id);
            $iden = [];
            if($request->use != ''){
                foreach($request->use as $i=>$itm){
                    $dta = [
                        'use'       => $itm,
                        'system'    => $request->system[$i],
                        'type'      => [
                            'text'  => $request->type_text[$i],
                            'coding'=> [
                                "system"        => $request->type_coding_system[$i],
                                "version"       => $request->type_coding_version[$i],
                                "code"          => $request->type_coding_code[$i],
                                "display"       => $request->type_coding_display[$i],
                                "userSelected"  => $request->type_coding_userSelected[$i],
                            ],
                        ],
                        'value'     => $request->value[$i],
                        'peroide'   => [
                            "start" => $request->peroide_start[$i],
                            "end"   => $request->peroide_end[$i],
                        ],
                        'assigner'  => $request->assigner[$i],
                    ];
                    array_push($iden, $dta);
                }
                $data['identifier'] = $iden;
                $data->save();
                return redirect()->back()->with('success', 'User Berhasil Di Update!!');
            }else{
                $data['identifier'] = $iden;
                $data->save();
                return redirect()->back()->with('warning', 'No data to Update!!');
            }
        }else{
            return redirect()->route('home')->with('error', 'Anda tidak memiliki izin!!');
        }
    }
    //=================================================================================================



    //=================================================================================================
    public function edit_advance_telecom(Request $request,$id)
    {
        if(Auth::user()->hasRole('admin') || Auth::user()['id'] == $id){
            $data = $this->user_table::findOrFail($id);
            $iden = [];
            if($request->use != ''){
                foreach($request->use as $i=>$itm){
                    $dta = [
                        'system'    => $request->system[$i],
                        'value'     => $request->value[$i],
                        'use'       => $itm,
                        'rank'      => $request->rank[$i],
                        'peroide'   => [
                            "start" => $request->peroide_start[$i],
                            "end"   => $request->peroide_end[$i],
                        ],
                    ];
                    array_push($iden, $dta);
                }
                $data['telecom'] = $iden;
                $data->save();
                return redirect()->back()->with('success', 'User Berhasil Di Update!!');
            }else{
                $data['telecom'] = $iden;
                $data->save();
                return redirect()->back()->with('warning', 'No data to Update!!');
            }
        }else{
            return redirect()->route('home')->with('error', 'Anda tidak memiliki izin!!');
        }
    }
    //=================================================================================================



    //=================================================================================================
    public function edit_advance_address(Request $request,$id)
    {
        if(Auth::user()->hasRole('admin') || Auth::user()['id'] == $id){
            $data = $this->user_table::findOrFail($id);
            $iden = [];
            if($request->use != ''){
                foreach($request->use as $i=>$itm){
                    $dta = [
                        'use'       => $itm,
                        "type"      => $request->type[$i],
                        "text"      => $request->text[$i],
                        "line"      => $request->line[$i],
                        "city"      => $request->city[$i],
                        "district"  => $request->district[$i],
                        "state"     => $request->state[$i],
                        "postalCode"=> $request->postalCode[$i],
                        "country"   => $request->country[$i],
                        'peroide'   => [
                            "start" => $request->peroide_start[$i],
                            "end"   => $request->peroide_end[$i],
                        ],
                    ];
                    array_push($iden, $dta);
                }
                $data['address'] = $iden;
                $data->save();
                return redirect()->back()->with('success', 'User Berhasil Di Update!!');
            }else{
                $data['address'] = $iden;
                $data->save();
                return redirect()->back()->with('warning', 'No data to Update!!');
            }
        }else{
            return redirect()->route('home')->with('error', 'Anda tidak memiliki izin!!');
        }
    }
    //=================================================================================================



    //=================================================================================================
    public function edit_advance_communication(Request $request,$id)
    {
        if(Auth::user()->hasRole('admin') || Auth::user()['id'] == $id){
            $data = $this->user_table::findOrFail($id);
            $iden = [];
            if($request->text != ''){
                foreach($request->text as $i=>$itm){
                    $dta = [
                        'text'  => $request->text[$i],
                        'coding'=> [
                            "system"        => $request->coding_system[$i],
                            "version"       => $request->coding_version[$i],
                            "code"          => $request->coding_code[$i],
                            "display"       => $request->coding_display[$i],
                            "userSelected"  => $request->coding_userSelected[$i],
                        ],
                    ];
                    array_push($iden, $dta);
                }
                $data['communication'] = $iden;
                $data->save();
                return redirect()->back()->with('success', 'User Berhasil Di Update!!');
            }else{
                $data['communication'] = $iden;
                $data->save();
                return redirect()->back()->with('warning', 'No data to Update!!');
            }
        }else{
            return redirect()->route('home')->with('error', 'Anda tidak memiliki izin!!');
        }
    }
    //=================================================================================================





    public function edit_submit(Request $request, $id)
    {
        if(Auth::user()->hasRole('admin') || Auth::user()['id'] == $id){
            $data = $this->user_table::findOrFail($id);
            $request->validate([
                'name' => "required|string|max:255",
                'username' => "required|string|max:255|unique:users,username," . $id .',id',
                'email' => "required|string|email|max:255|unique:users,email," . $id .',id', 
                'no_tlp'   => "nullable",
                'photo' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',

                'address_alamat'  => "nullable",
                'tempat_lahir'  => "nullable",
                'birthDate'     => "nullable",
            ]);

            $photo_name = $data->photo;
            if ($request->hasFile('photo')) {

                $destinationPath = public_path('/images/profile');
                File::delete($destinationPath.'/'.$data->photo);

                $image = $request->file('photo');
                $name = time().'.'.$image->getClientOriginalExtension();
                $image->move($destinationPath, $name);
                $photo_name = $name;
            }

            $data->update([
                'name'      => $request->name,
                'username'  => $request->username,
                'email'     => $request->email,
                'no_tlp'    => $request->no_tlp,
                'photo'     => $photo_name,

                'address_alamat'     => $request->address_alamat,
                'tempat_lahir'     => $request->tempat_lahir,
                'birthDate'     => $request->birthDate,
            ]);  
            return redirect()->back()->with('success', 'User Berhasil Di Edit!!');
            
        }else{
            return redirect()->route('home')->with('error', 'Anda tidak memiliki izin!!');
        } 
    }

    public function ganti_password($id)
    {
        if(Auth::user()->hasRole('admin') || Auth::user()['id'] == $id){
            $data = $this->user_table::findOrFail($id);
            $this->to_return['data'] = $data;
            return view($this->v_ganti_password, $this->to_return);
        }else{
            return redirect()->route('home')->with('error', 'Anda tidak memiliki izin!!');
        }
        
    }

    public function ganti_password_submit(Request $request, $id)
    {
        if(Auth::user()['id'] == $id){
            $data = $this->user_table::findOrFail($id);
            $request->validate([
                'old_password' => "required|string|min:6",
                'password' => "required|string|min:6|confirmed", 
            ]);
            
            if(Hash::check($request['old_password'], $data->password)){
                $request['password'] = Hash::make($request['password']);
                $data->update($request->all());
                return redirect()->back()->with('success', 'Password User Berhasil Di Edit!!');
            }else{
                return redirect()->back()->with('error', 'Password Lama Salah!!');
            }
        }else if(Auth::user()->hasRole('admin') ){
            $data = User::findOrFail($id);
            $request->validate([
                'password' => "required|string|min:6|confirmed", 
            ]);
            $request['password'] = Hash::make($request['password']);
            $data->update($request->all());
            return redirect()->back()->with('success', 'Password User Berhasil Di Reset!!');
        }else{
            return redirect()->route('home')->with('error', 'Anda tidak memiliki izin!!');
        } 
    }




    public function edit_role($id)
    {
        if(Auth::user()->hasRole('admin')){
            $this->to_return['data']    = $this->user_table::findOrFail($id);
            $this->to_return['roles']   = Role::get();
            $this->to_return['role']    = $this->to_return['data']->getRoleNames();
            return view($this->v_role, $this->to_return);
        }else{
            return redirect()->route('home')->with('error', 'Anda tidak memiliki izin!!');
        }
        
    }

    public function store_role($id, Request $request)
    {
        if(Auth::user()->hasRole('admin')){
            $data = $this->user_table::findOrFail($id);

            $data->roles()->detach();
            foreach($request->roles as $item){
                $data->assignRole($item);
            }
            return redirect()->back()->with('success', 'Roles Berhasil diUpdate!!');
        }else{
            return redirect()->route('home')->with('error', 'Anda tidak memiliki izin!!');
        }
        
    }
}
