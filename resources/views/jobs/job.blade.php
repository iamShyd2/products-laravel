<tr>
  <th scope="row">{{ $job->id }}</th>
  <td>{{ $job->customer->name }}</td>
  <td>{{ $job->customer->phone }}</td>
  <td>{{ $job->customer->address }}</td>
  <td>{{ $job->branch->name }}</td>
  <td>{{ $job->shelf_code }}</td>
  <td>{{ $job->total_items }}</td>
  <td>{{ "GHC {$job->price()}" }}</td>
  <td>
    <div class="form-group">
      <select class="form-control" name="state" form="change-job-{{ $job->id }}-state" onchange="event.preventDefault();
                    document.getElementById('change-job-{{ $job->id }}-state').submit();">
        @foreach (App\Models\Job::states() as $key => $value)
          <option {{ $value == $job->state ? "selected" : '' }}>{{ $value }}</option>
        @endforeach
      </select>
      <form id="change-job-{{ $job->id }}-state" action="{{ route('jobs.show', [$job]) }}" method="POST" class="d-none">
          @csrf
          {{ method_field('PUT') }}
      </form>
    </div>
  </td>
  <td>{{ $job->created_at->format('d/m/Y') }}</td>
  <td>
    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
    </a>

    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('jobs.show', [$job->id]) }}">
           Show
        </a>
        @if ($job->state == "Paid")
          <a class="dropdown-item" href="{{ route("jobs.receipt", [$job]) }}">
            View Receipt
          </a>
        @endif
        @if(auth()->user()->can("destroy jobs"))
          <a class="dropdown-item"
             onclick="event.preventDefault();
                           document.getElementById('delete-jobs-form').submit();">
              {{ __('Delete') }}
          </a>
          <form id="delete-jobs-form" action="{{ route('jobs.destroy', [$job]) }}" method="POST" class="d-none">
              @csrf
              {{ method_field('DELETE') }}
          </form>
        @endif
    </div>
  </td>
</tr>
