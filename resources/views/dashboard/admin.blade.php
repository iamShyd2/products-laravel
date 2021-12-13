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
          @include('shared/info_box', [
            "title" => "Customers",
            "count" => count($customers),
            "icon" => "users",
            "bg" => "warning"
          ])
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-lg-3">
          @include('shared/info_box', [
            "title" => "Ayeduase Jobs",
            "count" => count($jobsAyeduase),
            "icon" => "soap",
            "bg" => "info"
          ])
        </div>
        <div class="col-lg-3">
          @include('shared/info_box', [
            "title" => "Ayeduase Income",
            "count" => $AyeduaseSum / 100.00,
            "icon" => "money-bill",
            "bg" => "success"
          ])
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-lg-3">
          @include('shared/info_box', [
            "title" => "KATH Jobs",
            "count" => count($jobsKATH),
            "icon" => "soap",
            "bg" => "info"
          ])
        </div>
        <div class="col-lg-3">
          @include('shared/info_box', [
            "title" => "KATH Income",
            "count" => $KATHSum / 100.00,
            "icon" => "money-bill",
            "bg" => "success"
          ])
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-lg-6">
          @include('dashboard/jobs', ["jobs" => $jobsAyeduase, "title" => "Ayeduase Jobs"])
        </div>
        <div class="col-lg-6">
          @include('dashboard/jobs', ["jobs" => $jobsKATH, "title" => "KATH Jobs"])
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-lg-6">
          @include('dashboard/customers', ["customers" => $customers])
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-lg-4">
          <div class="card">
            <div class="card-header">Recent Activities</div>
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
