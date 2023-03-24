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

class AttJenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //agama
        $data = array(
            ["id" => '1' , "nama" => 'ISLAM'],
            ["id" => '2' , "nama" => 'Katolik'],
            ["id" => '3' , "nama" => 'Kristen'],
            ["id" => '4' , "nama" => 'Hindu'],
            ["id" => '5' , "nama" => 'Buddha'],
            ["id" => '6' , "nama" => 'Konghucu'],
            ["id" => '7' , "nama" => 'Lainnya'],
            ["id" => '8' , "nama" => 'Agnostisisme'],
            ["id" => '9' , "nama" => 'Ateisme'],
        );
        foreach ($data as $key => $d) {
            if(!attJenisAgama::find($d['id'])){
                attJenisAgama::insert($d);
            }
        }

        //kelamin
        $data = array(
            ["id" => '1' , "kode" => 'L', "nama" => 'Laki-Laki'],
            ["id" => '2' , "kode" => 'P', "nama" => 'Perempuan'],
            ["id" => '3' , "kode" => 'X', "nama" => 'Lain-Lain'],
        );
        foreach ($data as $key => $d) {
            if(!attJenisKelamin::find($d['id'])){
                attJenisKelamin::insert($d);
            }
        }


        //attJenisPendidikan
        $data = array(
            ["id" => '1' , "nama" => 'Belum Sekolah'],
            ["id" => '2' , "nama" => 'Buta Huruf / Tidak Sekolah'],
            ["id" => '3' , "nama" => 'TK'],
            ["id" => '4' , "nama" => 'SD / MI'],
            ["id" => '5' , "nama" => 'SMP / MTS'],
            ["id" => '6' , "nama" => 'SMA / MA'],
            ["id" => '7' , "nama" => 'SMK'],
            ["id" => '8' , "nama" => 'D1'],
            ["id" => '9' , "nama" => 'D2'],
            ["id" => '10' , "nama" => 'D3'],
            ["id" => '11' , "nama" => 'S1 / D4'],
            ["id" => '12' , "nama" => 'S2'],
            ["id" => '13' , "nama" => 'S3'],
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
            ["id" => '1' , "nama" => 'Single'],
            ["id" => '2' , "nama" => 'Menikah'],
            ["id" => '3' , "nama" => 'Duda / Janda'],
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
        
    }
}
