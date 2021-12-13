@extends('layouts.app')
@section('content')
<div class="d-flex">
  @include("sidebar")
  <div id="main">
    @include('nav', ['title' => "Jobs"])
    <div id="app" class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="card">
                <ul class="nav">
                  <li class="nav-item">
                      <a href="/jobs" class="nav-link">All</a>
                  </li>
                  @foreach (App\Models\Job::states() as $key => $value)
                    <li class="nav-item">
                        <a href="/jobs?state={{ $value }}" class="nav-link">{{ $value }}</a>
                    </li>
                  @endforeach
                </ul>
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Phone number</th>
                      <th scope="col">Address</th>
                      <th scope="col">Branch</th>
                      <th scope="col">Shelf Code</th>
                      <th scope="col">Total items</th>
                      <th scope="col">Total price</th>
                      <th scope="col">State</th>
                      <th scope="col">Created at</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($jobs as $job)
                      @include('jobs/job')
                    @endforeach
                  </tbody>
                </table>
                {{ $jobs->links() }}
              </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection
