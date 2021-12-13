@extends('layouts.app')
@section('content')
<div class="d-flex">
  @include("sidebar")
  <div id="main">
    @include('nav', ['title' => "Laundry Items"])
    <div id="app" class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
              <a href="{{ route("laundry_items.create") }}" class="btn btn-primary mb-2">New Laundry Item</a>
              <div class="card">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Price</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($laundry_items as $laundry_item)
                      <tr>
                        <th scope="row">{{ $laundry_item->id }}</th>
                        <td>{{ $laundry_item->name }}</td>
                        <td>{{ $laundry_item->price }}</td>
                        <td>
                          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          </a>

                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item"  href="{{ route('laundry_items.edit', [$laundry_item]) }}">
                                 Edit
                              </a>
                              <a class="dropdown-item"
                                 onclick="event.preventDefault();
                                               document.getElementById('delete-laundry_item-form').submit();">
                                  {{ __('Delete') }}
                              </a>
                              <form id="delete-laundry_item-form" action="{{ route('laundry_items.destroy', [$laundry_item]) }}" method="POST" class="d-none">
                                  @csrf
                                  {{ method_field('DELETE') }}
                              </form>
                          </div>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection
