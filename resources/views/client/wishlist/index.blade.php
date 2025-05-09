@extends('client.layouts.master')

@section('content')
<div class="container">
    <h2>Wishlists</h2>

    @if ($wishlists->isEmpty())
        <p>Bạn chưa thêm sản phẩm nào vào danh sách yêu thích.</p>
    @else
        <div class="row">
            @foreach ($wishlists as $item)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="{{ asset($item->product->image) }}" class="card-img-top" alt="{{ $item->product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->product->name }}</h5>
                            <p class="card-text">{{ number_format($item->product->price, 0, ',', '.') }} VND</p>
                            <form action="{{ route('wishlist.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Xoá khỏi yêu thích</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
