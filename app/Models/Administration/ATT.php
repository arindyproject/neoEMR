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

    public $TITLE_PATIENT = [
        [
            'id'    => 'BY',
            'name'  => 'BY.'
        ],
        [
            'id'    => 'AN',
            'name'  => 'AN.'
        ],
        [
            'id'    => 'SDR/i',
            'name'  => 'SDR/i.'
        ],
        [
            'id'    => 'TN',
            'name'  => 'TN.'
        ],
        [
            'id'    => 'NY',
            'name'  => 'NY.'
        ],
        [
            'id'    => 'NN',
            'name'  => 'NN.'
        ],
        [
            'id'    => 'MR',
            'name'  => 'MR.'
        ],
        [
            'id'    => 'MRS',
            'name'  => 'MRS.'
        ],
        [
            'id'    => 'dr',
            'name'  => 'dr.'
        ],

        [
            'id'    => 'DR',
            'name'  => 'DR.'
        ],
    ];
}