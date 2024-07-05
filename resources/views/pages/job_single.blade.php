@extends("layouts.app")

@php
$job_title = $data["title"] ?? ""; 
@endphp

@section('title')
{{$job_title}} | HR
@endsection

@section("content")
<div class="jobs job_single">
	<x-main-nav></x-main-nav>

    <div class="section1">
        <h1 class="fw-bold mt-4 text-capitalize">{{$job_title}}</h1>
        <p class="fs-5 text-muted mt-3 mb-5">Discover your next career move, freelance gig, or internship</p>
    </div>
    
    <div class="section2 mb-5 d-flex flex-wrap">
        <div class="j_first">
            <div class="img">
                <img src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/page/job-single/img-job-feature.png" alt="">
            </div>

            <div class="mt-5">
                <h4>Company Name</h4>
                <p class="text-muted">The AliStudio Design team has a vision to establish a trusted platform that enables productive and healthy enterprises in a world of digital and remote everything, constantly changing work patterns and norms, and the need for organizational resiliency.</p>
                <p class="text-muted">The ideal candidate will have strong creative skills and a portfolio of work which demonstrates their passion for illustrative design and typography. This candidate will have experiences in working with numerous different design platforms such as digital and print forms.</p>
            </div>

            <div class="mt-5">
                <h4>Job Description</h4>
                <p class="text-muted">Create deliverables for your product area (for example competitive analyses, user flows, low fidelity wireframes, high fidelity mockups, prototypes, etc.) that solve real user problems through the user experience.</p>
            </div>

            <div class="mt-5">
                <h4>Preferred Experience</h4>
                <ul>
                    <li class="text-muted ft mb-2">A portfolio demonstrating well thought through and polished end to end customer journeys</li>
                    <li class="text-muted ft mb-2">A portfolio demonstrating well thought through and polished end to end customer journeys</li>
                    <li class="text-muted ft mb-2">A portfolio demonstrating well thought through and polished end to end customer journeys</li>
                    <li class="text-muted ft mb-2">A portfolio demonstrating well thought through and polished end to end customer journeys</li>
                    <li class="text-muted ft mb-2">A portfolio demonstrating well thought through and polished end to end customer journeys</li>
                    <li class="text-muted ft mb-2">A portfolio demonstrating well thought through and polished end to end customer journeys</li>
                </ul>
            </div>  
            
            <div class="mt-5"> <h4>Company Name</h4></div>
            <hr style="color: rgb(198, 198, 198)">
            
            <div class="d-flex">
                <button class="btn text-white btn-success px-4 bg_">Apply Now</button>
                <button class="btn btn-outline-primary px-4 mx-3">Save Job</button>
            </div>

        </div>

        <div class="j_sec">
            <div class="d-flex pt-2" style="border-bottom: 1px solid rgb(235, 235, 235)">
                <img style="border-radius: 50%" width="30" height="30" src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/page/job-single/img-job-feature.png" alt="">
                <p class="mb-3 mx-2 fw-bold">Company name</p>
            </div>
            <p class="text-muted mt-3">We're looking to add more product designers to our growing teams.</p>
            <div class="d-flex">
                <a href="" class="btn text-white btn-success px-4 bg_">Apply Now</a>
                <button class="btn btn-outline-primary px-4 mx-3">Save Job</button>
            </div>
            <hr style="color: rgb(172, 172, 172)">
            <p class="fw-bold text-muted mb-1"><i class="fa-solid fa-bag-shopping"></i> Job Type</p>
            <p class="mb-4 text-muted">Full-time / Remote</p>

            <p class="fw-bold text-muted mb-1"><i class="fa-solid fa-location-dot"></i> Location</p>
            <p class="mb-4 text-muted">Lagos, Nigeria</p>

            <p class="fw-bold text-muted mb-1"><i class="fa-solid fa-sack-dollar"></i> Salary</p>
            <p class="mb-4 text-muted">$35k - $45k</p>

            <p class="fw-bold text-muted mb-1"><i class="fa-regular fa-clock"></i> Date posted</p>
            <p class="mb-4 text-muted">1 hours ago</p>
            <hr style="color: rgb(172, 172, 172)">

            <p class="fw-bold text-muted mb-2">Contact Info</p>
            <p class="text-muted ft"><i class="fa-solid fa-phone"></i> (+91) - 540-025-124553</p>
            <p class="text-muted ft"><i class="fa-regular fa-envelope"></i> contact@nestmart.com</p>
            <p class="text-muted ft"><i class="fa-solid fa-location-dot"></i> Campbell Ave undefined Kent, Utah 53127 United States</p>

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