<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Administration\AdministrationPayment;

class AdministrationPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            [
                "id" => '1' , 
                "code" => 'U',
                "name" => 'Umum',
                "type" => 'TUNAI',
                "ket"  => 'dibayar tunai atau cash',
                'author_id' => 1
            ],
            [
                "id" => '2' , 
                "code" => 'B',
                "name" => 'BPJS',
                "type" => 'BPJS',
                "ket"  => 'dibayar oleh BPJS',
                'author_id' => 1
            ],
            [
                "id" => '3' , 
                "code" => 'A',
                "name" => 'Asuransi',
                "type" => 'ASURANSI',
                "ket"  => 'dibayar oleh Perusahaan Asuransi',
                'author_id' => 1
            ],
            [
                "id" => '4' , 
                "code" => 'G',
                "name" => 'Gratis',
                "type" => 'GRATIS',
                "ket"  => 'GRATIS',
                'author_id' => 1
            ],
        );
        foreach ($data as $key => $d) {
            if(!AdministrationPayment::find($d['id'])){
                AdministrationPayment::insert($d);
            }
        }
    }
}
