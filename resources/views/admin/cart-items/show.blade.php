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
                            <h5 class="m-b-10">Cart Item Details</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.cart-items.index') }}">Cart Items</a></li>
                            <li class="breadcrumb-item" aria-current="page">Cart Item #{{ $cartItem->id }}</li>
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
                        <h5>Cart Item Information</h5>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <h6>User Information</h6>
                                <table class="table table-borderless">
                                    <tr>
                                        <th>Name:</th>
                                        <td>{{ $cartItem->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email:</th>
                                        <td>{{ $cartItem->user->email }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h6>Product Information</h6>
                                <table class="table table-borderless">
                                    <tr>
                                        <th>Product Name:</th>
                                        <td>{{ $cartItem->product->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Price:</th>
                                        <td>${{ number_format($cartItem->product->price, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Quantity:</th>
                                        <td>{{ $cartItem->quantity }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td>${{ number_format($cartItem->product->price * $cartItem->quantity, 2) }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <form action="{{ route('admin.cart-items.update', $cartItem->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="quantity">Quantity</label>
                                                <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $cartItem->quantity }}" min="1" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-primary">Update Cart Item</button>
                                        <a href="{{ route('admin.cart-items.index') }}" class="btn btn-secondary">Back to List</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
@endsection 