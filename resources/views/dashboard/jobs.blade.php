<div class="card">
  <div class="card-header">{{ $title }}</div>
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
          <td>{{ "GHC {$job->price()}" }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
