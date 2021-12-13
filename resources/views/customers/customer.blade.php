<tr>
    <th>
      <input type="checkbox" name="ids[{{ $key }}]" value="{{ $customer->id }}" class="form-control" form="messages-form">
    </th>
    <th scope="row">{{ $customer->id }}</th>
    <td>{{ $customer->name }}</td>
    <td>{{ $customer->gender }}</td>
    <td>{{ $customer->phone }}</td>
    <td>{{ $customer->email }}</td>
    <td>{{ $customer->address }}</td>
    <td>{{ $customer->created_at->format('d/m/Y') }}</td>
    <td>
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('customers.show', [$customer]) }}">
               Show
            </a>
            @if (auth()->user()->can("update customer"))
              <a class="dropdown-item"  href="{{ route('customers.edit', [$customer]) }}">
                 Edit
              </a>
            @endif
            <a class="dropdown-item" href="{{ route('customers.jobs.create', [$customer]) }}">
               New Job
            </a>
            @if (auth()->user()->can("destroy customers"))
              <a class="dropdown-item"
                 onclick="event.preventDefault();
                               document.getElementById('delete-customers-form').submit();">
                  {{ __('Delete') }}
              </a>
              <form id="delete-customers-form" action="{{ route('customers.destroy', [$customer]) }}" method="POST" class="d-none">
                  @csrf
                  {{ method_field('DELETE') }}
              </form>
            @endif
        </div>
    </td>
</tr>
