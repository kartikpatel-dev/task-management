<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::insert([
            ['name' => 'Role List', 'slug' => 'admin.roles.index'],
            ['name' => 'Role Read', 'slug' => 'admin.roles.show'],
            ['name' => 'Role Create', 'slug' => 'admin.roles.store'],
            ['name' => 'Role Update', 'slug' => 'admin.roles.udpate'],
            ['name' => 'Role Delete', 'slug' => 'admin.roles.destroy'],

            ['name' => 'User List', 'slug' => 'admin.users.index'],
            ['name' => 'User Read', 'slug' => 'admin.users.show'],
            ['name' => 'User Create', 'slug' => 'admin.users.store'],
            ['name' => 'User Update', 'slug' => 'admin.users.udpate'],
            ['name' => 'User Delete', 'slug' => 'admin.users.destroy'],
        ]);
    }
}
