<?php

namespace App\Http\Controllers\Kepegawaian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\Config;
use Spatie\Permission\Models\Role;

class KepegawaianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:kepegawaian|admin']);

        $this->title     = "Kepegawaian";

        $this->to_return = [
            'title'     => $this->title,
            'bg'        => Config::get()['navbar_variants'],
        ];
    }

    public function index(){
        return view('kepegawaian.index', $this->to_return);
    }
}
