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
        $this->config    =  Config::get();
        $this->to_return = [
            'title'             => $this->title,
            'bg'                => $this->config['navbar_variants'],
            'profil_name'       => $this->config['name'],
            'profil_tag_line'   => $this->config['tag_line'],
            'profil_alamat'     => $this->config['alamat'],
            'profil_email'      => $this->config['email'],
            'profil_no_tlp'     => $this->config['no_tlp'],
            'profil_icon'       => $this->config['icon_mini'],
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
