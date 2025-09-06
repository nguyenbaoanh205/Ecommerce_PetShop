@extends('client.layouts.master')
@section('title', 'Blogs')

@section('content')
    <!-- Start Blog Section -->
    <div class="blog-section mt-5">
        <div class="container">
            <!-- Page Title -->
            <div class="text-center mb-5">
                <h1 class="fw-bold display-5">📰 Our Blogs</h1>
                <p class="text-muted">Discover the latest tips, news & stories about pets 🐾</p>
            </div>

            <div class="row">
                @foreach ($blogs as $blog)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-5">
                        <div class="post-entry">
                            <a href="{{ route('blog.show', $blog->slug) }}" class="post-thumbnail">
                                <img src="{{ asset($blog->image ?? 'uploads/default/default.jpg') }}" alt="Image"
                                    class="blog-image">
                            </a>
                            <div class="post-content-entry">
                                <h3>
                                    <a href="{{ route('blog.show', $blog->slug) }}">
                                        {{ Str::limit($blog->title, 90) }}
                                    </a>
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
    .post-thumbnail {
        display: block;
        width: 100%;
        aspect-ratio: 4/3;
        /* hoặc 16/9 cho rộng hơn */
        overflow: hidden;
        border-radius: 12px 12px 0 0;
        background: #f1f1f1;
        /* màu nền khi ảnh không load */
    }

    .blog-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* đảm bảo ảnh fill khung */
    }

    .post-entry {
        border-radius: 12px;
        overflow: hidden;
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
        padding: 15px;
        border-radius: 0 0 12px 12px;
    }
</style>
