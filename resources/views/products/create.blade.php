@extends('layouts.app')
@section('content')
<div class="d-flex">
  @include("sidebar")
  <div id="main">
    @include('nav', ['title' => "New Product"])
    <div id="app" class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="card">
                  <div class="card-header">{{ __('New Product') }}</div>

                  <div class="card-body">
                      <form method="POST" action="{{ route('products.store') }}" enctype= multipart/form-data>
                          @csrf

                          @include('shared/_image')

                          @include('shared/_text', ["name" => "name"])
                          @include('shared/_text', ["name" => "cost_price"])
                          @include('shared/_text', ["name" => "selling_price"])
                          @include('shared/_text', ["name" => "units"])

                          <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                              Create Product
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
