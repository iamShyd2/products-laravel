@extends('layouts.app')
@section('content')
<div class="d-flex">
  @include("sidebar")
  <div id="main">
    @include('nav', ['title' => "Edit Customer"])
    <div id="app" class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="card">
                  <div class="card-header">Edit Customer</div>

                  <div class="card-body">
                      <form method="POST" action="{{ route('customers.update', [$customer]) }}">
                          @csrf
                          {{ method_field('PUT') }}
                          <div class="form-group row">
                              <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                              <div class="col-md-6">
                                  <input id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $customer->name }}" autofocus>
                                  @error('name')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="gender" class="col-md-4 col-form-label text-md-right">Gender</label>

                              <div class="col-md-6">
                                  <select id="gender" class="form-control" name="gender">
                                    <option {{ $customer->gender == "Male" ? "selected" : '' }}>Male</option>
                                    <option {{ $customer->gender == "Female" ? "selected" : '' }}>Female</option>
                                  </select>
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="phone" class="col-md-4 col-form-label text-md-right">Phone Number</label>

                              <div class="col-md-6">
                                  <input id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $customer->phone }}">
                                  @error('phone')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                              <div class="col-md-6">
                                  <input id="email" class="form-control" name="email" value="{{ $customer->email }}">
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>

                              <div class="col-md-6">
                                  <input id="address" class="form-control" name="address" value="{{ $customer->address }}">
                              </div>
                          </div>

                          <div class="form-group row mb-0">
                              <div class="col-md-8 offset-md-4">
                                  <button type="submit" class="btn btn-primary">
                                      Update Customer
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
