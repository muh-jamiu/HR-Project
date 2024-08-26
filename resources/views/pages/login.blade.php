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
        <img src="https://superio-appdir.vercel.app/images/background/12.jpg" alt="">
    </div>
    <div class="form">
        <br>
            <div class="text-center">
                <h4 class="text-center mb-5 mt-4 text-dark">{{ __('messages.l_login_to_continue') }}</h4>

                <div class="nav nav_ d-flex mb-4 justify-content-evenly nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="pill" href="#home"><i class="fa-regular fa-user"></i> {{ __('messages.l_candidate') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-4" data-bs-toggle="pill" href="#menu1"><i class="fa-solid fa-bag-shopping"></i> {{ __('messages.l_employer') }}</a>
                    </li>
                </div>

                @if ($errors->any())
                <div class="alert mt-2 alert-danger">
                    @foreach ($errors->all() as $error)
                        <li style="width: fit-content" class="list-unstyled mb-0">{{ $error }}</li>
                    @endforeach
                </div>
                @endif
                @if (session("msg"))
                    <div class="alert alert-danger mt-2 text-center">
                        <li style="width: fit-content" class="list-unstyled">{{session("msg")}}</li>
                    </div>
                @endif

                <div class="tab-content">
                    <div class="tab-pane container active" id="home">
                        <form action="/login" method="post">
                            @csrf
                            <input name="email" value="{{ old('email') }}" required type="email" placeholder="{{ __('messages.l_enter_email') }}">
                            <input name="password" type="password" placeholder="{{ __('messages.l_password_placeholder') }}">
                            <br>
                            <button style="width: 80%" class="btn p-3 mt-4 mx-5 btn-primary">{{ __('messages.l_login_button') }}</button>
                        </form>
                    </div>

                    <div class="tab-pane container fade" id="menu1">
                        <form action="/login" method="post">
                            @csrf
                            <input name="email" value="{{ old('email') }}" required type="email" placeholder="{{ __('messages.l_enter_email') }}">
                            <input name="password" type="password" placeholder="{{ __('messages.l_password_placeholder') }}">
                            <br>
                            <button style="width: 80%" class="btn p-3 mt-4 mx-5 btn-primary">{{ __('messages.l_login_button') }}</button>
                        </form>
                    </div>
                </div>
                <p class="text-center mt-5 text-muted ft">{{ __('messages.l_no_account') }} <a href="/signup" class="text-decoration-none text-primary">{{ __('messages.l_signup_instead') }}</a></p>
            </div>
    </div>
</div>
@endsection