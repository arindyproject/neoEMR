<?php

namespace App\Models\Attributes\Kepegawaian;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attKepegawaianPendidikan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'ket',
        'poin',
        'log',

        'author_id',
        'edithor_id',
        'deleted_by',
        'deleted_at',
        'alasan_menghapus'
    ];


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
