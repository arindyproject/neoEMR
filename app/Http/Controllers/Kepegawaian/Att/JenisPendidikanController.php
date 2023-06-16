<?php

namespace App\Http\Controllers\Kepegawaian\Att;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Schema;

use App\Models\Attributes\Kepegawaian\attKepegawaianPendidikan;
use App\Models\User;

class JenisPendidikanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:attribute|admin|kepegawaian']);

        $this->paging       = 10;
        $this->view_index   = 'attributes.kepegawaian.basic.index';
        $this->view_edit    = 'attributes.kepegawaian.basic.edit';
        $this->view_show    = 'attributes.kepegawaian.basic.show';
        $this->view_deleted = 'attributes.kepegawaian.basic.deleted';

        $this->url_index    = 'attributes.kepegawaian.pendidikan.index';
        $this->url_edit     = 'attributes.kepegawaian.pendidikan.edit';
        $this->url_store    = 'attributes.kepegawaian.pendidikan.store';
        $this->url_update   = 'attributes.kepegawaian.pendidikan.update';
        $this->url_delete   = 'attributes.kepegawaian.pendidikan.destroy';
        $this->url_show     = 'attributes.kepegawaian.pendidikan.show';
        $this->url_deleted  = 'attributes.kepegawaian.pendidikan.deleted';

        $this->title        = "ATT Kepegawaian Pendidikan";
        $this->table        = new attKepegawaianPendidikan;
        $this->cols         = Schema::getColumnListing($this->table->getTable());
        $this->not_show     = [
                                'log', 
                                'alasan_menghapus', 
                                'deleted_by' , 
                                'deleted_at'
                            ];
        $this->cols         = array_diff($this->cols, $this->not_show);
        $this->validate = [
                           'nama'           => "required|string|max:255",
                           'poin'           => "numeric|min:0",
                         ];
        $this->to_select    = [];
        $this->to_return    = [
            'title'         => $this->title,
            'cols'          => $this->cols,
            'url_index'     => $this->url_index,
            'url_edit'      => $this->url_edit,
            'url_store'     => $this->url_store,
            'url_update'    => $this->url_update,
            'url_delete'    => $this->url_delete,
            'url_show'      => $this->url_show,
            'url_deleted'   => $this->url_deleted,
            'bg'            => \App\Models\Config::get()['navbar_variants'],
            'to_select'     => $this->to_select,
        ];
    }

    public function index()
    {   
        $this->to_return['data'] = $this->table::whereNull('deleted_at')->paginate($this->paging);
        return view($this->view_index, $this->to_return);
    }

    public function deleted()
    {   
        $data = $this->table::whereNotNull('deleted_at')->paginate($this->paging);
        if(count($data) > 0){
            $this->to_return['cols'] = Schema::getColumnListing($this->table->getTable());
            $this->to_return['data'] = $data;
            return view($this->view_deleted, $this->to_return);
        }
        return redirect()->route($this->url_index)->with('error', $this->title .' Data Deleted NOT FOUND!!');
    }

    public function edit($id){
        $data =  $this->table::whereNull('deleted_at')->where('id', $id)->first();
        if($data){
            $this->to_return['data'] = $this->table::whereNull('deleted_at')->paginate($this->paging);
            $this->to_return['itm']  = $data;
            return view($this->view_edit, $this->to_return);
        }
        return redirect()->back()->with('error', $this->title .' Data NOT FOUND!!');
    }

    public function show($id){
        $data = $this->table::whereNull('deleted_at')->find($id);
        if($data){
            $this->to_return['data'] = $data;
            $this->to_return['title_2'] = "User yang menggunakan";
            $this->to_return['users']= User::paginate(20);
            return view($this->view_show, $this->to_return);
        }
        return redirect()->back()->with('error', $this->title .' Data NOT FOUND!!');
    }

    public function store(Request $request){
        $request->validate($this->validate);
        $request['author_id'] = Auth::user()->id;
        $u = $this->table::create($request->all());
        if($u){
            return redirect()->route($this->url_index)->with('success', $this->title . ' Baru berhasil ditambahkan!!');
        }else{
            return redirect()->back()->with('error', $this->title .' Baru Gagal ditambahkan!!');
        }
    }

    public function update(Request $request, $id){
        $request->validate($this->validate);
        $request['edithor_id'] = Auth::user()->id;
        $u = $this->table::find($id);

        $log = $u->log == '' ? '[]' : $u->log;
            $log = json_decode($log);
            $log_tmp = [
                'user'      => Auth::user()->name,
                'tgl'       => date('Y-m-d H:i:s'),
            ];
            foreach ($this->cols as $i) {
               if($i != 'id' && $i != 'author_id' && $i != 'edithor_id' && $i != 'created_at' && $i != 'updated_at' ){
                    $log_tmp[$i] = $request[$i];
               }
            }
            array_push($log, $log_tmp);
            $request['log']   = json_encode($log);
        if($u->update($request->all())){
            return redirect()->route($this->url_index)->with('success', $this->title . ' berhasil diUpdate!!');
        }else{
            return redirect()->back()->with('error', $this->title .' Gagal diUpdate!!');
        }
    }

    public function destroy(Request $request, $id){
        $data = $this->table::whereNull('deleted_at')->find($id);
        if($data){
            $data->deleted_by       = Auth::user()->id;
            $data->deleted_at       = date('Y-m-d H:i:s');
            $data->alasan_menghapus = $request->alasan_menghapus;
            if($data->save()){
                return redirect()->route($this->url_index)->with('success', $this->title . ' berhasil diHapus!!');
            }
        }
        return redirect()->back()->with('error', $this->title .' Gagal diHapus!!');
    }
}
