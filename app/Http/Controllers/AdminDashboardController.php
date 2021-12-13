<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Job;
use App\Models\Branch;
use App\Models\LaundryItem;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Carbon;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
      $this->middleware('auth.admin');
    }

    public function index()
    {
      $customers = Customer::all();

      $AyeduaseBranch = Branch::where(["name" => "Ayeduase"])->first();
      $KATHBranch = Branch::where(["name" => "KATH"])->first();

      $jobsAyeduase = Job::where(["branch_id" => $AyeduaseBranch->id])->get();
      $jobsKATH = Job::where(["branch_id" => $KATHBranch->id])->get();

      $AyeduaseSum = Job::where([
        "state" => "Paid",
        "branch_id" => $AyeduaseBranch->id
      ])
      ->whereMonth("created_at", Carbon::now()->month)
      ->sum('total_price');

      $KATHSum = Job::where([
        "state" => "Paid",
        "branch_id" => $KATHBranch->id
      ])
      ->whereMonth("created_at", Carbon::now()->month)
      ->sum('total_price');

      $activities = Activity::all();
      return view("dashboard.admin", [
        "customers" => $customers,
        "jobsAyeduase" => $jobsAyeduase,
        "jobsKATH" => $jobsKATH,
        "activities" => $activities,
        "KATHSum" => $KATHSum,
        "AyeduaseSum" => $AyeduaseSum
      ]);
    }
}
