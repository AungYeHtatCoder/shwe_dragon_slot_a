<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
    <title>
        TigerMM Slot
    </title>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('admin_app/assets/css/nucleo-icons.css')}}" rel="stylesheet" />
    <link href="{{ asset('admin_app/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/b829c5162c.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('admin_app/assets/css/material-dashboard.css?v=3.0.6')}}" rel="stylesheet" />

    <script defer data-site="https://delightmyanmar.online" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>

</head>

<body class="g-sidenav-show  bg-gray-200">


    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <div class="container-fluid py-4">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="mb-0">Win/Lose Detail Report</h5>
                            <form action="" method="GET">
                                <input type="hidden" name="user_id" value="{{$player->id}}">
                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="input-group input-group-static my-3">
                                            <label>Player</label>
                                            <input type="text" class="form-control" id="" value="{{$player->user_name}}" name="player_name" readonly>
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
                                        <button type="submit" class="btn btn-sm btn-primary mt-5">Search</button>
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Result
                                            Product Type
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Valid Bet
                                            Amount
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bet
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
                                        <td class="text-sm font-weight-normal">{{$detail->settlement_date}}</td>
                                        <td class="text-sm font-weight-normal">{{$detail->product_name}}</td>
                                        <td class="text-sm font-weight-normal">{{$detail->valid_bet_amount}}</td>
                                        <td class="text-sm font-weight-normal">{{$detail->bet_amount}}</td>
                                        <td class="text-sm font-weight-normal">{{$detail->payout_amount}}</td>
                                        @php
                                        $result = $detail->payout_amount - $detail->bet_amount;
                                        @endphp
                                        @if($result > 0)
                                        <td class="text-sm text-success font-weight-bold">{{$result}}</td>
                                        @else
                                        <td class="text-sm text-danger font-weight-bold">{{$result}}</td>
                                        @endif
                                        </td>
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