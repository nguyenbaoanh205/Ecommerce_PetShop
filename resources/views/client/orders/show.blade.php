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
                                    <span class="badge badge-{{ $order->status }}">
                                        {{ ucfirst($order->status) }}
                                    </span>

                                </p>

                            </div>
                            <div class="col-md-6">
                                <h5>Checkout Information</h5>
                                <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
                                <p><strong>Total:</strong> ${{ number_format($order->total_amount, 2, '.', ',') }}</p>
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
                                    @foreach ($order->orderItems as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if ($item->product->image)
                                                        <img src="{{ asset($item->product->image) }}"
                                                            alt="{{ $item->product->name }}" class="img-thumbnail"
                                                            style="width: 50px; margin-right: 10px;">
                                                    @endif
                                                    <div>
                                                        <h6 class="mb-0">{{ $item->product->name }}</h6>
                                                        @if ($item->product->sku)
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
                        @if ($order->shipping_note)
                            <p><strong>Note:</strong> {{ $order->shipping_note }}</p>
                        @endif
                    </div>
                </div>

                <div class="mt-3">
                    <a href="{{ route('orders.history') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
    <style>
        /* pending */
        .badge-pending {
            background-color: #ffe0b2 !important;
            /* cam nhạt */
            color: #e65100 !important;
        }

        /* confirmed */
        .badge-confirmed {
            background-color: #d1c4e9 !important;
            /* tím nhạt */
            color: #4527a0 !important;
        }

        /* processing */
        .badge-processing {
            background-color: #b3e5fc !important;
            /* xanh dương nhạt */
            color: #01579b !important;
        }

        /* shipped */
        .badge-shipped {
            background-color: #b2dfdb !important;
            /* xanh ngọc nhạt */
            color: #004d40 !important;
        }

        /* delivered */
        .badge-delivered {
            background-color: #fff9c4 !important;
            /* vàng nhạt */
            color: #f57f17 !important;
        }

        /* completed */
        .badge-completed {
            background-color: #c8e6c9 !important;
            /* xanh lá nhạt */
            color: #1b5e20 !important;
        }

        /* failed */
        .badge-failed {
            background-color: #ffccbc !important;
            /* cam đất nhạt */
            color: #bf360c !important;
        }

        /* returned */
        .badge-returned {
            background-color: #d7ccc8 !important;
            /* nâu xám nhạt */
            color: #3e2723 !important;
        }

        /* refunded */
        .badge-refunded {
            background-color: #cfd8dc !important;
            /* xanh ghi nhạt */
            color: #263238 !important;
        }

        /* cancelled */
        .badge-cancelled {
            background-color: #ffcdd2 !important;
            /* đỏ nhạt */
            color: #b71c1c !important;
        }
    </style>


@endsection
