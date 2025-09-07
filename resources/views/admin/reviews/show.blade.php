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
                            <h5 class="m-b-10">Review Details</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.reviews.index') }}">Reviews</a></li>
                            <li class="breadcrumb-item" aria-current="page">Review #{{ $review->id }}</li>
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
                        <h5>Review Information</h5>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <h6>User Information</h6>
                                <table class="table table-borderless">
                                    <tr>
                                        <th>Name:</th>
                                        <td>{{ $review->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email:</th>
                                        <td>{{ $review->user->email }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h6>Product Information</h6>
                                <table class="table table-borderless">
                                    <tr>
                                        <th>Product Name:</th>
                                        <td>{{ $review->product->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Rating:</th>
                                        <td>
                                            <div class="rating">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="ti ti-star{{ $i <= $review->rating ? ' text-warning' : '' }}"></i>
                                                @endfor
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Review Date:</th>
                                        <td>{{ $review->created_at->format('Y-m-d H:i') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <h6>Review Comment</h6>
                                <div class="card">
                                    <div class="card-body">
                                        {{ $review->comment }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                {{-- <form action="{{ route('admin.reviews.update', $review->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="rating">Rating</label>
                                                <select class="form-control" id="rating" name="rating" required>
                                                    <option value="1" {{ $review->rating == 1 ? 'selected' : '' }}>1 Star</option>
                                                    <option value="2" {{ $review->rating == 2 ? 'selected' : '' }}>2 Stars</option>
                                                    <option value="3" {{ $review->rating == 3 ? 'selected' : '' }}>3 Stars</option>
                                                    <option value="4" {{ $review->rating == 4 ? 'selected' : '' }}>4 Stars</option>
                                                    <option value="5" {{ $review->rating == 5 ? 'selected' : '' }}>5 Stars</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-primary">Update Review</button>
                                    </div>
                                </form> --}}
                                <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary">Back to List</a>
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