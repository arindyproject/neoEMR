<?php

namespace App\Models\Attributes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attAlamatKelurahan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode', 
        'nama', 
        'user_id',

        'kode_kelurahan',
        'att_alamat_kecamatans_id'
    ];


    public function author(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }


    public function kecamatan(){
        return $this->belongsTo('App\Models\attAlamatKecamatan', 'att_alamat_kecamatans_id');
    }
}
