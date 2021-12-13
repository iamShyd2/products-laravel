<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Job;
use App\Models\LaundryItem;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Carbon;

class ManagerDashboardController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
      $user = auth()->user();
      $customers = Customer::all();
      $branch_id = $user->branch_id;
      $jobs = Job::where(["branch_id" => $branch_id])->get();
      $sum = Job::where([
        "branch_id" => $branch_id,
        "state" => "Paid"
      ])
      ->whereMonth("created_at", Carbon::now()->month)
      ->sum('total_price');
      $activities = Activity::all();
      return view("dashboard.index", [
        "customers" => $customers,
        "jobs" => $jobs,
        "activities" => $activities,
        "sum" => $sum
      ]);
    }
}
