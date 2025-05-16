<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WarehouseItem;

class WarehouseItemSeeder extends Seeder
{
    public function run()
    {
        $samples = [
            ['name'=>'Wooden Pallet','description'=>'Standard 48x40 inch wooden shipping pallet.','quantity'=>150,'price'=>350.00],
            ['name'=>'Steel Drum','description'=>'55-gallon steel drum for liquid storage.','quantity'=>60,'price'=>1200.50],
            ['name'=>'Cardboard Box','description'=>'Medium 12x12x12 shipping box.','quantity'=>500,'price'=>25.75],
            ['name'=>'Shrink Wrap','description'=>'Clear stretch film roll, 18" x 1500 ft.','quantity'=>200,'price'=>95.00],
            ['name'=>'Bubble Wrap','description'=>'3/16" cushioning bubble roll, 12" x 175 ft.','quantity'=>100,'price'=>89.99],
            ['name'=>'Pallet Jack','description'=>'2.5 ton capacity manual pallet jack.','quantity'=>10,'price'=>23000.00],
            ['name'=>'Strapping Band','description'=>'Polypropylene strapping, 3/4" x 1000 ft.','quantity'=>300,'price'=>150.00],
            ['name'=>'Forklift Tire','description'=>'Solid rubber tire for 3K-5K lb forklift.','quantity'=>25,'price'=>4500.00],
            ['name'=>'Label Printer','description'=>'Thermal label printer for warehouse labels.','quantity'=>15,'price'=>5500.00],
            ['name'=>'Safety Vest','description'=>'ANSI Class 2 hi-vis safety vest.','quantity'=>250,'price'=>299.95],
        ];

        foreach ($samples as $item) {
            WarehouseItem::create($item);
        }
    }
}
