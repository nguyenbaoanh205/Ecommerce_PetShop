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

                                    {{-- @if ($order->status === 'shipped')
                                        <form action="{{ route('orders.receive', $order->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PUT') --}}
                                            <button type="submit" class="btn btn-sm btn-success">
                                                Nhận hàng
                                            </button>
                                        </form>
                                    {{-- @endif

                                    @if ($order->status === 'completed') --}}
                                        <a href="orders.review', $order->id" class="btn btn-sm btn-warning">
                                            Đánh giá
                                        </a>
                                    {{-- @endif --}}
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
        .badge-pending {
            background-color: #ffe0b2 !important;
            color: #e65100 !important;
        }

        .badge-confirmed {
            background-color: #bbdefb !important;
            color: #0d47a1 !important;
        }

        .badge-shipped {
            background-color: #b2ebf2 !important;
            color: #006064 !important;
        }

        .badge-completed {
            background-color: #c8e6c9 !important;
            color: #1b5e20 !important;
        }

        .badge-returned {
            background-color: #e0e0e0 !important;
            color: #424242 !important;
        }

        .badge-cancelled {
            background-color: #ffcdd2 !important;
            color: #b71c1c !important;
        }
    </style>
@endsection
