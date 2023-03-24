<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attAlamatCountry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nama',
        'alpha_2',
        'alpha_3',
        'country_code',
        'iso_3166_2',
        'region',
        'sub_region',
        'intermediate_region',
        'region_code',
        'sub_region_code',
        'intermediate_region_code',
        'user_id',
    ];

    public function author(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
