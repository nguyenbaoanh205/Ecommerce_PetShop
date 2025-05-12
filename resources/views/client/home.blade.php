@extends('client.layouts.master')

<style>
    .card img {
        height: 250px;
        /* hoặc 300px tùy giao diện */
        object-fit: cover;
        width: 100%;
    }

    .card-title {
        font-size: 1.2rem;
        /* nhỏ hơn display mặc định */
        display: -webkit-box;
        -webkit-line-clamp: 1;
        /* chỉ hiển thị 1 dòng */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: normal;
    }

    @media (max-width: 768px) {
        #banner {
            height: 1000px !important;
        }
        .swiper-slide {
            width: 100% !important;
        }

        .card {
            width: 100%;
        }
    }
</style>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@section('content')
    <section id="banner" style="background: #F9F3EC; height: 800px">
        <div class="container">
            <div class="swiper main-swiper">
                <div class="swiper-wrapper">

                    <div class="swiper-slide py-5">
                        <div class="row banner-content align-items-center">
                            <div class="img-wrapper col-md-5">
                                <img src="public_index/images/banner-img.png" class="img-fluid">
                            </div>
                            <div class="content-wrapper col-md-7 p-5 mb-5">
                                <div class="secondary-font text-primary text-uppercase mb-4">Save 10 - 20 % off</div>
                                <h2 class="banner-title display-1 fw-normal">Best destination for <span
                                        class="text-primary">your
                                        pets</span>
                                </h2>
                                <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                                    shop now
                                    <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                                        <use xlink:href="#arrow-right"></use>
                                    </svg></a>
                            </div>

                        </div>
                    </div>
                    <div class="swiper-slide py-5">
                        <div class="row banner-content align-items-center">
                            <div class="img-wrapper col-md-5">
                                <img src="public_index/images/banner-img3.png" class="img-fluid">
                            </div>
                            <div class="content-wrapper col-md-7 p-5 mb-5">
                                <div class="secondary-font text-primary text-uppercase mb-4">Save 10 - 20 % off</div>
                                <h2 class="banner-title display-1 fw-normal">Best destination for <span
                                        class="text-primary">your
                                        pets</span>
                                </h2>
                                <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                                    shop now
                                    <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                                        <use xlink:href="#arrow-right"></use>
                                    </svg></a>
                            </div>

                        </div>
                    </div>
                    <div class="swiper-slide py-5">
                        <div class="row banner-content align-items-center">
                            <div class="img-wrapper col-md-5">
                                <img src="public_index/images/banner-img4.png" class="img-fluid">
                            </div>
                            <div class="content-wrapper col-md-7 p-5 mb-5">
                                <div class="secondary-font text-primary text-uppercase mb-4">Save 10 - 20 % off</div>
                                <h2 class="banner-title display-1 fw-normal">Best destination for <span
                                        class="text-primary">your
                                        pets</span>
                                </h2>
                                <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                                    shop now
                                    <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                                        <use xlink:href="#arrow-right"></use>
                                    </svg></a>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="swiper-pagination mb-5"></div>

            </div>
        </div>
    </section>

    <section id="categories">
        <div class="container my-3 py-5">
            <div class="row my-5">
                <div class="col text-center">
                    <a href="#" class="categories-item">
                        <iconify-icon class="category-icon" icon="ph:bowl-food"></iconify-icon>
                        <h5>Foodies</h5>
                    </a>
                </div>
                <div class="col text-center">
                    <a href="#" class="categories-item">
                        <iconify-icon class="category-icon" icon="ph:bird"></iconify-icon>
                        <h5>Bird Shop</h5>
                    </a>
                </div>
                <div class="col text-center">
                    <a href="#" class="categories-item">
                        <iconify-icon class="category-icon" icon="ph:dog"></iconify-icon>
                        <h5>Dog Shop</h5>
                    </a>
                </div>
                <div class="col text-center">
                    <a href="#" class="categories-item">
                        <iconify-icon class="category-icon" icon="ph:fish"></iconify-icon>
                        <h5>Fish Shop</h5>
                    </a>
                </div>
                <div class="col text-center">
                    <a href="#" class="categories-item">
                        <iconify-icon class="category-icon" icon="ph:cat"></iconify-icon>
                        <h5>Cat Shop</h5>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="clothing" class="my-5 overflow-hidden">
        <div class="container pb-5" style="height: 550px">

            <div data-aos="fade-right" data-aos-offset="400" data-aos-easing="ease-in-sine"
                class="section-header d-md-flex justify-content-between align-items-center mb-3">
                <h2 class="display-3 fw-normal">Pet Clothing</h2>
                <div>
                    <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                        shop now
                        <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                            <use xlink:href="#arrow-right"></use>
                        </svg></a>
                </div>
            </div>

            <div data-aos="fade-left" data-aos-offset="400" data-aos-easing="ease-in-sine"
                class="products-carousel swiper">
                <div class="swiper-wrapper">
                    @foreach ($highly_rated_product as $product)
                        <div class="swiper-slide">
                            <div class="z-1 position-absolute rounded-3 m-3 px-3 border border-dark-subtle" style="background-color: #f1f1f1">
                                New
                            </div>
                            <div class="card position-relative">
                                <a href="{{ route('product-detail', $product->id) }}">
                                    <img src="{{ asset($product->image) }}" class="img-fluid rounded-4" alt="image">
                                </a>
                                <div class="card-body p-0">
                                    <a href="{{ route('product-detail', $product->id) }}">
                                        <h3 class="card-title pt-4 m-0">{{ $product->name }}</h3>
                                    </a>

                                    <div class="card-text">
                                        <span class="rating secondary-font">
                                            @php
                                                $productReviews = $reviews->where('product_id', $product->id); // Giả sử bạn có trường product_id trong bảng Review
                                                $averageRating = $productReviews->avg('rating'); // Tính điểm trung bình
                                            @endphp

                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($averageRating >= $i)
                                                    <iconify-icon icon="material-symbols:star"
                                                        style="color: #dead6f; font-size: 22px;"
                                                        class="me-1"></iconify-icon>
                                                @elseif ($averageRating >= $i - 0.5)
                                                    <iconify-icon icon="material-symbols:star-half"
                                                        style="color: #dead6f; font-size: 22px;"
                                                        class="me-1"></iconify-icon>
                                                @else
                                                    <iconify-icon icon="material-symbols:star-outline"
                                                        style="color: #ccc; font-size: 22px;"
                                                        class="me-1"></iconify-icon>
                                                @endif
                                            @endfor
                                            {{ number_format($averageRating, 1) }} <!-- Hiển thị điểm trung bình -->
                                        </span>

                                        <h3 class="secondary-font text-primary">${{ number_format($product->price, 2) }}
                                        </h3>

                                        <div class="d-flex flex-wrap mt-3">
                                            <form action="{{ route('cart.add') }}" method="POST" class="me-3">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <input type="hidden" name="quantity" id="cart-quantity" value="1">
                                                <button type="submit"
                                                    class="btn-cart px-4 py-3 btn btn-dark text-uppercase rounded-1">
                                                    Add to Cart
                                                </button>
                                            </form>
                                            <form action="{{ route('wishlist.add') }}" class="rounded-1"
                                                style="border: 1px solid #d9d9d8;" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit"
                                                    class="btn-wishlist px-4 pt-3 bg-transparent border-0">
                                                    <iconify-icon icon="fluent:heart-28-filled"
                                                        class="fs-5"></iconify-icon>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
            <!-- / products-carousel -->


        </div>
    </section>

    <section id="foodies" class="my-5">
        <div class="container my-5 py-5">

            <!-- Section Header with Categories -->
            <div data-aos="fade-right" data-aos-offset="400" data-aos-easing="ease-in-sine"
                class="section-header d-md-flex justify-content-between align-items-center">
                <h2 class="display-3 fw-normal">Pet Foodies</h2>
                <div class="mb-4 mb-md-0">
                    <p class="m-0">
                        <button class="filter-button me-4 active" data-filter="*">ALL</button>
                        @foreach ($categories as $category)
                            <button class="filter-button me-4" data-filter=".{{ $category->slug }}">
                                {{ strtoupper($category->name) }}
                            </button>
                        @endforeach
                    </p>
                </div>
                <div>
                    <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                        shop now
                        <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                            <use xlink:href="#arrow-right"></use>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Product Grid -->
            <div data-aos="fade-left" data-aos-offset="400" data-aos-easing="ease-in-sine"
                class="isotope-container row">
                @foreach ($product_list->shuffle() as $product)
                    @php
                        $categorySlug = $product->category->slug ?? 'uncategorized';
                    @endphp
                    <div class="item {{ $categorySlug }} col-md-4 col-lg-3 my-4">
                        <div class="z-1 position-absolute rounded-3 m-3 px-3 border border-dark-subtle"
                            style="background-color: #f1f1f1">
                            New
                        </div>
                        <div class="card position-relative">
                            <a href="{{ route('product-detail', $product->id) }}">
                                <img src="{{ asset($product->image) }}" class="img-fluid rounded-4" alt="image">
                            </a>
                            <div class="card-body p-0">
                                <a href="{{ route('product-detail', $product->id) }}">
                                    <h3 class="card-title pt-4 m-0">{{ $product->name }}</h3>
                                </a>

                                <div class="card-text">
                                    <h3 class="secondary-font text-primary">${{ number_format($product->price, 2) }}</h3>

                                    <div class="d-flex flex-wrap mt-3">
                                        <form action="{{ route('cart.add') }}" method="POST" class="me-3">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit"
                                                class="btn-cart px-4 py-3 btn btn-dark text-uppercase rounded-1">
                                                Add to Cart
                                            </button>
                                        </form>
                                        <form action="{{ route('wishlist.add') }}" method="POST" class="rounded-1"
                                            style="border: 1px solid #d9d9d8;">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit" class="btn-wishlist px-4 pt-3 bg-transparent border-0">
                                                <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>


    <section id="banner-2" class="my-3" style="background: #F9F3EC;">
        <div class="container">
            <div class="row flex-row-reverse banner-content align-items-center">
                <div class="img-wrapper col-12 col-md-6">
                    <img src="public_index/images/banner-img2.png" class="img-fluid">
                </div>
                <div class="content-wrapper col-12 offset-md-1 col-md-5 p-5">
                    <div class="secondary-font text-primary text-uppercase mb-3 fs-4">Upto 40% off</div>
                    <h2 class="banner-title display-1 fw-normal">Clearance sale !!!
                    </h2>
                    <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                        shop now
                        <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                            <use xlink:href="#arrow-right"></use>
                        </svg></a>
                </div>

            </div>
        </div>
    </section>

    <section id="testimonial">
        <div class="container my-5 py-5">
            <div class="row">
                <div class="offset-md-1 col-md-10">
                    <div class="swiper testimonial-swiper">
                        <div class="swiper-wrapper">

                            <div class="swiper-slide">
                                <div class="row ">
                                    <div class="col-2">
                                        <iconify-icon icon="ri:double-quotes-l"
                                            class="quote-icon text-primary"></iconify-icon>
                                    </div>
                                    <div class="col-md-10 mt-md-5 p-5 pt-0 pt-md-5">
                                        <p class="testimonial-content fs-2">At the core of our practice is the idea
                                            that cities are the
                                            incubators of our
                                            greatest achievements, and the best hope for a sustainable future.</p>
                                        <p class="text-black">- Joshima Lin</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="row ">
                                    <div class="col-2">
                                        <iconify-icon icon="ri:double-quotes-l"
                                            class="quote-icon text-primary"></iconify-icon>
                                    </div>
                                    <div class="col-md-10 mt-md-5 p-5 pt-0 pt-md-5">
                                        <p class="testimonial-content fs-2">At the core of our practice is the idea
                                            that cities are the
                                            incubators of our
                                            greatest achievements, and the best hope for a sustainable future.</p>
                                        <p class="text-black">- Joshima Lin</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="row ">
                                    <div class="col-2">
                                        <iconify-icon icon="ri:double-quotes-l"
                                            class="quote-icon text-primary"></iconify-icon>
                                    </div>
                                    <div class="col-md-10 mt-md-5 p-5 pt-0 pt-md-5">
                                        <p class="testimonial-content fs-2">At the core of our practice is the idea
                                            that cities are the
                                            incubators of our
                                            greatest achievements, and the best hope for a sustainable future.</p>
                                        <p class="text-black">- Joshima Lin</p>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="swiper-pagination"></div>

                    </div>
                </div>
            </div>
        </div>

    </section>

    <section id="bestselling" class="my-5 overflow-hidden">
        <div class="container py-3 mb-5" style="height: 550px">

            <div data-aos="fade-right" data-aos-offset="400" data-aos-easing="ease-in-sine"
                class="section-header d-md-flex justify-content-between align-items-center mb-3">
                <h2 class="display-3 fw-normal">Best selling products</h2>
                <div>
                    <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                        shop now
                        <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                            <use xlink:href="#arrow-right"></use>
                        </svg></a>
                </div>
            </div>

            <div data-aos="fade-left" data-aos-offset="400" data-aos-easing="ease-in-sine"
                class=" swiper bestselling-swiper">
                <div class="swiper-wrapper">
                    @foreach ($product_bestselling as $bestselling)
                        @php
                            $hasDiscount =
                                !empty($bestselling->discount_price) &&
                                $bestselling->discount_price < $bestselling->price;
                            $discountPercent = $hasDiscount
                                ? round(
                                    (($bestselling->price - $bestselling->discount_price) / $bestselling->price) * 100,
                                )
                                : 0;

                            // Tính điểm trung bình từ reviews (giống sản phẩm đánh giá cao)
                            $productReviews = $reviews->where('product_id', $bestselling->id);
                            $averageRating = $productReviews->avg('rating');
                        @endphp
                        <div class="swiper-slide">
                            <div class="z-1 position-absolute rounded-3 m-3 px-3 border border-dark-subtle"
                                style="background-color: #f1f1f1">
                                {{ $hasDiscount ? 'Sale -' . $discountPercent . '%' : 'Sale' }}
                            </div>
                            <div class="card position-relative">
                                <a href="single-product.html">
                                    <img src="{{ asset($bestselling->image) }}" class="img-fluid rounded-4"
                                        alt="image">
                                </a>
                                <div class="card-body p-0">
                                    <a href="single-product.html">
                                        <h3 class="card-title pt-4 m-0">{{ $bestselling->name }}</h3>
                                    </a>

                                    <div class="card-text">
                                        <span class="rating secondary-font">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($averageRating >= $i)
                                                    <iconify-icon icon="material-symbols:star"
                                                        style="color: #dead6f; font-size: 22px;"
                                                        class="me-1"></iconify-icon>
                                                @elseif ($averageRating >= $i - 0.5)
                                                    <iconify-icon icon="material-symbols:star-half"
                                                        style="color: #dead6f; font-size: 22px;"
                                                        class="me-1"></iconify-icon>
                                                @else
                                                    <iconify-icon icon="material-symbols:star-outline"
                                                        style="color: #ccc; font-size: 22px;"
                                                        class="me-1"></iconify-icon>
                                                @endif
                                            @endfor
                                            {{ number_format($averageRating, 1) }}
                                        </span>

                                        @if ($hasDiscount)
                                            <h5 class="text-muted text-decoration-line-through mb-1">
                                                ${{ number_format($bestselling->price, 2) }}
                                            </h5>
                                        @endif

                                        <h3 class="secondary-font text-primary">
                                            ${{ number_format($bestselling->discount_price, 2) }}
                                        </h3>

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
            <!-- / category-carousel -->


        </div>
    </section>

    {{-- <section id="register" style="background: url('images/background-img.png') no-repeat;">
        <div class="container ">
            <div class="row my-5 py-5">
                <div class="offset-md-3 col-md-6 my-5 ">
                    <h2 class="display-3 fw-normal text-center">Get 20% Off on <span class="text-primary">first
                            Purchase</span>
                    </h2>
                    <form>
                        <div class="mb-3">
                            <input type="email" class="form-control form-control-lg" name="email" id="email"
                                placeholder="Enter Your Email Address">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control form-control-lg" name="email" id="password1"
                                placeholder="Create Password">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control form-control-lg" name="email" id="password2"
                                placeholder="Repeat Password">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-dark btn-lg rounded-1">Register it now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section> --}}

    <section id="latest-blog" class="my-5">
        <div class="container py-5 my-5">
            <div data-aos="fade-right" data-aos-offset="400" data-aos-easing="ease-in-sine" class="row mt-5">
                <div class="section-header d-md-flex justify-content-between align-items-center mb-3">
                    <h2 class="display-3 fw-normal">Latest Blog Post</h2>
                    <div>
                        <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                            Read all
                            <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                                <use xlink:href="#arrow-right"></use>
                            </svg></a>
                    </div>
                </div>
            </div>
            <div data-aos="fade-left" data-aos-offset="400" data-aos-easing="ease-in-sine" class="row">
                @foreach ($posts as $post)
                    <div class="col-md-4 my-4 my-md-0">
                        <div class="z-1 position-absolute rounded-3 m-2 px-3 pt-1 bg-light">
                            <h3 class="secondary-font text-primary m-0">
                                {{ \Carbon\Carbon::parse($post->created_at)->format('d') }}
                            </h3>
                            <p class="secondary-font fs-6 m-0">
                                {{ \Carbon\Carbon::parse($post->created_at)->format('M') }}
                            </p>
                        </div>
                        <div class="card position-relative">
                            <a href="single-post.html"><img src="{{ asset($post->image) }}" class="img-fluid rounded-4"
                                    style="height: 300px" alt="image"></a>
                            <div class="card-body p-0">
                                <a href="single-post.html">
                                    <h3 class="card-title pt-4 pb-3 m-0">{{ $post->title }}</h3>
                                </a>

                                <div class="card-text">
                                    <p class="blog-paragraph fs-6">{!! $post->description !!}</p>
                                    <a href="single-post.html" class="blog-read">read more</a>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <section id="service">
        <div class="container py-5 my-5">
            <div class="row g-md-5 pt-4">
                <div class="col-md-3 my-3">
                    <div class="card">
                        <div>
                            <iconify-icon class="service-icon text-primary" icon="la:shopping-cart"></iconify-icon>
                        </div>
                        <h3 class="card-title py-2 m-0">Free Delivery</h3>
                        <div class="card-text">
                            <p class="blog-paragraph fs-6">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 my-3">
                    <div class="card">
                        <div>
                            <iconify-icon class="service-icon text-primary" icon="la:user-check"></iconify-icon>
                        </div>
                        <h3 class="card-title py-2 m-0">100% secure payment</h3>
                        <div class="card-text">
                            <p class="blog-paragraph fs-6">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 my-3">
                    <div class="card">
                        <div>
                            <iconify-icon class="service-icon text-primary" icon="la:tag"></iconify-icon>
                        </div>
                        <h3 class="card-title py-2 m-0">Daily Offer</h3>
                        <div class="card-text">
                            <p class="blog-paragraph fs-6">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 my-3">
                    <div class="card">
                        <div>
                            <iconify-icon class="service-icon text-primary" icon="la:award"></iconify-icon>
                        </div>
                        <h3 class="card-title py-2 m-0">Quality guarantee</h3>
                        <div class="card-text">
                            <p class="blog-paragraph fs-6">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section id="insta" class="my-5">
        <div class="row g-0 py-5">
            <div class="col instagram-item  text-center position-relative">
                <div class="icon-overlay d-flex justify-content-center position-absolute">
                    <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
                </div>
                <a href="#">
                    <img src="public_index/images/insta1.jpg" alt="insta-img" class="img-fluid rounded-3">
                </a>
            </div>
            <div class="col instagram-item  text-center position-relative">
                <div class="icon-overlay d-flex justify-content-center position-absolute">
                    <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
                </div>
                <a href="#">
                    <img src="public_index/images/insta2.jpg" alt="insta-img" class="img-fluid rounded-3">
                </a>
            </div>
            <div class="col instagram-item  text-center position-relative">
                <div class="icon-overlay d-flex justify-content-center position-absolute">
                    <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
                </div>
                <a href="#">
                    <img src="public_index/images/insta3.jpg" alt="insta-img" class="img-fluid rounded-3">
                </a>
            </div>
            <div class="col instagram-item  text-center position-relative">
                <div class="icon-overlay d-flex justify-content-center position-absolute">
                    <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
                </div>
                <a href="#">
                    <img src="public_index/images/insta4.jpg" alt="insta-img" class="img-fluid rounded-3">
                </a>
            </div>
            <div class="col instagram-item  text-center position-relative">
                <div class="icon-overlay d-flex justify-content-center position-absolute">
                    <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
                </div>
                <a href="#">
                    <img src="public_index/images/insta5.jpg" alt="insta-img" class="img-fluid rounded-3">
                </a>
            </div>
            <div class="col instagram-item  text-center position-relative">
                <div class="icon-overlay d-flex justify-content-center position-absolute">
                    <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
                </div>
                <a href="#">
                    <img src="public_index/images/insta6.jpg" alt="insta-img" class="img-fluid rounded-3">
                </a>
            </div>
        </div>
    </section>
@endsection
