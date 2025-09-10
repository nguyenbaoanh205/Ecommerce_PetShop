@extends('admin.layouts.master')

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Order Details</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Orders</a></li>
                                <li class="breadcrumb-item" aria-current="page">Order #{{ $order->id }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Order Information</h5>
                        </div>
                        <div class="card-body">
                            @include('admin.partials.alert')
                            <div class="row">
                                {{-- Luôn luôn có Customer Info --}}
                                <div class="col-md-4">
                                    <h4>Customer Information</h4>
                                    <p><strong>Name:</strong> {{ $order->user->name }}</p>
                                    <p><strong>Email:</strong> {{ $order->user->email }}</p>
                                    <p><strong>Phone:</strong> {{ $order->user->phone }}</p>
                                    <p><strong>Address:</strong> {{ $order->user->address }}</p>
                                </div>

                                {{-- Nếu shipping khác với user thì hiển thị thêm Shipping Info --}}
                                @if (
                                    $order->shipping_name !== $order->user->name ||
                                        $order->shipping_phone !== $order->user->phone ||
                                        $order->shipping_address !== $order->user->address)
                                    <div class="col-md-4">
                                        <h4>Shipping Information</h4>
                                        <p><strong>Name:</strong> {{ $order->shipping_name }}</p>
                                        <p><strong>Phone:</strong> {{ $order->shipping_phone }}</p>
                                        <p><strong>Address:</strong> {{ $order->shipping_address }}</p>
                                        @if ($order->shipping_note)
                                            <p><strong>Note:</strong> {{ $order->shipping_note }}</p>
                                        @endif
                                    </div>
                                @endif

                                {{-- Order Details --}}
                                <div class="col-md-4">
                                    <h4>Order Details</h4>
                                    <p><strong>Order ID:</strong> #{{ $order->id }}</p>
                                    <p><strong>Order Date:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
                                    <p><strong>Status:</strong>
                                        <span
                                            class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'processing' ? 'warning' : ($order->status == 'cancelled' ? 'danger' : 'info')) }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </p>
                                </div>
                            </div>


                            <div class="table-responsive mt-4">
                                <h6>Order Items</h6>
                                <table class="table table-hover table-borderless">
                                    <thead>
                                        <tr>
                                            <th style="width: 15%;">Image</th>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderItems as $item)
                                            <tr>
                                                <td>
                                                    <img src="{{ asset($item->product->image) }}"
                                                        alt="{{ $item->product->name }}" class="img-fluid" width="90">
                                                </td>
                                                <td>{{ $item->product->name }}</td>
                                                <td>${{ number_format($item->price, 2) }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" class="text-end"><strong>Total Amount:</strong></td>
                                            <td><strong>${{ number_format($order->total_amount, 2) }}</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="mt-4">
                                @php
                                    $statuses = [
                                        'pending', // Chờ xác nhận
                                        'confirmed', // Đã xác nhận
                                        'processing', // Đang xử lý
                                        'shipped', // Đã giao cho vận chuyển
                                        'delivered', // Đã giao (chờ khách xác nhận)
                                        'completed', // Hoàn tất
                                        'failed', // Giao thất bại
                                        'returned', // Khách trả hàng
                                        'refunded', // Đã hoàn tiền
                                        'cancelled', // Đã hủy
                                    ];
                                    $nextStatuses = $order->getNextStatuses();
                                @endphp

                                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="status">Update Status</label>
                                                <select class="form-control" name="status">
                                                    @foreach ($statuses as $status)
                                                        <option value="{{ $status }}" {{-- Disable nếu không thuộc nextStatuses hoặc nếu là completed --}}
                                                            @if (!in_array($status, $nextStatuses) || $status === 'completed') disabled style="color: #999;" @endif
                                                            {{ $order->status == $status ? 'selected' : '' }}>
                                                            {{ ucfirst($status) }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-primary">Update Status</button>
                                        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Back to
                                            Orders</a>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
@endsection
