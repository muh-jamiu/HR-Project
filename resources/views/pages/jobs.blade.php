@extends("layouts.app")

@php
$is_jobs = true;
$jobs = $data["jobs"] ?? [];
$job_ =  App\Models\Job::all();
use Carbon\Carbon;
@endphp

@section('title')
Browse All Jobs | HR
@endsection

@section("content")
<div class="jobs">
	<x-main-nav :isjobs="$is_jobs"></x-main-nav>

    <div class="section1">
        <h1 class="fw-bold mt-4">There Are {{number_format(count($job_))}} Jobs Here For you!</h1>
        <p class="fs-5 text-muted mt-3 mb-5">Discover your next career move, freelance gig, or internship</p>
        <div class="input_cont mb-3">
            <input type="text" placeholder="search job...">
            <select name="" id="">
                <option value="">Fulltime</option>
            </select>
            <select name="" id="">
                <option value="">Location</option>
            </select>
            <button class="btn">Find Now</button>
        </div>

    </div>

    <div class="section2 d-flex">
        <div class="first">
            <div class="__job__ mb-3">
                <h5 class="fw-bold mb-3">Recruiting?</h5>
                <p class="ft">Advertise your jobs to millions of monthly users and search 16.8 million CVs in our database.</p>
                <button class="btn btn-light mt-4">Post A Job</button>
            </div>

            <div class="email__ mb-3">
                <h5 class="fw-bold mb-3">Set job reminder</h5>
                <p class="text-muted ft">Enter you email address and get job notification.</p>
                <div class="input-group flex-nowrap">
                    <span style="background: transparent" class="input-group-text"><i class="fa-regular text-muted fa-envelope"></i></span>
                    <input style="border:1px solid rgb(231, 231, 231);border-left: none;" type="text" class="form-control" placeholder="Enter email address">
                </div>
                <button style="width: 100%" class="btn btn-danger mt-4">Submit</button>
            </div>

            <div class="xys_">
                <div class="mb-4">
                    <p class="fw-semibold mb-1">Locations</p>
                    <div class="input-group flex-nowrap">
                        <span style="background: transparent" class="input-group-text"><i class="fa-solid text-muted fa-location-dot"></i></span>
                        <input style="border:1px solid rgb(231, 231, 231);border-left: none;" type="text" class="form-control" placeholder="Enter location">
                    </div>
                    <button style="width: 100%" class="btn btn-primary_ mt-4">Apply Filter</button>
                </div>
    
                <div class="mb-4">
                    <p class="fw-semibold mb-1">Category</p>
                    <div class="input-group flex-nowrap">
                        <span style="background: transparent" class="input-group-text"><i class="fa-solid text-muted fa-layer-group"></i></span>
                        <input style="border:1px solid rgb(231, 231, 231);border-left: none;" type="text" class="form-control" placeholder="Enter Category">
                    </div>
                    <button style="width: 100%" class="btn btn-primary_ mt-4">Apply Filter</button>
                </div>
            </div>

            <div class="xys_">    
                <div class="mb-1">
                    <p class="fw-semibold mb-1">Job Type</p>
                    <div class="input-group flex-nowrap">
                        <span style="background: transparent" class="input-group-text"><i class="fa-solid text-muted fa-layer-group"></i></span>
                        <input style="border:1px solid rgb(231, 231, 231);border-left: none;" type="text" class="form-control" placeholder="Job Type">
                    </div>
                    <button style="width: 100%" class="btn btn-primary_ mt-4">Apply Filter</button>
                </div>
            </div>

            <div class="xys_">    
                <div class="mb-1">
                    <p class="fw-semibold mb-1">Experience Level</p>
                    <div class="input-group flex-nowrap">
                        <span style="background: transparent" class="input-group-text"><i class="fa-solid text-muted fa-layer-group"></i></span>
                        <input style="border:1px solid rgb(231, 231, 231);border-left: none;" type="text" class="form-control" placeholder="Experience Level">
                    </div>
                    <button style="width: 100%" class="btn btn-primary_ mt-4">Apply Filter</button>
                </div>
            </div>
        </div>

        <div class="second">
            <div class="d-flex justify-content-between">
                <p class="mb-0 ft text-muted">Showing <strong>1-10</strong> of <strong> {{number_format(count($job_))}}</strong> jobs</p>
            </div>
            <div class="section3 section4">        
                <div class="d-flex justify-content- mt-3 flex-wrap">
                    @foreach ($jobs as $job)
                    <a href="/job/{{str_replace(" ", "_", $job->title)}}/{{$job->id}}" class="text-decoration-none text-dark">
                        <div class="cont_">
                            <div class="img">
                                <img src="{{$job->avatar ?? "https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/jobs/job-3.png"}}" alt="">
                            </div>
                            <div class="p-3">
                                <p class="mt-3 text-capitalize mb-0 fw-semibold">{{$job->title}}</p>
                                <p class="text-capitalize mb-3 ft text-muted">{{$job->employment_type}}</p>
                                <p class="ft text-muted"><i class="fa-regular fa-clock"></i> {{Carbon::create($job->created_at)->format('l F j, Y')}}</p>
                                <div class="d-flex">
                                    <p class="ft text-muted text-capitalize"><i class="fa-solid fa-location-dot"></i> {{$job->state}}, {{$job->country}}</p>
                                </div>
                                <p class="ft text-muted text-capitalize">Level: {{$job->level}}</p>
                                <div class="d-flex mt-2 mb-2 justify-content-between">
                                    <p class="text-muted"><span class="cl fw-bold">${{number_format((int)$job->salary)}}</span>/Month</p>
                                    <div class="d-flex mt-1">
                                        <i class="fa-regular btn text-primary fa-thumbs-up"></i>
                                        <i class="fa-regular btn text-danger fa-thumbs-down"></i>
                                    </div>
                                </div>
                            </div>
                        </div>		
                    </a>		
                    @endforeach                    
                    <div class="text-center px-2">
                        <div class="" style="">            
                            {{ $jobs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<hr style="color: rgb(183, 183, 183)">

	<x-footer></x-footer>
</div>
@endsection