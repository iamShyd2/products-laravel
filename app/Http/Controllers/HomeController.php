<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Job;
use App\Models\LaundryItem;
use Spatie\Activitylog\Models\Activity;

class HomeController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
      $user = auth()->user();
      if($user->hasRole("Staff"))
      {
        return redirect()->route('customers.index');
      }elseif($user->hasRole("Super Admin"))
      {
        return redirect()->route('admin.index');
      }elseif($user->hasRole("Manager"))
      {
        return redirect()->route("manager.index");
      }
    }
}
