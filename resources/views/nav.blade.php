<nav id='nav' class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
          {{ $title }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto d-none d-md-block">
              <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    Hello {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
              </li>
            </ul>
            <ul class="navbar-nav ml-auto d-block d-md-none">
              <li class="nav-item">
                <a href="{{ route("root") }}" class="nav-link {{ Request::is('/') ? 'active' : '' }}">
                  Home
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route("products.index") }}" class="nav-link {{ Request::is('products') ? 'active' : '' }}">
                  Products
                </a>
              </li>
            </ul>
        </div>
    </div>
</nav>
