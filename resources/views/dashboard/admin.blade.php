@extends("layouts.app")

@php
$user = $data["user"] ?? [];
$employer = $data["employer"] ?? [];
$candidate = $data["candidate"] ?? [];
$jobs = $data["jobs"] ?? [];
$applications = $data["applications"] ?? [];
use Carbon\Carbon;
@endphp

@section('title')
Admin Panel | HR
@endsection

@section("content")
<div class="dashboard_ admins_ d-flex">
    <div class="sidebar__">
        <div class="d-flex justify-content-between">
            <div class="logo"><a href="/"><img src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/favicon.svg" alt=""></a> </div>
            <div class="">
                <p class="mb-0 btn text-white"><i class="fa-regular fa-bell"></i></p>
            </div>
        </div>

        <div class="text-center mt-4">
            @if ($user->avatar)
            <img  width="150" height="150" style="border-radius: 50%; object-fit:cover" src="{{$user->avatar}}" alt="">                
            @else
            <img class=""  width="150" height="150" style="border-radius: 50%" src="https://static.vecteezy.com/system/resources/previews/036/594/092/non_2x/man-empty-avatar-photo-placeholder-for-social-networks-resumes-forums-and-dating-sites-male-and-female-no-photo-images-for-unfilled-user-profile-free-vector.jpg" alt="">
            @endif
           <p class="mb-1 mt-3 text-capitalize">{{$user->first_name}} {{$user->last_name}} </p>
            <p class="ft mb-1">{{$user->email}}</p>
            <p class="ft">{{$user->phone ?? ""}}</p>
        </div>

        <div class="mt-4">
            <p class="fw-bold mb-0" style="color: purple">Dashboard</p>
            <li class="list-unstyled active"><a href="" class="text-decoration-none">
                <i class="fa-solid fa-house-user"></i> Overview
            </a></li>
            <li class="list-unstyled fw-bold"><a href="/logOut" class="text-decoration-none text-danger">
                <i class="fa-solid fa-right-from-bracket"></i> Log Out
            </a></li>
        </div>

    </div>

    <div class="mainbar__">
        <div class="d-flex top_bar_ p-4 bg-white justify-content-between pb-0" style="border-bottom: 1px solid rgb(223, 223, 223); position:fixed; width:75%">
            <i class="fa-solid __sliders text-muted fa-sliders"></i>
            <div class="d-flex">
                <div class="dropdown mb-0">
                    <i style="transform: translateY(-10px)" class="fa-solid fa-user btn text-muted" data-bs-toggle="dropdown"></i>
                    <ul class="dropdown-menu mb-0">
                        <li><h5 class="dropdown-header text-capitalize">{{$user->first_name}}</h5></li>
                        <li><hr class="dropdown-divider"></hr></li>
                        <li><hr class="dropdown-divider"></hr></li>
                        <li style="width: 90%" class="btn text-center mx-2 ft btn-danger"><a href="/logOut" class="text-decoration-none text-white">Log Out</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="d_section1 p-4">
            <div class="d-flex">
                @if ($user->avatar)
                <img  width="80" height="80" style="border-radius: 50%; object-fit:cover" src="{{$user->avatar}}" alt="">                
                @else
                <img  width="80" height="80" style="border-radius: 50%" src="https://static.vecteezy.com/system/resources/previews/036/594/092/non_2x/man-empty-avatar-photo-placeholder-for-social-networks-resumes-forums-and-dating-sites-male-and-female-no-photo-images-for-unfilled-user-profile-free-vector.jpg" alt="">                   
                @endif
                <div class="mt-0 mx-2">
                    <h4 class="fw-bold mb-1 text-capitalize">Welcome Back, {{$user->first_name}}</h4>
                    <div class="d-flex">
                        <p class="text-muted ft text-capitalize">Admin</p>
                    </div>
                </div>
            </div>
            <form action="/update-profile" enctype="multipart/form-data" method="POST" class="d_cv" id="upload_form">
                @csrf
                <label style="border-radius: 3px" for="avatar__" class=" px-4 mx-4 py-2 btn ft bg-info">Upload Profile Picture</label>
                <input type="file" name="company_logo" id="avatar__" class="d-none">
            </form>
            
            @if (session("msg"))
            <p style="position: absolute; font-size:12px" class="ftr alert alert-success mt-3">{{session("msg")}}</p>                
            @endif
        </div>

        <div class="d_section2 mt-4">
            <div class="__nav nav flex-nowrap d-flex nav-tabs">
                <li class="list-unstyled active" data-bs-toggle="tab" href="#home"><a href="#" class="text-decoration-none text-muted">Overview</a></li>
                <li class="list-unstyled" data-bs-toggle="tab" href="#jobs"><a href="#" class="text-decoration-none text-muted">Applications</a></li>
                <li class="list-unstyled" data-bs-toggle="tab" href="#profile"><a href="#" class="text-decoration-none text-muted">User Profile</a></li>
                <li class="list-unstyled" data-bs-toggle="tab" href="#all_jobs_"><a href="#" class="text-decoration-none text-muted">All Jobs</a></li>
                <li class="list-unstyled" data-bs-toggle="tab" href="#user_e"><a href="#" class="text-decoration-none text-muted">Employers Management</a></li>
                <li class="list-unstyled" data-bs-toggle="tab" href="#user_c"><a href="#" class="text-decoration-none text-muted">Candidate Management</a></li>
            </div>

            <div class="tab-content mt-4">
                <div class="tab-pane container active" id="home">
                    <div class="justify-content-evenly  d-flex flex-wrap">
                        <div class="box_">
                            <p class="mt-2 ft text-info">Total Application</p>
                            <div class="text-center mt-4">
                                <h1 style="font-size: 3em" class="fw-bold text-info">{{number_format(count($applications))}}</h1>
                                <p class="text-muted ft mt-5">From Yesterday</p>
                            </div>
                        </div>
    
                        <div class="box_">
                            <p class="mt-2 ft text-success">Total Employers</p>
                            <div class="text-center mt-4">                               
                                <h1 style="font-size: 3em" class="fw-bold text-success">{{number_format(count($employer))}}</h1>
                                <p class="text-muted ft mt-5">From Yesterday</p>
                            </div>
                        </div>
    
                        <div class="box_">
                            <p class="ft mt-2 text-danger">Total Jobs</p>
                            <div class="text-center mt-4">
                                <h1 style="font-size: 3em" class="fw-bold text-danger">{{number_format(count($jobs))}}</h1>
                                <p class="text-muted ft mt-5">From Yesterday</p>
                            </div>
                        </div>
    
                        <div class="box_">
                            <p class="mt-2 ft text-warning">Total Candidates</p>
                            <div class="text-center mt-4">
                                <h1 style="font-size: 3em" class="fw-bold text-warning">{{number_format(count($candidate))}}</h1>
                                <p class="text-muted ft mt-5">From Yesterday</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="tab-pane container fade" id="jobs">                   
                    <table class="table table-striped text-center table-bordered">
                        <thead class="">
                            <tr>
                                <th class="ftrs_ text-muted" scope="col">Job Title</th>
                                <th class="ftrs_ text-muted" scope="col">Application Email</th>
                                <th class="ftrs_ text-muted" scope="col">Application Phone</th>
                                <th class="ftrs_ text-muted" scope="col">Country</th>
                                <th class="ftrs_ text-muted" scope="col">Employment Type</th>
                                <th class="ftrs_ text-muted" scope="col">Applied Date</th>
                                <th class="ftrs_ text-muted" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>        
                            @foreach ($applications as $item)
                            @php
                                $jobs = App\Models\Job::where(["id" => $item->job_id])->first();
                                $users_ = App\Models\User::find($item->userId);
                                $company_ = App\Models\User::where(["id" => $jobs->company_id])->first();
                            @endphp
                            <tr>
                                <td class="ftrs_ text-capitalize text-muted"><a class="text-decoration-none text-muted" href="/application/{{str_replace(" ", "_", $item->job_title)}}/{{$item->id}}">{{$item->job_title}}</a></td>
                                <td class="ftrs_ text-muted">{{$users_->email ?? "N/A"}}</td>
                                <td class="ftrs_ text-capitalize text-muted">{{$users_->phone ?? "N/A"}}</td>
                                <td class="ftrs_ text-capitalize text-muted">{{$jobs->country}}</td>
                                <td class="ftrs_ text-capitalize text-muted">{{$jobs->employment_type}}</td>
                                <td class="ftrs_ text-muted">{{Carbon::create($item->created_at)->format('l F j, Y')}}</td>
                                <td class="ftrs_ text-muted">
                                    <div class="table_act">
                                        <div class="dropdown">
                                            <i class="fa-solid fa-ellipsis btn" data-bs-toggle="dropdown"></i>
                                            <ul class="dropdown-menu bg-light">
                                                <li><a href="/delete-application/{{$item->id}}" class="dropdown-header text-decoration-none mt-2 ft mb-0 text-white btn btn-danger">Delete Application</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach                           
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane container all_input fade" id="profile">
                    <form action="/update-profile" method="POST">
                        @csrf
                        <div class="d-flex justify-content-between">
                            <h4 class="fw-bold mb-4">Edit Profile</h4>                        
                            <button class="btn mt-3 mb-2 btn-dark px-4">Save Changes</button>
                        </div>

                        <hr style="color: grey">
                        <p class="fw-bold mb-2">Basic Information</p>
                        <div class="d-flex justify-content-evenly mb-3">
                            <input name="first_name" type="text" placeholder="First name" value="{{$user->first_name}}">
                            <input name="last_name" type="text" placeholder="Last name" value="{{$user->last_name}}">
                        </div>
                        <div class="d-flex justify-content-evenly mb-3">
                            <input name="email" type="text" placeholder="Email Address" value="{{$user->email}}">
                            <input name="phone" type="text" placeholder="Phone number" value="{{$user->phone}}">
                        </div>
                    </form>
                </div>

                <div class="tab-pane container fade" id="all_jobs_">
                    <div class="section3_d" style="margin-bottom: 0 !important">
                        <table class="table table-striped text-center table-bordered">
                            <thead class="">
                                <tr>
                                    <th class="ftrs_ text-muted" scope="col">Job Title</th>
                                    <th class="ftrs_ text-muted" scope="col">Employer Email</th>
                                    <th class="ftrs_ text-muted" scope="col">Employer Phone</th>
                                    <th class="ftrs_ text-muted" scope="col">Country</th>
                                    <th class="ftrs_ text-muted" scope="col">Employment Type</th>
                                    <th class="ftrs_ text-muted" scope="col">Posted Date</th>
                                    <th class="ftrs_ text-muted" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $jobs = App\Models\Job::all();
                                @endphp

                                @foreach ($jobs as $item)
                                <tr>
                                    <td class="ftrs_ text-capitalize text-muted"><a class="text-decoration-none text-muted" href="/jobs/{{str_replace(" ", "_", $item->title)}}/{{$item->id}}">{{$item->title}}</a></td>
                                    <td class="ftrs_ text-muted">{{$item->email}}</td>
                                    <td class="ftrs_ text-capitalize text-muted">{{$item->phone}}</td>
                                    <td class="ftrs_ text-capitalize text-muted">{{$item->country}}</td>
                                    <td class="ftrs_ text-capitalize text-muted">{{$item->employment_type}}</td>
                                    <td class="ftrs_ text-muted">{{Carbon::create($item->created_at)->format('l F j, Y')}}</td>
                                    <td class="ftrs_ text-muted">
                                        <div class="table_act">
                                            <div class="dropdown">
                                                <i class="fa-solid fa-ellipsis btn" data-bs-toggle="dropdown"></i>
                                                <ul class="dropdown-menu bg-light">
                                                    <li><a href="/delete-job/{{$item->id}}" class="dropdown-header text-decoration-none mt-2 ft mb-0 text-white btn btn-danger">Delete Job</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach                           
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane container fade" id="user_e">
                    <table class="table table-striped text-center table-bordered">
                        <thead class="">
                            <tr>
                                {{-- <th class="ftrs_ text-muted" scope="col">Fullname</th> --}}
                                <th class="ftrs_ text-muted" scope="col">Company Name</th>
                                <th class="ftrs_ text-muted" scope="col">Email Address</th>
                                <th class="ftrs_ text-muted" scope="col">Phone Number</th>
                                <th class="ftrs_ text-muted" scope="col">Company Type</th>
                                <th class="ftrs_ text-muted" scope="col">Country</th>
                                <th class="ftrs_ text-muted" scope="col">Join Date</th>
                                <th class="ftrs_ text-muted" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employer as $item)
                            <tr>
                                {{-- <td class="ftrs_ text-capitalize text-muted">{{$item->first_name}} {{$item->last_name}}</td> --}}
                                <td class="ftrs_ text-capitalize text-muted">{{$item->company_name}}</td>
                                <td class="ftrs_ text-muted">{{$item->email}}</td>
                                <td class="ftrs_ text-capitalize text-muted">{{$item->phone}}</td>
                                <td class="ftrs_ text-capitalize text-muted">{{$item->title}}</td>
                                <td class="ftrs_ text-capitalize text-muted">{{$item->country}}</td>
                                <td class="ftrs_ text-muted">{{Carbon::create($item->created_at)->format('l F j, Y')}}</td>
                                <td class="ftrs_ text-muted">
                                    <div class="table_act">
                                        <div class="dropdown">
                                            <i class="fa-solid fa-ellipsis btn" data-bs-toggle="dropdown"></i>
                                            <ul class="dropdown-menu bg-light">
                                                <li><a href="/delete-user/{{$item->id}}" class="dropdown-header text-decoration-none mt-2 ft mb-0 text-white btn btn-danger">Delete user</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach                           
                        </tbody>
                    </table>
                </div>
                
                <div class="tab-pane container fade" id="user_c">
                    <table class="table table-striped text-center table-bordered">
                        <thead class="">
                            <tr>
                                <th class="ftrs_ text-muted" scope="col">Full Name</th>
                                <th class="ftrs_ text-muted" scope="col">Email Address</th>
                                <th class="ftrs_ text-muted" scope="col">Phone Number</th>
                                <th class="ftrs_ text-muted" scope="col">Title</th>
                                <th class="ftrs_ text-muted" scope="col">Country</th>
                                <th class="ftrs_ text-muted" scope="col">Join Date</th>
                                <th class="ftrs_ text-muted" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($candidate as $item)
                            <tr>
                                <td class="ftrs_ text-capitalize text-muted">{{$item->first_name}} {{$item->last_name}}</td>
                                <td class="ftrs_ text-muted">{{$item->email}}</td>
                                <td class="ftrs_ text-capitalize text-muted">{{$item->phone}}</td>
                                <td class="ftrs_ text-capitalize text-muted">{{$item->title}}</td>
                                <td class="ftrs_ text-capitalize text-muted">{{$item->country}}</td>
                                <td class="ftrs_ text-muted">{{Carbon::create($item->created_at)->format('l F j, Y')}}</td>
                                <td class="ftrs_ text-muted">
                                    <div class="table_act">
                                        <div class="dropdown">
                                            <i class="fa-solid fa-ellipsis" data-bs-toggle="dropdown"></i>
                                            <ul class="dropdown-menu bg-light">
                                                <li><a href="/delete-user/{{$item->id}}" class="dropdown-header text-decoration-none mt-2 ft mb-0 text-white btn btn-danger">Delete user</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@push('javascript')
    <script>
        var __sliders = document.querySelector(".__sliders")
        var sidebar__ = document.querySelector(".sidebar__")
        var mainbar__ = document.querySelector(".mainbar__")
        var top_bar_ = document.querySelector(".top_bar_")
        __sliders.addEventListener("click", () => {
            mainbar__.classList.toggle("toggle");
            sidebar__.classList.toggle("toggle");
            top_bar_.classList.toggle("toggle");
        })
    </script>
@endpush