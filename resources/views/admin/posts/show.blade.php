@extends('admin.layouts.master')

@section('content')
<div class="pc-container">
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Post Details</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.posts.index') }}">Posts</a></li>
                            <li class="breadcrumb-item" aria-current="page">Post Details</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Post Information</h5>
                        <div class="card-header-right">
                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-info btn-sm">
                                <i class="ti ti-edit"></i> Edit
                            </a>
                            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary btn-sm">
                                <i class="ti ti-arrow-left"></i> Back to List
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-4">
                                    <h4 class="mb-3">{{ $post->title }}</h4>
                                    <div class="mb-3">
                                        <span class="badge bg-{{ $post->status == 'published' ? 'success' : 'warning' }}">
                                            {{ ucfirst($post->status) }}
                                        </span>
                                        <span class="text-muted ms-2">
                                            Created: {{ $post->created_at->format('Y-m-d H:i') }}
                                        </span>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Category:</strong> {{ $post->category->name }}
                                    </div>
                                    <div class="mb-3">
                                        <strong>Slug:</strong> {{ $post->slug }}
                                    </div>
                                    <div class="mb-3">
                                        <strong>Description:</strong>
                                        <div class="mt-2">
                                            {!! nl2br(e($post->description)) !!}
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Content:</strong>
                                        <div class="mt-2">
                                            {!! nl2br(e($post->content)) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                @if($post->image)
                                    <div class="card">
                                        <img src="{{ asset($post->image) }}" 
                                             alt="{{ $post->title }}" 
                                             class="card-img-top"
                                             style="max-height: 300px; object-fit: cover;">
                                    </div>
                                @else
                                    <div class="alert alert-info">
                                        No image available
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
@endsection 