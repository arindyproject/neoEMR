<?php

namespace App\Http\Controllers\Attributes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\attAlamatKota;

class AlamatKotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:attribute|admin'])->except(['autocomplete']);

        $this->paging       = 30;
        $this->view_index   = 'attributes.alamat.kota.index';
        $this->view_edit    = 'attributes.alamat.kota.edit';

        $this->url_index    = 'attributes.alamat.kota.index';
        $this->url_edit     = 'attributes.alamat.kota.edit';
        $this->url_store    = 'attributes.alamat.kota.store';
        $this->url_update   = 'attributes.alamat.kota.update';
        $this->url_delete   = 'attributes.alamat.kota.destroy';

        $this->title        = "ATT Alamat Kota / Kabupaten";
        $this->table        = new attAlamatKota;
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
        $att_alamat_provinsis_id = request('att_alamat_provinsis_id');
        $id = request('id');
        
        $this->to_return['data'] = $this->table::where(function($q) use($att_alamat_provinsis_id){
            if($att_alamat_provinsis_id != ''){
                return $q->where('att_alamat_provinsis_id', $att_alamat_provinsis_id);
            }
        })
        ->where(function($q) use($id){
            if($id != ''){
                $q->where('id', $id);
            }
        })
        ->paginate($this->paging);
        return view($this->view_index, $this->to_return);
    }

    public function edit($id)
    {   
        $att_alamat_provinsis_id = request('att_alamat_provinsis_id');
        $ids = request('id');

        $this->to_return['data'] = $this->table::where(function($q) use($att_alamat_provinsis_id){
            if($att_alamat_provinsis_id != ''){
                return $q->where('att_alamat_provinsis_id', $att_alamat_provinsis_id);
            }
        })
        ->where(function($q) use($ids){
            if($ids != ''){
                $q->where('id', $ids);
            }
        })
        ->paginate($this->paging);
        $this->to_return['itm']  = $this->table::find($id);
        return view($this->view_edit, $this->to_return);
    }

    public function store(Request $request){
        $request->validate([
            'nama' => "required|string|max:255",
            'kode' => "nullable|string|max:255|unique:att_alamat_kotas",
            'kode_kota' => "nullable|string|max:255",
            'att_alamat_provinsis_id' => 'required'
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
            'nama'      => "required|string|max:255",
            'kode'      => "nullable|string|max:255|unique:att_alamat_kotas,kode," . $id .'ID',
            'kode_kota' => "nullable|string|max:255",
            'att_alamat_provinsis_id' => 'required'
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
            $data = $this->table::select("kode", "kode_kota","nama", "id")
            ->where('nama', 'LIKE', '%'. $request->get('q'). '%')
            ->where(function($query) use($request){
                if($request->id_provinsi != ''){
                    return $query->where('att_alamat_provinsis_id', $request->id_provinsi);
                }
            })
            ->get();
        }
        return response()->json($data);
    }
}
