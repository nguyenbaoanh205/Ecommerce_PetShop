@extends('client.layouts.master')

@section('content')
    <section id="single-product" class="my-5">
        <div class="container py-5">
            <div class="row">
                <!-- Product Image -->
                <div class="col-md-6">
                    <div class="main-img">
                        <img src="{{ asset($product->image) }}" class="img-fluid rounded-4" alt="{{ $product->name }}">
                    </div>
                    <div class="thumbnail-images d-flex mt-3">
                        @if ($product->additional_images)
                            @foreach (json_decode($product->additional_images) as $image)
                                <img src="{{ asset($image) }}" class="img-fluid rounded-3 me-2"
                                    style="width: 100px; cursor: pointer;" alt="thumbnail">
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- Product Details -->
                <div class="col-md-6 ps-md-5">
                    <h1 class="fw-normal">{{ $product->name }}</h1>
                    <div class="rating secondary-font my-3">
                        @php
                            $productReviews = $reviews->where('product_id', $product->id);
                            $averageRating = $productReviews->avg('rating') ?? 0;
                            $reviewCount = $productReviews->count();
                        @endphp
                        @for ($i = 0; $i < 5; $i++)
                            <iconify-icon icon="clarity:star-solid"
                                class="{{ $i < $averageRating ? 'text-primary' : 'text-secondary' }}"></iconify-icon>
                        @endfor
                        <span class="ms-2">{{ number_format($averageRating, 1) }} ({{ $reviewCount }} reviews)</span>
                    </div>
                    <h3 class="secondary-font text-primary mb-4">${{ number_format($product->price, 2) }}</h3>
                    <p class="fs-5">{{ $product->description }}</p>

                    <!-- Quantity Selector -->
                    <div class="quantity-selector my-4">
                        <label for="quantity" class="me-3">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" value="1" min="1"
                            class="form-control d-inline-block w-auto">
                    </div>

                    <!-- Add to Cart and Wishlist -->
                    <div class="d-flex flex-wrap mt-4">
                        <form action="{{ route('cart.add') }}" method="POST" class="me-3">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1"> {{-- Hoặc cho user chọn số lượng nếu muốn --}}
                            <button type="submit" class="btn-cart px-4 py-3 btn btn-dark text-uppercase rounded-1">
                                Add to Cart
                            </button>
                        </form>

                        <a href="#" class="btn-wishlist px-4 py-3 btn btn-outline-dark rounded-1">
                            <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                        </a>
                    </div>

                    <!-- Additional Info -->
                    <div class="mt-4">
                        {{-- <p><strong>SKU:</strong> {{ $product->sku }}</p> --}}
                        <p><strong>Category:</strong> {{ $product->category->name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="product-reviews" class="my-5">
        <div class="container py-5">
            <h2 class="display-3 fw-normal mb-4">Customer Reviews</h2>
            <div class="row">
                @foreach ($reviews->where('product_id', $product->id) as $review)
                    <div class="col-md-6 mb-4">
                        <div class="card p-4">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5>{{ $review->user->name }}</h5>
                                    <div class="rating secondary-font">
                                        @for ($i = 0; $i < 5; $i++)
                                            <iconify-icon icon="clarity:star-solid"
                                                class="{{ $i < $review->rating ? 'text-primary' : 'text-secondary' }}"></iconify-icon>
                                        @endfor
                                    </div>
                                </div>
                                <span>{{ $review->created_at->format('d M Y') }}</span>
                            </div>
                            <p class="mt-3">{{ $review->comment }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Add Review Form -->
            <div class="mt-5">
                <h3 class="fw-normal">Write a Review</h3>
                <form action="{{ route('reviews.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label>
                        <select name="rating" id="rating" class="form-control" required>
                            <option value="5">5 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="2">2 Stars</option>
                            <option value="1">1 Star</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Your Review</label>
                        <textarea name="comment" id="comment" class="form-control" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-dark rounded-1">Submit Review</button>
                </form>
            </div>
        </div>
    </section>

    <section id="related-products" class="my-5 overflow-hidden">
        <div class="container py-5">
            <div class="section-header d-md-flex justify-content-between align-items-center mb-3">
                <h2 class="display-3 fw-normal">Related Products</h2>
                <div>
                    <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                        Shop Now
                        <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                            <use xlink:href="#arrow-right"></use>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="products-carousel swiper">
                <div class="swiper-wrapper">
                    @foreach ($relatedProducts as $relatedProduct)
                        <div class="swiper-slide">
                            <div class="card position-relative">
                                <a href="{{ route('product-detail', $relatedProduct->id) }}">
                                    <img src="{{ asset($relatedProduct->image) }}" class="img-fluid rounded-4"
                                        alt="{{ $relatedProduct->name }}">
                                </a>
                                <div class="card-body p-0">
                                    <a href="{{ route('products.show', $relatedProduct->id) }}">
                                        <h3 class="card-title pt-4 m-0">{{ $relatedProduct->name }}</h3>
                                    </a>
                                    <div class="card-text">
                                        <span class="rating secondary-font">
                                            @php
                                                $relatedProductReviews = $reviews->where(
                                                    'product_id',
                                                    $relatedProduct->id,
                                                );
                                                $relatedAverageRating = $relatedProductReviews->avg('rating') ?? 0;
                                            @endphp
                                            @for ($i = 0; $i < 5; $i++)
                                                <iconify-icon icon="clarity:star-solid"
                                                    class="{{ $i < $relatedAverageRating ? 'text-primary' : 'text-secondary' }}"></iconify-icon>
                                            @endfor
                                            {{ number_format($relatedAverageRating, 1) }}
                                        </span>
                                        <h3 class="secondary-font text-primary">
                                            ${{ number_format($relatedProduct->price, 2) }}</h3>
                                        <div class="d-flex flex-wrap mt-3">
                                            <a href="#" class="btn-cart me-3 px-4 pt-3 pb-3">
                                                <h5 class="text-uppercase m-0">Add to Cart</h5>
                                            </a>
                                            <a href="#" class="btn-wishlist px-4 pt-3">
                                                <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
