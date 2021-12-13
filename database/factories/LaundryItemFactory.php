<?php

namespace Database\Factories;

use App\Models\LaundryItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class LaundryItemFactory extends Factory
{

    protected $model = LaundryItem::class;

    public function definition()
    {
        return[
          "name" => "Laundry Item",
          "price" => "1"
        ];
    }

}
