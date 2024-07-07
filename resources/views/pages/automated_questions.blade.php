@extends("layouts.app")

@php
$is_jobs = true;
$job = $data["job"] ?? ""; 
$company = $data["company"] ?? ""; 
$questions = $data["questions"] ?? ""; 
use Carbon\Carbon;
@endphp

@section('title')
Automated Questions | HR
@endsection

@section("content")
<div class="jobs job_single">
	<x-main-nav></x-main-nav>

    <div class="section1">
        <h1 class="fw-bold mt-4 text-capitalize">{{$job->title}}</h1>
        <p class="fs-5 text-muted mt-3 mb-5">Discover your next career move, freelance gig, or internship</p>
    </div>
    
    <div class="section2 mb-5 d-flex flex-wrap">
        <div class="j_first">
        </div>

        <div class="j_sec">
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
                <form action="/create-application" method="post" enctype="multipart/form-data">
                    @csrf
                    <input name="name" required type="text" placeholder="Enter fullname">
                    <input name="email" required type="email" placeholder="Enter email address">
                    <input name="phone" required type="text" placeholder="Phone number">
                    <input name="country" required type="text" placeholder="Country">
                    <input name="state" required type="text" placeholder="State">
                    <input name="city" required type="text" placeholder="city">
                    <input name="job_id" required type="text" class="d-none" value="{{$job->id}}">
                    <input name="company_id" required type="text" class="d-none" value="{{$company->id}}">
                    <input name="job_title" required type="text" class="d-none" value="{{$job->title}}">

                    <hr>
                    <p class="fw-bold">More Information</p>
                    <input required type="text" placeholder="Work title (eg) software developer, marketers, designer">
                    <input name="education" required type="text" placeholder="Education">
                    <input name="website" required type="text" placeholder="Portfolio website (link)">
                    <label for="__cv__" class="btn px-4 py-2 ft mt-3 mb-2" style="background-color: rgba(179, 179, 179, 0.266)">Upload Resume</label>
                    <input required accept=".pdf" type="file" name="company_logo" id="__cv__" class="d-none">
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