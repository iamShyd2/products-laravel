<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Sequence;

class ProductsTableSeeder extends Seeder
{
    function run()
    {
      Product::factory()
              ->count(7)
              ->state(new Sequence(
                  [
                    'selling_price' => 1600,
                    'cost_price' => 2300,
                    "name" => "Multiple strap configurations",
                    "image" => "/images/B3-CL839_WSJSTO_574V_20181126102921.jpg",
                    'units' => 2,
                  ],
                  [
                    'selling_price' => 378,
                    'cost_price' => 1300,
                    'name' => "Spacious interior with top zip",
                    'image' => "/images/index.jpeg",
                    'units' => 20,
                  ],
                  [
                    'selling_price' => 378,
                    'cost_price' => 340,
                    'name' => "Interior dividers",
                    'units' => 20,
                  ],
                  ["name" => "Multiple strap"],
                  ["name" => "Multiple configurations"],
                  ["name" => "Configurations"],
                  ["name" => "Multiple"],
                ))
              ->create();
    }
}
