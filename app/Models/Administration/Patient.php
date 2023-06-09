<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_rm',
        'title',
        'full_name', 
        'place_of_birth',
        'birthDate',
        'identity_number',
        'identity_type_id',
        'maritalStatus_id',
        'gender_id',

        'no_bpjs',
        'jenis_bpjs_id',
        'kelas_bpjs',

        'is_pasien_gratis',
        'ket_pasien_gratis',
        'author_pasien_gratis_id',
        'pasien_gratis_at',
        
        'no_tlp',

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
        'activated_by',
        'activated_at',

        'author_id',
        'edithor_id',
    ];

    //--------------------------------------------------------------------------
    public $incrementing = false;
    protected $keyType = 'string';

    public static function boot()
    {
        parent::boot();

        static::creating(function ($pasien) {
            $pasien->no_rm = static::generateNomorRm();
        });

        static::deleting(function ($pasien) {
            // hapus record pasien dari database
            $pasien->delete();
            
            // update nomor_rm dari record selanjutnya
            $nextPasien = static::where('id', '>', $pasien->id)->orderBy('id', 'asc')->first();
            if ($nextPasien) {
                $nextPasien->no_rm = str_pad((string) $nextPasien->id, 6, '0', STR_PAD_LEFT);
                $nextPasien->save();
            }
        });
    }

    public static function generateNomorRm()
    {
        $lastRecord = static::orderBy('id', 'desc')->first();

        if (! $lastRecord) {
            return '000000';
        }

        $lastId = (int) $lastRecord->no_rm;

        return str_pad((string) $lastId + 1, 6, '0', STR_PAD_LEFT);
    }
    //--------------------------------------------------------------------------

    public function full_address(){
        return $this->address_alamat . ' ' .
        ($this->address_kelurahan_id != '' ? $this->kelurahan->nama .' ,' : '').
        ($this->address_kecamatan_id != '' ? $this->kecamatan->nama .' ,' : '').
        ($this->address_kota_id != '' ? $this->kota->nama .' ,' : '').
        ($this->address_provinsi_id != '' ? $this->provinsi->nama  : '');
    }

    public function usia(){
        return \Carbon\Carbon::parse($this->birthDate)->diff(\Carbon\Carbon::now())->format('%y Tahun, %m Bulan, %d Hari');
    }

    public function jenis_bpjs(){
        return $this->belongsTo('App\Models\Attributes\attJenisBpjs', 'jenis_bpjs_id');
    }

    public function kelurahan(){
        return $this->belongsTo('App\Models\Attributes\attAlamatKelurahan', 'address_kelurahan_id');
    }

    public function kecamatan(){
        return $this->belongsTo('App\Models\Attributes\attAlamatKecamatan', 'address_kecamatan_id');
    }

    public function kota(){
        return $this->belongsTo('App\Models\Attributes\attAlamatKota', 'address_kota_id');
    }

    public function provinsi(){
        return $this->belongsTo('App\Models\Attributes\attAlamatProvinsi', 'address_provinsi_id');
    }


    public function gender(){
        return $this->belongsTo('App\Models\Attributes\attJenisKelamin', 'gender_id');
    }

    public function identityType(){
        return $this->belongsTo('App\Models\Attributes\attJenisKartuIdentitas', 'identity_type_id');
    }

    public function maritalStatus(){
        return $this->belongsTo('App\Models\Attributes\attJenisPernikahan', 'maritalStatus_id');
    }

    public function agama(){
        return $this->belongsTo('App\Models\Attributes\attJenisAgama', 'agama_id');
    }

    public function kewarganegaraan(){
        return $this->belongsTo('App\Models\Attributes\attAlamatCountry', 'kewarganegaraan_id');
    }

    public function pendidikan(){
        return $this->belongsTo('App\Models\Attributes\attJenisPendidikan', 'pendidikan_id');
    }

    public function pekerjaan(){
        return $this->belongsTo('App\Models\Attributes\attJenisPekerjaan', 'pekerjaan_id');
    }

    public function author(){
        return $this->belongsTo('App\Models\User', 'author_id');
    }

    public function edithor(){
        return $this->belongsTo('App\Models\User', 'edithor_id');
    }

    public function activator(){
        return $this->belongsTo('App\Models\User', 'activated_by');
    }


    public function authorGratis(){
        return $this->belongsTo('App\Models\User', 'author_pasien_gratis_id');
    }

    //-----------------------------------------------------------------------
    public function files(){
        return $this->hasMany('App\Models\Administration\PatientFile', 'patient_id');
    }
    //-----------------------------------------------------------------------

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
            "period"       : {
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
            "period"   : {
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
            "period"   : {
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
            "period"   : {
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
                "period"   : {
                    "start" : "",
                    "end"   : ""
                }
            },
            "telecom"       : {
                "system"    : "",
                "value"     : "",
                "use"       : "",
                "rank"      : "",
                "period"   : {
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
                "period"   : {
                    "start" : "",
                    "end"   : ""
                }
            },
            "gender"        : "",
            "period"        : {
                "start" : "",
                "end"   : ""
            },
            "organization"  : ""
        }]',
        //deceased----------------
        'deceased'  => '{
            "deceasedBoolean" : false,
            "deceasedDateTime": ""	
        }'
    ];
}
