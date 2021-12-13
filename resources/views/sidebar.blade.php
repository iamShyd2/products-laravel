<div id="sidebar" class="d-flex flex-column flex-shrink-0 p-3 bg-dark shadow" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-center text-decoration-none">
      <img style="width: 100%;" src="/logo.png" />
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      @if (auth()->user()->hasRole("Super Admin") || auth()->user()->hasRole("Manager"))
        <li class="nav-item">
          <a href="/" class="nav-link {{ Request::is('/') || Request::is('admin') || Request::is('manager') ? 'active' : 'text-white' }}">
            Home
          </a>
        </li>
      @endif
      @if (auth()->user()->can("view customers"))
        <li class="nav-item">
          <a href="/customers" class="nav-link {{ Request::is('customers') ? 'active' : 'text-white' }}">
            Customers
          </a>
        </li>
      @endif
      <li class="nav-item">
        <a href="/jobs" class="nav-link {{ Request::is('jobs') ? 'active' : 'text-white' }}">
          Jobs
        </a>
      </li>
      @if (auth()->user()->can("view users"))
        <li class="nav-item">
          <a href="/users" class="nav-link {{ Request::is('users') ? 'active' : 'text-white' }}">
            Users
          </a>
        </li>
      @endif
    </ul>
  </div>
