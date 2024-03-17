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
            <h5 class="mb-0">Win/lose Report</h5>

          </div>

        </div>
      </div>
      <div class="container">
        <form action="{{ route('admin.report.index')}}" method="GET">
          <div class="row">
            <div class="col-md-3">
              <div class="input-group input-group-static my-3">
                <label>From</label>
                <input type="datetime-local" class="form-control" id="fromDate" name="start_date">
              </div>
            </div>
            <div class="col-md-3">
              <div class="input-group input-group-static my-3">
                <label>To</label>
                <input type="datetime-local" class="form-control" id="toDate" name="end_date">
              </div>
            </div>
            <div class="col-md-3">
              <button type="submit" class="btn btn-sm btn-warning mt-5" id="search">Search</button>
            </div>
        </form>

      </div>
    </div>

    <div class="table-responsive">
      <table class="table table-flush" id="users-search">
        <thead class="thead-light">
          <th>Player Name</th>
          <th>Product Name</th>
          <th>Game Type</th>
          <th>TotalBetAmount</th>
          <th>TotalValidAmount</th>
          <th>TotalTransactionAmount</th>
          <th>Action</th>
        </thead>
        <tbody>
          @if(count($report) > 0)
          @foreach ($report as $rep)

          <tr>
            <td>{{$rep->user_name}}</td>
            <td>{{$rep->product_name}}</td>
            <td>{{$rep->game_type_name}}</td>
            <td>{{$rep->total_bet_amount}}</td>
            <td>{{$rep->total_valid_amount}}</td>
            <td>{{$rep->total_transaction_amount}}</td>
            <td>
                <a href="{{route('admin.report.detail',
                    ['user_name' => $rep->user_id , 'product' => $rep->product_id , 'game_type' => $rep->game_type_id])}}">Detail</a>
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
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
@endsection