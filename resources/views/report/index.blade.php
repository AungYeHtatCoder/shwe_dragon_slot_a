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
    background-color: #e91e63;
    /* or any color you prefer */
    color: white;
    /* optional: change text color if needed */
  }

  #search {
    margin-top: 40px;
  }
  #product {
    background-color: #CCDDEB;
    color: #e91e63;
  }
  #clear {
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
            <h5 class="mb-0">Win/lose Report</h5>
          </div>
          <div class="ms-auto my-auto mt-lg-0 mt-4">
            <div class="ms-auto my-auto">
              <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">Export</button>
            </div>
          </div>

        </div>
      </div>
      <div class="container">
        <form action="{{route('admin.report.index')}}" method="GET">
          <div class="row">
            <div class="col-md-3">
              <div class="input-group input-group-static my-3">
                <label>From</label>
                <input type="date" class="form-control" id="fromDate" name="fromDate">
              </div>
            </div>
            <div class="col-md-3">
              <div class="input-group input-group-static my-3">
                <label>To</label>
                <input type="date" class="form-control" id="toDate" name="toDate">
              </div>
            </div>
            <div class="col-md-3">
              <div class="input-group input-group-static my-3">
                <label>Player</label>
                <input type="text" class="form-control" id="player_name" name="player_name" value="{{Request::query('player_name')}}">
              </div>
            </div>
            <div class="col-md-3">
              <button type="submit" class="btn btn-sm btn-primary" id="search">Search</button>
            </div>
            <div class="col">
              <label for="" class="font-weight-bold">Game Type</label>
              <br>
              <button type="button" class="btn btn-sm btn-primary">All</button>
              @foreach ($gameTypes as $type)
                <button type="button" class="btn btn-sm" id="product">{{$type->name}}</button>
              @endforeach
            </div>
        </form>
      </div>
    </div>


    <div class="table-responsive">
      <table class="table table-flush" id="users-search">
        <thead class="thead-light bg-gradient-info  ">
          <tr>
            <th rowspan="2" class="text-white">PlayerName</th>
            <th rowspan="2" class="text-white">Total Bet</th>
            <th rowspan="2" class="text-white">Total Valid</th>
            <th colspan="3" class="text-white">Member</th>
            <th colspan="3" class="text-white">Agent</th>
            <th rowspan="2" class="text-white">Win/Lose</th>
            <th rowspan="2" class="text-white">Action</th>
          </tr>
          <tr>
            <th class="text-white">Win/Lose</th>
            <th class="text-white">Com</th>
            <th class="text-white">Total</th>
            <th class="text-white">Win/Lose</th>
            <th class="text-white">Com</th>
            <th class="text-white">Total</th>
          </tr>
        </thead>
        <tbody>\
          <tr>
            <td>

            </td>
          </tr>
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
{{-- <script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: true
    });
  </script> --}}
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
</script>
@endsection