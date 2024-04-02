@extends('admin_layouts.app')
@section('styles')
<style>
  .transparent-btn {
    background: none;
    border: none;
    padding: 0;
    outline: none;
    cursor: pointer;
    box-shadow: none;
    appearance: none;
    /* For some browsers */
  }

  .active-button {
    background-color: #4CAF50;
    /* or any color you prefer */
    color: white;
    /* optional: change text color if needed */
  }

  #search {
    margin-top: 40px;
  }
</style>
@endsection
@section('content')
<div class="row mt-4">
  <div class="col-12">
    <div class="card">
      <!-- Card header -->
      <div class="card-header pb-0">
        <div class="d-lg-flex">
          <div>
            <h5 class="mb-0">Player Get Bet Detail</h5>
          </div>
          <div class="ms-auto my-auto mt-lg-0 mt-4">
            <div class="ms-auto my-auto">
              <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">Export</button>
            </div>
          </div>

        </div>
      </div>
      <div class="container">
        <form action="{{ route('admin.getBetDetail') }}" method="GET">
          <div class="row">
            <div class="col-md-4">
              <div class="input-group input-group-static my-3">
                <label for="fromDate">From</label>
                <input type="date" class="form-control" id="fromDate" name="fromDate" value="{{ request()->fromDate }}">
              </div>
            </div>
            <div class="col-md-4">
              <div class="input-group input-group-static my-3">
                <label for="toDate">To</label>
                <input type="date" class="form-control" id="toDate" name="toDate" value="{{ request()->toDate }}">
              </div>
            </div>
            <div class="col-md-4">
              <button type="submit" class="btn btn-warning">Search</button>
            </div>
          </div>
        </form>
        <div class="col-md-6">
          <button type="button" class="btn btn-sm date-range-button " id="today">Today</button>
          <button type="button" class="btn btn-sm date-range-button" id="yesterday">Yesterday</button>
          <button type="button" class="btn btn-sm date-range-button" id="thisWeek">ThisWeek</button>
          <button type="button" class="btn btn-sm date-range-button" id="thisMonth">ThisMonth</button>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-flush" id="users-search">
          <thead class="thead-light">
            <tr>
              <th>ID</th>
              <th>User</th>
              <th>Event ID</th>
              <th>Transaction ID</th>
              <th>Transaction Amount</th>
              <th>Bet Amount</th>
              <th>Valid Amount</th>
              <th>Status</th>
              <th>Created At</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($transactions as $transaction)
            <tr>
              <td>{{ $transaction->id }}</td>
              <td>{{ $transaction->user->name ?? 'N/A' }}</td> {{-- Assuming the User model has a name field --}}
              <td>{{ $transaction->seamless_event_id }}</td>
              <td>{{ $transaction->seamless_transaction_id }}</td>
              <td>{{ $transaction->transaction_amount }}</td>
              <td>{{ $transaction->bet_amount }}</td>
              <td>{{ $transaction->valid_amount }}</td>
              <td>{{ $transaction->status }}</td>
              <td>{{ $transaction->created_at->toFormattedDateString() }}</td>
              <td>
                <a href="{{ route('admin.getBetDetail.show', ['wagerId' => $transaction->wager_id]) }}" class="btn btn-sm btn-primary">View</a>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="9">No get bet detail found.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('admin_app/assets/js/plugins/datatables.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
<script src="https://demos.creative-tim.com/test/soft-ui-dashboard-pro/assets/js/plugins/choices.min.js"></script>
<script src="{{ asset('admin_app/assets/js/button.js') }}"></script>

<script>
  if (document.getElementById('choices-tags-edit')) {
    var tags = document.getElementById('choices-tags-edit');
    const examples = new Choices(tags, {
      removeItemButton: true
    });
  }
</script>
<script>
  if (document.getElementById('users-search')) {
    const dataTableSearch = new simpleDatatables.DataTable("#users-search", {
      searchable: true,
      fixedHeight: false,
      perPage: 7
    });
    document.querySelectorAll(".export").forEach(function(el) {
      el.addEventListener("click", function(e) {
        var type = el.dataset.type;

        var data = {
          type: type,
          filename: "material-" + type,
        };

        if (type === "csv") {
          data.columnDelimiter = "|";
        }

        dataTableSearch.export(data);
      });
    });
  };
</script>
<script>
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })

  function click() {
    document.addEventListener('DOMContentLoaded', (event) => {
      document.getElementById('today').addEventListener('click', function() {
        console.log('here');
      });
    })
  }
</script>

@endsection