@extends("layouts.app")

@php
$iscontact = true;
@endphp

@section('title')
Contact Us | HR
@endsection

@section("content")
<div class="contact jobs">
	<x-main-nav :iscontact="$iscontact"></x-main-nav>

    <div class="section1">
        <h1 class="fw-bold mt-4">Contact Us</h1>
        <p class="fs-5 text-muted mt-3 mb-5">Discover your next career move, freelance gig, or internship</p>
    </div>

    <div class="d-flex _section1 mt-5 flex-wrap">
        <div class="first">
            <div class="head">
                <h6>Office Address</h6>
            </div>
            <div class="mt-4 _sec__">
                <p class="text-muted mt-4"><strong>Phone</strong>:- (+21) 124 123 4546</p>
                <p class="text-muted"><strong>Website</strong>:- www.example.com</p>
                <p class="text-muted"><strong>E-Mail</strong>:- info@example.com</p>
                <p class="text-muted mb-4"><strong>Address</strong>:- 3241, Lorem ipsum dolor sit amet, consectetur adipiscing elit Proin fermentum condimentum mauris.</p>
            </div>
        </div>

        <div class="sec">
            <div class="head">
                <h6>Contact Form</h6>
            </div>     
            <div class="mt-4 _sec__">
                <div class="d-flex mb-3">
                    <input type="text" placeholder="First name">
                    <input type="text" placeholder="Last name">
                </div>
                <div class="d-flex mb-3">
                    <input type="text" placeholder="Email Address">
                    <input type="text" placeholder="Subject">
                </div>
                <textarea name="" placeholder="Type message..." id="" cols="20" rows="5"></textarea>
                <button class="btn mt-2 bg_ text-white px-4 mb-2">Submit</button>
            </div>       
        </div>
    </div>

	<hr style="color: rgb(183, 183, 183)">

	<x-footer></x-footer>
</div>
@endsection