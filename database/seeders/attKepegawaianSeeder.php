<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Attributes\attKepegawaianPendidikan;
use App\Models\Attributes\attKepegawaianProfesi;

class attKepegawaianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            [
                "nama" => 'D3',
                'author_id' => 1
            ],
            [
                "nama" => 'S1',
                'author_id' => 1
            ],
        );
        foreach ($data as $key => $d) {
            attKepegawaianPendidikan::create($d);
        }

        $data = array(
            [
                "nama" => 'Dokter',
                'jenis_profesi' => 'NAKES',
                'author_id' => 1
            ],
            [
                "nama" => 'Perawat',
                'jenis_profesi' => 'NAKES',
                'author_id' => 1
            ],
            [
                "nama" => 'Pendaftaran',
                'jenis_profesi' => 'NON_NAKES',
                'author_id' => 1
            ],
        );
        foreach ($data as $key => $d) {
            attKepegawaianProfesi::create($d);
        }
    }
}
