<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\attJenisAgama;
use App\Models\attJenisKelamin;
use App\Models\attJenisPendidikan;
use App\Models\attJenisPekerjaan;
use App\Models\attJenisPernikahan;
use App\Models\attJenisKartuIdentitas;
use App\Models\attJenisBpjs;

class AttJenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //agama
        $data = array(
            ["id" => '1' , "nama" => 'Islam'],
            ["id" => '2' , "nama" => 'Kristen'],
            ["id" => '3' , "nama" => 'Katolik'],
            ["id" => '4' , "nama" => 'Hindu'],
            ["id" => '5' , "nama" => 'Budha'],
            ["id" => '6' , "nama" => 'Konghucu'],
            ["id" => '7' , "nama" => 'Lainnya']
        );
        foreach ($data as $key => $d) {
            if(!attJenisAgama::find($d['id'])){
                attJenisAgama::insert($d);
            }
        }

        //kelamin
        $data = array(
            ["id" => '1' , "kode" => '0', "nama" => 'Tidak diketahui'],
            ["id" => '2' , "kode" => '1', "nama" => 'Laki-laki'],
            ["id" => '3' , "kode" => '2', "nama" => 'Perempuan'],
            ["id" => '4' , "kode" => '3', "nama" => 'Tidak dapat dikategorikan'],
            ["id" => '5' , "kode" => '9', "nama" => 'Tidak Berlaku'],
        );
        foreach ($data as $key => $d) {
            if(!attJenisKelamin::find($d['id'])){
                attJenisKelamin::insert($d);
            }
        }


        //attJenisPendidikan
        $data = array(
            ["id" => '1' , "nama" => 'Tidak/Belum Sekolah'],
            ["id" => '2' , "nama" => 'TK/Belum tamat SD/Sederajat'],
            ["id" => '3' , "nama" => 'SD/Sederajat'],
            ["id" => '4' , "nama" => 'SLTP/Sederajat'],
            ["id" => '5' , "nama" => 'SLTA/Sederajat'],
            ["id" => '6' , "nama" => 'Diploma I/II/III'],
            ["id" => '7' , "nama" => 'Diploma IV/Strata I'],
            ["id" => '8' , "nama" => 'Strata II/Strata III'],
        );
        foreach ($data as $key => $d) {
            if(!attJenisPendidikan::find($d['id'])){
                attJenisPendidikan::insert($d);
            }
        }


        //attJenisPekerjaan
        $data = array(
            ["id" => '1' , "nama" => 'Belum Bekerja'],
            ["id" => '2' , "nama" => 'Pelajar'],
            ["id" => '3' , "nama" => 'Mahasiswa'],
            ["id" => '4' , "nama" => 'Swasta'],
            ["id" => '5' , "nama" => 'Ibu Ramah Tangga'],
            ["id" => '6' , "nama" => 'Petani'],
            ["id" => '7' , "nama" => 'Nelayan'],
            ["id" => '8' , "nama" => 'Pedagang'],
            ["id" => '9' , "nama" => 'Guru'],
            ["id" => '10' , "nama" => 'Perawat'],
            ["id" => '11' , "nama" => 'Bidan'],
            ["id" => '12' , "nama" => 'Dokter'],
            ["id" => '13' , "nama" => 'ASN'],
            ["id" => '14' , "nama" => 'PNS'],
            ["id" => '15' , "nama" => 'PPPK'],
            ["id" => '16' , "nama" => 'TNI'],
            ["id" => '17' , "nama" => 'Polisi'],
        );
        foreach ($data as $key => $d) {
            if(!attJenisPekerjaan::find($d['id'])){
                attJenisPekerjaan::insert($d);
            }
        }


        //attJenisPernikahan
        $data = array(
            ["id" => '1' , "nama" => 'Belum Kawin'],
            ["id" => '2' , "nama" => 'Kawin'],
            ["id" => '3' , "nama" => 'Cerai Hidup'],
            ["id" => '4' , "nama" => 'Cerai Mati'],
        );
        foreach ($data as $key => $d) {
            if(!attJenisPernikahan::find($d['id'])){
                attJenisPernikahan::insert($d);
            }
        }


        //attJenisKartuIdentitas
        $data = array(
            ["id" => '1' , "nama" => 'KTP'],
            ["id" => '2' , "nama" => 'KTA'],
            ["id" => '3' , "nama" => 'Kartu Pelajar/Mahasiswa'],
            ["id" => '4' , "nama" => 'SIM'],
            ["id" => '5' , "nama" => 'Jamsostek'],
            ["id" => '6' , "nama" => 'Paspor'],
            ["id" => '7' , "nama" => 'Lainnya'],
        );
        foreach ($data as $key => $d) {
            if(!attJenisKartuIdentitas::find($d['id'])){
                attJenisKartuIdentitas::insert($d);
            }
        }


        //attJenisBpjs
        $data = array(
            ["id" => '1' , "nama" => 'BPJS Mandiri'],
            ["id" => '2' , "nama" => 'BPJS PBI - JAMKESMAS'],
            ["id" => '3' , "nama" => 'BPJS PBI - JAMKESDA'],
            ["id" => '4' , "nama" => 'BPJS PBI - SKTM'],
            ["id" => '5' , "nama" => 'BPJS Ketenagakerjaan'],
            ["id" => '6' , "nama" => 'JAMKESKAB NGAWI'],
            ["id" => '7' , "nama" => 'JAMKESDA NGAWI'],
            ["id" => '8' , "nama" => 'BPJS ASKES'],
        );
        foreach ($data as $key => $d) {
            if(!attJenisBpjs::find($d['id'])){
                attJenisBpjs::insert($d);
            }
        }
        
    }
}
