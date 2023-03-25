<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;

class AdministrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:administration|admin']);

        $this->title = "Administration";
        $this->to_return = [
            'title'     => $this->title,
            'bg'        => Config::get()['navbar_variants'],
        ];
    }


    public function index(){
        return view('administration.index', $this->to_return);
    }
}
