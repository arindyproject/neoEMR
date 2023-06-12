<?php

namespace App\Models\Attributes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attAlamatKecamatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode', 
        'nama', 
        'user_id',

        'kode_kecamatan',
        'att_alamat_kotas_id'
    ];

    public function author(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    

    public function kota(){
        return $this->belongsTo('App\Models\Attributes\attAlamatKota', 'att_alamat_kotas_id');
    }

    public function kelurahan(){
        return $this->hasMany('App\Models\Attributes\attAlamatKelurahan', 'att_alamat_kecamatans_id');
    }
}
