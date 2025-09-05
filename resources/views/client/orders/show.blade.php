@extends('client.layouts.master')
@section('title', 'Order Detail')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="mb-0">Order Detail #{{ $order->id }}</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h5>Order Information</h5>
                            <p><strong>Order Date:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                            <p><strong>Status:</strong> 
                                @switch($order->status)
                                    @case('pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                        @break
                                    @case('processing')
                                        <span class="badge bg-info text-dark">Processing</span>
                                        @break
                                    @case('completed')
                                        <span class="badge bg-success text-dark">Completed</span>
                                        @break
                                    @case('cancelled')
                                        <span class="badge bg-danger text-dark">Cancelled</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">{{ $order->status }}</span>
                                @endswitch
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h5>Checkout Information</h5>
                            <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
                            <p><strong>Total:</strong> {{ number_format($order->total_amount) }} VNĐ</p>
                        </div>
                    </div>

                    <h5 class="mb-3">Ordered Products</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($item->product->image)
                                                <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" class="img-thumbnail" style="width: 50px; margin-right: 10px;">
                                            @endif
                                            <div>
                                                <h6 class="mb-0">{{ $item->product->name }}</h6>
                                                @if($item->product->sku)
                                                    <small class="text-muted">SKU: {{ $item->product->sku }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>$ {{ number_format($item->price, 2, '.', ',') }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>$ {{ number_format($item->price * $item->quantity, 2, '.', ',') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                    <td><strong>$ {{ number_format($order->total_amount, 2, '.', ',') }}</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Shipping Information</h5>
                </div>
                <div class="card-body">
                    <p><strong>Full Name:</strong> {{ $order->shipping_name }}</p>
                    <p><strong>Address:</strong> {{ $order->shipping_address }}</p>
                    <p><strong>Phone Number:</strong> {{ $order->shipping_phone }}</p>
                    @if($order->shipping_note)
                        <p><strong>Note:</strong> {{ $order->shipping_note }}</p>
                    @endif
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ route('orders.history') }}" class="btn btn-secondary">Quay lại</a>
            </div>
        </div>
    </div>
</div>
@endsection 