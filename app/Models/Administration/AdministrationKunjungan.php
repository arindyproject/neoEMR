<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdministrationKunjungan extends Model
{
    use HasFactory;


    protected $fillable = [
        'patient_id',
        'antrian_urut',

        'payment_id',
        'payment_type',
        'payment_json',
        
        'tgl_mendaftar',
        'tgl_pemeriksaan',

        'type_kunjungan',
        'type_layanan',

        'is_online',
        'is_cekin',
        'cekin_at',


        'author_id',
        'edithor_id',
        'deleted_by',
        'deleted_at',
        'alasan_menghapus'
    ];



    public function patient(){
        return $this->belongsTo('App\Models\Administration\Patient', 'patient_id');
    }
    public function payment(){
        return $this->belongsTo('App\Models\Administration\AdministrationPayment', 'payment_id');
    }


    //------------------------------------------------------------
    public function author(){
        return $this->belongsTo('App\Models\User', 'author_id');
    }
    public function edithor(){
        return $this->belongsTo('App\Models\User', 'edithor_id');
    }
    public function deletedBy(){
        return $this->belongsTo('App\Models\User', 'deleted_by');
    }
    //------------------------------------------------------------
}
