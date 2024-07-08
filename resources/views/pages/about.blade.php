@extends("layouts.app")

@php
$isabout = true;
@endphp

@section('title')
About Us | HR
@endsection

@section("content")
<div class="jobs">
	<x-main-nav :isabout="$isabout"></x-main-nav>

    <div class="section1">
        <h1 class="fw-bold mt-4">About Us</h1>
        <p class="fs-5 text-muted mt-3 mb-5">Discover your next career move, freelance gig, or internship</p>
    </div>
    <button id="checkout-button">Checkout</button>
    <button id="paypal-checkout-button">Pay with PayPal</button>


	<x-footer></x-footer>
</div>
@endsection

@push('javascript')
    <script>
        var stripe = Stripe('pk_test_51PWISG04IcA87AEYAPd7HuumgwcuLJlht6CZW6GfgVH9rBue8ROt1tqhFl2i9IvEWGjC4ket7sODFvDmQLEVqP2b00rnevrgns');

        document.getElementById('checkout-button').addEventListener('click', function () {
            axios.post('/stripe', {}, {
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(function (response) {
                console.log(response)
                return stripe.redirectToCheckout({ sessionId: response.data.id });
            })
            .then(function (result) {
                console.log(result)
                if (result.error) {
                    alert(result.error.message);
                }
            })
            .catch(function (error) {
                console.error('Error:', error);
            });
        });


        document.getElementById('paypal-checkout-button').addEventListener('click', function () {
            axios.post('{{ route('paypal.transaction') }}', {}, {
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(function (response) {
                console.log(response)
                // window.location.href = response.request.responseURL;
            })
            .catch(function (error) {
                console.error('Error:', error);
            });
        });

    </script>
@endpush