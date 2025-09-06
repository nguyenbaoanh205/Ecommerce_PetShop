@extends('client.layouts.master')
@section('title', 'Wishlists')

@section('content')
<div class="shop-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 data-aos="fade-up">Wishlists</h1>
                    <!-- Breadcrumbs -->
                    <div class="breadcrumbs" data-aos="fade-up" data-aos-delay="200">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Wishlists</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        @if ($wishlists->isEmpty())
            <p>You have no items in your wishlist.</p>
        @else
            <div class="row">
                @foreach ($wishlists as $item)
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <img src="{{ asset($item->product->image) }}" class="card-img-top"
                                alt="{{ $item->product->name }}">
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
