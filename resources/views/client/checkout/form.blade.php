@extends('client.layouts.master')

@section('content')
    <h2>Thông tin đặt hàng</h2>
    <form action="{{ route('checkout.place') }}" method="POST">
        @csrf
        <div>
            <label>Họ tên:</label>
            <input type="text" name="full_name" required>
        </div>
        <div>
            <label>Số điện thoại:</label>
            <input type="text" name="phone" required>
        </div>
        <div>
            <label>Địa chỉ:</label>
            <textarea name="address" required></textarea>
        </div>

        <h4>Sản phẩm</h4>
        <ul>
            @foreach ($cartItems as $item)
                <li>{{ $item->product->name }} x {{ $item->quantity }} ({{ number_format($item->product->price) }}đ)</li>
            @endforeach
        </ul>

        <button type="submit">Đặt hàng</button>
    </form>
@endsection