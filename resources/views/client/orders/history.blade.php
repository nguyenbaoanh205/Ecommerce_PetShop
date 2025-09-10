@extends('client.layouts.master')
@section('title', 'Order History')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">Order History</h2>

        @if ($orders->isEmpty())
            <div class="alert alert-info">
                You don't have any orders yet.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Order Code</th>
                            <th>Order Date</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td>$ {{ number_format($order->total_amount, 2, '.', ',') }}</td>
                                <td>
                                    <span class="badge badge-{{ $order->status }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                        View Details
                                    </a>

                                    @if ($order->status === 'delivered')
                                        <form action="{{ route('orders.receive', $order->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-success">
                                                Nhận hàng
                                            </button>
                                        </form>
                                    @endif

                                    @if ($order->status === 'completed' && $order->reviews->isEmpty())
                                        <a href="{{ route('orders.review', $order->id) }}" class="btn btn-sm btn-warning">
                                            Đánh giá
                                        </a>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $orders->links() }}
            </div>
        @endif
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
