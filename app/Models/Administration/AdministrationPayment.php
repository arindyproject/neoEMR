<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdministrationPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'ket',
        'type',
        'author_id',
        'edithor_id',
        'deleted_by',
        'deleted_at'
    ];


    public function author(){
        return $this->belongsTo('App\Models\User', 'author_id');
    }

    public function edithor(){
        return $this->belongsTo('App\Models\User', 'edithor_id');
    }

    public function deletedBy(){
        return $this->belongsTo('App\Models\User', 'deleted_by');
    }
}
