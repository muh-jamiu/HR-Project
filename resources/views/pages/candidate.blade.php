@extends("layouts.app")

@php
$iscand = true;
$users = $data["users"] ?? [];
@endphp

@section('title')
Platform Candidates | HR
@endsection

@section("content")
<div class="jobs">
	<x-main-nav :iscand="$iscand"></x-main-nav>

    <div class="section1">
        <h1 class="fw-bold mt-4">There Are 968 Candidates Here For You!</h1>
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
                <p class="mb-0 ft text-muted">Showing <strong>41-60</strong> of <strong>944</strong> jobs</p>
            </div>
            <div class="section3 section4">        
                <div class="d-flex justify-content- mt-3 flex-wrap">
                    @foreach ($users as $user)    
                    @if ($user->role == "candidate")             
			        <a href="/candidate/{{$user->id}}?username={{$user->username}}&name={{$user->first_name}}" class="text-decoration-none text-dark">
                        <div class="cont_">
                            <div class="text-center mt-3" >
                                <img style="width: 100px; height: 100px; object-fit:cover; border-radius:50%; object-fit:cover" src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/jobs/job-1.png" alt="">
                            </div>
                            <div class="p-3 text-center">
                                <p class="fw-bold mb-1 text-capitalize">{{$user->first_name}} {{$user->last_name}}</p>
                                <p class="text-muted mb-1 ft text-capitalize">{{$user->title ?? "N/A"}}</p>
                                <div class="d-flex mt-3 justify-content-evenly">
                                    <p class="text-muted ft mb-0 text-capitalize"><i class="fa-solid text-muted fa-location-dot"></i> {{$user->state ?? "n/a"}}</p>
                                    <p class="text-muted ft mb-0 text-capitalize"><i class="fa-solid text-muted fa-layer-group"></i> {{$user->country ?? "n/a"}}</p>
                                </div>
                            </div>

                            @php
                                $skills__ = explode(",", $user->skills);
                            @endphp

                            <div class="d-flex flex-wrap mb-3 justify-content-evenly px-3">
                                @foreach ($skills__ as $item)
                                <p style="background-color: rgba(9, 252, 199, 0.053); border-radius:6px; font-size:12px" class=" text-capitalize text-muted py-2 mb-2 px-4">{{$item}}</p>                       
                                @endforeach
                            </div>
                            
                            <div class="text-center mb-3">
                                <button class="btn ft btn-outline-dark">View Profile</button>
                            </div>
                        </div>	
                    </a>	                        
                    @endif   		
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="pag_">
        <div class="d-flex justify-content-evenly">
            @for ($i = 1; $i < 10; $i++)
            <li class="list-unstyled"><a href="" class="text-decoration-none">{{$i}}</a></li>                
            @endfor
        </div>
    </div>

	<hr style="color: rgb(183, 183, 183)">

	<x-footer></x-footer>
</div>
@endsection