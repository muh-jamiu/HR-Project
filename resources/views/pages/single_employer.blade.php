@extends("layouts.app")

@php
$username = $data["username"] ?? ""; 
@endphp

@section('title')
Employer-{{$username}} | HR
@endsection

@section("content")
<div class="jobs job_single">
	<x-main-nav></x-main-nav>

    <div class="section1">
       <div class="d-flex mt-3">
        <div class="img__">
            <img  width="150" height="150" style="border-radius: 50%" src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/page/employers/employer-12.png" alt="">
        </div>
        <div class="mx-3 mt-3">
            <h3 class="fw-bold text-capitalize">{{$username}} Ganiu</h3>
            <div class="d-flex _jenki">
                <p class="mb-0 text-muted"><i class="fa-solid fa-location-dot"></i> Lagos, Nigeria</p>
                <p class="mb-0 text-muted"><i class="fa-solid fa-bag-shopping"></i> Accounting / Finance</p>
                <p class="mb-0 text-muted"><i class="fa-solid text-primary fa-certificate"></i> Verified</p>
            </div>
            <div class="d-flex mt-3 flex-wrap _skills">
                <p class="text-muted">12 Open Job</p>
                <p class="text-muted">234 Completed Job</p>
            </div>
        </div>
       </div>
    </div>
    
    <div class="section2 mb-5 d-flex flex-wrap">
        <div class="j_first">
            <div class="">
                <h4>About Company</h4>
                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis illum fuga eveniet. Deleniti asperiores, commodi quae ipsum quas est itaque, ipsa, dolore beatae voluptates nemo blanditiis iste eius officia minus. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis illum fuga eveniet.</p>
                <p class="text-muted">The ideal candidate will have strong creative skills and a portfolio of work which demonstrates their passion for illustrative design and typography. This candidate will have experiences in working with numerous different design platforms such as digital and print forms.</p>
            </div>

            <hr style="color: rgb(198, 198, 198)">

            <div class="mt-5">
                <h4>Branches</h4>
                <div class="row mt-4">
                    <div class="col-sm-4 mb-3">
                        <p class="fw-bold mb-1">Behance Accounting</p>
                        <p class="text-muted mb-1 ft">Lagos, Nigeria</p>
                        <p class="text-muted mb-1 ft">Jan 2018 — Dec 2021</p>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <p class="fw-bold mb-1">Behance Accounting</p>
                        <p class="text-muted mb-1 ft">Lagos, Nigeria</p>
                        <p class="text-muted mb-1 ft">Jan 2018 — Dec 2021</p>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <p class="fw-bold mb-1">Behance Accounting</p>
                        <p class="text-muted mb-1 ft">Lagos, Nigeria</p>
                        <p class="text-muted mb-1 ft">Jan 2018 — Dec 2021</p>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <p class="fw-bold mb-1">Behance Accounting</p>
                        <p class="text-muted mb-1 ft">Lagos, Nigeria</p>
                        <p class="text-muted mb-1 ft">Jan 2018 — Dec 2021</p>
                    </div>
                </div>
            </div>

            <hr style="color: rgb(198, 198, 198)">
            
            <div class="mt-5">
                <h4>Vacancies</h4>
                <ul>
                    <li class="text-muted ft mb-2">Digital Designer - 03 person</li>
                    <li class="text-muted ft mb-2">Digital Marketing - 04 persons</li>
                    <li class="text-muted ft mb-2">Project Manager - 02 persons</li>
                </ul>
            </div>

        </div>

        <div class="j_sec">
            <div class="d-flex pt-2 mb-2" style="border-bottom: 1px solid rgb(235, 235, 235)">
                <img style="border-radius: 50%" width="30" height="30" src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/page/job-single/img-job-feature.png" alt="">
                <p class="mb-3 mx-2 fw-bold">Company name</p>
            </div>

            <p class="fw-bold text-muted mb-1"><i class="fa-solid fa-bag-shopping"></i> Company field</p>
            <p class="mb-4 text-muted">Accounting / Finance</p>

            <p class="fw-bold text-muted mb-1"><i class="fa-solid fa-location-dot"></i> Location</p>
            <p class="mb-4 text-muted">Lagos, Nigeria</p>

            <p class="fw-bold text-muted mb-1"><i class="fa-solid fa-sack-dollar"></i> Salary</p>
            <p class="mb-4 text-muted">$35k - $45k</p>

            <p class="fw-bold text-muted mb-1"><i class="fa-regular fa-clock"></i> Member since</p>
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