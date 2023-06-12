<?php

namespace App\Http\Controllers\Kepegawaian\Att;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Schema;

use App\Models\Attributes\Kepegawaian\attKepegawaianProfesi;

class JenisProfesiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:attribute|admin|kepegawaian']);

        $this->paging       = 10;
        $this->view_index   = 'attributes.kepegawaian.basic.index';
        $this->view_edit    = 'attributes.kepegawaian.basic.edit';

        
        $this->url_index    = 'attributes.kepegawaian.profesi.index';
        $this->url_edit     = 'attributes.kepegawaian.profesi.edit';
        $this->url_store    = 'attributes.kepegawaian.profesi.store';
        $this->url_update   = 'attributes.kepegawaian.profesi.update';
        $this->url_delete   = 'attributes.kepegawaian.profesi.destroy';
        $this->title        = "ATT Kepegawaian Profesi";
        $this->table        = new attKepegawaianProfesi;
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
                           'jenis_profesi'  => "required|string|max:255",
                        ];
        $this->to_select    = [
                                'jenis_profesi' => [
                                    'NAKES', 'NON_NAKES'
                                ],
                            ];
        $this->to_return    = [
            'title'     => $this->title,
            'cols'      => $this->cols,
            'url_index' => $this->url_index,
            'url_edit'  => $this->url_edit,
            'url_store' => $this->url_store,
            'url_update'=> $this->url_update,
            'url_delete'=> $this->url_delete,
            'bg'        => \App\Models\Config::get()['navbar_variants'],
            'to_select' => $this->to_select,
        ];
    }

    public function index()
    {   
        $this->to_return['data'] = $this->table::whereNull('deleted_at')->paginate($this->paging);
        return view($this->view_index, $this->to_return);
    }

    public function edit($id){
        $this->to_return['data'] = $this->table::whereNull('deleted_at')->paginate($this->paging);
        $this->to_return['itm']  = $this->table::whereNull('deleted_at')->where('id', $id)->first();
        return view($this->view_edit, $this->to_return);
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

    public function destroy($id){

    }
}
