<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Cviebrock\EloquentSluggable\Sluggable;

class PatientFile extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'patient_id',
        'title',
        'slug',
        'file',
        'ket',
        'author_id',
        'edithor_id'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    public function patient(){
        return $this->belongsTo('App\Models\Administration\Patient', 'patient_id');
    }

    public function author(){
        return $this->belongsTo('App\Models\User', 'author_id');
    }

    public function edithor(){
        return $this->belongsTo('App\Models\User', 'edithor_id');
    }
}
