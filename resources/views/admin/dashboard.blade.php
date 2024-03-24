@extends('admin_layouts.app')
@section('content')
    <div class="row">
        @if ($user->hasRole('Admin'))
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body p-3 position-relative">
                        <div class="row">
                            <div class="col text-start">
                                <p class="text-sm mb-1 text-capitalize font-weight-bold">Provider Balance</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ number_format($provider_balance, 2) }}MMK
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body p-3 position-relative">
                    <div class="row">
                        <div class="col text-start">
                            <p class="text-sm mb-1 text-capitalize font-weight-bold">Balance</p>
                            <h5 class="font-weight-bolder mb-0">
                                {{ number_format(auth()->user()->balanceFloat, 2) }}MMK
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body p-3 position-relative">
                    <div class="row">
                        <div class="col text-start">
                                <p class="text-sm mb-1 text-capitalize font-weight-bold">Master</p>
                            <h5 class="font-weight-bolder mb-0">
                                {{ $master_count }}
                            </h5>
                            <span class="text-sm text-end text-success font-weight-bolder mt-auto mb-0"> <span
                                    class="font-weight-normal text-secondary">last Update</span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body p-3 position-relative">
                    <div class="row">
                        <div class="col text-start">
                                <p class="text-sm mb-1 text-capitalize font-weight-bold">Agent</p>
                            <h5 class="font-weight-bolder mb-0">
                                {{ $agent_count }}
                            </h5>
                            <span class="text-sm text-end text-success font-weight-bolder mt-auto mb-0"> <span
                                    class="font-weight-normal text-secondary">last Update</span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body p-3 position-relative">
                    <div class="row">
                        <div class="col text-start">
                                <p class="text-sm mb-1 text-capitalize font-weight-bold">Player</p>

                            <h5 class="font-weight-bolder mb-0">
                                {{ $player_count }}
                            </h5>
                            <span class="text-sm text-end text-success font-weight-bolder mt-auto mb-0"> <span
                                    class="font-weight-normal text-secondary">last Update</span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    @can('admin_access')
        <div class="row gx-4 mt-4">
            <div class="col-md-6">
                <div class="card">
                    <form action="{{ route('admin.balanceUp') }}" method="post">
                        @csrf
                        <div class="card-header p-3 pb-0">
                            <h6 class="mb-1">Update Balance</h6>
                            <p class="text-sm mb-0">
                                Owner can update balance.
                            </p>
                        </div>
                        <div class="card-body p-3">
                            <div class="input-group input-group-static my-4">
                                <label>Amount</label>
                                <input type="integer" class="form-control" name="balance">
                            </div>

                            <button class="btn bg-gradient-dark mb-0 float-end">Update </button>
                        </div>
                    </form>
                </div>
            </div>
        @endcan
    @endsection
    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
        <script src="https://demos.creative-tim.com/material-dashboard-pro/assets/js/plugins/chartjs.min.js"></script>
        <script src="https://demos.creative-tim.com/material-dashboard-pro/assets/js/plugins/jkanban/jkanban.js"></script>
        <script>
            var errorMessage = @json(session('error'));
            var successMessage = @json(session('success'));

            console.log(successMessage);
        </script>
        <script>
            @if (session()->has('success'))
                Swal.fire({
                    icon: 'success',
                    title: successMessage,
                    showConfirmButton: false,
                    timer: 1500
                })
            @elseif (session()->has('error'))
                Swal.fire({
                    icon: 'error',
                    title: errorMessage,
                    showConfirmButton: false,
                    timer: 1500
                })
            @endif
        </script>
        <script>
            var ctx2 = document.getElementById("chart-pie").getContext("2d");
            // Pie chart
            new Chart(ctx2, {
                type: "pie",
                data: {
                    labels: ['Deposit', 'Withdraw'],
                    datasets: [{
                        label: "Transaction",
                        weight: 9,
                        cutout: 0,
                        tension: 0.9,
                        pointRadius: 2,
                        borderWidth: 1,
                        backgroundColor: ['#17c1e8', '#e91e63'],
                        data: [10, 20],
                        fill: false
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                                color: '#c1c4ce5c'
                            },
                            ticks: {
                                display: false
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                                color: '#c1c4ce5c'
                            },
                            ticks: {
                                display: false,
                            }
                        },
                    },
                },
            });
        </script>
    @endsection
