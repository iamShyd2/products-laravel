<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LaundryItem;

class JobLaundryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'laundry_item_id',
        "price",
        "quantity",
        "total_price"
    ];


    public function laundry_item()
    {
      return $this->belongsTo(LaundryItem::class);
    }
}
