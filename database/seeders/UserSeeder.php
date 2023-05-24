<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //admin
        $admin = User::create([
            'name' => 'SuperAdmin',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'level' => '1',
            'status' => '1',
            'password' => Hash::make('mantapjiwa'),
        ]);
        $admin->assignRole('admin');

        //attribute
        $attribute = User::create([
            'name' => 'attribute',
            'email' => 'attribute@gmail.com',
            'username' => 'attribute',
            'level' => '0',
            'status' => '1',
            'password' => Hash::make('jiwamantap'),
        ]);
        $attribute->assignRole('attribute');

        //administration
        $administration = User::create([
            'name' => 'administration',
            'email' => 'administration@gmail.com',
            'username' => 'administration',
            'level' => '0',
            'status' => '1',
            'password' => Hash::make('jiwamantap'),
        ]);
        $administration->assignRole('administration');

        //kepegawaian
        $kepegawaian = User::create([
            'name' => 'kepegawaian',
            'email' => 'kepegawaian@gmail.com',
            'username' => 'kepegawaian',
            'level' => '0',
            'status' => '1',
            'password' => Hash::make('jiwamantap'),
        ]);
        $kepegawaian->assignRole('kepegawaian');




        //=============================================================
        $user = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'username' => 'user',
            'level' => '0',
            'status' => '1',
            'password' => Hash::make('jiwamantap'),
        ]);


       
    }
}
