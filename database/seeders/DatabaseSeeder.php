<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\WarehouseItem;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create an admin and a regular user
        User::updateOrCreate(
            ['email'=>'admin@example.com'],
            ['name'=>'Administrator','password'=>bcrypt('secret123'),'role'=>'admin']
        );
        User::updateOrCreate(
            ['email'=>'user@example.com'],
            ['name'=>'Regular User','password'=>bcrypt('secret123'),'role'=>'user']
        );

        // Some demo items
        WarehouseItem::factory()->count(10)->create();
    }
}
