@extends("layouts.app")

@php
$iscand = true;
$users = $data["users"] ?? [];
$isSearch = $data["isSearch"] ?? false;
$cand_ =  App\Models\User::where('role', "candidate")->get();
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
Platform Candidates | HR
@endsection

@section("content")
<div class="jobs">
	<x-main-nav :iscand="$iscand"></x-main-nav>

    <div class="section1">
        <h1 class="fw-bold mt-4">There Are {{number_format(count($cand_))}}  Candidates Here For You!</h1>
        <p class="fs-5 text-muted mt-3 mb-5">Discover your next career move, freelance gig, or internship</p>
        <div class="input_cont mb-3">
            <form action="/search/candidate" method="post">
                @csrf
                <input name="search" type="text" placeholder="search job...">
                <select name="" id="">
                    <option value="">Full time</option>
                    <option value="">part time</option>
                </select>
                <select name="location" id="">
                    <option value="">Location</option>
                    @foreach ($_countries as $item)
                        <option value="{{$item}}">{{$item}}</option>                        
                    @endforeach
                </select>
                <button class="btn">Find Now</button>
            </form>
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
                @if ($isSearch)
                    <p class="mb-0 ft text-muted">Search result found <strong>1-10</strong> of <strong>{{number_format(count($users))}} </strong> candidate</p>                    
                @else
                    <p class="mb-0 ft text-muted">Showing <strong>1-10</strong> of <strong>{{number_format(count($cand_))}} </strong> candidate</p>                    
                @endif
            </div>
            <div class="section3 section4">        
                <div class="d-flex justify-content- mt-3 flex-wrap">
                    @foreach ($users as $user)    
                    @if ($user->role == "candidate")             
			        <a href="/candidate/{{$user->unique_id}}/{{$user->first_name}}" class="text-decoration-none text-dark">
                        <div class="cont_">
                            <div class="text-center mt-3" >
                                @if ($user->avatar)
                                    <img loading="lazy" lazy style="width: 100px; height: 100px; object-fit:cover; border-radius:50%; object-fit:cover" src="https://static.vecteezy.com/system/resources/previews/036/594/092/non_2x/man-empty-avatar-photo-placeholder-for-social-networks-resumes-forums-and-dating-sites-male-and-female-no-photo-images-for-unfilled-user-profile-free-vector.jpg" alt="">                                        
                                @else
                                    <img style="width: 100px; height: 100px; object-fit:cover; border-radius:50%; object-fit:cover" src="https://static.vecteezy.com/system/resources/previews/036/594/092/non_2x/man-empty-avatar-photo-placeholder-for-social-networks-resumes-forums-and-dating-sites-male-and-female-no-photo-images-for-unfilled-user-profile-free-vector.jpg" alt="">                                        
                                @endif
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
                    <div class="text-center px-2">
                        <div class="" style="">            
                            {{ $users->links() }}
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