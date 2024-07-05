@extends("layouts.app")

@php
$user = $data["user"] ?? [];
$skills__ = explode(",", $user->skills);
@endphp

@section('title')
Candidate-{{$user->username ?? ""}} | HR
@endsection

@section("content")
<div class="jobs job_single">
	<x-main-nav></x-main-nav>

    <div class="section1">
        <button class="btn btn-primary _cv_">Download CV</button>
       <div class="d-flex mt-3">
        <div class="img__" style="">
            @if ($user->avatar)
            <img  width="150" height="150" style="border-radius: 50% ; background-color: rgb(226, 226, 226)" src="{{$user->avatar}}" alt="">                                       
            @else
            <img  width="150" height="150" style="border-radius: 50%" src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/page/candidates/img-candidate.png" alt="">                                     
            @endif
        </div>
        <div class="mx-3 mt-3">
            <h3 class="fw-bold text-capitalize">{{$user->first_name}} {{$user->last_name}}</h3>
            <div class="d-flex _jenki">
                <p class="mb-0 text-muted text-capitalize"><i class="fa-solid fa-location-dot"></i> {{$user->state}}, {{$user->country}}</p>
                <p class="mb-0 text-muted text-capitalize"><i class="fa-solid fa-bag-shopping"></i> {{$user->title}}</p>
                <p class="mb-0 text-muted"><i class="fa-solid text-primary fa-certificate"></i> Verified</p>
            </div>
            <div class="d-flex mt-3 flex-wrap _skills">
                @foreach ($skills__ as $item)
                    <p class="text-muted text-capitalize">{{$item}}</p>                     
                @endforeach
            </div>
        </div>
       </div>
    </div>
    
    <div class="section2 mb-5 d-flex flex-wrap">
        <div class="j_first">
            <div class="">
                <h4>Biography</h4>
                <p class="text-muted text-capitalize">
                    @if ($user->bio)
                        {{$user->bio}}
                    @else
                        Hi, I am {{$user->first_name}} {{$user->last_name}}, a professional {{$user->title}}.
                    @endif
                </p>
            </div>

            <hr style="color: rgb(198, 198, 198)">

            <div class="mt-5">
                <h4>Work Experience</h4>
                <div class="row mt-4">
                    <div class="col-sm-4 mb-3">
                        <p class="fw-bold mb-1">Software Developer</p>
                        <p class="text-muted mb-1 ft">Lagos, Nigeria</p>
                        <p class="text-muted mb-1 ft">Jan 2018 — Dec 2021</p>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <p class="fw-bold mb-1">Software Developer</p>
                        <p class="text-muted mb-1 ft">Lagos, Nigeria</p>
                        <p class="text-muted mb-1 ft">Jan 2018 — Dec 2021</p>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <p class="fw-bold mb-1">Software Developer</p>
                        <p class="text-muted mb-1 ft">Lagos, Nigeria</p>
                        <p class="text-muted mb-1 ft">Jan 2018 — Dec 2021</p>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <p class="fw-bold mb-1">Software Developer</p>
                        <p class="text-muted mb-1 ft">Lagos, Nigeria</p>
                        <p class="text-muted mb-1 ft">Jan 2018 — Dec 2021</p>
                    </div>
                </div>
            </div>

            <hr style="color: rgb(198, 198, 198)">
            
            <div class="mt-5">
                <h4>Education</h4>
                <ul>
                    <li class="text-muted ft mb-2">Cambridge University(2001-2004)</li>
                    <li class="text-muted ft mb-2">Brads University(2004-2006)</li>
                    <li class="text-muted ft mb-2">Cambridge University(2006-2010)</li>
                </ul>
            </div>

            <div class="mt-5">
                <h4>Professional Skills</h4>
                <ul>
                    @foreach ($skills__ as $item)
                        <li class="text-muted text-capitalize ft mb-2">{{$item}}</li>                        
                    @endforeach
                </ul>
            </div>  

            <div class="d-flex mt-3">
                <button class="btn text-white btn-success px-4 bg_">Hire Now</button>
            </div>

        </div>

        <div class="j_sec">
            <div class="d-flex pt-2" style="border-bottom: 1px solid rgb(235, 235, 235)">
                <img style="border-radius: 50%" width="30" height="30" src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/page/job-single/img-job-feature.png" alt="">
                <p class="mb-3 mx-2 fw-bold text-capitalize">{{$user->first_name}} {{$user->last_name}}</p>
            </div>
            <div class="d-flex justify-content-between mt-3">
                <button class="btn text-white btn-success px-4 bg_">Hire Now</button>
            </div>
            <hr style="color: rgb(172, 172, 172)">
            <p class="fw-bold text-muted mb-1"><i class="fa-solid fa-bag-shopping"></i> Experience</p>
            <p class="mb-4 text-muted">Full-time / Remote</p>

            <p class="fw-bold text-muted mb-1"><i class="fa-solid fa-location-dot"></i> Location</p>
            <p class="mb-4 text-muted text-capitalize">{{$user->state}}, {{$user->country}}</p>

            <p class="fw-bold text-muted mb-1"><i class="fa-solid fa-sack-dollar"></i> Salary</p>
            <p class="mb-4 text-muted text-capitalize">{{$user->salary ?? "$0"}}</p>

            <p class="fw-bold text-muted mb-1"><i class="fa-regular fa-clock"></i> Member since</p>
            <p class="mb-4 text-muted">{{$user->created_at}}</p>
            <hr style="color: rgb(172, 172, 172)">

            <p class="fw-bold text-muted mb-2">Contact Info</p>
            <p class="text-muted ft"><i class="fa-solid fa-phone"></i> {{$user->phone ?? "N/A"}}</p>
            <p class="text-muted ft"><i class="fa-regular fa-envelope"></i> {{$user->email}}</p>
            <p class="text-muted ft text-capitalize"><i class="fa-solid fa-location-dot"></i> {{$user->address ?? "N/A"}}</p>

            <hr style="color: rgb(172, 172, 172)">

            <div class="__job__ mt-3 mb-3">
                <h5 class="fw-bold mb-3">Recruiting?</h5>
                <p class="ft">Advertise your jobs to millions of monthly users and search 16.8 million CVs in our database.</p>
                <button class="btn btn-light mt-4">Post A Job</button>
            </div>
        </div>
    </div>

	<hr style="color: rgb(183, 183, 183)">

	<x-footer></x-footer>
</div>
@endsection