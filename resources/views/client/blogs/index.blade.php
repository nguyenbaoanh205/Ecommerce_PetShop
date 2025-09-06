@extends('client.layouts.master')
@section('title', 'Blogs')

@section('content')
    <!-- Shop Banner -->
    <div class="shop-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 data-aos="fade-up">Blog</h1>
                    <!-- Breadcrumbs -->
                    <div class="breadcrumbs" data-aos="fade-up" data-aos-delay="200">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Blog</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Start Blog Section -->
    <div class="blog-section">
        <div class="container">
            <div class="row">
                @foreach ($blogs as $blog)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-5">
                        <div class="post-entry">
                            <a href="{{ route('blog.show', $blog->slug) }}" class="post-thumbnail">
                                <img src="{{ asset($blog->image ?? 'uploads/default/default.jpg') }}" alt="Image"
                                    class="img-fluid blog-image">
                            </a>
                            <div class="post-content-entry">
                                <h3><a href="{{ route('blog.show', $blog->slug) }}">{{ Str::limit($blog->title, 90) }}</a>
                                </h3>
                                <div class="meta">
                                    <span>{{ $blog->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Blog Section -->
@endsection
<style>
    .blog-image {
        width: 100%;
        height: 80px;
        /* bạn chỉnh theo ý, ví dụ 200-300px */
        object-fit: cover;
        /* đảm bảo ảnh không méo */
        border-radius: 12px 12px 0 0;
        /* bo góc phía trên */
    }

    .post-entry {
        border-radius: 12px;
        overflow: hidden;
        /* giữ bo góc */
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        background: #fff;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .post-entry:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .post-content-entry {
        background: #f8f9fa;
        /* nền nhạt */
        padding: 15px;
        border-radius: 0 0 12px 12px;
        /* bo góc dưới */
    }
</style>
