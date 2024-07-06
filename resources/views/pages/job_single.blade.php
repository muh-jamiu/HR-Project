@extends("layouts.app")

@php
$is_jobs = true;
$job_title = $data["title"] ?? ""; 
$job = $data["job"] ?? ""; 
$company = $data["company"] ?? ""; 
use Carbon\Carbon;
@endphp

@section('title')
{{$job->title}} | HR
@endsection

@section("content")
<div class="jobs job_single">
	<x-main-nav :isjobs="$is_jobs"></x-main-nav>

    <div class="section1">
        <h1 class="fw-bold mt-4 text-capitalize">{{$job->title}}</h1>
        <p class="fs-5 text-muted mt-3 mb-5">Discover your next career move, freelance gig, or internship</p>
    </div>
    
    <div class="section2 mb-5 d-flex flex-wrap">
        <div class="j_first">
            <div class="img">
                <img src="{{$job->avatar ?? "https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/jobs/job-3.png"}}" alt="">
            </div>

            <div class="mt-5">
                <h4 class="text-capitalize">{{$company->company_name}}</h4>
                <p class="text-muted text-capitalize">{{$company->bio}}</p>
            </div>
            <hr>

            <div class="mt-5">
                <h4>Job Description</h4>
                <p class="text-muted text-capitalize">{{$job->description}}</p>
            </div>
            <hr>

            <div class="mt-5">                
                @php
                    $experience = explode(" @/", $job->experience) ?? 0;
                @endphp
                <h4>Preferred Experience</h4>
                @if ($experience)
                    <ul>
                        @foreach ($experience as $item)
                        @if ($item != "")
                        <li class="text-muted text-capitalize ft mb-2">{{$item}}</li>                              
                        @endif                          
                        @endforeach
                    </ul>                    
                @endif
            </div>  
            <hr>

            <div class="mt-5">                
                @php
                    $skills = explode(" @/", $job->skills) ?? 0;
                @endphp
                <h4>Desired skills</h4>
                @if ($skills)
                    <ul>
                        @foreach ($skills as $item)
                        @if ($item != "")
                        <li class="text-muted text-capitalize ft mb-2">{{$item}}</li>                              
                        @endif                          
                        @endforeach
                    </ul>                    
                @endif
            </div>  
            <hr>
            
            <div class="mt-5 text-capitalize"> <a class="text-decoration-none" href="/employer/{{$company->unique_id}}/{{str_replace(" ", "_", $company->company_name)}}"><h4>Visit {{$company->company_name}} Page</h4></a></div>
            <hr style="color: rgb(198, 198, 198)">
            
            <div class="d-flex">
                <button data-bs-toggle="modal" data-bs-target="#apply__" class="btn text-white btn-success px-4 bg_">Apply Now</button>
                <button class="btn btn-outline-primary px-4 mx-3">Save Job</button>
            </div>

        </div>

        <div class="j_sec">
            <div class="d-flex pt-2" style="border-bottom: 1px solid rgb(235, 235, 235)">
                <img style="border-radius: 50%; object-fit:cover" width="30" height="30" src="{{$company->avatar}}" alt="">
                <p class="mb-3 mx-2 fw-bold text-capitalize"> <a class="text-decoration-none text-muted" href="/employer/{{$company->unique_id}}/{{str_replace(" ", "_", $company->company_name)}}">{{$company->company_name}}</a></p>
            </div>
            <p class="text-muted mt-3">We're looking to add more candidate to our growing teams.</p>
            <div class="d-flex">
                <a href="#apply" data-bs-toggle="modal" data-bs-target="#apply__" class="btn text-white btn-success px-4 bg_">Apply Now</a>
                <button class="btn btn-outline-primary px-4 mx-3">Save Job</button>
            </div>
            <hr style="color: rgb(172, 172, 172)">
            <p class="fw-bold text-muted mb-1"><i class="fa-solid fa-bag-shopping"></i> Employment Type</p>
            <p class="mb-4 text-muted text-capitalize">{{$job->employment_type}}</p>

            <p class="fw-bold text-muted mb-1"><i class="fa-solid fa-location-dot"></i> Location</p>
            <p class="mb-4 text-muted text-capitalize">{{$job->state}}, {{$job->country}}</p>

            
            <p class="fw-bold text-muted mb-1">Level</p>
            <p class="mb-4 text-muted text-capitalize">{{$job->level}}</p>

            <p class="fw-bold text-muted mb-1"><i class="fa-solid fa-sack-dollar"></i> Salary</p>
            <p class="mb-4 text-muted">${{number_format($job->salary)}}</p>

            <p class="fw-bold text-muted mb-1"><i class="fa-regular fa-clock"></i> Date posted</p>
            <p class="mb-4 text-muted"> {{Carbon::create($job->created_at)->format('l F j, Y')}}</p>
            <hr style="color: rgb(172, 172, 172)">

            <p class="fw-bold text-muted mb-2">Contact Info</p>
            <p class="text-muted ft"><i class="fa-solid fa-phone"></i> {{$job->phone}}</p>
            <p class="text-muted ft"><i class="fa-regular fa-envelope"></i> {{$job->email}}</p>
            <p class="text-muted ft text-capitalize"><i class="fa-solid fa-location-dot"></i> {{$job->address}}</p>

            <hr style="color: rgb(172, 172, 172)">

            <div class="__job__ mt-3 mb-3">
                <h5 class="fw-bold mb-3">Recruiting?</h5>
                <p class="ft">Advertise your jobs to millions of monthly users and search 16.8 million CVs in our database.</p>
                <button class="btn btn-light mt-4">Post A Job</button>
            </div>
        </div>
    </div>

	<hr style="color: rgb(183, 183, 183)">

    <div class="modal fade" id="apply__">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
          <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
              <h6 class="modal-title">Job Application</h6>
              <button type="button" class="btn-close ft" data-bs-dismiss="modal"></button>
            </div>
      
            <!-- Modal body -->
            <div class="modal-body">
                <p class="fw-bold">Basic Information</p>
                <form action="" method="get">
                    <input required type="text" placeholder="Enter fullname">
                    <input required type="email" placeholder="Enter email address">
                    <input required type="text" placeholder="Phone number">
                    <input required type="text" placeholder="Country">
                    <input required type="text" placeholder="State">
                    <input required type="text" placeholder="city">

                    <hr>
                    <p class="fw-bold">More Information</p>
                    <input required type="text" placeholder="Work title (eg) software developer, marketers, designer">
                    <input required type="text" placeholder="Education">
                    <input required type="text" placeholder="Portfolio website (link)">
                    <label for="__cv__" class="btn px-4 py-2 ft mt-3 mb-2" style="background-color: rgba(179, 179, 179, 0.266)">Upload Resume</label>
                    <input accept=".pdf" required type="file" name="__cv__" id="__cv__" class="d-none">
                    <p class="text-danger mb-2" style="font-size: 12px">Resume must be a (.pdf) file and must not be more than 5mb </p>
                    <input style="width: fit-content" type="submit" value="Apply" class="btn px-4 py-2 btn-primary mt-4 mb-5" >
                </form>

            </div>
      
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn px-4 btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
      
          </div>
        </div>
    </div>

	<x-footer></x-footer>
</div>
@endsection