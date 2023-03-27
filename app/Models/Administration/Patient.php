<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_rm',
        'full_name', 
        'place_of_birth',
        'birthDate',
        'identity_number',
        'identity_type_id',
        'maritalStatus_id',
        'gender_id',

        'postalCode',
        'address_alamat',
        'address_provinsi_id',
        'address_kota_id',
        'address_kecamatan_id',
        'address_kelurahan_id',

        'name',
        'identifier',
        'communication',
        'address',
        'telecom',
        'contact',
        'deceased',

        'photo',
        'nama_ibu',
        'bahasa',
        'suku',
        'agama_id',
        'kewarganegaraan_id',
        'pendidikan_id',
        'pekerjaan_id',

        'blood',
        'note',

        'active',
        'author_id',
        'edithor_id',
    ];

    public function usia(){
        return \Carbon\Carbon::parse($this->birthDate)->diff(\Carbon\Carbon::now())->format('%y Tahun, %m Bulan, %d Hari');
    }

    public function kelurahan(){
        return $this->belongsTo('App\Models\attAlamatKelurahan', 'address_kelurahan_id');
    }

    public function kecamatan(){
        return $this->belongsTo('App\Models\attAlamatKecamatan', 'address_kecamatan_id');
    }

    public function kota(){
        return $this->belongsTo('App\Models\attAlamatKota', 'address_kota_id');
    }

    public function provinsi(){
        return $this->belongsTo('App\Models\attAlamatProvinsi', 'address_provinsi_id');
    }


    public function gender(){
        return $this->belongsTo('App\Models\attJenisKelamin', 'gender_id');
    }

    public function identityType(){
        return $this->belongsTo('App\Models\attJenisKartuIdentitas', 'identity_type_id');
    }

    public function maritalStatus(){
        return $this->belongsTo('App\Models\attJenisPernikahan', 'maritalStatus_id');
    }

    public function agama(){
        return $this->belongsTo('App\Models\attJenisAgama', 'agama_id');
    }

    public function kewarganegaraan(){
        return $this->belongsTo('App\Models\attAlamatCountry', 'kewarganegaraan_id');
    }

    public function pendidikan(){
        return $this->belongsTo('App\Models\attJenisPendidikan', 'pendidikan_id');
    }

    public function pekerjaan(){
        return $this->belongsTo('App\Models\attJenisPekerjaan', 'pekerjaan_id');
    }

    public function author(){
        return $this->belongsTo('App\Models\User', 'author_id');
    }

    public function edithor(){
        return $this->belongsTo('App\Models\User', 'edithor_id');
    }

    protected $casts = [
        'identifier'    => 'array' ,
        'name'          => 'array' ,
        'telecom'       => 'array' ,
        'address'       => 'array' ,
        'communication' => 'array' ,
        'contact'       => 'array' ,
        'deceased'      => 'array' ,
    ];

    protected $attributes = [
        //identifier--------------------
        'identifier' => '[{
            "use"           : "",
            "type"          : {
                "coding"    : {
                    "system"        : "",
                    "version"       : "",
                    "code"          : "",
                    "display"       : "",
                    "userSelected"  : ""
                },
                "text"      : ""
            },
            "system"        : "",
            "value"         : "",
            "peroide"       : {
                "start"     : "",
                "end"       : ""
            },
            "assigner"      : ""
        }]',
        //name--------------------
        'name' => '[{
            "use"       : "",
            "text"      : "",
            "family"    : "",
            "given"     : "",
            "prefix"    : "",
            "suffix"    : "",
            "peroide"   : {
                "start" : "",
                "end"   : ""
            }
        }]',
        //telecom--------------------
        'telecom' => '[{
            "system"    : "",
            "value"     : "",
            "use"       : "",
            "rank"      : "",
            "peroide"   : {
                "start" : "",
                "end"   : ""
            }
        }]',
        //address--------------------
        'address' => '[{
            "use"       : "",
            "type"      : "",
            "text"      : "",
            "line"      : "",
            "city"      : "",
            "district"  : "",
            "state"     : "",
            "postalCode": "",
            "country"   : "",
            "peroide"   : {
                "start" : "",
                "end"   : ""
            }
        }]',
        //communication-------------------
        'communication' => '[{
            "text"          : "",
            "language"      : {
                "coding"    : {
                    "system"        : "",
                    "version"       : "",
                    "code"          : "",
                    "display"       : "",
                    "userSelected"  : ""
                },
                "text"      : ""
            }
        }]',
        //contact-------------------
        'contact' => '[{
            "relationship"  : {
                "coding"    : {
                    "system"        : "",
                    "version"       : "",
                    "code"          : "",
                    "display"       : "",
                    "userSelected"  : ""
                },
                "text"      : ""
            },
            "name"          : {
                "use"       : "",
                "text"      : "",
                "family"    : "",
                "given"     : "",
                "prefix"    : "",
                "suffix"    : "",
                "peroide"   : {
                    "start" : "",
                    "end"   : ""
                }
            },
            "telecom"       : {
                "system"    : "",
                "value"     : "",
                "use"       : "",
                "rank"      : "",
                "peroide"   : {
                    "start" : "",
                    "end"   : ""
                }
            },
            "address"       : {
                "use"       : "",
                "type"      : "",
                "text"      : "",
                "line"      : "",
                "city"      : "",
                "district"  : "",
                "state"     : "",
                "postalCode": "",
                "country"   : "",
                "peroide"   : {
                    "start" : "",
                    "end"   : ""
                }
            },
            "gender"        : "",
            "period"        : {
                "start" : "",
                "end"   : ""
            },
            "organization"  : "",
        }]',
        //deceased----------------
        'deceased'  => '{
            "deceasedBoolean" : false,
            "deceasedDateTime": ""	
        },'
    ];
}
