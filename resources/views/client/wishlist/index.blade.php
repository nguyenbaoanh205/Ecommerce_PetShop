@extends('client.layouts.master')
@section('title', 'Wishlists')

@section('content')
    <div class="container py-5">
        @if ($wishlists->isEmpty())
            <div class="text-center py-5">
                <h4 class="text-muted">Your wishlist is empty.</h4>
                <a href="{{ route('shop.index') }}" class="btn btn-primary mt-3">Shop Now</a>
            </div>
        @else
            <div class="row g-4">
                @foreach ($wishlists as $item)
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card wishlist-card h-100 border-0 shadow-sm position-relative">
                            <!-- Hình ảnh sản phẩm -->
                            <a href="{{ route('product-detail', $item->product->slug) }}" class="text-decoration-none">
                                <div class="product-img-wrapper">
                                    <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}"
                                        class="card-img-top">
                                </div>
                            </a>

                            <!-- Thông tin sản phẩm -->
                            <div class="card-body d-flex flex-column">
                                <a href="{{ route('product-detail', $item->product->slug) }}"
                                    class="text-dark text-decoration-none mb-2">
                                    <h6 class="card-title">{{ Str::limit($item->product->name, 40) }}</h6>
                                </a>
                                <h5 class="fw-bold mb-3">$ {{ number_format($item->product->price, 2, ',', '.') }}</h5>

                                <!-- Nút Xóa + Add to Cart -->
                                <div class="d-flex gap-2 mt-auto">
                                    <form action="{{ route('wishlist.remove', $item->id) }}" method="POST"
                                        class="flex-fill">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger w-100 fw-bold" type="submit">
                                            <i class="bi bi-trash me-1"></i> Delete
                                        </button>
                                    </form>
                                    <a href="{{ route('cart.add', $item->product->slug) }}"
                                        class="btn btn-success flex-fill fw-bold text-white">
                                        <i class="bi bi-cart me-1"></i> Add to Cart
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <style>
        .wishlist-card {
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .wishlist-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .product-img-wrapper {
            height: 250px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
            padding: 15px;
        }

        .product-img-wrapper img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .product-img-wrapper img:hover {
            transform: scale(1.05);
        }

        .btn-outline-danger {
            border-radius: 8px;
            transition: all 0.2s;
        }

        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-success {
            border-radius: 8px;
            transition: all 0.2s;
        }

        .btn-success:hover {
            background-color: #28a745cc;
        }
    </style>
@endsection
