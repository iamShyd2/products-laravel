@extends('layouts.app')
@section('content')
<div class="d-flex">
  @include("sidebar")
  <div id="main">
    @include('nav', ['title' => "Edit Laundry Item"])
    <div id="app" class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="card">
                  <div class="card-header">Edit Laundry Item</div>

                  <div class="card-body">
                      <form method="POST" action="{{ route('laundry_items.update', [$laundry_item]) }}">
                          @csrf
                          {{ method_field('PUT') }}
                          <div class="form-group row">
                              <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                              <div class="col-md-6">
                                  <input id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $laundry_item->name }}" autofocus>
                                  @error('name')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="price" class="col-md-4 col-form-label text-md-right">Price</label>

                              <div class="col-md-6">
                                  <input id="price" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $laundry_item->price }}">
                                  @error('price')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>

                          <div class="form-group row mb-0">
                              <div class="col-md-8 offset-md-4">
                                  <button type="submit" class="btn btn-primary">
                                      Update Laundry Item
                                  </button>
                              </div>
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
