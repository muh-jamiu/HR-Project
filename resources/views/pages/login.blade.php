@extends("layouts.app")

@php
$iscontact = true;
@endphp

@section('title')
Login to continue | HR
@endsection

@section("content")
<div class="d-flex login">
    <div class="img __login">
        <img src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/blog/img-blog-4.png" alt="">
    </div>
    <div class="form">
        <br>
        <div class="text-center">
            <h4 class="text-center mb-4 mt-4 text-white" >Login to continue</h4>
            <input type="text" placeholder="Enter email address">
            <input type="password" placeholder="********">
        </div>
        <br>
        <button class="btn px-5 mx-5 btn-outline-light">Login</button>
        <p class="text-center mt-5 text-white ft">Don't have an account? <a href="/signup" class="text-decoration-none text-primary">Sign up instead</a></p>
    </div>
</div>
@endsection