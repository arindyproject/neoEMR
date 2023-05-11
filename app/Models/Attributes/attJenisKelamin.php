<?php

namespace App\Models\Attributes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attJenisKelamin extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'nama',
        'name', 
        'user_id'
    ];

    public function author(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
