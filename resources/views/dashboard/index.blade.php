@extends('layouts.app')
@section('content')
  <style>
    .info-box {
      box-shadow: 0 0 1px rgba(0,0,0,.125),0 1px 3px rgba(0,0,0,.2);
      border-radius: .25rem;
      background-color: #fff;
      display: -webkit-flex;
      display: -ms-flexbox;
      display: flex;
      margin-bottom: 1rem;
      min-height: 80px;
      padding: .5rem;
      position: relative;
      width: 100%;
  }
  .info-box .info-box-icon {
    border-radius: .25rem;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    font-size: 1.875rem;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    text-align: center;
    width: 70px;
}
.info-box .info-box-content {
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    line-height: 1.8;
    -webkit-flex: 1;
    -ms-flex: 1;
    flex: 1;
    padding: 0 10px;
}

.info-box .info-box-text, .info-box .progress-description {
    display: block;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.info-box .info-box-number {
    display: block;
    margin-top: .25rem;
    font-weight: 700;
}

.card-header{
  background-color: transparent;
}
  </style>
<div class="d-flex">
  @include("sidebar")
  <div id="main">
    @include('nav', ['title' => "Dashboard"])
    <div id="app" class="container-fluid">
      <div class="row mb-4">
        <div class="col-lg-3">
          <div class="info-box">
            <span class="info-box-icon bg-info elevation-1">
              <i class="fas fa-soap"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">Jobs</span>
              <span class="info-box-number">
                {{ count($jobs) }}
              </span>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="info-box">
            <span class="info-box-icon bg-warning elevation-1">
              <i class="fas fa-users"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">Customers</span>
              <span class="info-box-number">
                {{ count($customers) }}
              </span>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="info-box">
            <span class="info-box-icon bg-success elevation-1">
              <i class="fas fa-money-bill"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">Income</span>
              <span class="info-box-number">
                {{ $sum / 100.00 }}
              </span>
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header border-0">{{ __('New Customers') }}</div>
            <div class="card-body p-0">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Phone number</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($customers as $customer)
                    <tr>
                      <td>{{ $customer->name }}</td>
                      <td>{{ $customer->gender }}</td>
                      <td>{{ $customer->phone }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header">{{ __('New Jobs') }}</div>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Name</th>
                  <th scope="col">Phone number</th>
                  <th scope="col">Address</th>
                  <th scope="col">Total items</th>
                  <th scope="col">Total price</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($jobs as $job)
                  <tr>
                    <td>{{ $job->customer->name }}</td>
                    <td>{{ $job->customer->phone }}</td>
                    <td>{{ $job->customer->address }}</td>
                    <td>{{ $job->total_items }}</td>
                    <td>{{ "GHC {$job->total_price}" }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-lg-4">
          <div class="card">
            <div class="card-header">{{ __('Recent Activities') }}</div>
            <ul class="list-group list-group-flush">
              @foreach ($activities as $activity)
                <li class="list-group-item list-group-item-action">
                  {{ "{$activity->causer->name} {$activity->description}" }}
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
