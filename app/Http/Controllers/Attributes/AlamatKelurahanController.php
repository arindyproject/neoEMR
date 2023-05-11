<?php

namespace App\Http\Controllers\Attributes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\Attributes\attAlamatKelurahan;

class AlamatKelurahanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:attribute|admin'])->except(['autocomplete']);

        $this->paging       = 30;
        $this->view_index   = 'attributes.alamat.kelurahan.index';
        $this->view_edit    = 'attributes.alamat.kelurahan.edit';

        $this->url_index    = 'attributes.alamat.kelurahan.index';
        $this->url_edit     = 'attributes.alamat.kelurahan.edit';
        $this->url_store    = 'attributes.alamat.kelurahan.store';
        $this->url_update   = 'attributes.alamat.kelurahan.update';
        $this->url_delete   = 'attributes.alamat.kelurahan.destroy';

        $this->title        = "ATT Alamat Kelurahan";
        $this->table        = new attAlamatKelurahan;
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
        $att_alamat_kotas_id     = request('att_alamat_kotas_id');
        $att_alamat_kecamatans_id = request('att_alamat_kecamatans_id');

        $this->to_return['data'] = $this->table::select(
            'att_alamat_kelurahans.id as id', 
            'att_alamat_kelurahans.kode as kode',
            'att_alamat_kelurahans.kode_kelurahan as kode_kelurahan',
            'att_alamat_kelurahans.nama as nama',
            'att_alamat_kelurahans.att_alamat_kecamatans_id as att_alamat_kecamatans_id',
            'att_alamat_kecamatans.att_alamat_kotas_id as att_alamat_kotas_id',
            'att_alamat_kelurahans.user_id as user_id',
            'att_alamat_kelurahans.created_at as created_at',
            'att_alamat_kelurahans.updated_at as updated_at',
        )
        ->join('att_alamat_kecamatans', 'att_alamat_kelurahans.att_alamat_kecamatans_id', '=', 'att_alamat_kecamatans.id')
        ->where(function($q) use($att_alamat_kotas_id){
            if($att_alamat_kotas_id != ''){
                $q->where('att_alamat_kecamatans.att_alamat_kotas_id',  $att_alamat_kotas_id);
            }
        })
        ->where(function($q) use($att_alamat_kecamatans_id){
            if($att_alamat_kecamatans_id != ''){
                return $q->where('att_alamat_kecamatans_id', $att_alamat_kecamatans_id);
            }
        })
        ->paginate($this->paging);
        //return $this->to_return['data'];
        return view($this->view_index, $this->to_return);
    }

    public function edit($id)
    {   
        $att_alamat_kotas_id     = request('att_alamat_kotas_id');
        $att_alamat_kecamatans_id = request('att_alamat_kecamatans_id');

        $this->to_return['data'] = $this->table::select(
            'att_alamat_kelurahans.id as id', 
            'att_alamat_kelurahans.kode as kode',
            'att_alamat_kelurahans.kode_kelurahan as kode_kelurahan',
            'att_alamat_kelurahans.nama as nama',
            'att_alamat_kelurahans.att_alamat_kecamatans_id as att_alamat_kecamatans_id',
            'att_alamat_kecamatans.att_alamat_kotas_id as att_alamat_kotas_id',
            'att_alamat_kelurahans.user_id as user_id',
            'att_alamat_kelurahans.created_at as created_at',
            'att_alamat_kelurahans.updated_at as updated_at',
        )
        ->join('att_alamat_kecamatans', 'att_alamat_kelurahans.att_alamat_kecamatans_id', '=', 'att_alamat_kecamatans.id')
        ->where(function($q) use($att_alamat_kotas_id){
            if($att_alamat_kotas_id != ''){
                $q->where('att_alamat_kecamatans.att_alamat_kotas_id',  $att_alamat_kotas_id);
            }
        })
        ->where(function($q) use($att_alamat_kecamatans_id){
            if($att_alamat_kecamatans_id != ''){
                return $q->where('att_alamat_kecamatans_id', $att_alamat_kecamatans_id);
            }
        })
        ->paginate($this->paging);
        //return $this->to_return['data'];
       
        $this->to_return['itm']  = $this->table::find($id);
        return view($this->view_edit, $this->to_return);
    }

    public function store(Request $request){
        $request->validate([
            'nama' => "required|string|max:255",
            'kode' => "nullable|string|max:255|unique:att_alamat_kelurahans",
            'kode_kelurahan' => "nullable|string|max:255",
            'att_alamat_kecamatans_id' => 'required'
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
            'nama' => "required|string|max:255",
            'kode' => "nullable|string|max:255|unique:att_alamat_kelurahans,kode," . $id .',id',
            'kode_kelurahan' => "nullable|string|max:255",
            'att_alamat_kecamatans_id' => 'required'
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
            $data = $this->table::
            select("kode", "kode_kelurahan","nama", "id")
            ->where('nama', 'LIKE', '%'. $request->get('q'). '%')
            ->where(function($query) use($request){
                if($request->id_kecamatan != ''){
                    return $query->where('att_alamat_kecamatans_id', $request->id_kecamatan);
                }
            })
            ->get();
        }
        return response()->json($data);
    }
}
