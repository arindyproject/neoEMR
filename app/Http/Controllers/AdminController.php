<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\Config;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data   = User::get();
        $admin  = User::whereHas(
            'roles', function($q){
                $q->where('name', 'admin');
            }
        )->where('status', 1)->get();
        $roles  = Role::get();
        return view('admin.index', compact(['data','admin','roles']));
    }

    public function add_user(Request $request ){
        $request->validate([
            'name' => "required|string|max:255",
            'username' => "required|string|max:255|unique:users",
            'email' => "required|string|email|max:255|unique:users",
            'password' => "required|string|min:6|confirmed", 
        ]);

       
        $request['password'] = Hash::make($request['password']);
        $u = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'status' => $request->status,
        ]);

        if($u){
            foreach($request->roles as $r){
                $u->assignRole($r);
            }
            return redirect()->back()->with('success', 'User Baru berhasil ditambahkan!!');
        }else{
            return redirect()->back()->with('error', 'User Baru Gagal ditambahkan!!');
        }
    }

    public function list_aktif()
    {
        $nama = request('nama');
        $role = request('role');

        $data = User::where(function($query) use($nama){
            if($nama != ''){
                $query->where('name', 'LIKE', '%'.$nama.'%');
            }
        })
        ->where('status', 1)
        ->whereHas(
            'roles', function($q) use($role){
                if($role != ''){
                    $q->where('name', $role);
                }
            }
        )->paginate(30);

        $roles  = Role::get();
        return view('admin.list_aktif', compact(['data','roles']));
    }

    public function list_non_aktif()
    {
        $data = User::where('status', 0)->paginate(20);
        return view('admin.list_non_aktif', compact(['data']));
    }

    public function list_admin()
    {
        $data = User::whereHas(
            'roles', function($q){
                $q->where('name', 'admin');
            }
        )->where('status', 1)->paginate(20);
        return view('admin.list_admin', compact(['data']));
    }


    public function set_admin($id){
        $u = User::findOrFail($id);
        if($u){
            if($u->hasRole('admin')){
                $u->removeRole('admin');
            }else{
                $u->assignRole('admin');
            }
            return response()->json(array('success' => true));
        }else{
            return response()->json(array('success' => false));
        }
    }

    public function set_aktif($id){
        $u = User::findOrFail($id);
        if($u){
            if($u->status == 1){
                $u->status = 0;
            }else{
                $u->status = 1;
            }
            $u->save();
            return response()->json(array('success' => true));
        }else{
            return response()->json(array('success' => false));
        }
    }

    public function delete($id)
    {
        $u = User::findOrFail($id);

        $u->delete();

        return response()->json(array('success' => true));
    }

    ///=========================================================================================
    ///=========================================================================================
    ///=========================================================================================

    public function web_setting(){
        $data = Config::get();
        return view('admin.web_setting', compact(['data'])); 
    }

    public function web_setting_submit(Request $request){
        $request->validate([
            'icon_mini'     => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'icon_medium'   => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

       

        $data = Config::get();

        $icon_mini = $data['icon_mini'];
        if ($request->hasFile('icon_mini')) {
            $image = $request->file('icon_mini');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/icon');
            $image->move($destinationPath, $name);
            $icon_mini = $name;
        }

        $icon_medium = $data['icon_medium'];
        if ($request->hasFile('icon_medium')) {
            $image = $request->file('icon_medium');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/icon');
            $image->move($destinationPath, $name);
            $icon_medium = $name;
        }

        $data = Config::put(
            $request->name,
            $request->dark_mode,
            $request->navbar_variants,
            $request->navbar_fixed,
            $icon_mini,
            $icon_medium,
            $request->footer,
            $request->pop_up,
            $request->tag_line,
            $request->alamat,
            $request->no_tlp,
            $request->email
        );
        return redirect()->back()->with('success', 'WEB Setting berhasil DiEdit!!');
    }


    ///=========================================================================================
    ///=========================================================================================
    ///=========================================================================================

    public function roles_index(){
        $roles = Role::withCount('users')->get();
        $permissions = Permission::get();
        return view('admin.roles.index', compact(['roles','permissions'])); 
    }

    public function roles_edit($id){
        $roles = Role::withCount('users')->get();
        $permissions = Permission::get();
        $data = Role::find($id);
        return view('admin.roles.edit', compact(['roles','permissions', 'data'])); 
    }

    public function roles_store(Request $request){
        $request->validate([
            'name'          => "required|string|max:255|unique:roles",
            'guard_name'    => "required|string|max:255",
        ]);

        $r = Role::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name
        ]);
        if($r){
            foreach($request->permissions as $item){
                $r->givePermissionTo($item);
            }
        }
        return redirect()->route('admin.roles')->with('success', 'Roles Berhasil diTambah!!');
    }


    public function roles_update(Request $request, $id){
        $request->validate([
            'name'          => "required|string|max:255|unique:roles,name," . $id .',id',
            'guard_name'    => "required|string|max:255",
        ]);

        $r = Role::find($id);
        $r->update([
            'name' => $request->name,
            'guard_name' => $request->guard_name
        ]);

        if(count($r->permissions) > 0){
            foreach($r->permissions->pluck('name') as $itm){
                $r->revokePermissionTo($itm);
            }
            foreach($request->permissions as $item){
                $r->givePermissionTo($item);
            }
        }
        return redirect()->route('admin.roles')->with('success', 'Roles Berhasil diUpdate!!');
    }

   

    public function role_delete($id){
        $u = Role::findOrFail($id);
        $u->delete();
        return redirect()->route('admin.roles')->with('success', 'Roles Berhasil diHapus!!');
    }


    ///=========================================================================================
    ///=========================================================================================
    ///=========================================================================================

    public function permissions_index(){
        $name = request('name');
        $permissions = Permission::where(function($query) use($name){
            if($name != ''){
                $query->where('name', 'LIKE', '%'.$name.'%');
            }
        })->paginate(20);
        
        return view('admin.permissions.index', compact(['permissions'])); 
    }

    public function permissions_edit($id){
        $name = request('name');
        $permissions = Permission::where(function($query) use($name){
            if($name != ''){
                $query->where('name', 'LIKE', '%'.$name.'%');
            }
        })->paginate(20);
        $data        = Permission::find($id);
        return view('admin.permissions.edit', compact(['permissions','data'])); 
    }


    public function permissions_store(Request $request){
        $request->validate([
            'name'          => "required|string|max:255|unique:permissions",
            'guard_name'    => "required|string|max:255",
        ]);

        $r = Permission::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name
        ]);
     
        return redirect()->route('admin.permissions')->with('success', 'Permissions Berhasil diTambah!!');
    }

    public function permissions_update(Request $request, $id){
        $request->validate([
            'name'          => "required|string|max:255|unique:permissions",
            'guard_name'    => "required|string|max:255",
        ]);

        $r = Permission::find($id)->update([
            'name' => $request->name,
            'guard_name' => $request->guard_name
        ]);
     
        return redirect()->route('admin.permissions')->with('success', 'Permissions Berhasil diUpdate!!');
    }


    public function permissions_delete($id){
        $u = Permission::findOrFail($id);
        $u->delete();
        return redirect()->route('admin.permissions')->with('success', 'Permissions Berhasil diHapus!!');
    }
}