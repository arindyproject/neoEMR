<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\attAlamatCountry;
use App\Models\attAlamatProvinsi;
use App\Models\attAlamatKota;
use App\Models\attAlamatKecamatan;
use App\Models\attAlamatKelurahan;
use File;

class AlamatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //attAlamatProvinsi::truncate();
        $json = File::get("database/data/country.json");
        $data = json_decode($json);

        foreach ($data as $key => $d) {
            if(!attAlamatCountry::where('alpha_3', $d->alpha_3)->first() ){
                attAlamatCountry::insert([
                    'name' => $d->name,
                    'nama' => $d->nama,
                    'alpha_2' => $d->alpha_2,
                    'alpha_3' => $d->alpha_3,
                    'country_code' => $d->country_code,
                    'iso_3166_2' => $d->iso_3166_2,
                    'region' => $d->region,
                    'sub_region' => $d->sub_region,
                    'intermediate_region' => $d->intermediate_region,
                    'region_code' => $d->region_code,
                    'sub_region_code' => $d->sub_region_code,
                    'intermediate_region_code' => $d->intermediate_region_code,
                    'user_id' => 1,
                ]);
            } 
        }


        $json = File::get("database/data/provinsi.json");
        $data = json_decode($json);

        foreach ($data as $key => $d) {
            if(!attAlamatProvinsi::find($d->id)){
                attAlamatProvinsi::insert([
                    "id" => $d->id,
                    "kode" => $d->kode,
                    "nama" => $d->nama,
                    'user_id' => 1,
                ]);
            } 
        }


        $json = File::get("database/data/kota.json");
        $data = json_decode($json);

        foreach ($data as $key => $d) {
            if(!attAlamatKota::find($d->id)){
                attAlamatKota::insert([
                    "id" => $d->id,
                    "kode" => $d->kode,
                    "nama" => $d->nama,

                    "kode_kota" => $d->kota_kode,
                    "att_alamat_provinsis_id" => $d->provinsi_id,
                    'user_id' => 1,
                ]);
            } 
        }


        $json = File::get("database/data/kecamatan.json");
        $data = json_decode($json);

        foreach ($data as $key => $d) {
            if(!attAlamatKecamatan::find($d->id)){
                attAlamatKecamatan::insert([
                    "id" => $d->id,
                    "kode" => $d->kode,
                    "nama" => $d->nama,

                    "kode_kecamatan" => $d->kecamatan_kode,
                    "att_alamat_kotas_id" => $d->kota_id,
                    'user_id' => 1,
                ]);
            } 
        }

        $json = File::get("database/data/kelurahan.json");
        $data = json_decode($json);
        
        foreach ($data as $key => $d) {
            if(!attAlamatKelurahan::find($d->id)){
                attAlamatKelurahan::insert([
                    "id" => $d->id,
                    "kode" => $d->kode,
                    "nama" => $d->nama,

                    "kode_kelurahan" => $d->kelurahan_kode,
                    "att_alamat_kecamatans_id" => $d->kecamatan_id,
                    'user_id' => 1,
                ]);
            } 
        }
         
    }
}
