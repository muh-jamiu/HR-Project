@extends("layouts.app")

@php
$user = $data["user"] ?? [];
$branch = $data["branch"] ?? [];
$skills__ = explode(",", $user->skills);
use Carbon\Carbon;
$is_employ = true;
@endphp

@section('title')
Employer-{{$user->company_name}} | HR
@endsection

@section("content")
<div class="jobs job_single">
	<x-main-nav :isemploy="$is_employ"></x-main-nav>

    <div class="section1">
       <div class="d-flex mt-3">
        <div class="img__">
            @if ($user->avatar)
            <img  width="150" height="150" style="border-radius: 50% ; background-color: rgb(226, 226, 226)" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS48f-GOfd7Vvaya0EWXRmDjamdDQs-FJdkWg&s" alt="">                                       
            @else
            <img  width="150" height="150" style="border-radius: 50%" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS48f-GOfd7Vvaya0EWXRmDjamdDQs-FJdkWg&s" alt="">                                     
            @endif
        </div>
        <div class="mx-3 mt-3">
            <h3 class="fw-bold text-capitalize">{{$user->company_name}}</h3>
            <div class="d-flex _jenki">
                <p class="mb-0 text-muted text-capitalize"><i class="fa-solid fa-location-dot"></i> {{$user->state}}, {{$user->country}}</p>
                <p class="mb-0 text-muted text-capitalize"><i class="fa-solid fa-bag-shopping"></i> {{$user->company_type}}</p>
                <p class="mb-0 text-muted text-capitalize"><i class="fa-solid text-primary fa-certificate"></i> Verified</p>
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
                <h4>About Company</h4>
                <p class="text-muted">{{$user->bio ?? "N/A"}}</p>
            </div>

            <hr style="color: rgb(198, 198, 198)">

            <div class="mt-5">
                <h4>Branches</h4>
                @if (count($branch) == 0)
                    <p class="text-muted mt-3">This Company does not have any branch added</p>
                @else
                <div class="row mt-4">
                    @foreach ($branch as $item)
                        <div class="col-sm-4 mb-3">
                            <p class="fw-bold text-capitalize mb-1">{{$item->name}}</p>
                            <p class="text-muted text-capitalize mb-1 ft">{{$item->state}}, {{$item->country}}</p>
                            <p class="text-muted mb-1 ft">{{$item->date}}</p>
                        </div>                        
                    @endforeach
                </div>
                    
                @endif
            </div>

            <hr style="color: rgb(198, 198, 198)">
            
            {{-- <div class="mt-5">
                <h4>Vacancies</h4>
                <ul>
                    <li class="text-muted ft mb-2">Digital Designer - 03 person</li>
                    <li class="text-muted ft mb-2">Digital Marketing - 04 persons</li>
                    <li class="text-muted ft mb-2">Project Manager - 02 persons</li>
                </ul>
            </div> --}}

        </div>

        <div class="j_sec">
            <div class="d-flex pt-2 mb-2" style="border-bottom: 1px solid rgb(235, 235, 235)">
                <img style="border-radius: 50%" width="30" height="30" src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/page/job-single/img-job-feature.png" alt="">
                <p class="mb-3 mx-2 fw-bold text-capitalize">{{$user->company_name}}</p>
            </div>

            <p class="fw-bold text-muted mb-1 text-capitalize"><i class="fa-solid fa-bag-shopping"></i> {{$user->company_type}}</p>
            <p class="mb-4 text-muted text-capitalize">{{$user->title}}</p>

            <p class="fw-bold text-muted mb-1"><i class="fa-solid fa-location-dot"></i> Location</p>
            <p class="mb-4 text-muted text-capitalize">{{$user->state}}, {{$user->country}}</p>

            <p class="fw-bold text-muted mb-1"><i class="fa-solid fa-sack-dollar"></i> Salary</p>
            <p class="mb-4 text-muted text-capitalize">($) {{$user->salary}}</p>

            <p class="fw-bold text-muted mb-1"><i class="fa-regular fa-clock"></i> Member since</p>
            <p class="mb-4 text-muted">{{Carbon::create($user->created_at)->format('l F j, Y')}}</p>
            <hr style="color: rgb(172, 172, 172)">

            <p class="fw-bold text-muted mb-2">Contact Info</p>
            <p class="text-muted ft text-capitalize"><i class="fa-solid fa-phone"></i> {{$user->phone}}</p>
            <p class="text-muted ft text-capitalize"><i class="fa-regular fa-envelope"></i> {{$user->email}}</p>
            <p class="text-muted ft text-capitalize"><i class="fa-solid fa-location-dot"></i> {{$user->address}}</p>

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