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
          <div class="ms-auto my-auto mt-lg-0 mt-4">
            <div class="ms-auto my-auto">
              <a href="{{ route('admin.agent.create') }}" class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; Create 
                Agent</a>
              <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">Export</button>
            </div>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-flush" id="users-search">
          <thead class="thead-light">
            <th>#</th>
            <th>AgentName</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Balance</th>
            <th>Action</th>
            <th>Transfer</th>
          </thead>
          <tbody>\
            {{-- kzt --}}
            @if(isset($users))
            @if(count($users)>0)
            @foreach ($users as $user)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>
                <span class="d-block">{{ $user->name }}</span>

              </td>
              <td>{{$user->user_name}}</td>
              <td>{{ $user->phone }}</td>
              <td>
              <small class="badge bg-gradient-{{ $user->status == 1 ? 'success' : ($user->status == 2 ? 'danger' : 'warning') }}">{{ $user->status == 1 ? "active" : ($user->status == 2 ? "inactive" : "pending") }}</small>
            
              </td>
              <td>{{ number_format($user->balanceFloat,2) }} MMK</td>

              <td>
                @if ($user->status == 2)
                <a onclick="event.preventDefault(); document.getElementById('banUser-{{ $user->id }}').submit();" class="me-2" href="#" data-bs-toggle="tooltip" data-bs-original-title="Ban Agent">
                  <i class="fas fa-user-slash text-danger" style="font-size: 20px;"></i>
                </a>
                @elseif($user->status == 1)
                <a onclick="event.preventDefault(); document.getElementById('banUser-{{ $user->id }}').submit();" class="me-2" href="#" data-bs-toggle="tooltip" data-bs-original-title="Active Agent">
                  <i class="fas fa-user-check text-success" style="font-size: 20px;"></i>
                </a>
                @else
                <a href="" class="me-2" href="#" data-bs-toggle="tooltip" data-bs-original-title="Active Agent">
                  <i class="fas fa-user-check text-warning" style="font-size: 20px;"></i>
                </a>
                @endif
                <form class="d-none" id="banUser-{{ $user->id }}" action="{{ route('admin.agent.ban', $user->id) }}" method="post">
                  @csrf
                  @method('PUT')
                </form>


                <a class="me-1" href="{{ route('admin.agent.getChangePassword', $user->id) }}" data-bs-toggle="tooltip" data-bs-original-title="Change Password">
                  <i class="fas fa-lock text-info" style="font-size: 20px;"></i>
                </a>
                <a class="me-1" href="{{ route('admin.agent.edit', $user->id) }}" data-bs-toggle="tooltip" data-bs-original-title="Edit Agent">
                  <i class="fas fa-pen-to-square text-info" style="font-size: 20px;"></i>
                </a>
              </td>
              <td>
                <a href="{{ route('admin.agent.getCashIn', $user->id) }}" data-bs-toggle="tooltip" data-bs-original-title="Deposit To Agent" class="btn btn-info btn-sm">
                <i class="fas fa-plus text-white me-1"></i>Dep
                </a>
                <a href="{{ route('admin.agent.getCashOut', $user->id) }}" data-bs-toggle="tooltip" data-bs-original-title="WithDraw To Agent" class="btn btn-info btn-sm">
                <i class="fas fa-minus text-white me-1"></i>
                  WDL
                </a>
                <a href="{{ route('admin.logs', $user->id) }}" data-bs-toggle="tooltip" data-bs-original-title="Agent logs" class="btn btn-info btn-sm">
                  <i class="fas fa-right-left text-white me-1"></i>
                  Logs
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