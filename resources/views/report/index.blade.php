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
  background-color: #e91e63; /* or any color you prefer */
  color: white; /* optional: change text color if needed */
  }
  #search {
    margin-top: 40px;
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
            <h5 class="mb-0">Winlose Report</h5>
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
        </form>
        
      </div>
    </div>
     
      
      <div class="table-responsive">
        <table class="table table-flush" id="users-search">
          <thead class="thead-light">
            <th>PlayerName</th>
            <th>Total Bet</th>
            <th>Total Valid</th>
            <th>Win/Lose</th>
            <th>Action</th>
          </thead>
          <tbody>\
            {{-- kzt --}}
            @if(isset($report))
            @if(count($report)>0)
            @foreach ($report as $res)
              <tr>
                <td>{{$res->user_name}}</td>
                <td>{{ $res->total_bet_amount}}</td>
                <td>{{ $res->total_valid_amount}}</td>
                  @if($res->total_transaction_amount > 0)
                    <td class="text-sm text-success font-weight-normal">{{$res->total_transaction_amount}}</td>
                    @else
                    <td class="text-sm text-danger font-weight-normal">{{$res->total_transaction_amount}}</td>
                    @endif
                    <td>
                <a href="{{ route('admin.report.show', $res->user_id) }}" data-bs-toggle="tooltip" data-bs-original-title="View Report" class="btn btn-info btn-sm">
                  <i class="fas fa-right-left text-white me-1"></i>
                  View
                </a>
                </td>
              </tr>
            @endforeach
            @else
            <tr>
              <td col-span=8>
                There was no Agents.
              </td>
            </tr>
            @endif
            @endif
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