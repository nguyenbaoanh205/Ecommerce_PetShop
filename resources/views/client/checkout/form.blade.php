@extends('client.layouts.master')
@section('title', 'Checkout')

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

                                {{-- Thông tin mặc định của user --}}
                                <div id="default_shipping">
                                    <div class="mb-3">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" name="shipping_name" class="form-control"
                                            value="{{ old('shipping_name', $user->name) }}" required>
                                        @error('shipping_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Phone Number</label>
                                        <input type="text" name="shipping_phone" class="form-control"
                                            value="{{ old('shipping_phone', $user->phone) }}" required>
                                        @error('shipping_phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Address</label>
                                        <textarea name="shipping_address" class="form-control" rows="2" required>{{ old('shipping_address', $user->address) }}</textarea>
                                        @error('shipping_address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Checkbox đặt hàng ở địa chỉ khác --}}
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" id="different_address"
                                        name="different_address" onchange="toggleRecipient(this)">
                                    <label class="form-check-label" for="different_address">
                                        Ship to a different address
                                    </label>
                                </div>


                                {{-- Thông tin người nhận khác --}}
                                <div id="different_shipping" style="display: none;">
                                    <div class="mb-3">
                                        <label class="form-label">Recipient Name</label>
                                        <input type="text" name="recipient_name" class="form-control"
                                            value="{{ old('recipient_name') }}">
                                        @error('recipient_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Recipient Phone</label>
                                        <input type="text" name="recipient_phone" class="form-control"
                                            value="{{ old('recipient_phone') }}">
                                        @error('recipient_phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Recipient Address</label>
                                        <textarea name="recipient_address" class="form-control" rows="2">{{ old('recipient_address') }}</textarea>
                                        @error('recipient_address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Note</label>
                                    <textarea name="shipping_note" class="form-control" rows="3">{{ old('shipping_note') }}</textarea>
                                    @error('shipping_note')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
                                                            <img src="{{ asset($item->product->image) }}"
                                                                alt="{{ $item->product->name }}"
                                                                class="img-fluid rounded-3"
                                                                style="width: 60px; margin-right: 10px;">
                                                            <div>
                                                                <div>{{ $item->product->name }}</div>
                                                                <small class="text-muted">Quantity:
                                                                    {{ $item->quantity }}</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end secondary-font text-primary">
                                                        ${{ number_format($itemTotal, 2) }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td><strong>Total:</strong></td>
                                                <td class="text-end secondary-font text-primary">
                                                    <strong>${{ number_format($total, 2) }}</strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <h4 class="card-title mb-4">Payment Method</h4>
                                <div class="mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="cod"
                                            value="cod" checked>
                                        <label class="form-check-label" for="cod">
                                            Cash on Delivery (COD)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="pay"
                                            value="pay">
                                        <label class="form-check-label" for="pay">
                                            Online Payment
                                        </label>
                                    </div>
                                    @error('payment_method')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkbox = document.getElementById('different_address');
            const differentForm = document.getElementById('different_shipping');
            const defaultInputs = document.querySelectorAll('#default_shipping input, #default_shipping textarea');

            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    differentForm.style.display = 'block';
                    defaultInputs.forEach(input => input.disabled = true); // disable thông tin user
                } else {
                    differentForm.style.display = 'none';
                    defaultInputs.forEach(input => input.disabled = false); // enable thông tin user
                }
            });
        });
    </script>


@endsection
