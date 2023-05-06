<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Config;

use App\Models\Administration\Patient;
use PDF;

class PatientPrintController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->title     = "Print Patient";

        $this->to_return = [
            'title'     => $this->title,
            'bg'        => Config::get()['navbar_variants'],
        ];
    }

    public function print_profil($id, $tmp = null){
        $data = Patient::find($id);
        $this->to_return['data'] = $data;
        if($tmp == null){
            $tmp = Config::get()['setting']['template']['pasien']['profil'];
        }
        $pdf = Pdf::loadView('administration.template.profil.' . $tmp, $this->to_return);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('profil '. $data->no_rm . '-' . $data->full_name . ' ' .  date('d-m-Y'). '.pdf');
    }

    public function print_card($id, $tmp = null){
        $data = Patient::find($id);
        $this->to_return['data'] = $data;
        if($tmp == null){
            $tmp = Config::get()['setting']['template']['pasien']['card'];
        }
        $pdf = Pdf::loadView('administration.template.card.' . $tmp, $this->to_return);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('card '. $data->no_rm . '-' . $data->full_name . ' ' .  date('d-m-Y'). '.pdf');
    }

    public function print_label($id, $tmp = null){
        $data = Patient::find($id);
        $this->to_return['data'] = $data;
        if($tmp == null){
            $tmp = Config::get()['setting']['template']['pasien']['label'];
        }
        $pdf = Pdf::loadView('administration.template.label.' . $tmp, $this->to_return);

        return $pdf->stream('label '. $data->no_rm . '-' . $data->full_name . ' ' .  date('d-m-Y'). '.pdf');
    }
}
