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
        $admin = User::create([
            'name' => 'SuperAdmin',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'level' => '1',
            'status' => '1',
            'password' => Hash::make('mantapjiwa'),
        ]);
        $admin->assignRole('admin');

        $attribute = User::create([
            'name' => 'attribute',
            'email' => 'attribute@gmail.com',
            'username' => 'attribute',
            'level' => '0',
            'status' => '1',
            'password' => Hash::make('jiwamantap'),
        ]);
        $attribute->assignRole('attribute');

        $user = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'username' => 'user',
            'level' => '0',
            'status' => '1',
            'password' => Hash::make('jiwamantap'),
        ]);


        $post_reader = User::create([
            'name' => 'post_reader',
            'email' => 'post_reader@gmail.com',
            'username' => 'post_reader',
            'level' => '0',
            'status' => '1',
            'password' => Hash::make('jiwamantap'),
        ]);
        $post_reader->assignRole('post_test.reader');


        $post_creator = User::create([
            'name' => 'post_creator',
            'email' => 'post_creator@gmail.com',
            'username' => 'post_creator',
            'level' => '0',
            'status' => '1',
            'password' => Hash::make('jiwamantap'),
        ]);
        $post_creator->assignRole('post_test.creator');

        $post_admin = User::create([
            'name' => 'post_admin',
            'email' => 'post_admin@gmail.com',
            'username' => 'post_admin',
            'level' => '0',
            'status' => '1',
            'password' => Hash::make('jiwamantap'),
        ]);
        $post_admin->assignRole('post_test.admin');
    }
}
