@extends('client.layouts.master')
@section('title', 'Stripe Payment')
@section('content')
    <div class="container py-5">
        <h2>Thanh toán trực tuyến</h2>
        <p>Total: ${{ number_format($total, 2) }}</p>

        <form id="payment-form">
            <div id="card-element"></div>
            <button id="submit" class="btn btn-dark mt-3">Pay ${{ number_format($total, 2) }}</button>
        </form>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe("{{ config('services.stripe.key') }}");
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        const form = document.getElementById('payment-form');
        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const {
                error,
                paymentIntent
            } = await stripe.confirmCardPayment("{{ $clientSecret }}", {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: "{{ $order->shipping_name }}"
                    }
                }
            });

            if (error) {
                alert(error.message);
            } else if (paymentIntent.status === 'succeeded') {
                alert('Thanh toán thành công!');
                window.location.href = "{{ route('cart.index') }}";
            }
        });
    </script>
@endsection
