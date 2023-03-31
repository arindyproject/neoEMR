<?php

namespace App\Http\Controllers\Attributes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\attAlamatCountry;

class AlamatCountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:attribute|admin'])->except(['autocomplete']);

        $this->paging       = 30;
        $this->view_index   = 'attributes.alamat.country.index';
        $this->view_edit    = 'attributes.alamat.country.edit';

        $this->url_index    = 'attributes.alamat.country.index';
        $this->url_edit     = 'attributes.alamat.country.edit';
        $this->url_store    = 'attributes.alamat.country.store';
        $this->url_update   = 'attributes.alamat.country.update';
        $this->url_delete   = 'attributes.alamat.country.destroy';

        $this->title        = "ATT Country";
        $this->table        = new attAlamatCountry;
        $this->to_return    = [
            'title'     => $this->title,
            'url_index' => $this->url_index,
            'url_edit'  => $this->url_edit,
            'url_store' => $this->url_store,
            'url_update'=> $this->url_update,
            'url_delete'=> $this->url_delete,

            'bg'        => \App\Models\Config::get()['navbar_variants'],
        ];
    }

    public function index()
    {
        $this->to_return['data'] = $this->table::paginate($this->paging);
        return view($this->view_index, $this->to_return);
    }

    public function edit($id)
    {   
        $this->to_return['data'] = $this->table::paginate($this->paging);
        $this->to_return['itm']  = $this->table::find($id);
        return view($this->view_edit, $this->to_return);
    }

    public function store(Request $request){
        $request->validate([
            'nama' => "required|string|max:255",
            'name' => "required|string|max:255",
            'alpha_2'       => "required|string|max:255|unique:att_alamat_countries",
            'alpha_3'       => "required|string|max:255|unique:att_alamat_countries",
            'country_code'  => "required|string|max:255|unique:att_alamat_countries",
        ]);

        $request['user_id'] = Auth::user()->id;
        $u = $this->table::create($request->all());
        if($u){
            return redirect()->route($this->url_index)->with('success', $this->title . ' Baru berhasil ditambahkan!!');
        }else{
            return redirect()->back()->with('error', $this->title .' Baru Gagal ditambahkan!!');
        }
    }

    public function update(Request $request, $id){
        $request->validate([
            'nama'          => "required|string|max:255",
            'name'          => "required|string|max:255",
            'alpha_2'       => "required|string|max:255|unique:att_alamat_countries,alpha_2," . $id .',id',
            'alpha_3'       => "required|string|max:255|unique:att_alamat_countries,alpha_3," . $id .',id',
            'country_code'  => "required|string|max:255|unique:att_alamat_countries,country_code," . $id .',id',
        ]);

        $request['user_id'] = Auth::user()->id;
        $u = $this->table::find($id)->update($request->all());
        if($u){
            return redirect()->route($this->url_index)->with('success', $this->title . ' berhasil diUpdate!!');
        }else{
            return redirect()->back()->with('error', $this->title .' Gagal diUpdate!!');
        }
    }


    public function destroy($id){
        $u = $this->table::destroy($id);
        if($u){
            return redirect()->route($this->url_index)->with('success', $this->title . ' berhasil diHapus!!');
        }else{
            return redirect()->back()->with('error', $this->title .' Gagal diHapus!!');
        }
    }

    //------------------------------------------------------------------------------------------------
    public function autocomplete(Request $request)
    {
        $data = [];
        if($request->filled('q')){
            $data = $this->table::select("nama", "id")->where('nama', 'LIKE', '%'. $request->get('q'). '%')->get();
        }
        return response()->json($data);
    }
}
