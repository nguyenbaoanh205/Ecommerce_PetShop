@extends('admin.layouts.master')
@section('title', 'Dashboard')
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Dashboard</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item" aria-current="page">Home</li>
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Dashboard</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- [ sample-page ] start -->
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-2 f-w-400 text-muted">Total Product Views</h6>
                            <h4 class="mb-3">
                                {{ number_format($totalProductViews) }}
                                <span
                                    class="badge {{ $productViewsChange >= 0 ? 'bg-light-success border border-success' : 'bg-light-danger border border-danger' }}">
                                    <i
                                        class="ti {{ $productViewsChange >= 0 ? 'ti-trending-up' : 'ti-trending-down' }}"></i>
                                    {{ abs(round($productViewsChange, 1)) }}%
                                </span>
                            </h4>
                            <p class="mb-0 text-muted text-sm">
                                You made an extra
                                <span class="{{ $productViewsChange >= 0 ? 'text-success' : 'text-danger' }}">
                                    {{ number_format($totalProductViews - $lastYearProductViews) }}
                                </span>
                                this year
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-2 f-w-400 text-muted">Total Users</h6>
                            <h4 class="mb-3">
                                {{ number_format($totalUsers) }}
                                <span
                                    class="badge {{ $usersChange >= 0 ? 'bg-light-success border border-success' : 'bg-light-danger border border-danger' }}">
                                    <i class="ti {{ $usersChange >= 0 ? 'ti-trending-up' : 'ti-trending-down' }}"></i>
                                    {{ abs(round($usersChange, 1)) }}%
                                </span>
                            </h4>
                            <p class="mb-0 text-muted text-sm">
                                You made an extra
                                <span class="{{ $usersChange >= 0 ? 'text-success' : 'text-danger' }}">
                                    {{ number_format($totalUsers - $lastYearUsers) }}
                                </span>
                                this year
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-2 f-w-400 text-muted">Total Orders</h6>
                            <h4 class="mb-3">
                                {{ number_format($totalOrders) }}
                                <span
                                    class="badge {{ $ordersChange >= 0 ? 'bg-light-success border border-success' : 'bg-light-danger border border-danger' }}">
                                    <i class="ti {{ $ordersChange >= 0 ? 'ti-trending-up' : 'ti-trending-down' }}"></i>
                                    {{ abs(round($ordersChange, 1)) }}%
                                </span>
                            </h4>
                            <p class="mb-0 text-muted text-sm">
                                You made an extra
                                <span class="{{ $ordersChange >= 0 ? 'text-success' : 'text-danger' }}">
                                    {{ number_format($totalOrders - $lastYearOrders) }}
                                </span>
                                this year
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-2 f-w-400 text-muted">Total Sales</h6>
                            <h4 class="mb-3">
                                ${{ number_format($totalSales, 2) }}
                                <span
                                    class="badge {{ $salesChange >= 0 ? 'bg-light-success border border-success' : 'bg-light-danger border border-danger' }}">
                                    <i class="ti {{ $salesChange >= 0 ? 'ti-trending-up' : 'ti-trending-down' }}"></i>
                                    {{ abs(round($salesChange, 1)) }}%
                                </span>
                            </h4>
                            <p class="mb-0 text-muted text-sm">
                                You made an extra
                                <span class="{{ $salesChange >= 0 ? 'text-success' : 'text-danger' }}">
                                    ${{ number_format($totalSales - $lastYearSales, 2) }}
                                </span>
                                this year
                            </p>
                        </div>
                    </div>
                </div>


                <div class="col-md-12 col-xl-8">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="mb-0">Unique Visitor</h5>
                        <ul class="nav nav-pills justify-content-end mb-0" id="chart-tab-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="chart-tab-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#chart-tab-home" type="button" role="tab"
                                    aria-controls="chart-tab-home" aria-selected="true">Month</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="chart-tab-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#chart-tab-profile" type="button" role="tab"
                                    aria-controls="chart-tab-profile" aria-selected="false">Week</button>
                            </li>
                        </ul>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content" id="chart-tab-tabContent">
                                <div class="tab-pane" id="chart-tab-home" role="tabpanel"
                                    aria-labelledby="chart-tab-home-tab" tabindex="0">
                                    <div id="visitor-chart-1"></div>
                                </div>
                                <div class="tab-pane show active" id="chart-tab-profile" role="tabpanel"
                                    aria-labelledby="chart-tab-profile-tab" tabindex="0">
                                    <div id="visitor-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-12 col-xl-4">
                    <h5 class="mb-3">Income Overview</h5>
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-2 f-w-400 text-muted">This Week Statistics</h6>
                            <h3 class="mb-3">$7,650</h3>
                            <div id="income-overview-chart"></div>
                        </div>
                    </div>
                </div> --}}

                <div class="col-md-12 col-xl-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="mb-3">Tổng quan về thu nhập</h5>
                        <ul class="nav nav-pills justify-content-end mb-0" id="income-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="income-month-tab" data-bs-toggle="pill"
                                    data-bs-target="#income-month" type="button" role="tab"
                                    aria-controls="income-month" aria-selected="false">Tháng</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="income-week-tab" data-bs-toggle="pill"
                                    data-bs-target="#income-week" type="button" role="tab"
                                    aria-controls="income-week" aria-selected="true">Tuần</button>
                            </li>
                        </ul>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content" id="income-tab-content">
                                <div class="tab-pane fade" id="income-month" role="tabpanel"
                                    aria-labelledby="income-month-tab">
                                    <h6 class="mb-2 f-w-400 text-muted">Thống kê tháng này</h6>
                                    <h3 class="mb-3">$ {{ number_format($monthlyTotalIncome, 2, ',', '.') }}</h3>
                                    <div id="income-chart-month" data-monthly-income='@json($monthlyIncome)'></div>
                                </div>
                                <div class="tab-pane fade show active" id="income-week" role="tabpanel"
                                    aria-labelledby="income-week-tab">
                                    <h6 class="mb-2 f-w-400 text-muted">Thống kê tuần này</h6>
                                    <h3 class="mb-3">$ {{ number_format($weeklyTotalIncome, 2, ',', '.') }}</h3>
                                    <div id="income-chart-week" data-weekly-income='@json($weeklyIncome)'></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-xl-8">
                    <h5 class="mb-3">Recent Orders</h5>
                    <div class="card tbl-card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-borderless mb-0">
                                    <thead>
                                        <tr>
                                            <th>ID.</th>
                                            <th>PRODUCT NAME</th>
                                            <th>TOTAL ORDER</th>
                                            <th>STATUS</th>
                                            <th class="text-end">TOTAL AMOUNT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recentOrders as $order)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                                        class="text-muted">
                                                        <strong>#{{ $order->id }}</strong>
                                                    </a>
                                                </td>

                                                <td>
                                                    @foreach ($order->orderItems as $item)
                                                        {{ $item->product->name ?? 'N/A' }} (x{{ $item->quantity }})<br>
                                                    @endforeach
                                                </td>

                                                <td>
                                                    {{ $order->orderItems->sum('quantity') }}
                                                </td>

                                                <td>
                                                    @php
                                                        $statusColors = [
                                                            'pending' => 'text-warning', // Pending
                                                            'confirmed' => 'text-primary', // Confirmed
                                                            'processing' => 'text-info', // Processing
                                                            'shipped' => 'text-info', // Shipped (có thể giữ màu giống Processing)
                                                            'delivered' => 'text-secondary', // Delivered
                                                            'completed' => 'text-success', // Completed (màu xanh lá)
                                                            'failed' => 'text-danger', // Failed
                                                            'returned' => 'text-muted', // Returned
                                                            'refunded' => 'text-success', // Refunded (màu xanh lá)
                                                            'cancelled' => 'text-danger', // Cancelled
                                                        ];

                                                        $statusLabels = [
                                                            'pending' => 'Pending',
                                                            'confirmed' => 'Confirmed',
                                                            'processing' => 'Processing',
                                                            'shipped' => 'Shipped',
                                                            'delivered' => 'Delivered',
                                                            'completed' => 'Completed',
                                                            'failed' => 'Failed',
                                                            'returned' => 'Returned',
                                                            'refunded' => 'Refunded',
                                                            'cancelled' => 'Cancelled',
                                                        ];

                                                        $status = $order->status;
                                                        $colorClass = $statusColors[$status] ?? 'text-muted';
                                                        $label = $statusLabels[$status] ?? 'Unknown';
                                                    @endphp
                                                    <span class="d-flex align-items-center gap-2">
                                                        <i class="fas fa-circle f-10 m-r-5 {{ $colorClass }}"></i>
                                                        {{ $label }}
                                                    </span>
                                                </td>

                                                <td class="text-end">{{ number_format($order->total_amount, 2) }} USD</td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-12 col-xl-4">
                    <h5 class="mb-3">Analytics Report</h5>
                    <div class="card">
                        <div class="list-group list-group-flush">
                            <a href="#"
                                class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">Company
                                Finance Growth<span class="h5 mb-0">+45.14%</span></a>
                            <a href="#"
                                class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">Company
                                Expenses Ratio<span class="h5 mb-0">0.58%</span></a>
                            <a href="#"
                                class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">Business
                                Risk Cases<span class="h5 mb-0">Low</span></a>
                        </div>
                        <div class="card-body px-2">
                            <div id="analytics-report-chart"></div>
                        </div>
                    </div>
                </div> --}}

                {{-- <div class="col-md-12 col-xl-8">
                    <h5 class="mb-3">Sales Report</h5>
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-2 f-w-400 text-muted">This Week Statistics</h6>
                            <h3 class="mb-0">$7,650</h3>
                            <div id="sales-report-chart"></div>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="col-md-12 col-xl-4">
                    <h5 class="mb-3">Transaction History</h5>
                    <div class="card">
                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <div class="avtar avtar-s rounded-circle text-success bg-light-success">
                                            <i class="ti ti-gift f-18"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">Order #002434</h6>
                                        <p class="mb-0 text-muted">Today, 2:00 AM</P>
                                    </div>
                                    <div class="flex-shrink-0 text-end">
                                        <h6 class="mb-1">+ $1,430</h6>
                                        <p class="mb-0 text-muted">78%</P>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <div class="avtar avtar-s rounded-circle text-primary bg-light-primary">
                                            <i class="ti ti-message-circle f-18"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">Order #984947</h6>
                                        <p class="mb-0 text-muted">5 August, 1:45 PM</P>
                                    </div>
                                    <div class="flex-shrink-0 text-end">
                                        <h6 class="mb-1">- $302</h6>
                                        <p class="mb-0 text-muted">8%</P>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <div class="avtar avtar-s rounded-circle text-danger bg-light-danger">
                                            <i class="ti ti-settings f-18"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">Order #988784</h6>
                                        <p class="mb-0 text-muted">7 hours ago</P>
                                    </div>
                                    <div class="flex-shrink-0 text-end">
                                        <h6 class="mb-1">- $682</h6>
                                        <p class="mb-0 text-muted">16%</P>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
