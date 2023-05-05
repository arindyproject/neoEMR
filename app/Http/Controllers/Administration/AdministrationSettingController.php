<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Config;

class AdministrationSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:admin']);

        $this->title = "Administration Setting";
        $this->to_return = [
            'title'     => $this->title,
            'bg'        => Config::get()['navbar_variants'],
        ];
    }

    public function index(){
        $this->to_return['data'] = Config::get()['setting']['form'];
        return view('administration.setting.index', $this->to_return);
    }
}
