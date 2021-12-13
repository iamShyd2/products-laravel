<div class="card">
    <div class="card-header">Filter Customers</div>

    <div class="card-body">
        <form method="GET" action="{{ route('customers.store') }}">

            <div class="form-group">
                <label for="name" class="form-label">Name</label>
                <input id="name" class="form-control" name="filter[name]" value="{{ $query['name'] ?? '' }}">
            </div>

            <div class="form-group">
                <label for="gender" class="form-label">Gender</label>
                <select id="gender" class="form-control" name="filter[gender]">
                  <option value="" {{ !key_exists('gender', $query) || $query["gender"] == "" ? '' : 'selected' }} >Select Gender</option>
                  <option {{ key_exists('gender', $query) && $query["gender"] == 'Male' ? 'selected' : '' }}>Male</option>
                  <option {{ key_exists('gender', $query) && $query["gender"] == 'Male' ? 'selected' : '' }}>Male</option>
                </select>
            </div>

            <div class="form-group">
                <label for="phone" class="form-label">Phone Number</label>
                <input id="phone" class="form-control" name="filter[phone]" value={{ $query["phone"] ?? '' }}>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                  Filter
                </button>
            </div>
        </form>
    </div>
  </div>
