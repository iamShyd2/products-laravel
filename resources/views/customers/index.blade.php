@extends('layouts.app')
@section('content')
<div class="d-flex">
  @include("sidebar")
  <div id="main">
    @include('nav', ['title' => "Customers"])
    <div id="app" class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
              <a href="{{ route("customers.create") }}" class="btn btn-primary mb-2">New Customer</a>
              <a
                 onclick="event.preventDefault();
                               document.getElementById('messages-form').submit();"
                class="btn btn-secondary mb-2 ml-3"
                >Send Message
              </a>
              <form id="messages-form" action="{{ route("messages.create") }}" method="get" enctype="text/plain">
              </form>
              <div class="card">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col"></th>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Gender</th>
                      <th scope="col">Phone number</th>
                      <th scope="col">Email</th>
                      <th scope="col">Address</th>
                      <th scope="col">Created At</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($customers as $customer)
                      @include('customers/customer', ["customer" => $customer, "query" => $query, "key" => $loop->index])
                    @endforeach
                  </tbody>
                </table>
                {{ $customers->links() }}
              </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection
