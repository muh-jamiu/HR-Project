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
        <h1 class="fw-bold mt-4">@lang("messages.cand_title", ["count" => number_format(count($cand_))])</h1>
        <p class="fs-5 text-muted mt-3 mb-5">@lang("messages.subtitle")</p>
        <div class="input_cont mb-3">
            <form action="/search/candidate" method="post">
                @csrf
                <input name="search" type="text" placeholder='{{ __('messages.search_job_placeholder')}}'>
                <select name="" id="">
                    <option value="">@lang("messages.fulltime")</option>
                    <option value="">@lang("messages.parttime")</option>
                </select>
                <select name="location" id="">
                    <option value="">@lang("messages.locations")</option>
                    @foreach ($_countries as $item)
                        <option value="{{$item}}">{{$item}}</option>                        
                    @endforeach
                </select>
                <button class="btn">@lang("messages.find_now")</button>
            </form>
        </div>

    </div>

    <div class="section2 d-flex">
        <div class="first">
            <div class="__job__ mb-3">
                <h5 class="fw-bold mb-3">@lang("messages.recruiting")</h5>
                <p class="ft">@lang("messages.advertise_jobs")</p>
                <button class="btn btn-light mt-4">@lang("messages.post_a_job")b</button>
            </div>

            <div class="xys_">
                <div class="mb-4">
                    <p class="fw-semibold mb-1">@lang("messages.locations")</p>
                    <div class="input-group flex-nowrap">
                        <span style="background: transparent" class="input-group-text"><i class="fa-solid text-muted fa-location-dot"></i></span>
                        <input style="border:1px solid rgb(231, 231, 231);border-left: none;" type="text" class="form-control" placeholder={{ __('messages.enter_location')}}>
                    </div>
                    <button style="width: 100%" class="btn btn-primary_ mt-4">@lang("messages.apply_filter")</button>
                </div>
    
                <div class="mb-4">
                    <p class="fw-semibold mb-1">@lang("messages.category")</p>
                    <div class="input-group flex-nowrap">
                        <span style="background: transparent" class="input-group-text"><i class="fa-solid text-muted fa-layer-group"></i></span>
                        <input style="border:1px solid rgb(231, 231, 231);border-left: none;" type="text" class="form-control" placeholder={{ __('messages.enter_category')}}>
                    </div>
                    <button style="width: 100%" class="btn btn-primary_ mt-4">@lang("messages.apply_filter")</button>
                </div>
            </div>

            <div class="xys_">    
                <div class="mb-1">
                    <p class="fw-semibold mb-1">@lang("messages.job_type")</p>
                    <div class="input-group flex-nowrap">
                        <span style="background: transparent" class="input-group-text"><i class="fa-solid text-muted fa-layer-group"></i></span>
                        <input style="border:1px solid rgb(231, 231, 231);border-left: none;" type="text" class="form-control" placeholder={{ __('messages.enter_job_type')}}>
                    </div>
                    <button style="width: 100%" class="btn btn-primary_ mt-4">@lang("messages.apply_filter")</button>
                </div>
            </div>

            <div class="xys_">    
                <div class="mb-1">
                    <p class="fw-semibold mb-1">@lang("messages.experience_level")</p>
                    <div class="input-group flex-nowrap">
                        <span style="background: transparent" class="input-group-text"><i class="fa-solid text-muted fa-layer-group"></i></span>
                        <input style="border:1px solid rgb(231, 231, 231);border-left: none;" type="text" class="form-control" placeholder='{{ __('messages.enter_experience_level')}}'>
                    </div>
                    <button style="width: 100%" class="btn btn-primary_ mt-4">@lang("messages.apply_filter")</button>
                </div>
            </div>
        </div>

        <div class="second">
            <div class="d-flex justify-content-between">
                @if ($isSearch)
                    <p class="mb-0 ft text-muted">@lang("messages.cand_showing", ["total" => number_format(count($users))])</p>
                    {{-- <p class="mb-0 ft text-muted">Search result found <strong>1-10</strong> of <strong>{{number_format(count($users))}} </strong> candidate</p>                     --}}
                @else
                    <p class="mb-0 ft text-muted">@lang("messages.search_result", ["total" => number_format(count($cand_))])</p>
                    {{-- <p class="mb-0 ft text-muted">Showing <strong>1-10</strong> of <strong>{{number_format(count($cand_))}} </strong> candidate</p>                     --}}
                @endif
            </div>
            <div class="section3 section4">        
                <div class="d-flex justify-content- mt-3 flex-wrap">
                    @foreach ($users as $user)    
                    @if ($user->role == "candidate")             
			        <a href="/candidate/{{$user->unique_id}}/{{$user->first_name}}" class="text-decoration-none text-dark">
                        <div class="cont_">
                            <div class="text-center mt-3" >
                                @php
                                    $image = $user->avatar ?? null;
                                @endphp
                                @if ($image)
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
                                <button class="btn ft btn-outline-dark">@lang("messages.view_profile")</button>
                            </div>
                        </div>	
                    </a>	                        
                    @endif   		
                    @endforeach
                    @if (!$isSearch)
                    <div class="text-center px-2">
                        <div class="" style="">            
                            {{ $users->links() }}
                        </div>
                    </div>                        
                    @endif
                </div>
            </div>
        </div>
    </div>


	<hr style="color: rgb(183, 183, 183)">

	<x-footer></x-footer>
</div>
@endsection