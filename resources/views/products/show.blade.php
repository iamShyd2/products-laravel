@extends('layouts.app')
@section('content')
<div class="d-flex">
  @include("sidebar")
  <div id="main">
    @include('nav', ['title' => "Product"])
    <div id="app" class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">{{ __('Product') }}</div>
                <div class="card-body">
                  <div style="width: 470px;">
                    <img src="{{ $product->image }}" class="img-responsive" />
                  </div>
                  <dl class="form-group">
                    <dt>Name</dt>
                    <dd>{{ $product->name }}</dd>
                    <dt>Selling Price</dt>
                    <dd>{{ $product->selling_price }}</dd>
                    <dt>Cost Price</dt>
                    <dd>{{ $product->cost_price }}</dd>
                    <dt>Units</dt>
                    <dd>{{ $product->units }}</dd>
                  </dl>
                  <div class="d-flex">
                    <a class="btn btn-primary d-block" href="{{ route("products.edit", [$product]) }}">Edit</a>
                    <button class="btn btn-danger ml-2" onclick="event.preventDefault();
                      document.getElementById('delete-products-{{ $product->id }}').submit();">Delete</button>
                    <form id="delete-products-{{ $product->id }}" action="{{ route('products.destroy', [$product]) }}" method="POST" class="d-none">
                        @csrf
                        {{ method_field('DELETE') }}
                    </form>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection
