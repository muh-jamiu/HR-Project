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

    <img class="mx-5" style="width: 320px" src="/img/logo_.png" alt="">

    <p class="text-muted" style="padding:4em; line-height:30px; padding-top:0em">
        Welcome to Ai-SmartRecuiter.com, your ultimate AI-powered resume analysis platform 
            designed to streamline the hiring process for medium to large companies. Founded by 
            Salaheddine Rchouma, a dedicated Business Analytics and Data Science student with 
            extensive experience in the field, our company is proudly based in Rabat, Morocco. At Ai-
            SmartRecuiter, we leverage advanced AI technology to automate resume scanning, evaluate 
            candidates' technical and soft skills, and provide a comprehensive scoring system to help HR 
            professionals make informed hiring decisions with ease and efficiency. Join us in 
            revolutionizing the recruitment landscape with cutting-edge solutions tailored to meet your 
    </p>

    <hr>


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