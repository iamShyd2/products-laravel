<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Log;

class CustomersController extends Controller
{

  function doValidation($request)
  {
    $request->validate([
     'name' => 'required',
     'phone' => 'required',
    ]);
  }

  public function index(Request $request)
  {
    if(!auth()->user()->can("view customers")) return redirect("401");
    $query = $request->query();
    $customers = Customer::paginate(10);
    return view("customers.index", ['customers' => $customers, 'query' => $query]);
  }

  public function show($id)
  {
    if(!auth()->user()->can("show customers")) return redirect("401");
    $customer = Customer::find($id);
    return view("customers.show", ["customer" => $customer]);
  }

  public function create()
  {
    if(!auth()->user()->can("store customers")) return redirect("401");
    return view("customers.create");
  }

  public function store(Request $request)
  {
    if(!auth()->user()->can("store customers")) return redirect("401");
    $this->doValidation($request);
    $customer = Customer::create($request->all());
    activity()
     ->performedOn($customer)
     ->causedBy(auth()->user())
     ->log('created a customer');
    return redirect()
      ->route('customers.index')
      ->with('success','Customer created successfully.');

  }

  public function edit($id)
  {
    if(!auth()->user()->can("update customers")) return redirect("401");
    $customer = Customer::find($id);
    return view("customers.edit", ["customer" => $customer]);
  }

  public function update(Request $request, $id)
  {
    if(!auth()->user()->can("update customers")) return redirect("401");
    $this->doValidation($request);
    $customer = Customer::find($id);
    $customer->update($request->all());
    activity()
     ->performedOn($customer)
     ->causedBy(auth()->user())
     ->log('updated a customer');
    return redirect()
      ->route('customers.index')
      ->with('success','Customer updated successfully.');
  }

  public function destroy($id)
  {
    if(!auth()->user()->can("destroy customers")) return redirect("401");
    $user = auth()->user();
    $customer = Customer::find($id);
    $customer->destroy($id);

    activity()
     ->performedOn($customer)
     ->causedBy($user)
     ->log('deleted a customer');

    return redirect()
      ->route('customers.index')
      ->with('success','Customer deleted successfully.');
  }

}
