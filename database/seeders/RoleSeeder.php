<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'post_test.delete']);
        Permission::create(['name' => 'post_test.edit']);
        Permission::create(['name' => 'post_test.create']);
        Permission::create(['name' => 'post_test.show']);

        Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'attribute',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'administration',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'kepegawaian',
            'guard_name' => 'web'
        ]);

        $post_test_reader = Role::create([
            'name' => 'post_test.reader',
            'guard_name' => 'web'
        ]);
        $post_test_admin = Role::create([
            'name' => 'post_test.admin',
            'guard_name' => 'web'
        ]);
        $post_test_creator = Role::create([
            'name' => 'post_test.creator',
            'guard_name' => 'web'
        ]);

        $post_test_reader->givePermissionTo([
            'post_test.show'
        ]);

        $post_test_creator->givePermissionTo([
            'post_test.show',
            'post_test.edit',
            'post_test.create'
        ]);

        $post_test_admin->givePermissionTo([
            'post_test.show',
            'post_test.edit',
            'post_test.create',
            'post_test.delete'
        ]);

    }
}
