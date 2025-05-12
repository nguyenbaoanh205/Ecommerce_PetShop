@extends('client.layouts.master')

@section('content')
    <section id="cart" class="my-5">
        <div class="container py-5">
            <h2 class="display-3 fw-normal mb-4">Your Cart</h2>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($cartItems->isEmpty())
                <div class="alert alert-info">
                    <p class="mb-0">Your cart is empty.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach ($cartItems as $item)
                                @php
                                    $product = $item->product;
                                    $hasDiscount =
                                        !empty($product->discount_price) && $product->discount_price < $product->price;
                                    $priceToUse = $hasDiscount ? $product->discount_price : $product->price;
                                    $itemTotal = $priceToUse * $item->quantity;
                                    $total += $itemTotal;
                                @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}"
                                                class="img-fluid rounded-3" style="width: 80px; margin-right: 15px;">
                                            <span>{{ $item->product->name }}</span>
                                        </div>
                                    </td>
                                    <td class="secondary-font text-primary">
                                        @if ($hasDiscount)
                                            <del>${{ number_format($product->price, 2) }}</del>
                                            <span class="ms-1 fs-5">${{ number_format($product->discount_price, 2) }}</span>
                                        @else
                                            ${{ number_format($product->price, 2) }}
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST"
                                            class="d-flex align-items-center">
                                            @csrf
                                            <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                min="1" class="form-control" style="width: 80px;">
                                            <button type="submit" class="btn btn-outline-dark ms-2">Update</button>
                                        </form>
                                    </td>
                                    <td class="secondary-font text-primary">${{ number_format($itemTotal, 2) }}</td>
                                    <td>
                                        <a href="{{ route('cart.remove', $item->id) }}"
                                            onclick="return confirm('Are you sure you want to remove this item?')"
                                            class="btn btn-outline-danger">
                                            <iconify-icon icon="mdi:trash-can-outline"></iconify-icon>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                <td colspan="2" class="secondary-font text-primary">
                                    <strong>${{ number_format($total, 2) }}</strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    {{-- <a href="{{ route('products.index') }}" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                        Continue Shopping
                        <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                            <use xlink:href="#arrow-right"></use>
                        </svg>
                    </a> --}}
                    <a href="{{ route('checkout.form') }}" class="btn btn-dark btn-lg text-uppercase fs-6 rounded-1">
                        Proceed to Checkout
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection
