<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
          "image" => "/images/Global-Running-Footwear-Market.jpg",
          "cost_price" => 10,
          "selling_price" => 20,
          "units" => 2,
        ];
    }

}
