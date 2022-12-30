<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            ['name' => 'Admin', 'slug' => 'admin'],
            ['name' => 'Moderator', 'slug' => 'moderator'],
            ['name' => 'Editor', 'slug' => 'editor'],
            ['name' => 'Author', 'slug' => 'author'],
            ['name' => 'User', 'slug' => 'user'],
        ]);
    }
}
