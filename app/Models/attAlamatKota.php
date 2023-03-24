<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attAlamatKota extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode', 
        'nama', 
        'user_id',

        'kode_kota',
        'att_alamat_provinsis_id'
    ];

    public function author(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function provinsi(){
        return $this->belongsTo('App\Models\attAlamatProvinsi', 'att_alamat_provinsis_id');
    }

    public function kecamatan(){
        return $this->hasMany('App\Models\attAlamatKecamatan', 'att_alamat_kotas_id');
    }

    public function kelurahan(){
        return $this->hasManyThrough(
            attAlamatKelurahan::class,
            attAlamatKecamatan::class, 
            'att_alamat_kotas_id',
            'att_alamat_kecamatans_id',
        );
    }
}
