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
        <h1 class="fw-bold mt-4">@lang("messages.con_title")</h1>
        <p class="fs-5 text-muted mt-3 mb-5">@lang("messages.con_subtitle")</p>
    </div>

    <div class="d-flex _section1 mt-5 flex-wrap">
        <div class="first">
            <div class="head">
                <h6>@lang("messages.con_office_address")</h6>
            </div>
            <div class="mt-4 _sec__">
                <p class="text-muted mt-4"><strong>@lang("messages.con_phonecon_phone")</strong>:- (+21) 124 123 4546</p>
                <p class="text-muted"><strong>@lang("messages.con_website")</strong>:- www.example.com</p>
                <p class="text-muted"><strong>@lang("messages.con_email")</strong>:- info@example.com</p>
                <p class="text-muted mb-4"><strong>@lang("messages.con_address")</strong>:- @lang("messages.con_address_details")</p>
            </div>
        </div>

        <div class="sec">
            <div class="head">
                <h6>@lang("messages.con_contact_form")</h6>
            </div>     
            <div class="mt-4 _sec__">
                <div class="d-flex mb-3">
                    <input type="text" placeholder='{{ __('messages.con_first_name')}}'>
                    <input type="text" placeholder='{{ __('messages.con_last_name')}}'>
                </div>
                <div class="d-flex mb-3">
                    <input type="text" placeholder='{{ __('messages.con_email_address')}}'>
                    <input type="text" placeholder='{{ __('messages.con_subject')}}'>
                </div>
                <textarea name="" placeholder='{{ __('messages.con_type_message')}}' id="" cols="20" rows="5"></textarea>
                <button class="btn mt-2 bg_ text-white px-4 mb-2">@lang("messages.con_submit")</button>
            </div>       
        </div>
    </div>

	<hr style="color: rgb(183, 183, 183)">

	<x-footer></x-footer>
</div>
@endsection