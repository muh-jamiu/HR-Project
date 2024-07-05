@extends("layouts.app")

@php
$iscontact = true;
@endphp

@section('title')
Sign up to continue | HR
@endsection

@section("content")
<div class="d-flex login">
    <div class="form" style="height: 100vh; overflow:scroll">
        <br>
        <div class="text-center">
            <h4 class="text-center mb-1 text-white" >Sign up to continue</h4>
            <input type="text" placeholder="First Name">
            <input type="text" placeholder="Last Name">
            <input type="text" placeholder="Phone Number">
            <input type="text" placeholder="Enter email address">
            <input type="password" placeholder="Password">
        </div>
        <br>
        <button class="btn px-5 mx-5 btn-outline-light">Sign up</button>
        <p class="text-center mt-5 text-white ft">Already have an account? <a href="/login" class="text-decoration-none text-primary">Login instead</a></p>
    </div>
    <div class="img __reg">
        <img src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/blog/img-blog-2.png" alt="">
    </div>
</div>
@endsection