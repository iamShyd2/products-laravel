@extends('layouts.app')
@section('content')
<div class="d-flex">
  @include("sidebar")
  <div id="main">
    @include('nav', ['title' => "Show Job"])
    <div id="app" class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="card p-3">
                <div class="">
                  <h3>Customer details</h3>
                  <p>Name: {{ $job->customer->name }}</p>
                  <p>Gender: {{ $job->customer->sex }}</p>
                </div>
              </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection
