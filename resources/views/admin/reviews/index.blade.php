@extends('admin.layouts.master')
@section('title', 'Reviews Management')

@section('content')
<div class="pc-container">
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Reviews</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Reviews</li>
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
                        <h5>Reviews List</h5>
                    </div>
                    <div class="card-body">
                        @include('admin.partials.alert')
                        <div class="table-responsive">
                            <table class="table table-hover table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>Product</th>
                                        <th>Rating</th>
                                        <th>Comment</th>
                                        <th>Date</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reviews as $review)
                                        <tr>
                                            <td>{{ $review->id }}</td>
                                            <td>{{ $review->user->name }}</td>
                                            <td>{{ $review->product->name }}</td>
                                            <td>
                                                <div class="rating">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="ti ti-star{{ $i <= $review->rating ? ' text-warning' : '' }}"></i>
                                                    @endfor
                                                </div>
                                            </td>
                                            <td>{{ Str::limit($review->comment, 50, '...') }}</td>
                                            <td>{{ $review->created_at->format('Y-m-d H:i') }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.reviews.show', $review->id) }}" class="btn btn-info btn-sm">
                                                    <i class="ti ti-eye"></i> View
                                                </a>
                                                {{-- <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this review?')">
                                                        <i class="ti ti-trash"></i> Delete
                                                    </button>
                                                </form> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $reviews->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
@endsection 