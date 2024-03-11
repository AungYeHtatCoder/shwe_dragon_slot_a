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
  background-color: #4CAF50; /* or any color you prefer */
  color: white; /* optional: change text color if needed */
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
      <div class="table-responsive">
        <table class="table table-flush" id="users-search">
          <thead class="thead-light">
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($betDetails) && !empty($betDetails))
                <tr>
                    <td>Wager ID</td>
                    <td>{{ $betDetails['wagerId'] ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td>Transaction Amount</td>
                    <td>{{ $betDetails['transactionAmount'] ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td>Bet Amount</td>
                    <td>{{ $betDetails['betAmount'] ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td>Valid Amount</td>
                    <td>{{ $betDetails['validAmount'] ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>{{ $betDetails['status'] ?? 'N/A' }}</td>
                </tr>
                {{-- Add more rows as needed for each piece of bet detail information --}}
            @else
                <tr>
                    <td colspan="2">No bet details available.</td>
                </tr>
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