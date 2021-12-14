<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
      "name",
      "image",
      "selling_price",
      "cost_price",
      "units",
    ];


    public function scopeShortage($query)
    {
       return $query->where('units', '<', 5);
    }

}
