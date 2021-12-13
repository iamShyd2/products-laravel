<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Customer;
use App\Models\LaundryItem;
use App\Models\JobLaundryItem;
use App\Models\Branch;
use Illuminate\Support\Facades\Log;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;

class JobsController extends Controller
{

  //converted to peswas
  private $per_weight_charge = 550;
  private $delivery = 500;

  public function __construct()
  {
      $this->middleware("auth");
  }

  function doValidation($request)
  {
      $request->validate([
         'laundry_items' => 'required',
         'weight' => 'required',
         "shelf_code" => "required"
     ]);
  }

  public function index(Request $request)
  {
    if(!auth()->user()->can("view jobs")) return response("", 401);
    $state = $request->state;
    if($state) $jobs = Job::where("state", "=", $state)->paginate(10);
    else $jobs = Job::paginate(10);
    return view("jobs.index", ["jobs" => $jobs]);
  }

  public function show($id)
  {
    if(!auth()->user()->can("view jobs")) return response("", 401);
    $job = Job::find($id);
    return view("jobs.show", ["job" => $job]);
  }

  public function create(Request $request, $id)
  {
    if(!auth()->user()->can("store jobs")) return response("", 401);
    $customer = Customer::find($id);
    $branches = Branch::all();
    return view("jobs.create", [
      "customer" => $customer,
      "branches" => $branches
    ]);
  }

  public function store(Request $request, $id)
  {
    if(!auth()->user()->can("store jobs")) return response("", 401);
    $this->doValidation($request);
    $customer = Customer::find($id);
    $job = new Job;
    $user = auth()->user();
    if($user->hasRole("Super Admin"))
    {
      $job->branch_id = $request->branch_id;
    }else
    {
      $job->branch_id = $user->branch_id;
    }
    $job->shelf_code = $request->shelf_code;

    $job->user_id = $user->id;
    $job->customer_id = $customer->id;

    $job->weight = $request->weight;
    $job->per_weight_charge = $this->per_weight_charge;

    $job->subtotal = $job->per_weight_charge * $job->weight;
    $job->total_price = $job->subtotal;

    $job->delivery = $this->delivery;
    $job->total_price += $job->delivery;

    if($request->pickup)
    {
        $job->pickup = $this->delivery;
        $job->total_price += $job->pickup;
        $job->state = "Pick up";
    }else
    {
        $job->state = "Collected";
    }
    $job->save();
    $lis = $request->all()["laundry_items"];
    $names = array_column($lis, "name");
    $quantities = array_column($lis, "quantity");
    $total_count = 0;
    for ($i=0; $i < count($lis); $i++) {
      $li = LaundryItem::firstOrCreate([
        "name" => $names[$i],
        "price" => ""
      ]);
      $quantity = $quantities[$i];
      JobLaundryItem::create(
        [
          "job_id" => $job->id,
          "laundry_item_id" => $li->id,
          "quantity" => $quantity,
          "price" => "",
          "total_price" => ""
        ]
      );
      $total_count += $quantity;
    };

    $job->update([
      "total_items" => $total_count
    ]);

    activity()
     ->performedOn($job)
     ->causedBy($user)
     ->log('created a job');

    return redirect()
      ->route('jobs.index')
      ->with('success','Job created successfully.');
  }

  public function destroy($id)
  {
    if(!auth()->user()->can("destroy jobs")) return response("", 401);
    $user = auth()->user();
    $job = Job::find($id);
    $job->destroy($id);

    activity()
     ->performedOn($job)
     ->causedBy($user)
     ->log('deleted a job');

    return redirect()
      ->route('jobs.index')
      ->with('success','Job deleted successfully.');
  }

  protected function update(Request $request, $id)
  {
    if(!auth()->user()->can("update jobs")) return response("", 401);
    $user = auth()->user();
    $job = Job::find($id);
    $job->update(["state" => $request->state]);
    activity()
     ->performedOn($job)
     ->causedBy($user)
     ->log("updated a job to {$job->state}");
    if($job->state == "Paid")
    {
      $job_laundry_items = $job->job_laundry_items;
      $customer = $job->customer;

      $c = new Buyer([
        'name' => $customer->name,
        'phone' => $customer->phone,
      ]);

      $items = [];
      $item = (
        new InvoiceItem()
      )
        ->title("Service Charge")
        ->pricePerUnit($job->subtotal());
      $items[0] = $item;

      $i = 1;

      if($job->pickup != null)
      {
          $item = (
            new InvoiceItem()
          )
            ->title("Pickup Charge")
            ->pricePerUnit($job->pickup());
          $items[1] = $item;
          $i = 2;
      }

      $item = (
        new InvoiceItem()
      )
        ->title("Delivery Charge")
        ->pricePerUnit($job->delivery());
      $items[$i] = $item;

      $client = new Party([
        'name'          => config("app.name"),
        'phone'         => config("app.phone"),
      ]);

      $invoice = Invoice::make()
          ->seller($client)
          ->buyer($c)
          //->taxRate(15)
          //->shipping(1.99)
          ->status("paid")
          ->currencySymbol('₵')
          ->currencyCode('GHS')
          ->currencyFormat('{SYMBOL}{VALUE}')
          ->currencyThousandsSeparator(',')
          ->currencyDecimalPoint('.')
          ->filename($customer->name."-".now()->format('Y-m-d'))
          ->addItems($items)
          ->logo(public_path('/logo.png'));
          //->save('public');

      return $invoice->stream(); // redirect(asset("storage/".$customer->name.'-'.now()->format('Y-m-d').".pdf"));
    }

    return redirect()
      ->route("jobs.index")
      ->with("success", "Job updated successfully");
  }

  public function receipt(Request $request, $id)
  {
    if(!auth()->user()->can("view jobs")) return response("", 401);
    $job = Job::find($id);
    if($job->state == "Paid")
    {
      $job_laundry_items = $job->job_laundry_items;
      $customer = $job->customer;

      $c = new Buyer([
        'name' => $customer->name,
        'phone' => $customer->phone,
      ]);

      $items = [];
      $item = (
        new InvoiceItem()
      )
        ->title("Service Charge")
        ->pricePerUnit($job->subtotal());
      $items[0] = $item;

      $i = 1;

      if($job->pickup != null)
      {
          $item = (
            new InvoiceItem()
          )
            ->title("Pickup Charge")
            ->pricePerUnit($job->pickup());
          $items[1] = $item;
          $i = 2;
      }

      $item = (
        new InvoiceItem()
      )
        ->title("Delivery Charge")
        ->pricePerUnit($job->delivery());
      $items[$i] = $item;

      $client = new Party([
        'name'          => config("app.name"),
        'phone'         => config("app.phone"),
      ]);

      $invoice = Invoice::make()
          ->seller($client)
          ->buyer($c)
          //->taxRate(15)
          //->shipping(1.99)
          ->status("paid")
          ->currencySymbol('₵')
          ->currencyCode('GHS')
          ->currencyFormat('{SYMBOL}{VALUE}')
          ->currencyThousandsSeparator(',')
          ->currencyDecimalPoint('.')
          ->filename($customer->name."-".now()->format('Y-m-d'))
          ->addItems($items)
          ->logo(public_path('/logo.png'));

      return $invoice->stream(); // redirect(asset("storage/".$customer->name.'-'.now()->format('Y-m-d').".pdf"));
    }
  }

}
