<tr>
  <th scope="row">{{ $product->id }}</th>
  <td>
    <div style="width: 100px;">
      <img class="img-responsive" src="{{ $product->image }}" />
    </div>
  </td>
  <td>{{ $product->name }}</td>
  <td>{{ $product->units }}</td>
  <td>{{ $product->selling_price }}</td>
  <td>{{ $product->cost_price }}</td>
  <td>
    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
    </a>

    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
      <a class="dropdown-item"  href="{{ route('products.edit', [$product]) }}">
        Edit
      </a>
      <a class="dropdown-item" onclick="event.preventDefault();
        document.getElementById('delete-products-{{ $product->id }}').submit();">
          {{ __('Delete') }}
      </a>
      <form id="delete-products-{{ $product->id }}" action="{{ route('products.destroy', [$product]) }}" method="POST" class="d-none">
          @csrf
          {{ method_field('DELETE') }}
      </form>
    </div>
  </td>
</tr>
