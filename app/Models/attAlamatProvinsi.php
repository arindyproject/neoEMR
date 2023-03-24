<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attAlamatProvinsi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode', 
        'nama', 
        'user_id'
    ];

    public function author(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function kota(){
        return $this->hasMany('App\Models\attAlamatKota', 'att_alamat_provinsis_id');
    }

    public function kecamatan(){
        return $this->hasManyThrough(
            attAlamatKecamatan::class,
            attAlamatKota::class, 
            'att_alamat_provinsis_id',
            'att_alamat_kotas_id', 
            
        );
    }

  
}
