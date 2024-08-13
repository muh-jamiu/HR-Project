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
$jobs = $data["jobs"] ?? [];
$approved_job = $data["approved_job"] ?? [];
$pending_job = $data["pending_job"] ?? [];
$decline_job = $data["decline_job"] ?? [];
$applications = $data["applications"] ?? [];
$_countries = [
    "Afghanistan",
    "Albania",
    "Algeria",
    "Andorra",
    "Angola",
    "Antigua and Barbuda",
    "Argentina",
    "Armenia",
    "Australia",
    "Austria",
    "Azerbaijan",
    "Bahamas",
    "Bahrain",
    "Bangladesh",
    "Barbados",
    "Belarus",
    "Belgium",
    "Belize",
    "Benin",
    "Bhutan",
    "Bolivia",
    "Bosnia and Herzegovina",
    "Botswana",
    "Brazil",
    "Brunei",
    "Bulgaria",
    "Burkina Faso",
    "Burundi",
    "Cabo Verde",
    "Cambodia",
    "Cameroon",
    "Canada",
    "Central African Republic",
    "Chad",
    "Chile",
    "China",
    "Colombia",
    "Comoros",
    "Congo, Democratic Republic of the",
    "Congo, Republic of the",
    "Costa Rica",
    "Croatia",
    "Cuba",
    "Cyprus",
    "Czech Republic",
    "Denmark",
    "Djibouti",
    "Dominica",
    "Dominican Republic",
    "East Timor (Timor-Leste)",
    "Ecuador",
    "Egypt",
    "El Salvador",
    "Equatorial Guinea",
    "Eritrea",
    "Estonia",
    "Eswatini (Swaziland)",
    "Ethiopia",
    "Fiji",
    "Finland",
    "France",
    "Gabon",
    "Gambia",
    "Georgia",
    "Germany",
    "Ghana",
    "Greece",
    "Grenada",
    "Guatemala",
    "Guinea",
    "Guinea-Bissau",
    "Guyana",
    "Haiti",
    "Honduras",
    "Hungary",
    "Iceland",
    "India",
    "Indonesia",
    "Iran",
    "Iraq",
    "Ireland",
    "Israel",
    "Italy",
    "Ivory Coast (Côte d'Ivoire)",
    "Jamaica",
    "Japan",
    "Jordan",
    "Kazakhstan",
    "Kenya",
    "Kiribati",
    "Korea, North",
    "Korea, South",
    "Kosovo",
    "Kuwait",
    "Kyrgyzstan",
    "Laos",
    "Latvia",
    "Lebanon",
    "Lesotho",
    "Liberia",
    "Libya",
    "Liechtenstein",
    "Lithuania",
    "Luxembourg",
    "Madagascar",
    "Malawi",
    "Malaysia",
    "Maldives",
    "Mali",
    "Malta",
    "Marshall Islands",
    "Mauritania",
    "Mauritius",
    "Mexico",
    "Micronesia",
    "Moldova",
    "Monaco",
    "Mongolia",
    "Montenegro",
    "Morocco",
    "Mozambique",
    "Myanmar (Burma)",
    "Namibia",
    "Nauru",
    "Nepal",
    "Netherlands",
    "New Zealand",
    "Nicaragua",
    "Niger",
    "Nigeria",
    "North Macedonia (Macedonia)",
    "Norway",
    "Oman",
    "Pakistan",
    "Palau",
    "Panama",
    "Papua New Guinea",
    "Paraguay",
    "Peru",
    "Philippines",
    "Poland",
    "Portugal",
    "Qatar",
    "Romania",
    "Russia",
    "Rwanda",
    "Saint Kitts and Nevis",
    "Saint Lucia",
    "Saint Vincent and the Grenadines",
    "Samoa",
    "San Marino",
    "Sao Tome and Principe",
    "Saudi Arabia",
    "Senegal",
    "Serbia",
    "Seychelles",
    "Sierra Leone",
    "Singapore",
    "Slovakia",
    "Slovenia",
    "Solomon Islands",
    "Somalia",
    "South Africa",
    "South Sudan",
    "Spain",
    "Sri Lanka",
    "Sudan",
    "Suriname",
    "Sweden",
    "Switzerland",
    "Syria",
    "Taiwan",
    "Tajikistan",
    "Tanzania",
    "Thailand",
    "Togo",
    "Tonga",
    "Trinidad and Tobago",
    "Tunisia",
    "Turkey",
    "Turkmenistan",
    "Tuvalu",
    "Uganda",
    "Ukraine",
    "United Arab Emirates",
    "United Kingdom",
    "United States",
    "Uruguay",
    "Uzbekistan",
    "Vanuatu",
    "Vatican City (Holy See)",
    "Venezuela",
    "Vietnam",
    "Yemen",
    "Zambia",
    "Zimbabwe"
];
use Carbon\Carbon;
@endphp

@section('title')
Employer Dashboard | HR
@endsection

@section("content")
<div class="dashboard_ d-flex">
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
            <img class=""  width="150" height="150" style="border-radius: 50%" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS48f-GOfd7Vvaya0EWXRmDjamdDQs-FJdkWg&s" alt="">
            @endif
            <p class="mb-1 mt-3 text-capitalize">{{$user->company_name}} </p>
            <p class="ft mb-1">{{$user->email}}</p>
            <p class="ft">{{$user->phone ?? ""}}</p>
        </div>

        <div class="mt-4">
            <p class="fw-bold mb-0" style="color: purple">Dashboard</p>
            <li class="list-unstyled active"><a href="" class="text-decoration-none">
                <i class="fa-solid fa-house-user"></i> Overview
            </a></li>
             <li class="list-unstyled"><a href="/candidates" class="text-decoration-none">
                <i class="fa-solid fa-clipboard-user"></i> Browse Candidate
            </a></li>
            <li class="list-unstyled"><a href="/my-jobs" class="text-decoration-none">
                <i class="fa-solid fa-briefcase"></i> My Jobs
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
                        <li><a class="ft text-muted mt-2 dropdown-item" href="/browse-jobs">Explore Jobs</a></li>
                        <li><a class="ft text-muted mt-2 mb-2 dropdown-item" href="/candidates">Browse Candidate</a></li>
                        <li><hr class="dropdown-divider"></hr></li>
                        <li style="width: 90%" class="btn text-center mx-2 ft btn-danger"><a href="/logOut" class="text-decoration-none text-white">Log Out</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="d_section1 p-4">
            <div class="d-flex">
                @php
                    $skills__ = explode(",", $user->skills);
                @endphp
                  @if ($user->avatar)
                  <img  width="90" height="90" style="border-radius: 50%; object-fit:cover" src="{{$user->avatar}}" alt="">                
                  @else
                  <img  width="90" height="90" style="border-radius: 50%" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS48f-GOfd7Vvaya0EWXRmDjamdDQs-FJdkWg&s" alt="">                   
                  @endif
                <div class="mt-0 mx-2">
                    <h4 class="fw-bold mb-1 text-capitalize">Welcome Back, {{$user->company_name}}</h4>
                    <div class="d_skills mb-2 mt-2 d-flex">
                        @foreach ($skills__ as $item)
                        <p class="text-muted mb-0">{{$item}}</p>                            
                        @endforeach
                    </div>
                    <div class="d-flex">
                        <p class="text-muted ft text-capitalize">Employer | {{$user->company_type ?? "N/A"}}</p>
                    </div>
                </div>
            </div>
            <form action="/update-profile" enctype="multipart/form-data" method="POST" class="d_cv" id="upload_form">
                @csrf
                <label style="border-radius: 3px" for="avatar__" class=" px-4 mx-4 py-2 ft bg-info btn">Upload Company Logo</label>
                <input type="file" name="company_logo" id="avatar__" class="d-none">
            </form>
            @if (session("msg"))
            <p style="position: absolute; font-size:12px" class="ftr alert alert-success mt-3">{{session("msg")}}</p>                
            @endif
        </div>

        <div class="d_section2 mt-4">
            <div class="__nav nav d-flex nav-tabs">
                <li class="list-unstyled active" data-bs-toggle="tab" href="#home"><a href="#" class="text-decoration-none text-muted">Overview</a></li>
                <li class="list-unstyled" data-bs-toggle="tab" href="#jobs"><a href="#" class="text-decoration-none text-muted">My Jobs</a></li>
                <li class="list-unstyled" data-bs-toggle="tab" href="#profile"><a href="#" class="text-decoration-none text-muted">Company Profile</a></li>
                <li class="list-unstyled" data-bs-toggle="tab" href="#new_job"><a href="#" class="text-decoration-none text-muted">Post New Job</a></li>
                <li class="list-unstyled" data-bs-toggle="tab" href="#applicant"><a href="#" class="text-decoration-none text-muted">Job Application</a></li>
                <li class="list-unstyled" data-bs-toggle="tab" href="#price"><a href="#" class="text-decoration-none text-muted">Pricing</a></li>
            </div>

            <div class="tab-content mt-4">
                <div class="tab-pane container active" id="home">
                    <div class="justify-content-evenly  d-flex flex-wrap">
                        <div class="box_">
                            <p class="mt-2 ft text-info">Overall Jobs</p>
                            <div class="text-center mt-4">
                                <h1 style="font-size: 3em" class="fw-bold text-info">{{number_format(count($jobs))}}</h1>
                                <p class="text-muted ft mt-5">From Yesterday</p>
                            </div>
                        </div>
    
                        <div class="box_">
                            <p class="mt-2 ft text-success">Approved Jobs</p>
                            <div class="text-center mt-4">
                                <h1 style="font-size: 3em" class="fw-bold text-success">{{number_format(count($approved_job))}}</h1>
                                <p class="text-muted ft mt-5">From Yesterday</p>
                            </div>
                        </div>
    
                        <div class="box_">
                            <p class="ft mt-2 text-danger">Decline Jobs</p>
                            <div class="text-center mt-4">
                                <h1 style="font-size: 3em" class="fw-bold text-danger">{{number_format(count($decline_job))}}</h1>
                                <p class="text-muted ft mt-5">From Yesterday</p>
                            </div>
                        </div>
    
                        <div class="box_">
                            <p class="mt-2 ft text-warning">Pending Jobs</p>
                            <div class="text-center mt-4">
                                <h1 style="font-size: 3em" class="fw-bold text-warning">{{number_format(count($pending_job))}}</h1>
                                <p class="text-muted ft mt-5">From Yesterday</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane container fade" id="jobs">
                    <div class="section3_d" style="margin-bottom: 0 !important">
                        @if (count($jobs) == 0)
                            <div class="text-center mt-5">
                                <h4 class="fw-bold">Empty</h4>
                                <p class="text-muted ft">You do not have any created jobs at the moment</p>
                            </div>                            
                        @endif
                        <div class="d-flex justify-content- mt-3 flex-wrap">
                            @foreach ($jobs as $job)
                            <a href="/job/{{str_replace(" ", "_", $job->title)}}/{{$job->id}}" class="text-decoration-none text-dark">
                                <div class="cont_ bg-white">
                                    <div class="img" style="height: 150px">
                                        <img src="{{$job->avatar ?? "https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/jobs/job-1.png"}}" alt="">
                                    </div>
                                    <div class="p-3">
                                        <div class="d-fle flex-wrap mt-2 mb-4 justify-content-between">
                                            <p class="mb-2 text-muted ft mt-1 ">
                                                <img class="mx-2" width="20" height="20" style="border-radius: 50%" src="{{$user->avatar ?? "https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/jobs/job-1.png"}}" alt="">{{$user->company_name}}</p>
                                            <button style="background-color: rgba(45, 249, 45, 0.088); height:fit-content" class="btn text-success ft px-4 py-1">{{$job->employment_type}}</button>
                                        </div>
                                        <p class="mt-3 mb-1 fw-bold text-capitalize">{{$job->title}}</p>
                                        <p class="mt-3 mb-1 text-capitalize text-muted">{{$job->level}}</p>
                                        <p class="ft text-muted"><i class="fa-regular fa-clock"></i> {{Carbon::create($job->created_at)->format('l F j, Y')}}</p>
                                        <p class="text-muted"><span class="cl fw-bold">${{number_format((int)$job->salary)}}</span>/month</p>
                                        @if ($job->status == "approved")
                                            <p style="background-color: rgba(0, 255, 162, 0.063); font-size:10px" class="btn px-3 text-success">Approved</p>                                            
                                        @elseif ($job->status == "pending")
                                            <p style="background-color: rgba(0, 119, 255, 0.063); font-size:10px" class="btn px-3 text-info">Pending</p> 
                                        @else
                                            <p style="background-color: rgba(255, 0, 0, 0.063); font-size:10px" class="btn px-3 text-danger">Deline</p>                                             
                                        @endif
                                    </div>
                                </div>		
                            </a>		
                            @endforeach
                        </div>	
                    </div>
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
                            <input name="company_name" type="text" placeholder="Company name" value="{{$user->company_name}}">
                            <input name="company_type" type="text" placeholder="Company type" value="{{$user->company_type}}">
                        </div>
                        <div class="d-flex justify-content-evenly mb-3">
                            <input name="email" type="text" placeholder="Email Address" value="{{$user->email}}">
                            <input name="phone" type="text" placeholder="Phone number" value="{{$user->phone}}">
                        </div>
                        <textarea class="mb-3" name="bio" placeholder="About Company" id="" cols="5" rows="5">{{$user->bio}}</textarea>
                        <br>

                        <hr style="color: grey">
                        <br>
                        <p class="fw-bold mb-2">Location</p>
                        <div class="d-flex justify-content-evenly mb-3">
                            <input name="country" type="text" placeholder="Country" value="{{$user->country}}">
                            <input name="state" type="text" placeholder="State" value="{{$user->state}}">
                        </div>
                        <div class="d-flex justify-content-evenly mb-3">
                            <input name="city" type="text" placeholder="City" value="{{$user->city}}">
                            <input name="address" type="text" placeholder="Company full address" value="{{$user->address}}">
                        </div>
                        <br>
                        <hr style="color: grey">

                        <br>
                        <p class="fw-bold mb-2">Other Information</p>
                        <div class="d-flex justify-content-evenly mb-3">
                            <input name="title" value="{{$user->title}}" type="text" placeholder="Company title (eg) Remote/Hybrid">
                            <select name="salary" id="" value="{{$user->salary}}">
                                <option value="">{{$user->salary ?? "Select Salary range"}}</option>
                                @foreach ($salary as $item)
                                    <option value="{{$item}}">{{$item}}</option>                                    
                                @endforeach
                            </select>
                        </div>
                        <textarea class="mb-3" name="skills" placeholder="Company fields, comma(,) seperated..." id="" cols="5" rows="5">{{$user->skills}}</textarea>
                        <br>

                        <p data-bs-toggle="modal" data-bs-target="#apply__"  class="mt-3 Branches_btn text-white bg-primary">Add Company Branches</p>
                    </form>
                </div>

                <div class="tab-pane container all_input fade" id="new_job">
                    <form id="form_s" action="/create-job" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex justify-content-between">
                            <h4 class="fw-bold mb-4">Post A Job</h4>                        
                            {{-- <button class="btn mt-3 mb-2 btn-dark px-4">Save Changes</button> --}}
                        </div>

                        <hr style="color: grey">
                        <p class="fw-bold mb-2">Basic Information</p>
                        <div class="d-flex justify-content-evenly mb-3">
                            <input name="job_title" required type="text" placeholder="Job title">
                            <input name="job_type" required type="text" placeholder="Job type">
                        </div>
                        <div class="d-flex justify-content-evenly mb-3">
                            <input name="email" required type="text" placeholder="Contact Email Address">
                            <input name="phone" required type="text" placeholder="Contact Phone number">
                        </div>
                        <textarea class="mb-3" required name="description" placeholder="Job description" id="" cols="5" rows="5"></textarea>
                        <textarea class="mb-3" name="" placeholder="Desire skills, press enter to create tag..." id="tag-skills" cols="3" rows="3"></textarea>
                        <input type="text" name="skills" class="_skills_ d-none">
                        <div class="" id="tags_skill_list"></div>
                        <br>

                        <hr style="color: grey">
                        <br>
                        <p class="fw-bold mb-2">Location</p>
                        <div class="d-flex justify-content-evenly mb-3">
                            <input name="country" required type="text" placeholder="Country" value="{{$user->country}}">
                            <input name="state" required type="text" placeholder="State" value="{{$user->state}}">
                        </div>
                        <div class="d-flex justify-content-evenly mb-3">
                            <input name="city" required type="text" placeholder="City" value="{{$user->city}}">
                            <input name="address" required type="text" placeholder="Company full address" value="{{$user->address}}">
                        </div>
                        <br>
                        <hr style="color: grey">

                        <br>
                        <p class="fw-bold mb-2">Other Information</p>
                        <div class="d-flex justify-content-evenly mb-1">
                            <input name="salary" required id="numberInput" type="text" placeholder="Salary per month">
                            <select required name="" id="" >
                                <option value="">{{"Select Salary range"}}</option>
                                @foreach ($salary as $item)
                                    <option value="{{$item}}">{{$item}}</option>                                    
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex justify-content-evenly mt-3">
                            <select required name="employment_type" id="" >
                                <option value="">{{"Employment Type"}}</option>                                
                                <option value="Full-Time">Full-Time</option>  
                                <option value="Part-Time">Part-Time</option>  
                            </select>
                            <select required name="level" id="" >
                                <option value="">{{"Level"}}</option>
                                <option value="entry level">Entry Level</option>  
                                <option value="Junior">Junior</option>  
                                <option value="Senior">Senior</option>  
                                <option value="Experience">Experience</option> 
                                <option value="Not Applicable">Not Applicable</option> 
                            </select>
                        </div>
                        <textarea class="mb-3 mt-3" name="" placeholder="Experience, press enter to create tag..." id="tag-input" cols="3" rows="3"></textarea>
                        <input type="text" name="experience" class="_experience d-none">
                        <div class="mb-3" id="tags_list"></div>
                        <br>

                        <div class="d-flex mb-1 mt-3">
                            <p style="font-size: 10px" id="fileNameDisplay" class="fileNameDisplay mb-0 text-muted"></p>
                        </div>

                        <div class="">
                            <label style="background-color: rgba(214, 214, 214, 0.523); border-radius:10px" for="company_logo" class="mt-3 ft mb-2 py-2 px-4">Upload Job Logo</label>            
                            <input type="file" name="company_logo" id="company_logo" class="d-none">               
                        </div>

                        <button style="float: right" class="btn mt-3 mb-2 btn-dark px-4">Publish Job</button>  
                        <br>
                        <br>
                        <br>
                        <br>
                    </form>
                </div>

                <div class="tab-pane container fade" id="applicant">
                    <div class="section3_d" style="margin-bottom: 0 !important">
                        @if (count($applications) == 0)
                            <div class="text-center mt-5">
                                <h4 class="fw-bold">Empty</h4>
                                <p class="text-muted ft">You do not have any job applicant at the moment</p>
                            </div>                            
                        @endif
                        <div class="d-flex justify-content- mt-3 flex-wrap">
                            @foreach ($applications as $job)
                            <a href="/application/{{str_replace(" ", "_", $job->job_title)}}/{{$job->id}}" class="text-decoration-none text-dark">
                                <div class="cont_ bg-white">
                                    <div class="img" style="height: 150px">
                                        <img src="{{$job->avatar ?? "https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/jobs/job-1.png"}}" alt="">
                                    </div>
                                    <div class="p-3">
                                        <div class="d-fle flex-wrap mt-2 mb-4 justify-content-between">
                                            <p class="mb-2 text-muted ft mt-1 ">
                                                <img class="mx-2" width="20" height="20" style="border-radius: 50%" src="{{$user->avatar ?? "https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/jobs/job-1.png"}}" alt="">{{$user->company_name}}</p>    </div>

                                        <p class="mt-3 mb-2 fw-bold text-muted text-capitalize"><i class="fa-brands fa-cuttlefish"></i> {{$job->job_title}}</p>
                                        <p class="mt-3 mb-3 fw-bold ft text-muted text-capitalize"><i class="fa-regular fa-user"></i> {{$job->username}}</p>
                                        <p class="mb-2 ft text-muted text-capitalize text-muted"><i class="fa-solid fa-earth-americas"></i> {{$job->user_country}}</p>
                                        <p class="mb-2 ft text-muted text-capitalize text-muted"><i class="fa-solid fa-phone"></i> {{$job->phone}}</p>
                                        <p class="mb-2 ft text-muted text-muted"><i class="fa-regular fa-envelope"></i> {{$job->user_email}}</p>
                                        <p class="mb-2 ft text-muted text-capitalize text-muted"><i class="fa-solid fa-sliders"></i> {{$job->user_education}}</p>
                                    </div>
                                </div>		
                            </a>		
                            @endforeach
                        </div>	
                    </div>
                </div>

                <div class="tab-pane container fade" id="price">price</div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="apply__">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h6 class="modal-title">Add Company Branch</h6>
          <button type="button" class="btn-close ft" data-bs-dismiss="modal"></button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
            <input name="branch_name" style="width:100%; border: 1px solid rgb(213, 213, 213); padding:.8em;" class="mb-3" required type="text" placeholder="Enter branch name">
            <select style="width:100%; border: 1px solid rgb(213, 213, 213); padding:.8em;" class="mb-3" required type="text" placeholder="Country" name="branch_country" id="">
                @foreach ($_countries as $item)
                    <option value="{{$item}}">{{$item}}</option>
                @endforeach
            </select>
            <input name="branch_state" style="width:100%; border: 1px solid rgb(213, 213, 213); padding:.8em;" class="mb-3" required type="text" placeholder="State">                    
            <input id="checkdate" name="duration_state" style="width:100%; border: 1px solid rgb(213, 213, 213); padding:.8em;" class="mb-3" required type="text" placeholder="From - to">                    
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn px-4 btn-dark" data-bs-dismiss="modal">Add Branch</button>
          <button type="button" class="btn px-4 btn-danger" data-bs-dismiss="modal">Close</button>
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

        document.getElementById('company_logo').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const fileName = event.target.files[0].name;
        const fileSizeInMB = (file.size / (1024 * 1024)).toFixed(2);
        document.getElementById('fileNameDisplay').textContent = fileName;
    });
    </script>
@endpush