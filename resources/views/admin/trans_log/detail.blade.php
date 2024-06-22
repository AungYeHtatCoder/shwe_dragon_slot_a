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
      <h5 class="mb-0">Transfer Log Detail</h5>

     </div>
     <div class="ms-auto my-auto mt-lg-0 mt-4">
      <div class="ms-auto my-auto">
       <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1 " data-type="csv" type="button"
        name="button">Export</button>
      </div>
     </div>
    </div>
   </div>
   <div class="table-responsive">
    <table class="table table-flush" id="users-search">
     <thead class="thead-light">

        <tr>
            <th>Date</th>
            <th>To User</th>
            <th>Amount</th>
            <th>Type</th>
        </tr>
    </thead>
        {{-- <tbody>
    @foreach($transferLogs as $log)
        <tr>
            <td>{{ $log->created_at }}</td>
            <td>{{ $log->targetUser->name }}</td>
            <td>
                <div class="d-flex align-items-center text-{{ $log->type == 'deposit' ? 'danger' : 'success' }} text-gradient text-sm font-weight-bold ms-auto">
                    {{ $log->type == 'deposit'}}{{ $log->amountFloat }}
                </div>
            </td>
            <td>
                @if($log->type == 'withdraw')
                    <p class="text-success">Deposit</p>
                @else
                    <p class="text-danger">Withdraw</p>
                @endif
            </td>
        </tr>
    @endforeach
</tbody> --}}

        <tbody>
    @foreach($transferLogs as $log)
        <tr>
            <td>{{ $log->created_at }}</td>
            <td>{{ $log->targetUser->name }}</td>
            <td>
                {{-- <div class="d-flex align-items-center text-{{ $log->type == 'deposit' ? 'danger' : 'success' }} text-gradient text-sm font-weight-bold ms-auto">
                    {{ $log->amountFloat }}
                </div> --}}
                @if($log->type == 'deposit')
                <p class="text-danger"> - {{ $log->amountFloat }}</p>
                @elseif($log->type == 'withdraw')
                <p class="text-success">+ {{ $log->amountFloat }}</p>
                @else
                <p>No data Fount</p>
                @endif
            </td>
            <td>
                @if($log->type == 'deposit')
                    <p class="text-danger">Withdraw</p>
                @else
                    <p class="text-success">Deposit</p>
                @endif
            </td>
        </tr>
    @endforeach
</tbody>




    </table>
   </div>
  </div>
 </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('admin_app/assets/js/plugins/datatables.js') }}"></script>
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
