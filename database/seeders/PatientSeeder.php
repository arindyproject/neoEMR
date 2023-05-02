<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Administration\Patient;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'full_name'         => 'Aji Ari Adam',
                'place_of_birth'    => 'Planet NameX',
                'birthDate'         => '1990-'.(string)rand(1,12).'-' .(string)rand(1,25),
                'gender_id'         => 1,
                'address_alamat'    => 'localhost',
                'bahasa'            => 'Jawa',
                'suku'              => 'Jawa',
                'author_id'         => 1,
                'active'            => 1,

                'name'              => '',
                'identifier'        => '',
                'communication'     => '',
                'address'           => '',
                'telecom'           => '',
                'contact'           => '',
                'deceased'          => '',
            ],
            [
                'full_name'         => 'Dadang Soleh',
                'place_of_birth'    => 'Planet NameX',
                'birthDate'         => '1990-'.(string)rand(1,12).'-' .(string)rand(1,25),
                'gender_id'         => 1,
                'address_alamat'    => 'localhost',
                'bahasa'            => 'Jawa',
                'suku'              => 'Jawa',
                'author_id'         => 1,
                'active'            => 1,

                'name'              => '',
                'identifier'        => '',
                'communication'     => '',
                'address'           => '',
                'telecom'           => '',
                'contact'           => '',
                'deceased'          => '',
            ],
            [
                'full_name'         => 'Arif Bento',
                'place_of_birth'    => 'Planet NameX',
                'birthDate'         => '1991-'. (string) rand(1,12).'-' .(string)rand(1,25),
                'gender_id'         => 1,
                'address_alamat'    => 'localhost',
                'bahasa'            => 'Jawa',
                'suku'              => 'Jawa',
                'author_id'         => 1,
                'active'            => 1,

                'name'              => '',
                'identifier'        => '',
                'communication'     => '',
                'address'           => '',
                'telecom'           => '',
                'contact'           => '',
                'deceased'          => '',
            ],
            [
                'full_name'         => 'Bambang',
                'place_of_birth'    => 'Planet NameX',
                'birthDate'         => '1990-'. (string) rand(1,12).'-' . (string)rand(1,25),
                'gender_id'         => 1,
                'address_alamat'    => 'localhost',
                'bahasa'            => 'Jawa',
                'suku'              => 'Jawa',
                'author_id'         => 1,
                'active'            => 0,

                'name'              => '',
                'identifier'        => '',
                'communication'     => '',
                'address'           => '',
                'telecom'           => '',
                'contact'           => '',
                'deceased'          => '',
            ],
            [
                'full_name'         => 'Tarjo',
                'place_of_birth'    => 'Planet NameX',
                'birthDate'         => '1990-'. (string) rand(1,12).'-' . (string) rand(1,25),
                'gender_id'         => 1,
                'address_alamat'    => 'localhost',
                'bahasa'            => 'Jawa',
                'suku'              => 'Jawa',
                'author_id'         => 1,
                'active'            => 0,

                'name'              => '',
                'identifier'        => '',
                'communication'     => '',
                'address'           => '',
                'telecom'           => '',
                'contact'           => '',
                'deceased'          => '',
            ],
        ];

        foreach ($data as $key => $d) {
            Patient::create($d); 
        }
    }
}
