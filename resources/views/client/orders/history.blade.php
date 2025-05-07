@extends('client.layouts.master')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">Order History</h2>

        @if ($orders->isEmpty())
            <div class="alert alert-info">
                You don't have any orders.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Order Code</th>
                            <th>Order Date</th>
                            <th>Total</th>
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
                                            <span class="badge bg-secondary text-dark">{{ $order->status }}</span>
                                    @endswitch
                                </td>
                                <td>
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-primary">Chi
                                        tiết</a>
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
@endsection
