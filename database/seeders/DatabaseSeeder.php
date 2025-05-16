<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\WarehouseItem;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Seed your users (if not already)
        User::updateOrCreate(
            ['email'=>'admin@example.com'],
            ['name'=>'Administrator','password'=>bcrypt('secret123'),'role'=>'admin']
        );
        User::updateOrCreate(
            ['email'=>'user@example.com'],
            ['name'=>'Regular User','password'=>bcrypt('secret123'),'role'=>'user']
        );

        // Seed your warehouse items
        $materials = [
            ['name'=>'Wood Plank','description'=>'Premium oak wood plank','quantity'=>120,'price'=>150.00],
            ['name'=>'Steel Beam','description'=>'Structural I-beam steel','quantity'=>60,'price'=>1200.50],
            ['name'=>'Nails','description'=>'Box of 100 nails','quantity'=>300,'price'=>45.99],
            ['name'=>'Screws','description'=>'Pack of 50 stainless steel screws','quantity'=>200,'price'=>80.25],
            ['name'=>'Concrete Mix','description'=>'50kg bag concrete mix','quantity'=>80,'price'=>220.00],
            ['name'=>'Paint Can','description'=>'White latex paint 5L','quantity'=>50,'price'=>350.75],
            ['name'=>'Plywood','description'=>'12mm plywood sheet','quantity'=>30,'price'=>500.00],
            ['name'=>'Glue','description'=>'Wood glue 250ml','quantity'=>100,'price'=>65.00],
        ];

        foreach ($materials as $m) {
            WarehouseItem::updateOrCreate(
                ['name'=>$m['name']],
                ['description'=>$m['description'],'quantity'=>$m['quantity'],'price'=>$m['price']]
            );
        }
    }
}
