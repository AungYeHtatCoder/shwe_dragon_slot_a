<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
    <title>
        ShweDragon Slot
    </title>
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700"/>
    <!-- Nucleo Icons -->
    <link href="{{ asset('admin_app/assets/css/nucleo-icons.css')}}" rel="stylesheet"/>
    <link href="{{ asset('admin_app/assets/css/nucleo-svg.css')}}" rel="stylesheet"/>
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/b829c5162c.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('admin_app/assets/css/material-dashboard.css?v=3.0.6')}}" rel="stylesheet"/>

    <script defer data-site="https://delightmyanmar.online"
            src="https://api.nepcha.com/js/nepcha-analytics.js"></script>

</head>

<body class="g-sidenav-show  bg-gray-200">


<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    <div class="container-fluid py-4">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <h5 class="mb-0">Win/Lose Detail Report</h5>
                        <form action="{{route('admin.report.detail')}}" method="GET">
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <input type="hidden" name="game_type_id" value="{{$gameType->id}}">
                            <input type="hidden" name="user_id" value="{{$player->id}}">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="input-group input-group-static my-3">
                                        <label>Product</label>
                                        <input type="text" class="form-control" id="" value="{{$product->name}}"
                                               name="description" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-static my-3">
                                        <label>Player</label>
                                        <input type="text" class="form-control" id="" value="{{$player->user_name}}"
                                               name="player_name" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-static my-3">
                                        <label>From</label>
                                        <input type="date" class="form-control" id="fromDate" name="fromDate">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-static my-3">
                                        <label>To</label>
                                        <input type="date" class="form-control" id="to" name="toDate">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-sm btn-primary">Search</button>
                                </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-flush" id="datatable-basic">
                            <thead class="thead-light">
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Result
                                    Time
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bet
                                    Amount
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Valid
                                    Amount
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Payout Amount
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Win/Lose
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($report)>0)
                                @foreach ($report as $detail)
                                    <tr>
                                        <td class="text-sm font-weight-normal">{{$detail->created_at}}</td>
                                        <td class="text-sm font-weight-normal">{{$detail->bet_amount}}</td>
                                        <td class="text-sm font-weight-normal">{{$detail->valid_amount}}</td>
                                        @php
                                            if($detail->transaction_amount > 0){
                                                $value = $detail->transaction_amount;
                                            }else{
                                                $value = $detail->bet_amount + $detail->transaction_amount;
                                            }

                                            $value = number_format($value, 2);
                                        @endphp
                                        @if($value > 0)
                                            <td class="text-sm font-weight-normal">
                                            <span
                                                class="text-success font-weight-bold">
                                                    {{$value}}
                                        </span></td>
                                        @else
                                            <td class="text-sm font-weight-normal">
                                            <span
                                                class="text-danger font-weight-bold">
                                                    {{$value}}
                                        </span></td>
                                        @endif
                                        @php
                                            if($detail->transaction_amount <= 0){
                                                $value = $detail->transaction_amount;
                                            }else{
                                                $value = $detail->transaction_amount - $detail->bet_amount;
                                            }

                                            $value = number_format($value, 2);
                                        @endphp
                                        @if($value >= 0)
                                            <td class="text-sm font-weight-normal">
                                            <span
                                                class="text-success font-weight-bold">
                                                    {{$value}}
                                        </span></td>
                                        @else
                                            <td class="text-sm font-weight-normal">
                                            <span
                                                class="text-danger font-weight-bold">
                                                    {{$value}}
                                        </span></td>
                                        @endif
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

<script src="https://kit.fontawesome.com/b829c5162c.js" crossorigin="anonymous"></script>
<script src="{{ asset('admin_app/assets/js/core/popper.min.js')}}"></script>
<script src="{{ asset('admin_app/assets/js/core/bootstrap.min.js')}}"></script>
<script src="{{ asset('admin_app/assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
<script src="{{ asset('admin_app/assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
<!-- Kanban scripts -->
<script src="{{ asset('admin_app/assets/js/plugins/dragula/dragula.min.js')}}"></script>
<script src="{{ asset('admin_app/assets/js/plugins/jkanban/jkanban.js')}}"></script>
<script src="{{ asset('admin_app/assets/js/plugins/chartjs.min.js')}}"></script>
<script src="{{ asset('admin_app/assets/js/plugins/world.js')}}"></script>

<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="{{ asset('admin_app/assets/js/plugins/datatables.js') }}"></script>

<script>
    const dataTableBasic = new simpleDatatables.DataTable("#datatable-basic", {
        searchable: false,
        fixedHeight: true
    });

    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
        searchable: true,
        fixedHeight: true
    });
</script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>


</body>

</html>
