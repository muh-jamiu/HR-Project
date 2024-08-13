@extends("layouts.app")

@php
$is_jobs = true;
$jobs = $data["jobs"] ?? [];
$job_ =  App\Models\Job::where("company_id", session("hr_id"))->get();
use Carbon\Carbon;
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
My Jobs | HR
@endsection

@section("content")
<div class="jobs">
	<x-main-nav :isjobs="$is_jobs"></x-main-nav>

    <div class="section1">
        <h1 class="fw-bold mt-4">There Are Total of {{number_format(count($job_))}} Jobs You've Created!</h1>
        <p class="fs-5 text-muted mt-3 mb-5">Discover your next career move, freelance gig, or internship</p>
    </div>

    <div class="section2 d-flex">
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

    <div class="text-center px-2">
        <div class="" style="">            
            {{ $jobs->links() }}
        </div>
    </div>     

	<hr style="color: rgb(183, 183, 183)">

	<x-footer></x-footer>
</div>
@endsection