@extends("layouts.app")
@php
$ishome = true;
$jobs = $data["jobs"] ?? [];
$rand_jobs = $data["rand_jobs"] ?? [];
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

$islogin = session("hr_id");

$category = [
	["name" =>  __('messages.content_writer'), "image" => "https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/icons/content-writer.svg"],
	["name" =>  __('messages.marketing_director'), "image" => "https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/icons/marketing-director.svg"],
	["name" =>  __('messages.system_analyst'), "image" => "https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/icons/system-analyst.svg"],
	["name" =>  __('messages.marketing_communication'), "image" => "https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/icons/marketing.svg"],
	["name" =>  __('messages.digital_designer'), "image" => "https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/icons/business-development.svg"],
	["name" =>  __('messages.market_research'), "image" => "https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/icons/proof-reading.svg"],
	["name" =>  __('messages.human_resource'), "image" => "https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/icons/marketing-director.svg"],
	["name" =>  __('messages.customer_service'), "image" => "https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/icons/proof-reading.svg"],
	["name" =>  __('messages.automotive_jobs'), "image" => "https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/icons/content-writer.svg"],
];

$images_ = [
    "https://superio-appdir.vercel.app/_next/image?url=%2Fimages%2Fresource%2Fblog%2F2.jpg&w=1920&q=75",
    "https://superio-appdir.vercel.app/_next/image?url=%2Fimages%2Fresource%2Fblog%2F1.jpg&w=1920&q=75",
    "https://superio-appdir.vercel.app/_next/image?url=%2Fimages%2Fresource%2Fblog%2F3.jpg&w=1920&q=75"
];

$blogt = [
    "15 High-Paying Future Jobs Shaped by AI Technology: Top Career 
Opportunities for 2030",
    "Which Jobs Will Thrive in the Age of AI? Top Careers That Will Endure and 
Those at Risk",
    "Top IT Skills for 2030: Expert Predictions on the Most In-Demand Technical 
Abilities",
];

$blogI = [
    "As artificial intelligence (AI) continues to evolve, it's reshaping the job market in 
unprecedented ways. The emergence of AI technology is creating new career opportunities 
that promise high salaries and exciting prospects. To navigate this future landscape, it's 
crucial to understand which roles are likely to thrive in this new era. This blog post explores 
15 high-paying jobs shaped by AI technology that will be in demand by 2030.",
    "As AI continues to advance, its impact on various professions is becoming increasingly 
evident. Understanding which jobs are likely to endure and which are at risk of automation is 
essential for career planning in the AI era. This blog post examines the careers that will thrive
despite AI advancements and those that might face challenges.",
    "The rapid evolution of technology is shaping the future of IT careers. To remain competitive 
and relevant, IT professionals must develop skills that align with emerging trends. This blog 
post outlines the top IT skills for 2030 based on expert predictions and offers guidance on 
how to acquire these essential abilities.",
];

$lang = session("locale");
@endphp

@section('title')
HR | Job Board
@endsection

@section("content")

<div class="_land_">
    <div style="background: transparent !important" class="top mobile_nav d-flex justify-content-between d-none">
        <h3 data-bs-toggle="offcanvas" data-bs-target="#demo" class="fw-bold"><a style="height: fit-content" href="#" class="text-dark text-decoration-none"><img style="width: 70px" src="/img/logo_.png" alt=""></a></h3>
        <div data-bs-toggle="offcanvas" data-bs-target="#demo" style="position:absolute; right:0; font-size:1.5em" class="mx-3 mt-2"><i class="fa-solid fa-bars"></i></div>
    </div>

    <div class="section_1 sections_all">
        <div style="background: transparent !important" class="top mb-5 web_nav d-flex justify-content-between">
            <h3 class="fw-bold"><a href="/" class="text-dark text-decoration-none"><img style="width: 100px;  transform:translateY(-20px)" src="/img/logo_.png" alt=""></a></h3>
            <div class="_all_links d-flex">
                <div class="dropdown flags_" style="margin-right: 3em">
                    <button type="button" class="btn bg__ text-muted dropdown-toggle" data-bs-toggle="dropdown">
                        @if ($lang == "en")
                        <img src="https://upload.wikimedia.org/wikipedia/en/thumb/a/ae/Flag_of_the_United_Kingdom.svg/1280px-Flag_of_the_United_Kingdom.svg.png" alt=""> English                
                        @endif
                        @if ($lang == "fr")
                        <img src="https://m.media-amazon.com/images/I/4109Z2o0HuL._AC_UF894,1000_QL80_.jpg" alt=""> French                
                        @endif
                        @if ($lang == "de")
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcScBXsZhOLWG9aaZzvy5KdAR39CVFsvM2e3DA&s" alt=""> German                
                        @endif
            
                        @if (!$lang)
                        <img src="https://upload.wikimedia.org/wikipedia/en/thumb/a/ae/Flag_of_the_United_Kingdom.svg/1280px-Flag_of_the_United_Kingdom.svg.png" alt=""> English                
                        @endif
                        
                    </button>

                    <ul class="dropdown-menu">
                        <li style="margin-right: 0 !important"><h5 class="dropdown-header">Choose Language</h5></li>
                        <li style="margin-right: 0 !important"><hr class="dropdown-divider"></hr></li>
                        <li style="margin-right: 0 !important"><a class="text-muted fr mt-3 mb-3 dropdown-item" href="/lang/en"><img src="https://upload.wikimedia.org/wikipedia/en/thumb/a/ae/Flag_of_the_United_Kingdom.svg/1280px-Flag_of_the_United_Kingdom.svg.png" alt=""> English</a></li>
                        <li style="margin-right: 0 !important"><a class="text-muted fr mb-3 dropdown-item" href="/lang/de"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcScBXsZhOLWG9aaZzvy5KdAR39CVFsvM2e3DA&s" alt=""> German</a></li>
                        <li style="margin-right: 0 !important"><a class="text-muted fr mb-3 dropdown-item" href="/lang/fr"><img src="https://m.media-amazon.com/images/I/4109Z2o0HuL._AC_UF894,1000_QL80_.jpg" alt=""> French</a></li>
                    </ul>
                </div>
                <li class="list-unstyled"><a href="/" class="text-decoration-none active">@lang("messages.n_home")</a></li>
                <li class="list-unstyled"><a href="/browse-jobs" class="text-decoration-none">@lang("messages.n_find_jobs")</a></li>
                <li class="list-unstyled"><a href="/employers" class="text-decoration-none">@lang("messages.n_employers")</a></li>
                <li class="list-unstyled"><a href="/candidates" class="text-decoration-none">@lang("messages.n_candidates")</a></li>
                <li class="list-unstyled"><a href="/contact-us" class="text-decoration-none">@lang("messages.n_contact_us")</a></li>
                 @if ($islogin)                
                    <a href="/account-check" class="btn _btnl">@lang("messages.n_dashboard")</a>
                @else
                    <a href="/login" class="btn _btnl">@lang("messages.n_login_register")</a>
                    <a href="/login" class="btn btn-primary">@lang("messages.n_post_job")</a>                
                @endif
            </div>
        </div>

        <div class="d-flex">
            <div class="text_ mt-5">
                <h1 style="font-size: 3.5em">@lang("messages.n_n1", ["count" => number_format(count($rand_jobs))])</h1>
                <p class="text-muted ft ftr">@lang("messages.n_n2")</p>
                <div class="inputs_">
                    <form action="/search-jobs" method="post">
                        @csrf
                        <input name="search" required class="mb-3" type="text" placeholder="{{ __('messages.search_placeholder')}}">
                        <input name="location" required class="mb-3" type="text" placeholder="{{ __('messages.location')}}">
                        <button class="btn btn-primary">@lang("messages.n_find_jobs")</button>
                    </form>
                </div>
                <p class="text-muted ft ftr">@lang("messages.n_popular_searches")</p>
            </div>

            <div class="img_">
                <div class="posit__ mt-3">
                    <img src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/banner/congratulation.svg" alt="" class="sec">
                    <img src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/banner/web-dev.svg" alt="" class="third">
                </div>
                <img class="all_" src="https://superio-appdir.vercel.app/_next/image?url=%2Fimages%2Fresource%2Fbanner-img-1.png&w=1920&q=75" alt="">
            </div>
        </div>
    </div>

    <div class="section_2 sections_all">
        <h4 class="text-center mt-5">@lang("messages.n_popular_job_categories")</h4>
        <p class="text-muted text-center ft ftr">@lang("messages.n_jobs_live", ["count" => number_format(count($rand_jobs)), 'today' => number_format(count($rand_jobs))]) </p>

        <div class="d-flex _cont flex-wrap justify-content-evenly">
            @foreach ($category as $item)
            <a href="/browse-jobs?category={{$item["name"]}}" class="_box text-decoration-none d-flex">
                <div class="icon_ text-center text-primary">
                    <img src="{{$item["image"]}}" alt="">
                </div>
                <div class="mx-3">
                    <h6 class="text-dark">{{$item["name"]}}</h6>
                    <p class="text-muted ft">(@lang("messages.n_n4"))</p>
                </div>
            </a>                
            @endforeach
        </div>

    </div>

    <hr style="color: rgb(197, 197, 197)">

    <div class="section_3 sections_all">
        <h4 class="text-center mt-5">@lang("messages.n_featured_jobs")</h4>
        <p class="text-muted text-center ft ftr">@lang("messages.n_know_your_worth")</p>
        <div class="d-flex _cont flex-wrap justify-content-evenly">
            
			@foreach ($rand_jobs as $item)
            <a href="/job/{{str_replace(" ", "-", $item->title)}}/{{$item->id}}" class="_box d-flex text-decoration-none">
                <div class="icon_ text-center text-primary">
                    <img src="{{$item->avatar ?? 'https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/icons/marketing-director.svg'}}" alt="">
                </div>
                <div class="mx-3">
                    <h6 class="text-dark text-capitalize">{{$item->title}}</h6>
                    <div class="d-flex flex-wrap mb-2">
                        <p class="mb-2 info_ text-muted fts_"><i class="fa-solid fa-bag-shopping"></i> {{str_replace("-", " ", $item->employment_type)}}</p>
                        <p class="mb-2 info_ text-muted text-capitalize fts_"><i class="fa-solid fa-location-dot"></i> {{$item->state}}, {{$item->country}}</p>
                        <p class="mb-2 info_ text-muted text-capitalize fts_"><i class="fa-regular fa-clock"></i> {{Carbon::create($item->created_at)->format('l F j, Y')}}</p>
                        <p class="mb-2 info_ text-muted text-capitalize fts_"><i class="fa-solid fa-sack-dollar"></i> ${{number_format($item->salary)}}</p>
                    </div>

                    <div class="d-flex mt-3">
                        <p class="info_1 text-primary type_1 text-capitalize mb-0 ft">{{str_replace("-", " ", $item->employment_type)}}</p>
                        <p class="info_1 type_2 text-warning text-capitalize mb-0 ft">{{$item->level}}</p>
                    </div>
                </div>
            </a>                
            @endforeach
        </div>
    </div>

    <div class="section_5 sections_all d-flex">
        <img src="https://superio-appdir.vercel.app/_next/image?url=%2Fimages%2Fresource%2Fimage-2.jpg&w=1200&q=75" alt="">
        <div style="margin-left: 4em" class="text_">
            <h1 class="fw-bold">@lang("messages.n_millions_of_jobs")</h1>
            <p class="text-muted mt-2 mb-4 ft">@lang("messages.n_search").</p>
            <p><i class="fa-solid fa-check text-success mx-2"></i> Elevate your HR operations</p>
            <p><i class="fa-solid fa-check text-success mx-2"></i> Optimize your recruitment strategy</p>
            <p><i class="fa-solid fa-check text-success mx-2"></i> Utilize advanced AI tools to streamline your hiring process</p>
            <a href="/browse-jobs" class="btn mt-3 btn-primary">Get Started</a>
        </div>
    </div>

    <div class="section_6 sections_all mb-5 mt-5 d-flex justify-content-evenly">
        <div>            
            <h1 class="fw-bold text-center">50+</h1>
            <p class="text-muted text-center ft">Over 50 AI features at your disposal</p>
        </div>
        <div>            
            <h1 class="fw-bold text-center">100+</h1>
            <p class="text-muted text-center ft">Hundreds of jobs posted daily</p>
        </div>
        <div>            
            <h1 class="fw-bold text-center">600</h1>
            <p class="text-muted text-center ft">Get the right candidate in time</p>
        </div>
    </div>

    <div class="section_8 sections_all">
        <div class="text-center mb-5">
            <h4 class="">Recent News Articles</h4>
            <p class="text-muted ft">Fresh job related news content posted each day.</p>
        </div>

        <div style="overflow: scroll" class="d-flex _blg_ justify-content-start flex-nowrap">
            @for ($i = 0; $i < 3; $i++)
                <a href="/blogs?title={{str_replace(" ", "_", $blogt[$i])}}" class="_box mx-2 mb-4 text-decoration-none">
                    <div class="img">
                        <img src="{{$images_[$i]}}" alt="">
                    </div>
                    <p class="text-muted mt-2 ft">August 31, 2024</p>
                    <p class="fw-bold text-muted mb-1">{{$blogt[$i]}}</p>
                    <p class="text-muted ft">{{$blogI[$i]}}</p>
                    
                    {{-- <a href="#" class="btn text-primary">Read More</a> --}}
                </a>       
            @endfor
        </div>     
    </div>

    <div class="section_7 sections_all mt-5 mb-5 pt-5 d-flex justify-content-between">
        <div class="">
            <h2>@lang("messages.n_recruiting")</h2>
            <p style="width: 50%"  class="text-muted mb-5 mt-3 ft">@lang("messages.n_n3")</p>
            <a href="/candidates" class="btn px-4 py-3 btn-primary">@lang("messages.n_start_recruiting_now")</a>
        </div>
        <img src="https://superio-appdir.vercel.app/images/resource/image-1.png" alt="">
    </div>
    <br>

    <hr style="color: rgb(197, 197, 197)">

   <x-footer></x-footer>
   <br>

    
    <div class="offcanvas offcanvas-start" id="demo">
        <div class="offcanvas-header">
            <h3 class="fw-bold"><a href="/" class="text-dark text-decoration-none"><img style="width: 70px" src="/img/logo_.png" alt=""></a></h3>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
        </div>

        <hr style="color: rgb(197, 197, 197)">

        <div class="offcanvas-body">
            <li class="list-unstyled"><a href="/" class="text-dark active text-decoration-none">@lang("messages.nav_home")</a></li>
            <li class="list-unstyled"><a href="/browse-jobs" class="text-dark text-decoration-none">@lang("messages.nav_browse_jobs")</a></li>
            <li class="list-unstyled" ><a href="/employers" class="text-dark text-decoration-none">@lang("messages.nav_employers")</a></li>
            <li class="list-unstyled"><a href="/candidates" class="text-dark text-decoration-none">@lang("messages.nav_candidates")</a></li>
            @if ($islogin)
                <li class="list-unstyled"><a href="/account-check" class="text-dark text-decoration-none">@lang('messages.nav_dashboard')</a></li>        
            @else
                <li class="list-unstyled"><a href="/login" class="text-dark text-decoration-none">Login</a></li>        
                <li class="list-unstyled"><a href="/signup" class="text-dark text-decoration-none">@lang("messages.nav_get_started")</a></li>        
            @endif
            <li class="list-unstyled"><a href="/contact-us" class="text-dark text-decoration-none">@lang("messages.nav_contact_us")</a></li>
            <div class="dropdown flags_" style="margin-right: 3em">
                <button type="button" class="btn bg__ text-muted dropdown-toggle" data-bs-toggle="dropdown">
                    @if ($lang == "en")
                    <img src="https://upload.wikimedia.org/wikipedia/en/thumb/a/ae/Flag_of_the_United_Kingdom.svg/1280px-Flag_of_the_United_Kingdom.svg.png" alt=""> English                
                    @endif
                    @if ($lang == "fr")
                    <img src="https://m.media-amazon.com/images/I/4109Z2o0HuL._AC_UF894,1000_QL80_.jpg" alt=""> French                
                    @endif
                    @if ($lang == "de")
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcScBXsZhOLWG9aaZzvy5KdAR39CVFsvM2e3DA&s" alt=""> German                
                    @endif
        
                    @if (!$lang)
                    <img src="https://upload.wikimedia.org/wikipedia/en/thumb/a/ae/Flag_of_the_United_Kingdom.svg/1280px-Flag_of_the_United_Kingdom.svg.png" alt=""> English                
                    @endif
                    
                </button>

                <ul class="dropdown-menu">
                    <li><h5 class="dropdown-header">Choose Language</h5></li>
                    <li><hr class="dropdown-divider"></hr></li>
                    <li><a class="text-muted fr mt-3 mb-3 dropdown-item" href="/lang/en"><img src="https://upload.wikimedia.org/wikipedia/en/thumb/a/ae/Flag_of_the_United_Kingdom.svg/1280px-Flag_of_the_United_Kingdom.svg.png" alt=""> English</a></li>
                    <li><a class="text-muted fr mb-3 dropdown-item" href="/lang/de"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcScBXsZhOLWG9aaZzvy5KdAR39CVFsvM2e3DA&s" alt=""> German</a></li>
                    <li><a class="text-muted fr mb-3 dropdown-item" href="/lang/fr"><img src="https://m.media-amazon.com/images/I/4109Z2o0HuL._AC_UF894,1000_QL80_.jpg" alt=""> French</a></li>
                </ul>
            </div>
<br>
        </div>
    </div>

</div>



@endsection

@push('javascript')
@endpush

