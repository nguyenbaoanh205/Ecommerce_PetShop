@extends('client.layouts.master')

@section('content')
    <h2>Giỏ hàng của bạn</h2>

    @if (session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    @if ($cartItems->isEmpty())
        <p>Giỏ hàng của bạn đang trống.</p>
    @else
        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach ($cartItems as $item)
                    @php
                        $itemTotal = $item->product->price * $item->quantity;
                        $total += $itemTotal;
                    @endphp
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ number_format($item->product->price) }}đ</td>
                        <td>
                            <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                @csrf
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" style="width: 50px;">
                                <button type="submit">Cập nhật</button>
                            </form>
                        </td>
                        <td>{{ number_format($itemTotal) }}đ</td>
                        <td>
                            <a href="{{ route('cart.remove', $item->id) }}" onclick="return confirm('Xoá sản phẩm này?')">Xoá</a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3"><strong>Tổng cộng:</strong></td>
                    <td colspan="2"><strong>{{ number_format($total) }}đ</strong></td>
                </tr>
            </tbody>
        </table>
    @endif
@endsection