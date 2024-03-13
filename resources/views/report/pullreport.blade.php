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
            <h5 class="mb-0">Agent List Dashboards</h5>

          </div>
          
        </div>
      </div>
      <div class="container">
        <form action="{{ route('admin.pullreport')}}" method="GET">
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
            <th>PlayerName</th>
            <th>ProductId</th>
            <th>GameType</th>
            <th>GameID</th>
            <th>ValidBetAmount</th>
            <th>BetAmount</th>
            <th>PayoutAmount</th>
            <th>CommissionAmount</th>
            <th>JackpotAmount</th>
            <th>JPBet</th>
          </thead>
          <tbody>
          
            @if(isset($result))
            @if(count($result) > 0)
                @foreach ($result as $res)

                <tr>
                    <td>{{$res->member_name}}</td>
                    <td>{{$res->product_code}}</td>
                    <td>{{$res->game_type_id}}</td>
                    <td>{{$res->game_id}}</td>
                    <td>{{$res->valid_bet_amount}}</td>
                    <td>{{$res->bet_amount}}</td>
                    <td>{{$res->payout_amount}}</td>
                    <td>{{$res->commission_amount}}</td>
                    <td>{{$res->jack_pot_amount}}</td>
                    <td>{{$res->jp_bet}}</td>
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
