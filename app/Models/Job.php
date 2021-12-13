<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\JobLaundryItem;
use App\Models\Branch;
use Illuminate\Support\Facades\Log;


class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_items',
        "total_price",
        "state",
        "branch_id",
        "shelf_code"
    ];

    public function price()
    {
        return $this->total_price / 100.00;
    }

    public function subtotal()
    {
        return $this->subtotal / 100.00;
    }

    public function pickup()
    {
        return $this->pickup / 100.00;
    }

    public function delivery()
    {
        return $this->delivery / 100.00;
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class)->withDefault();
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class)->withDefault();
    }

    public function job_laundry_items()
    {
        return $this->hasMany(JobLaundryItem::class);
    }

    public static function states()
    {
        return [
          "Pick up",
          "Collected",
          "Processing",
          "Washed",
          "Ironing",
          "Ironed",
          "Delivering",
          "Delivered",
          "Paid"
        ];
    }

}
