@extends('admin.layouts.master')
@section('title', 'Orders Management')

@section('content')
<div class="pc-container">
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Orders</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Orders</li>
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
                        <h5>Orders List</h5>
                    </div>
                    <div class="card-body">
                        @include('admin.partials.alert')
                        <div class="table-responsive">
                            <table class="table table-hover table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>Total Amount</th>
                                        <th>Status</th>
                                        <th>Order Date</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->user->name }}</td>
                                            <td>${{ number_format($order->total_amount, 2) }}</td>
                                            <td>
                                                <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'processing' ? 'warning' : ($order->status == 'cancelled' ? 'danger' : 'info')) }}">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info btn-sm">
                                                    <i class="ti ti-eye"></i> View
                                                </a>
                                                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this order?')">
                                                        <i class="ti ti-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
@endsection 