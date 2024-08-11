@extends("layouts.app")

@php
$is_jobs = true;
$job_title = $data["title"] ?? ""; 
$job = $data["job"] ?? ""; 
$company = $data["company"] ?? ""; 
$application = $data["application"] ?? ""; 
$user_ = $data["user"]; 
$applied_user = $data["applied_user"]; 
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
            @if (session("Erromsg"))
                <div class="alert alert-danger text-danger text-center">
                    <li style="width: fit-content" class="list-unstyled ft">{{session("Erromsg")}}</li>
                </div>
            @endif
            @if (session("msg"))
                <div class="alert alert-success text-success text-center">
                    <li style="width: fit-content" class="list-unstyled ft">{{session("msg")}}</li>
                </div>
            @endif

            <div class="img">
                <img src="{{$job->avatar ?? "https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/jobs/job-3.png"}}" alt="">
            </div>
            <hr>

            <div class="mt-5">
                <h4>Job Description</h4>
                <p class="text-muted text-capitalize">{{$job->description}}</p>
            </div>
            <hr>

            @if ($user_->role == "company")
                <div class="mt-3">
                    <h4>Applicant Information</h4>
                    <button data-bs-toggle="modal" data-bs-target="#applicant" class="mt-3 btn btn-primary">View Applicant Information</button>
                </div>
                
                <hr>                
            @endif

            <div class="mt-5">                
                @php
                    $automated_q = explode(" @/", $application->automated_q) ?? 0;
                @endphp
                @if ($user_->role == "company")
                <h4>Applicant Scores and Feedback</h4>                    
                @else
                <h4>Your Application Scores and Feedback</h4>                    
                @endif
                @if (true)
                    <h6 class="fw-bold text-muted mt-5">Automated Questions Feedback</h6>
                    @if ($automated_q != "")
                    <pre class="text-muted text-capitalize mt-2 ft mb-2">{{$application->automated_q}}</pre>                              
                    @endif                    
                @endif
                @if (true)
                    <h6 class="fw-bold text-muted mt-5">Skills Questions Feedback</h6>
                    @if ($automated_q != "")
                    <pre class="text-muted text-capitalize mt-2 ft mb-2">{{$application->skill_q}}</pre>                              
                    @endif                    
                @endif
                @if (true)
                    <h6 class="fw-bold text-muted mt-5">Technical Questions Feedback</h6>
                    @if ($automated_q != "")
                    <pre class="text-muted text-capitalize mt-2 ft mb-2">{{$application->technical_q}}</pre>                              
                    @endif                    
                @endif
            </div>  
            <hr>

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

    <div class="modal fade" id="applicant">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
          <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
              <h6 class="modal-title">Applicant Details</h6>
              <button type="button" class="btn-close ft" data-bs-dismiss="modal"></button>
            </div>
      
            <!-- Modal body -->
            <div class="modal-body row">
                <div class="mb-3 col-sm-6">
                    <p class="fw-semibold mb-1">Fullname</p>
                    <p class="text-muted text-capitalize ftr mb-0">{{$applied_user->first_name}} {{$applied_user->last_name}}</p>
                </div>
                <div class="mb-3 col-sm-6">
                    <p class="fw-semibold mb-1">Email Address</p>
                    <p class="text-muted ftr mb-0">{{$applied_user->email}}</p>
                </div>
                <div class="mb-3 col-sm-6">
                    <p class="fw-semibold mb-1">Phone Number</p>
                    <p class="text-muted ftr mb-0">{{$applied_user->phone}}</p>
                </div>
                <div class="mb-3 col-sm-6">
                    <p class="fw-semibold mb-1">Country</p>
                    <p class="text-muted ftr  text-capitalize mb-0">{{$applied_user->country}}</p>
                </div>
                <div class="mb-3 col-sm-6">
                    <p class="fw-semibold mb-1">State</p>
                    <p class="text-muted ftr  text-capitalize mb-0">{{$applied_user->state}}</p>
                </div>
                <div class="mb-3 col-sm-6">
                    <p class="fw-semibold mb-1">City</p>
                    <p class="text-muted ftr  text-capitalize mb-0">{{$applied_user->city}}</p>
                </div>
                <div class="mb-3 col-sm-6">
                    <p class="fw-semibold mb-1">Address</p>
                    <p class="text-muted ftr  text-capitalize mb-0">{{$applied_user->address}}</p>
                </div>
            </div>
      
            <!-- Modal footer -->
            <div class="modal-footer">
                <a href="/candidate/{{$applied_user->unique_id}}/{{$applied_user->first_name}}" class="btn ftr btn-primary">Visit Applicant profile</a>
              <button type="button" class="btn px-4 ftr btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
      
          </div>
        </div>
    </div>

	<x-footer></x-footer>
</div>
@endsection

@push('javascript')
<script>
    document.getElementById('__cv__').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const fileName = event.target.files[0].name;
        const fileSizeInMB = (file.size / (1024 * 1024)).toFixed(2);
        document.getElementById('fileNameDisplay').textContent = fileName;
        document.getElementById('fileZise').textContent = ` | ${fileSizeInMB}mb`;
    });
</script>
    
@endpush