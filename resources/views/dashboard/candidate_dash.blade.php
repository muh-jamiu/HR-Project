@extends("layouts.app")

@php
    $salary = [
        "Less than $100",
        "$100 - $500",
        "$500 - $1,000",
        "$1,000 - $1,500",
        "$1,500 - $2,000",
        "$2,000 - $5,000",
        "$5,000 - $10,000",
        "$10,000 - $50,000",
        "$50,000 Above",
];

    $user = $data["user"] ?? [];
@endphp

@section('title')
Candidate Dashboard | HR
@endsection

@section("content")
<div class="dashboard_ d-flex">
    <div class="sidebar__">
        <div class="d-flex justify-content-between">
            <div class="logo"><img src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/favicon.svg" alt=""> </div>
            <div class="">
                <p class="mb-0 btn text-white"><i class="fa-regular fa-bell"></i></p>
            </div>
        </div>

        <div class="text-center mt-4">
            <img class=""  width="150" height="150" style="border-radius: 50%" src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/page/candidates/img-candidate.png" alt="">
            <p class="mb-1 mt-3 text-capitalize">{{$user->first_name}} {{$user->last_name}} </p>
            <p class="ft mb-1">{{$user->email}}</p>
            <p class="ft">{{$user->phone ?? ""}}</p>
        </div>

        <div class="mt-4">
            <p class="fw-bold mb-0" style="color: purple">Dashboard</p>
            <li class="list-unstyled active"><a href="" class="text-decoration-none">
                <i class="fa-solid fa-house-user"></i> Overview
            </a></li>
             <li class="list-unstyled"><a href="" class="text-decoration-none">
                <i class="fa-solid fa-street-view"></i> Profile
            </a></li>
            <li class="list-unstyled"><a href="" class="text-decoration-none">
                <i class="fa-solid fa-hand-holding-dollar"></i> Pricing
           </a></li>
            <li class="list-unstyled fw-bold"><a href="/logOut" class="text-decoration-none text-danger">
                <i class="fa-solid fa-right-from-bracket"></i> Log Out
            </a></li>
        </div>

    </div>

    <div class="mainbar__">
        <div class="d-flex p-4 bg-white justify-content-between pb-3" style="border-bottom: 1px solid rgb(223, 223, 223); position:fixed; width:75%">
            <i class="fa-solid text-muted fa-sliders"></i>
            <div class="d-flex">
                <i class="fa-solid text-muted fa-user"></i>
            </div>
        </div>

        <div class="d_section1 p-4">
            <div class="d-flex">
                <img  width="80" height="80" style="border-radius: 50%" src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/page/candidates/img-candidate.png" alt="">
                <div class="mt-0 mx-2">
                    <h4 class="fw-bold mb-1 text-capitalize">Welcome Back, {{$user->first_name}}</h4>
                    <div class="d_skills mb-2 mt-2 d-flex">
                        <p class="text-muted mb-0">Python</p>
                        <p class="text-muted mb-0">Python</p>
                        <p class="text-muted mb-0">Python</p>
                    </div>
                    <div class="d-flex">
                        <p class="text-muted ft text-capitalize">Candidate | {{$user->title ?? "N/A"}}</p>
                    </div>
                </div>
            </div>
            <button class="btn-info px-4 mx-4 ft btn d_cv">Upload Profile Picture</button>
            <button class="btn-primary px-4 ft btn d_cv">Upload CV</button>
        </div>

        <div class="d_section2 mt-4">
            <div class="__nav nav d-flex nav-tabs">
                <li class="list-unstyled active" data-bs-toggle="tab" href="#home"><a href="#" class="text-decoration-none text-muted">Overview</a></li>
                <li class="list-unstyled" data-bs-toggle="tab" href="#jobs"><a href="#" class="text-decoration-none text-muted">Jobs</a></li>
                <li class="list-unstyled" data-bs-toggle="tab" href="#profile"><a href="#" class="text-decoration-none text-muted">User Profile</a></li>
                <li class="list-unstyled" data-bs-toggle="tab" href="#price"><a href="#" class="text-decoration-none text-muted">Pricing</a></li>
            </div>

            <div class="tab-content mt-4">
                <div class="tab-pane container active" id="home">
                    <div class="justify-content-evenly  d-flex flex-wrap">
                        <div class="box_">
                            <p class="mt-2 ft text-info">Overall Application</p>
                            <div class="text-center mt-4">
                                <h1 style="font-size: 3em" class="fw-bold text-info">420</h1>
                                <p class="text-muted ft mt-5">From Yesterday</p>
                            </div>
                        </div>
    
                        <div class="box_">
                            <p class="mt-2 ft text-success">Approved Application</p>
                            <div class="text-center mt-4">
                                <h1 style="font-size: 3em" class="fw-bold text-success">12</h1>
                                <p class="text-muted ft mt-5">From Yesterday</p>
                            </div>
                        </div>
    
                        <div class="box_">
                            <p class="ft mt-2 text-danger">Decline Application</p>
                            <div class="text-center mt-4">
                                <h1 style="font-size: 3em" class="fw-bold text-danger">0</h1>
                                <p class="text-muted ft mt-5">From Yesterday</p>
                            </div>
                        </div>
    
                        <div class="box_">
                            <p class="mt-2 ft text-warning">Pending Application</p>
                            <div class="text-center mt-4">
                                <h1 style="font-size: 3em" class="fw-bold text-warning">420</h1>
                                <p class="text-muted ft mt-5">From Yesterday</p>
                            </div>
                        </div>
                    </div>

                    <div class="__nav nav d-flex nav-tabs mt-4">
                        <li class="list-unstyled active" data-bs-toggle="tab" href="#all_j"><a href="#ddd_" class="text-decoration-none text-muted">All Application</a></li>
                        <li class="list-unstyled" data-bs-toggle="tab" href="#active_j"><a href="#ddd_" class="text-decoration-none text-muted">Active Application</a></li>
                        <li class="list-unstyled" data-bs-toggle="tab" href="#decline_j"><a href="#ddd_" class="text-decoration-none text-muted">Decline Application</a></li>
                        <li class="list-unstyled" data-bs-toggle="tab" href="#pending_j"><a href="#ddd_" class="text-decoration-none text-muted">Pending Application</a></li>
                    </div>

                    <div class="tab-content mb-5 mt-4" id="ddd_">

                        <div class="tab-pane container active" id="all_j">
                            <div class="text-center mt-5">
                                <h4>Empty</h4>
                                <p class="text-muted ft">You don't have any application at the momemt.</p>
                                <a href="/browse-jobs" class="btn btn-primary mt-2 mx-4">Browse Jobs</a>
                            </div>
                           {{-- <div class="section3_d">
                            <div class="d-flex justify-content-evenly mt-3 flex-wrap">
                                @for ($i = 0; $i < 5; $i++)
                                <a href="/job/title/{{$i}}" class="text-decoration-none text-dark">
                                    <div class="cont_ bg-white">
                                        <div class="img" style="height: 150px">
                                            <img src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/jobs/job-1.png" alt="">
                                        </div>
                                        <div class="p-3">
                                            <div class="d-flex flex-wrap mt-2 mb-4 justify-content-between">
                                                <p class="mb-2 text-muted mt-1 ">
                                                    <img class="mx-2" width="20" height="20" style="border-radius: 50%" src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/jobs/job-1.png" alt="">Company Name</p>
                                                <button style="background-color: rgba(45, 249, 45, 0.088); height:fit-content" class="btn text-success ft px-4 py-1">Fulltime</button>
                                            </div>
                                            <p class="mt-3 mb-3">Senior Full Stack Engineer, Creator Success Full Time</p>
                                        </div>
                                    </div>		
                                </a>		
                                @endfor
                            </div>	
                           </div> --}}
                        </div>

                        <div class="tab-pane container fade" id="active_j">
                            <div class="text-center mt-5">
                                <h4>Empty</h4>
                                <p class="text-muted ft">You don't have any active application at the momemt.</p>
                                <a href="/browse-jobs" class="btn btn-primary mt-2 mx-4">Browse Jobs</a>
                            </div>
                        </div>
                        
                        <div class="tab-pane container fade" id="decline_j">
                            <div class="text-center mt-5">
                                <h4>Empty</h4>
                                <p class="text-muted ft">You don't have any decline application at the momemt.</p>
                                <a href="/browse-jobs" class="btn btn-primary mt-2 mx-4">Browse Jobs</a>
                            </div>
                        </div>

                        <div class="tab-pane container fade" id="pending_j">
                            <div class="text-center mt-5">
                                <h4>Empty</h4>
                                <p class="text-muted ft">You don't have any pending application at the momemt.</p>
                                <a href="/browse-jobs" class="btn btn-primary mt-2 mx-4">Browse Jobs</a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="tab-pane container fade" id="jobs">
                    <div class="section3_d" style="margin-bottom: 0 !important">
                        <div class="d-flex justify-content- mt-3 flex-wrap">
                            @for ($i = 0; $i < 9; $i++)
                            <a href="/job/title/{{$i}}" class="text-decoration-none text-dark">
                                <div class="cont_ bg-white">
                                    <div class="img" style="height: 150px">
                                        <img src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/jobs/job-1.png" alt="">
                                    </div>
                                    <div class="p-3">
                                        <div class="d-flex flex-wrap mt-2 mb-4 justify-content-between">
                                            <p class="mb-2 text-muted mt-1 ">
                                                <img class="mx-2" width="20" height="20" style="border-radius: 50%" src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/jobs/job-1.png" alt="">Company Name</p>
                                            <button style="background-color: rgba(45, 249, 45, 0.088); height:fit-content" class="btn text-success ft px-4 py-1">Fulltime</button>
                                        </div>
                                        <p class="mt-3 mb-3">Senior Full Stack Engineer, Creator Success Full Time</p>
                                    </div>
                                </div>		
                            </a>		
                            @endfor
                        </div>	
                    </div>
                </div>

                <div class="tab-pane container fade" id="profile">
                    <form action="">
                        <h4 class="fw-bold mb-4">Edit Profile</h4>
                        <hr style="color: grey">
                        <p class="fw-bold mb-2">Basic Information</p>
                        <div class="d-flex justify-content-evenly mb-3">
                            <input type="text" placeholder="First name">
                            <input type="text" placeholder="Last name">
                        </div>
                        <div class="d-flex justify-content-evenly mb-3">
                            <input type="text" placeholder="Email Address">
                            <input type="text" placeholder="Phone number">
                        </div>
                        <textarea class="mb-3" name="" placeholder="Bio" id="" cols="5" rows="5"></textarea>
                        <button class="btn mb-2 btn-dark px-4">Save Changes</button>
                        <br>

                        <hr style="color: grey">
                        <br>
                        <p class="fw-bold mb-2">Location</p>
                        <div class="d-flex justify-content-evenly mb-3">
                            <input type="text" placeholder="Country">
                            <input type="text" placeholder="State">
                        </div>
                        <div class="d-flex justify-content-evenly mb-3">
                            <input type="text" placeholder="City">
                            <input type="text" placeholder="Full address">
                        </div>
                        <button class="btn mb-2 btn-dark px-4">Save Changes</button>
                        <br>
                        <hr style="color: grey">

                        <br>
                        <p class="fw-bold mb-2">Other Information</p>
                        <div class="d-flex justify-content-evenly mb-3">
                            <input type="text" placeholder="Work title (eg) software developer, designer, marketer">
                            <select name="" id="">
                                <option value="">Salary range</option>
                                @foreach ($salary as $item)
                                    <option value="{{$item}}">{{$item}}</option>                                    
                                @endforeach
                            </select>
                        </div>
                        <textarea class="mb-3" name="" placeholder="Professional skills, comma(,) seperated..." id="" cols="5" rows="5"></textarea>
                        <button class="btn mb-2 btn-dark px-4">Save Changes</button>
                        <br>

                    </form>

                    <hr style="color: grey">    
                    <br>
                    <p class="fw-bold mb-2">Work Experience</p>
                    <div class="d-flex">
                        <button class="btn px-4 btn-primary">Add Work Experience</button>
                    </div>
                    <div class="row mt-4">
                        @for ($i = 0; $i < 5; $i++)
                            <div class="col-sm-4 mb-3">
                                <p class="fw-bold mb-1">Software Developer</p>
                                <p class="text-muted mb-1 ft">Lagos, Nigeria</p>
                                <p class="text-muted mb-1 ft">Jan 2018 — Dec 2021</p>
                            </div>
                        @endfor
                    </div>

                    <hr style="color: grey">    
                    <br>
                    <p class="fw-bold mb-2">Education</p>
                    <div class="d-flex">
                        <button class="btn px-4 btn-primary">Add Education</button>
                    </div>
                    <div class="row mt-4">
                        @for ($i = 0; $i < 5; $i++)
                            <li class="col-sm-4 mb-3">
                                Cambridge University(2001-2004)
                            </li>
                        @endfor
                    </div>
                </div>

                <div class="tab-pane container fade" id="price">price</div>
            </div>
        </div>

    </div>
</div>
@endsection