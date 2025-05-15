<?php

namespace Database\Factories;

use App\Models\WarehouseItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class WarehouseItemFactory extends Factory
{
    protected $model = WarehouseItem::class;

    public function definition()
{
    return [
      'name'=>$this->faker->words(3,true),
      'description'=>$this->faker->sentence(),
      'quantity'=>$this->faker->numberBetween(1,100),
      'price'=>$this->faker->randomFloat(2,1,500),
    ];
}

}
