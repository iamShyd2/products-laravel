@extends('layouts.app')
@section('content')
<div class="d-flex">
  @include("sidebar")
  <div id="main">
    @include('nav', ['title' => "Show User"])
    <div id="app" class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="card p-3">
                <div class="">
                  <h3>User details</h3>
                  <p>Name: {{ $user->name }}</p>
                  <p>Gender: {{ $user->gender }}</p>
                  <p>Role: {{ $user->roles()->first()->name }}</p>
                </div>
                <div class="">
                  <h3>Contact details</h3>
                  <p>Phone number: {{ $user->phone }}</p>
                  <p>Email: {{ $user->email }}</p>
                </div>
                <div class="">
                  <h3>Address</h3>
                  <p>{{ $user->address }}</p>
                </div>
              </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection
