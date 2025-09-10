@extends('client.layouts.master')
@section('title', 'Review Order')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Review Order #{{ $order->id }}</h2>

    <form action="{{ route('orders.submitReview', $order->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="rating" class="form-label">Rating</label>
            <select name="rating" id="rating" class="form-control" required>
                <option value="">-- Select --</option>
                <option value="5">⭐️⭐️⭐️⭐️⭐️ Excellent</option>
                <option value="4">⭐️⭐️⭐️⭐️ Good</option>
                <option value="3">⭐️⭐️⭐️ Average</option>
                <option value="2">⭐️⭐️ Poor</option>
                <option value="1">⭐️ Very Bad</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="comment" class="form-label">Your Review</label>
            <textarea name="comment" id="comment" rows="5" class="form-control" placeholder="Write your feedback..."></textarea>
        </div>

        <button type="submit" class="btn btn-success">Submit Review</button>
        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
