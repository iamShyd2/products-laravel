@extends('layouts.app')
@section('content')
<div class="d-flex">
  <script type="text/javascript">

    var items = [

    ];

    function addItem() {
      var itemName = document.getElementById("item-name");
      var itemQuantity = document.getElementById("item-quantity");
      var itemsTableBody = document.getElementById("items-table-body");

      var tr = document.createElement("tr");
      var tdName = document.createElement("td");
      var tdQuantity = document.createElement("td");

      var nameHiddenInput = document.createElement("input");
      var quantityHiddenInput = document.createElement("input");

      var name = itemName.value;
      var quantity = itemQuantity.value;

      var size = items.length;

      nameHiddenInput.type = "hidden";
      quantityHiddenInput.type = "hidden";

      nameHiddenInput.name = `laundry_items[${size}][name]`;
      quantityHiddenInput.name = `laundry_items[${size}][quantity]`

      nameHiddenInput.value = name;
      quantityHiddenInput.value = quantity;

      tdName.innerHTML = name;
      tdQuantity.innerHTML = quantity;

      tr.appendChild(nameHiddenInput);
      tr.appendChild(quantityHiddenInput);

      tr.appendChild(tdName);
      tr.appendChild(tdQuantity);
      itemsTableBody.appendChild(tr);

      items.push({
        name,
        quantity
      })

      itemName.value = "";
      itemQuantity.value = "";
    }

  </script>
  @include("sidebar")
  <div id="main">
    @include('nav', ['title' => "New Job"])
    <div id="app" class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="card">
                  <div class="card-header">{{ "New Job for {$customer->name}" }}</div>
                  <div class="card-body">
                      <form method="POST" action="{{ route('customers.jobs.store', [$customer->id]) }}">
                          @csrf
                          <div class="form-group">
                              <label for="weight" class="form-label">Weight in Kg</label>
                              <input id="weight" class="form-control @error('weight') is-invalid @enderror" name="weight" autofocus>
                              @error('weight')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                          @if(auth()->user()->hasRole("Super Admin"))
                            <div class="form-group">
                                <label for="branch_id" class="form-label">Branch</label>
                                <select id="branch_id" class="form-control @error('branch_id') is-invalid @enderror" name="branch_id">
                                  @foreach ($branches as $key => $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                  @endforeach
                                </select>
                                @error('branch_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          @endif
                          <div class="form-group">
                              <label for="weight" class="form-label">Shelf Code</label>
                              <input id="weight" class="form-control @error('shelf_code') is-invalid @enderror" name="shelf_code" autofocus>
                              @error('shelf_code')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                          <div class="form-group">
                              <label for="pickup" class="form-label">Pick up</label>
                              <input id="pickup" name="pickup" type="checkbox">
                          </div>

                          <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Quantity</th>
                              </tr>
                            </thead>
                            <tbody id="items-table-body">
                              <tr>
                                <td>
                                  <input id="item-name" class="form-control" />
                                </td>
                                <td>
                                  <input id="item-quantity" class="form-control" />
                                </td>
                                <td>
                                  <button type="button" name="button" class="btn btn-primary" onclick="addItem()">Add Item</button>
                                </td>
                              </tr>
                            </tbody>
                          </table>

                          <div class="form-group">
                              <button type="submit" class="btn btn-primary">
                                  Create Job
                              </button>
                          </div>
                      </form>
                  </div>
              </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection
