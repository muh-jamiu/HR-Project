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

	<hr style="color: rgb(183, 183, 183)">

	<x-footer></x-footer>
</div>
@endsection