@extends('layouts.app')
@section('content')
<div class="d-flex">
  @include("sidebar")
  <div id="main">
    @include('nav', ['title' => "Edit Product"])
    <div id="app" class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="card">
                  <div class="card-header">{{ __('Edit Product') }}</div>

                  <div class="card-body">
                      <form method="POST" action="{{ route('products.update', $product->id) }}" enctype= multipart/form-data>
                          @csrf
                          {{ method_field('PUT') }}

                          @include('shared/_image', [$product])

                          @include('shared/_text', ["name" => "name", "value" => $product->name])
                          @include('shared/_text', ["name" => "cost_price", "value" => $product->cost_price])
                          @include('shared/_text', ["name" => "selling_price", "value" => $product->selling_price])
                          @include('shared/_text', ["name" => "units", "value" => $product->units])

                          <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                              Update Product
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
