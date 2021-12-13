@if (auth()->user()->hasRole("staff"))
  @include('customers.index')
@else
  @include('dashboard.index')
@endif
