<div class="card">
  <div class="card-header border-0">New Customers</div>
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
