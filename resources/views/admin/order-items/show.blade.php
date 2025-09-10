{{-- @extends('admin.layouts.master')

@section('content')
<div class="pc-container">
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Order Item Details</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.order-items.index') }}">Order Items</a></li>
                            <li class="breadcrumb-item" aria-current="page">Item #{{ $orderItem->id }}</li>
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
                        <h5>Order Item Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Order Information</h6>
                                <p><strong>Order ID:</strong> #{{ $orderItem->order->id }}</p>
                                <p><strong>Order Date:</strong> {{ $orderItem->order->created_at->format('Y-m-d H:i') }}</p>
                                <p><strong>Order Status:</strong> 
                                    <span class="badge bg-{{ $orderItem->order->status == 'completed' ? 'success' : ($orderItem->order->status == 'processing' ? 'warning' : ($orderItem->order->status == 'cancelled' ? 'danger' : 'info')) }}">
                                        {{ ucfirst($orderItem->order->status) }}
                                    </span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h6>Product Information</h6>
                                <p><strong>Product Name:</strong> {{ $orderItem->product->name }}</p>
                                <p><strong>Price:</strong> ${{ number_format($orderItem->price, 2) }}</p>
                                <p><strong>Quantity:</strong> {{ $orderItem->quantity }}</p>
                                <p><strong>Total:</strong> ${{ number_format($orderItem->price * $orderItem->quantity, 2) }}</p>
                            </div>
                        </div>

                        <div class="mt-4">
                            <form action="{{ route('admin.order-items.update', $orderItem->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="quantity">Quantity</label>
                                            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $orderItem->quantity }}" min="1" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="number" class="form-control" id="price" name="price" value="{{ $orderItem->price }}" min="0" step="0.01" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Update Item</button>
                                    <a href="{{ route('admin.order-items.index') }}" class="btn btn-secondary">Back to Order Items</a>
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
@endsection  --}}