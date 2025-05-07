@extends('client.layouts.master')

@section('content')
    <section id="checkout" class="my-5">
        <div class="container py-5">
            <h2 class="display-3 fw-normal mb-4">Checkout Information</h2>

            <form action="{{ route('checkout.place') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Shipping Information</h4>
                                <div class="mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" name="shipping_name" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" name="shipping_phone" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <textarea name="shipping_address" class="form-control" rows="2" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Note</label>
                                    <textarea name="shipping_note" class="form-control" rows="3" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Order Summary</h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            @php $total = 0; @endphp
                                            @foreach ($cartItems as $item)
                                                @php
                                                    $itemTotal = $item->product->price * $item->quantity;
                                                    $total += $itemTotal;
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" 
                                                                class="img-fluid rounded-3" style="width: 60px; margin-right: 10px;">
                                                            <div>
                                                                <div>{{ $item->product->name }}</div>
                                                                <small class="text-muted">Qty: {{ $item->quantity }}</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end secondary-font text-primary">${{ number_format($itemTotal, 2) }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td><strong>Total:</strong></td>
                                                <td class="text-end secondary-font text-primary"><strong>${{ number_format($total, 2) }}</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <button type="submit" class="btn btn-dark btn-lg w-100 text-uppercase fs-6 rounded-1">
                                    Place Order
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection