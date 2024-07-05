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
        <form action="/register" method="POST">
            @csrf
            <div class="text-center">
                <h4 class="text-center mb-1 text-white" >Sign up to continue</h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li style="width: fit-content" class="list-unstyled mb-0">{{ $error }}</li>
                        @endforeach
                    </div>
                @endif
                @if (session("msg"))
                    <div class="alert alert-danger text-center">
                        <li style="width: fit-content" class="list-unstyled">{{session("msg")}}</li>
                    </div>
                @endif
                
                <input required type="text" placeholder="First Name">
                <input required type="text" placeholder="Last Name">
                <input required type="text" placeholder="Phone Number">
                <input required type="email" placeholder="Enter email address">
                <input required type="password" placeholder="Password">
            </div>
            <br>
            <button class="btn px-5 mx-5 btn-outline-light">Sign up</button>
        </form>
        <p class="text-center mt-5 text-white ft">Already have an account? <a href="/login" class="text-decoration-none text-primary">Login instead</a></p>
    </div>
    <div class="img __reg">
        <img src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/blog/img-blog-2.png" alt="">
    </div>
</div>
@endsection