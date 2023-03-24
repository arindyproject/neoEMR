<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'slug',
        'content',
        'user_id',
        'editor_id'
    ];

    public function author(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function editor(){
        return $this->belongsTo('App\Models\User', 'editor_id');
    }
}
