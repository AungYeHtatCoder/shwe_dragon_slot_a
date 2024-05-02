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

        th,
        td {
            border: 1px solid !important;
            vertical-align: middle;
        }
    </style>
@endsection
@section('content')
    <div class="row mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Date</th>
                    <th>Username</th>
                    <th>Product<br></th>
                    <th>Stake<br></th>
                    <th>Payout</th>
                    <th>Win/Lose</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $report)
                    <tr>
                        <th>{{ $report->id }}</th>
                        <td>{{ $report->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>{{ $user->user_name }}</td>
                        <td>{{ $report->product->name }}</td>
                        <td>{{ $report->bet_amount }}</td>
                        <td>{{ $report->payout_amount }}</td>
                        <td>{{ $report->payout_amount - $report->bet_amount }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4">Total</td>
                    <td>{{ $total_bet_amount = $reports->sum('bet_amount') }}</td>
                    <td>{{ $total_payout_amount = $reports->sum('payout_amount') }}</td>
                    <td>{{ $total_payout_amount - $total_bet_amount }}</td>
                </tr>
            </tbody>
        </table>
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
