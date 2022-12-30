<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // assign permission
        $role = Role::where('slug', 'admin')->first();

        // admin
        $admin = User::create([
            'role_id' => $role->id,
            'name' => 'Naresh',
            'email' => 'naresh@inboxtechnology.com',
            'password' => Hash::make('Naresh@123'),
            'email_verified_at' => now(),
            'status' => 'Active',
        ]);
        $admin->roles()->sync([$role->id]);
    }
}
