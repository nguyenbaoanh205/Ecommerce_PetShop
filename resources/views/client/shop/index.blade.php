@extends('client.layouts.master')
@section('title', 'Pet Shop')

@section('content')
    <section id="pet-shop" class="my-5 overflow-hidden">
        <div class="container py-3 mb-5">
            <div class="section-header d-md-flex justify-content-between align-items-center mb-3">
                <h2 class="display-3 fw-normal">🐾 Pet Shop</h2>
                <div>
                    <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                    View All
                    <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                        <use xlink:href="#arrow-right"></use>
                    </svg>
                </a>
                </div>
            </div>

            <div class="row g-4">
                @foreach ($products as $product)
                    @php
                        $hasDiscount = !empty($product->discount_price) && $product->discount_price < $product->price;
                        $discountPercent = $hasDiscount
                            ? round((($product->price - $product->discount_price) / $product->price) * 100)
                            : 0;

                        $productReviews = $reviews->where('product_id', $product->id);
                        $averageRating = $productReviews->avg('rating') ?? 0;
                    @endphp

                    <div class="col-md-3 col-sm-6">
                        <div class="position-relative h-100 shadow-sm border-0 rounded-4">
                            <!-- Sale badge -->
                            @if ($hasDiscount)
                                <div class="position-absolute z-1 rounded-3 m-3 px-3 border border-dark-subtle"
                                    style="background-color: #f1f1f1">
                                    Sale -{{ $discountPercent }}%
                                </div>
                            @endif

                            <!-- Image -->
                            <a href="{{ route('product-detail', $product->slug) }}">
                                <img src="{{ asset($product->image) }}" class="img-fluid rounded-4"
                                    alt="{{ $product->name }}" style="height:250px; width: 100%;object-fit:cover;">
                            </a>

                            <div class="card-body p-3">
                                <a href="{{ route('product-detail', $product->slug) }}">
                                    <h5 style="height: 50px; line-height: 25px" class="card-title fw-semibold">{{ $product->name }}</h5>
                                </a>

                                <!-- Rating -->
                                <div class="mb-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($averageRating >= $i)
                                            <iconify-icon icon="material-symbols:star"
                                                style="color: #dead6f; font-size: 18px;" class="me-1"></iconify-icon>
                                        @elseif ($averageRating >= $i - 0.5)
                                            <iconify-icon icon="material-symbols:star-half"
                                                style="color: #dead6f; font-size: 18px;" class="me-1"></iconify-icon>
                                        @else
                                            <iconify-icon icon="material-symbols:star-outline"
                                                style="color: #ccc; font-size: 18px;" class="me-1"></iconify-icon>
                                        @endif
                                    @endfor
                                    <small>({{ number_format($averageRating, 1) }})</small>
                                </div>

                                <!-- Price -->
                                <div class="d-flex align-items-center">
                                <h4 class="text-primary">
                                    ${{ number_format($product->discount_price ?? $product->price, 2) }}
                                </h4>
                                @if ($hasDiscount)
                                    <h6 class="text-muted text-decoration-line-through mb-1 ms-2">
                                        ${{ number_format($product->price, 2) }}
                                    </h6>
                                @endif
                                </div>

                                <!-- Actions -->
                                <div class="d-flex flex-wrap mt-3">
                                    <form action="{{ route('cart.add') }}" method="POST" class="me-2">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit"
                                            class="btn-cart px-3 py-2 btn btn-dark text-uppercase rounded-1">
                                            🛒 Add To Cart
                                        </button>
                                    </form>
                                    <form action="{{ route('wishlist.add') }}" method="POST" class="rounded-1"
                                        style="border: 1px solid #d9d9d8;">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button style="padding: 7px 18px !important;" type="submit" class="btn-wishlist bg-transparent border-0">
                                            ❤️
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="d-flex justify-content-center mt-5">
                    {{ $products->links() }}
                </div>
            </div>

        </div>
    </section>
@endsection
