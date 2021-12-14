@extends('layouts.app')
@section('content')
<div class="d-flex">
  @include("sidebar")
  <div id="main">
    @include('nav', ['title' => "Products"])
    <div id="app" class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <a href="{{ route("products.create") }}" class="btn btn-primary mb-2">New Product</a>
          <div class="card">
            <table class="table table-striped table-responsive-md">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Image</th>
                  <th scope="col">Name</th>
                  <th scope="col">Stock</th>
                  <th scope="col">Selling Price</th>
                  <th scope="col">Cost Price</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($products as $product)
                  @include('products/_product', ["product" => $product, "key" => $loop->index])
                @endforeach
              </tbody>
            </table>
            {{ $products->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
