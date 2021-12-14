<div id="sidebar" class="d-flex flex-column flex-shrink-0 p-3 bg-dark shadow" style="width: 280px;">
  <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-center text-decoration-none">
    <img class="img-responsive" src="/logo.png" />
  </a>
  <hr>
  <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item">
      <a href="{{ route("root") }}" class="nav-link {{ Request::is('/') ? 'active' : 'text-white' }}">
        Home
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route("products.index") }}" class="nav-link {{ Request::is('products') ? 'active' : 'text-white' }}">
        Products
      </a>
    </li>
  </ul>
</div>
