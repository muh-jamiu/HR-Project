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
$work = $data["work"] ?? [];
$education = $data["education"] ?? [];
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
@endphp

@section('title')
Candidate Dashboard | HR
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
             <li class="list-unstyled"><a href="/employers" class="text-decoration-none">
                <i class="fa-solid fa-clipboard-user"></i> Browse Employers
            </a></li>
            <li class="list-unstyled"><a href="/browse-jobs" class="text-decoration-none">
                <i class="fa-solid fa-briefcase"></i> Explore Jobs
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
                        <li><a class="ft text-muted mt-2 mb-2 dropdown-item" href="/employers">Browse Employers</a></li>
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
                <img  width="80" height="80" style="border-radius: 50%; object-fit:cover" src="{{$user->avatar}}" alt="">                
                @else
                <img  width="80" height="80" style="border-radius: 50%" src="https://static.vecteezy.com/system/resources/previews/036/594/092/non_2x/man-empty-avatar-photo-placeholder-for-social-networks-resumes-forums-and-dating-sites-male-and-female-no-photo-images-for-unfilled-user-profile-free-vector.jpg" alt="">                   
                @endif
                <div class="mt-0 mx-2">
                    <h4 class="fw-bold mb-1 text-capitalize">Welcome Back, {{$user->first_name}}</h4>
                    <div class="d_skills mb-2 mt-2 d-flex">
                        @foreach ($skills__ as $item)
                        <p class="text-muted mb-0">{{$item}}</p>                            
                        @endforeach
                    </div>
                    <div class="d-flex">
                        <p class="text-muted ft text-capitalize">Candidate | {{$user->title ?? "N/A"}}</p>
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
            {{-- <form action="" class="d_cv">
                <label style="border-radius: 3px" for="cv" class="text-white btn px-4 mx-4 py-2 ft bg-primary">Upload CV</label>
                <input accept=".pdf" type="file" name="cv" id="cv" class="d-none">
            </form> --}}
        </div>

        <div class="d_section2 mt-4">
            <div class="__nav nav d-flex nav-tabs">
                <li class="list-unstyled active" data-bs-toggle="tab" href="#home"><a href="#" class="text-decoration-none text-muted">Overview</a></li>
                <li class="list-unstyled" data-bs-toggle="tab" href="#jobs"><a href="#" class="text-decoration-none text-muted">Applications</a></li>
                <li class="list-unstyled" data-bs-toggle="tab" href="#profile"><a href="#" class="text-decoration-none text-muted">User Profile</a></li>
                <li class="list-unstyled" data-bs-toggle="tab" href="#price"><a href="#" class="text-decoration-none text-muted">Pricing</a></li>
            </div>

            <div class="tab-content mt-4">
                <div class="tab-pane container active" id="home">
                    <div class="justify-content-evenly  d-flex flex-wrap">
                        <div class="box_">
                            <p class="mt-2 ft text-info">Overall Application</p>
                            <div class="text-center mt-4">
                                <h1 style="font-size: 3em" class="fw-bold text-info">{{number_format(count($applications))}}</h1>
                                <p class="text-muted ft mt-5">From Yesterday</p>
                            </div>
                        </div>
    
                        <div class="box_">
                            <p class="mt-2 ft text-success">Approved Application</p>
                            <div class="text-center mt-4">
                                @php
                                    $approved = 0;
                                    $pending = 0;
                                    $decline = 0;
                                    for($i = 0; $i < count($applications); $i++){
                                        if ($applications[$i]->status == "approved"){
                                            $approved += 1;
                                        }elseif($applications[$i]->status == "pending"){
                                            $pending += 1;
                                        }elseif($applications[$i]->status == "decline"){
                                            $decline += 1;
                                        }
                                    }
                                @endphp
                               
                                <h1 style="font-size: 3em" class="fw-bold text-success">{{number_format($approved)}}</h1>
                                <p class="text-muted ft mt-5">From Yesterday</p>
                            </div>
                        </div>
    
                        <div class="box_">
                            <p class="ft mt-2 text-danger">Decline Application</p>
                            <div class="text-center mt-4">
                                <h1 style="font-size: 3em" class="fw-bold text-danger">{{number_format($decline)}}</h1>
                                <p class="text-muted ft mt-5">From Yesterday</p>
                            </div>
                        </div>
    
                        <div class="box_">
                            <p class="mt-2 ft text-warning">Pending Application</p>
                            <div class="text-center mt-4">
                                <h1 style="font-size: 3em" class="fw-bold text-warning">{{number_format($pending)}}</h1>
                                <p class="text-muted ft mt-5">From Yesterday</p>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="__nav nav d-flex nav-tabs mt-4">
                        <li class="list-unstyled active" data-bs-toggle="tab" href="#all_j"><a href="#ddd_" class="text-decoration-none text-muted">All Application</a></li>
                        <li class="list-unstyled" data-bs-toggle="tab" href="#active_j"><a href="#ddd_" class="text-decoration-none text-muted">Active Application</a></li>
                        <li class="list-unstyled" data-bs-toggle="tab" href="#decline_j"><a href="#ddd_" class="text-decoration-none text-muted">Decline Application</a></li>
                        <li class="list-unstyled" data-bs-toggle="tab" href="#pending_j"><a href="#ddd_" class="text-decoration-none text-muted">Pending Application</a></li>
                    </div> --}}

                    {{-- <div class="tab-content mb-5 mt-4" id="ddd_">

                        <div class="tab-pane container active" id="all_j">
                            <div class="text-center mt-5">
                                <h4>Empty</h4>
                                <p class="text-muted ft">You don't have any application at the momemt.</p>
                                <a href="/browse-jobs" class="btn btn-primary mt-2 mx-4">Browse Jobs</a>
                            </div>
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
                    </div> --}}

                </div>

                <div class="tab-pane container fade" id="jobs">
                    <div class="section3_d" style="margin-bottom: 0 !important">
                        @if (count($applications) == 0)
                            <div class="text-center mt-5" style="margin-bottom: 15em">
                                <h4 class="fw-bold">Empty</h4>
                                <p class="text-muted ft">You don't have any job application at the moment.</p>
                            </div>
                        @endif
                        <div class="d-flex justify-content- mt-3 flex-wrap">
                            @foreach ($applications as $cp)
                            @php
                                $jobs = App\Models\Job::where(["id" => $cp->job_id])->first();
                                $company_ = App\Models\User::where(["id" => $jobs->company_id])->first();
                            @endphp
                            <a href="/application/{{str_replace(" ", "_", $cp->job_title)}}/{{$cp->id}}" class="text-decoration-none text-dark">
                                <div class="cont_ bg-white">
                                    <div class="img" style="height: 150px">
                                        <img src="{{$jobs->avatar ?? "https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/jobs/job-1.png"}}" alt="">
                                    </div>
                                    <div class="p-3">
                                        <div class="d-fle flex-wrap mt-2 mb-4 justify-content-between">
                                            <p class="mb-2 text-muted ft mt-1 ">
                                                <img class="mx-2" width="20" height="20" style="border-radius: 50%" src="{{$jobs->avatar ?? "https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/jobs/job-1.png"}}" alt="">{{$company_->company_name}}</p>
                                            <button style="background-color: rgba(45, 249, 45, 0.088); height:fit-content" class="btn text-success ft px-4 py-1  text-capitalize">{{$jobs->employment_type}}</button>
                                        </div>
                                        <p class="mt-3 text-capitalize fw-semibold mb-2">{{$cp->job_title}}</p>
                                        <p class="text-capitalize ft text-muted mb-1">{{$jobs->level}}</p>
                                        <p class="text-capitalize ft text-muted mb-1">{{$jobs->phone}}</p>
                                        <p class="text-capitalize ft text-muted mb-1">{{$jobs->country}}</p>
                                        <p class="ft text-muted mb-3">{{$jobs->email}}</p>
                                        <p style="background-color: rgba(0, 0, 255, 0.047); border-radius:13px; width:fit-content; font-size:12px" class="px-3 text-capitalize py-2 text-muted mb-1">{{$cp->status}}</p>
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
                            <input name="first_name" type="text" placeholder="First name" value="{{$user->first_name}}">
                            <input name="last_name" type="text" placeholder="Last name" value="{{$user->last_name}}">
                        </div>
                        <div class="d-flex justify-content-evenly mb-3">
                            <input name="email" type="text" placeholder="Email Address" value="{{$user->email}}">
                            <input name="phone" type="text" placeholder="Phone number" value="{{$user->phone}}">
                        </div>
                        <textarea class="mb-3" name="bio" placeholder="Bio" id="" cols="5" rows="5">{{$user->bio}}</textarea>
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
                            <input name="address" type="text" placeholder="Full address" value="{{$user->address}}">
                        </div>
                        <br>
                        <hr style="color: grey">

                        <br>
                        <p class="fw-bold mb-2">Other Information</p>
                        <div class="d-flex justify-content-evenly mb-3">
                            <input name="title" value="{{$user->title}}" type="text" placeholder="Work title (eg) software developer, designer, marketer">
                            <select name="salary" id="" value="{{$user->salary}}">
                                <option value="">{{$user->salary ?? "Select Salary range"}}</option>
                                @foreach ($salary as $item)
                                    <option value="{{$item}}">{{$item}}</option>                                    
                                @endforeach
                            </select>
                        </div>
                        <textarea class="mb-3" name="skills" placeholder="Professional skills, comma(,) seperated..." id="" cols="5" rows="5">{{$user->skills}}</textarea>
                        <br>

                    </form>

                    <hr style="color: grey">    
                    <br>
                    <p class="fw-bold mb-2">Work Experience</p>
                    <div class="d-flex">
                        <button data-bs-toggle="modal" data-bs-target="#work__"  class="btn px-4 btn-primary">Add Work Experience</button>
                    </div>
                    <div class="row mt-4">
                        @foreach ($work as $item)
                        <div class="col-sm-4 mb-3">
                            <p class="fw-bold  text-capitalize mb-1">{{$item->title}}</p>
                            <p class="text-muted  text-capitalize mb-1 ft">{{$item->state}}, {{$item->country}}</p>
                            <p class="text-muted mb-1 ft">{{$item->date}}</p>
                        </div>                            
                        @endforeach
                    </div>

                    <hr style="color: grey">    
                    <br>
                    <p class="fw-bold mb-2">Education</p>
                    <div class="d-flex">
                        <button data-bs-toggle="modal" data-bs-target="#education__"  class="btn px-4 btn-primary">Add Education</button>
                    </div>
                    <div class="mt-4">
                        @foreach ($education as $item)
                        <li class="mb-3 text-capitalize">
                            {{$item->name}}({{$item->date}})
                        </li>                            
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane container fade" id="price">price</div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="work__">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h6 class="modal-title">Add Work Experience</h6>
          <button type="button" class="btn-close ft" data-bs-dismiss="modal"></button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
            <form action="/work" method="post">
                @csrf
                <input name="work_name" style="width:100%; border: 1px solid rgb(213, 213, 213); padding:.8em;" class="mb-3" required type="text" placeholder="Enter work title">
                <select style="width:100%; border: 1px solid rgb(213, 213, 213); padding:.8em;" class="mb-3" required type="text" placeholder="Country" name="work_country" id="">
                    @foreach ($_countries as $item)
                        <option value="{{$item}}">{{$item}}</option>
                    @endforeach
                </select>
                <input name="work_state" style="width:100%; border: 1px solid rgb(213, 213, 213); padding:.8em;" class="mb-3" required type="text" placeholder="State">                    
                <input id="checkdate" name="work_date" style="width:100%; border: 1px solid rgb(213, 213, 213); padding:.8em;" class="mb-3" required type="text" placeholder="From - to">   
                <input style="width: fit-content" type="submit" value="Add Work Experience" class="btn px-4 py-2 btn-dark mt-4 mb-5" >
            </form>                 
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn px-4 btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
  
      </div>
    </div>
</div>

<div class="modal fade" id="education__">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h6 class="modal-title">Add Education</h6>
          <button type="button" class="btn-close ft" data-bs-dismiss="modal"></button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
            <form action="/education" method="post">
                @csrf
                <input name="name" style="width:100%; border: 1px solid rgb(213, 213, 213); padding:.8em;" class="mb-3" required type="text" placeholder="Enter institution name">
                <input name="degree" style="width:100%; border: 1px solid rgb(213, 213, 213); padding:.8em;" class="mb-3" required type="text" placeholder="Degree">                    
                <input id="checkdate" name="date" style="width:100%; border: 1px solid rgb(213, 213, 213); padding:.8em;" class="mb-3" required type="text" placeholder="From - to">   
                <input style="width: fit-content" type="submit" value="Add Education" class="btn px-4 py-2 btn-dark mt-4 mb-5" >
            </form>                 
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
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
    </script>
@endpush