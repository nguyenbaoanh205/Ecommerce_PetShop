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
                            <h5 class="m-b-10">Posts</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Posts</li>
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
                        <h5>Posts List</h5>
                        <div class="card-header-right">
                            <a href="{{ route('admin.posts.create') }}" class="btn btn-primary btn-sm">
                                <i class="ti ti-plus"></i> Add New Post
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-hover table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($posts as $post)
                                        <tr>
                                            <td>{{ $post->id }}</td>
                                            <td>
                                                @if($post->image)
                                                    <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" style="max-width: 100px;">
                                                @else
                                                    No Image
                                                @endif
                                            </td>
                                            <td>{{ $post->title }}</td>
                                            <td>{{ $post->category->name }}</td>
                                            <td>
                                                <span class="badge bg-{{ $post->status ? 'success' : 'danger' }}">
                                                    {{ $post->status ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td>{{ $post->created_at->format('Y-m-d H:i') }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="ti ti-eye"></i> View
                                                </a>
                                                <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-info btn-sm">
                                                    <i class="ti ti-edit"></i> Edit
                                                </a>
                                                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this post?')">
                                                        <i class="ti ti-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
@endsection 