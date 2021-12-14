@extends('layouts.app')
@section('content')
<div class="d-flex">
  @include("sidebar")
  <div id="main">
    @include('nav', ['title' => "Home"])
    <div id="app" class="container-fluid">
      <div class="row mb-4">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header">Shortage</div>
            <table class="table table-responsive">
              <thead>
                <tr>
                  <th scope="col">Image</th>
                  <th scope="col">Name</th>
                  <th scope="col">Units</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($products as $product)
                  <tr>
                    <td>
                      <div style="width: 100px;">
                        <img class="img-responsive" src="{{ $product->image }}" />
                      </div>
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->units }}</td>
                    <td>
                      <a  href="{{ route('products.show', [$product]) }}">
                        View
                      </a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
