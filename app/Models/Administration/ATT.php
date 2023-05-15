<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Model;

class ATT extends Model{
    public $TYPE_KUNJUNGAN = [
        [
            'id'    => 'KUNJUNGAN_SAKIT',
            'name'  => 'KUNJUNGAN SAKIT'
        ],
        [
            'id'    => 'KUNJUNGAN_SEHAT',
            'name'  => 'KUNJUNGAN SEHAT'
        ],
    ];

    public $TYPE_LAYANAN = [
        [
            'id'    => 'RAJAL',
            'name'  => 'Rawat Jalan'
        ],
        [
            'id'    => 'RANAP',
            'name'  => 'Rawat Inap'
        ],
        [
            'id'    => 'IGD',
            'name'  => 'IGD'
        ],
    ];
}