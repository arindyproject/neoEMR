<?php

namespace App\Http\Controllers\Attributes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Schema;

use App\Models\attJenisPernikahan;

class JenisPernikahanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:attribute|admin']);

        $this->paging       = 10;
        $this->view_index   = 'attributes.jenis.basic.index';
        $this->view_edit    = 'attributes.jenis.basic.edit';

        
        $this->url_index    = 'attributes.jenis.pernikahan.index';
        $this->url_edit     = 'attributes.jenis.pernikahan.edit';
        $this->url_store    = 'attributes.jenis.pernikahan.store';
        $this->url_update   = 'attributes.jenis.pernikahan.update';
        $this->url_delete   = 'attributes.jenis.pernikahan.destroy';

        $this->title        = "ATT Jenis Pernikahan";
        
        $this->table        = new attJenisPernikahan;
        $this->cols         = Schema::getColumnListing($this->table->getTable());

        $this->to_return    = [
            'title'     => $this->title,
            'cols'      => $this->cols,
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
}

