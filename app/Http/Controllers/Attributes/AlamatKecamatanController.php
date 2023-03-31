<?php

namespace App\Http\Controllers\Attributes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\attAlamatKecamatan;

class AlamatKecamatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:attribute|admin'])->except(['autocomplete']);

        $this->paging       = 30;
        $this->view_index   = 'attributes.alamat.kecamatan.index';
        $this->view_edit    = 'attributes.alamat.kecamatan.edit';

        $this->url_index    = 'attributes.alamat.kecamatan.index';
        $this->url_edit     = 'attributes.alamat.kecamatan.edit';
        $this->url_store    = 'attributes.alamat.kecamatan.store';
        $this->url_update   = 'attributes.alamat.kecamatan.update';
        $this->url_delete   = 'attributes.alamat.kecamatan.destroy';

        $this->title        = "ATT Alamat Kecamatan";
        $this->table        = new attAlamatKecamatan;
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
        $att_alamat_kotas_id     = request('att_alamat_kotas_id');
        $id = request('id');

        $this->to_return['data'] = $this->table::select(
            'att_alamat_kecamatans.id as id', 
            'att_alamat_kecamatans.kode as kode',
            'att_alamat_kecamatans.kode_kecamatan as kode_kecamatan',
            'att_alamat_kecamatans.nama as nama',
            'att_alamat_kecamatans.att_alamat_kotas_id as att_alamat_kotas_id',
            'att_alamat_kotas.att_alamat_provinsis_id as att_alamat_provinsis_id',
            'att_alamat_kecamatans.user_id as user_id',
            'att_alamat_kecamatans.created_at as created_at',
            'att_alamat_kecamatans.updated_at as updated_at',
        )
        ->join('att_alamat_kotas', 'att_alamat_kecamatans.att_alamat_kotas_id', '=', 'att_alamat_kotas.id')
        ->where(function($q) use($att_alamat_provinsis_id){
            if($att_alamat_provinsis_id != ''){
                $q->where('att_alamat_kotas.att_alamat_provinsis_id',  $att_alamat_provinsis_id);
            }
        })
        ->where(function($q) use($att_alamat_kotas_id){
            if($att_alamat_kotas_id != ''){
                return $q->where('att_alamat_kotas_id', $att_alamat_kotas_id);
            }
        })
        ->where(function($q) use($id){
            if($id != ''){
                $q->where('att_alamat_kecamatans.id', $id);
            }
        })
        ->paginate($this->paging);
        //return $this->to_return['data'];
        return view($this->view_index, $this->to_return);
    }

    public function edit($id)
    {   
        $att_alamat_provinsis_id = request('att_alamat_provinsis_id');
        $att_alamat_kotas_id     = request('att_alamat_kotas_id');
        $ids = request('id');

        $this->to_return['data'] = $this->table::select(
            'att_alamat_kecamatans.id as id', 
            'att_alamat_kecamatans.kode as kode',
            'att_alamat_kecamatans.kode_kecamatan as kode_kecamatan',
            'att_alamat_kecamatans.nama as nama',
            'att_alamat_kecamatans.att_alamat_kotas_id as att_alamat_kotas_id',
            'att_alamat_kotas.att_alamat_provinsis_id as att_alamat_provinsis_id',
            'att_alamat_kecamatans.user_id as user_id',
            'att_alamat_kecamatans.created_at as created_at',
            'att_alamat_kecamatans.updated_at as updated_at',
        )
        ->join('att_alamat_kotas', 'att_alamat_kecamatans.att_alamat_kotas_id', '=', 'att_alamat_kotas.id')
        ->where(function($q) use($att_alamat_provinsis_id){
            if($att_alamat_provinsis_id != ''){
                $q->where('att_alamat_kotas.att_alamat_provinsis_id',  $att_alamat_provinsis_id);
            }
        })
        ->where(function($q) use($att_alamat_kotas_id){
            if($att_alamat_kotas_id != ''){
                return $q->where('att_alamat_kotas_id', $att_alamat_kotas_id);
            }
        })
        ->where(function($q) use($ids){
            if($ids != ''){
                $q->where('att_alamat_kecamatans.id', $ids);
            }
        })
        ->paginate($this->paging);
        $this->to_return['itm']  = $this->table::find($id);
        return view($this->view_edit, $this->to_return);
    }

    public function store(Request $request){
        $request->validate([
            'nama' => "required|string|max:255",
            'kode' => "nullable|string|max:255|unique:att_alamat_kecamatans",
            'kode_kecamatan' => "nullable|string|max:255",
            'att_alamat_kotas_id' => 'required'
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
            'kode' => "nullable|string|max:255|unique:att_alamat_kecamatans,kode," . $id .',id',
            'kode_kecamatan' => "nullable|string|max:255",
            'att_alamat_kotas_id' => 'required'
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
            $data = $this->table::select("kode", "kode_kecamatan","nama", "id")
            ->where('nama', 'LIKE', '%'. $request->get('q'). '%')
            ->where(function($query) use($request){
                if($request->id_kota != ''){
                    return $query->where('att_alamat_kotas_id', $request->id_kota);
                }
            })
            ->get();
        }
        return response()->json($data);
    }
}
