<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username', 
        'email', 
        'name', 
        'password',
        
        'status',  //active
        'level', 
        'role',

        'gender', //gender

        'birthDate',
        'photo',
        'signature',
        'address_alamat',
  
        'no_tlp',
        'tempat_lahir',

        //json
        'identifier',
        'telecom',
        'address',
        'communication',


        'last_login_at',
        'last_login_ip',

        'poin',
        'code_in_pcare',
        'code_in_vclaim',
        'log',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',

        'identifier' => 'array' ,
        'telecom' => 'array' ,
        'address' => 'array' ,
        'communication' => 'array' ,
    ];


    protected $attributes = [
        //identifier--------------------
        'identifier' => '[{
            "use": "",
            "type": {
                "coding" : {
                    "system" : "",
                    "version" : "",
                    "code" : "",
                    "display" : "",
                    "userSelected" : ""
                },
                "text" : ""
            },
            "system": "",
            "value": "",
            "peroide": {
                "start": "",
                "end": ""
            },
            "assigner" : ""
        }]',
        //telecom--------------------
        'telecom' => '[{
            "system": "",
            "value": "",
            "use": "",
            "rank": "",
            "peroide": {
                "start": "",
                "end": ""
            }
        }]',
        //address--------------------
        'address' => '[{
            "use": "",
            "type": "",
            "text": "",
            "line": "",
            "city": "",
            "district": "",
            "state": "",
            "postalCode": "",
            "country": "",
            "peroide": {
                "start": "",
                "end": ""
            }
        }]',
        //communication-------------------
        'communication' => '[{
            "coding" : {
                "system" : "",
                "version" : "",
                "code" : "",
                "display" : "",
                "userSelected" : ""
            },
            "text" : ""
        }]',
    ];
  

    public function gender(){
        return $this->belongsTo('App\Models\attJenisKelamin', 'att_jenis_kelamins_id');
    }

}
