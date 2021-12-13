@extends('layouts.app')
@section('content')
<div class="d-flex">
  @include("sidebar")
  <div id="main">
    @include('nav', ['title' => "New Message"])
    <div id="app" class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
              <div class="card">
                <div class="card-header">Selected Customers</div>
                <ul class="list-group list-group-flush">
                  @foreach ($customers as $customer)
                    <li class="list-group-item list-group-item-action">
                      {{ "{$customer->name}" }}
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card">
                  <div class="card-body">
                      <form method="POST" action="{{ route('messages.store', ["ids" => $ids]) }}">
                          @csrf

                          <div class="form-group">
                              <label for="body" class="form-label">Body</label>

                              <textarea id="body" class="form-control @error('body') is-invalid @enderror" name="body" placeholder="Type message here" autofocus>
                              </textarea>

                              @error('body')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>

                          <div class="form-group">
                              <button type="submit" class="btn btn-primary">
                                Send Message
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
