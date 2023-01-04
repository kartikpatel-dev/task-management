<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::insert([
            ['name' => 'New', 'menu_order' => 0],
            ['name' => 'Pending', 'menu_order' => 1],
            ['name' => 'In Progress', 'menu_order' => 2],
            ['name' => 'Done', 'menu_order' => 3],
            ['name' => 'Re Open', 'menu_order' => 4],
        ]);
    }
}
