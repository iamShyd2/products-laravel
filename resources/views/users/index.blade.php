@extends('layouts.app')
@section('content')
<div class="d-flex">
  @include("sidebar")
  <div id="main">
    @include('nav', ['title' => "Users"])
    <div id="app" class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
              <a href="{{ route("users.create") }}" class="btn btn-primary mb-2">New User</a>
              <div class="card">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Gender</th>
                      <th scope="col">Role</th>
                      <th scope="col">Email</th>
                      <th scope="col">Phone</th>
                      <th scope="col">Address</th>
                      <th scope="col">Branch</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $user)
                      <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->gender }}</td>
                        <td>{{ $user->roles()->first()->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->branch->name }}</td>
                        <td>
                          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          </a>

                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="{{ route('users.show', [$user]) }}">
                                 Show
                              </a>
                              <a class="dropdown-item" href="{{ route('users.edit', [$user]) }}">
                                 Edit
                              </a>
                              <a class="dropdown-item"
                                 onclick="event.preventDefault();
                                               document.getElementById('delete-users-form').submit();">
                                  Delete
                              </a>
                              <form id="delete-users-form" action="{{ route('users.destroy', [$user]) }}" method="POST" class="d-none">
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
