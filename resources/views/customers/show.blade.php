@extends('layouts.app')
@section('content')
<div class="d-flex">
  @include("sidebar")
  <div id="main">
    @include('nav', ['title' => "Show Customer"])
    <div id="app" class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="card p-3">
                <div class="">
                  <h3>Customer details</h3>
                  <p>Name: {{ $customer->name }}</p>
                  <p>Gender: {{ $customer->gender }}</p>
                </div>
                <div class="">
                  <h3>Contact details</h3>
                  <p>Phone number: {{ $customer->phone }}</p>
                  <p>Email: {{ $customer->email }}</p>
                </div>
                <div class="">
                  <h3>Address</h3>
                  <p>{{ $customer->address }}</p>
                </div>
              </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection
