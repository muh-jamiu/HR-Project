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
	["name" => "Content Writer", "image" => "https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/icons/content-writer.svg"],
	["name" => "Marketing Director", "image" => "https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/icons/marketing-director.svg"],
	["name" => "System Analyst", "image" => "https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/icons/system-analyst.svg"],
	["name" => "Marketing & Communication", "image" => "https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/icons/marketing.svg"],
	["name" => "Digital Designer", "image" => "https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/icons/business-development.svg"],
	["name" => "Market Research", "image" => "https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/icons/proof-reading.svg"],
	["name" => "Human Resource", "image" => "https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/icons/marketing-director.svg"],
	["name" => "Customer Service", "image" => "https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/icons/proof-reading.svg"],
	["name" => "Automative Jobs", "image" => "https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/icons/content-writer.svg"],
];

$images_ = [
    "https://superio-appdir.vercel.app/_next/image?url=%2Fimages%2Fresource%2Fblog%2F2.jpg&w=1920&q=75",
    "https://superio-appdir.vercel.app/_next/image?url=%2Fimages%2Fresource%2Fblog%2F1.jpg&w=1920&q=75",
    "https://superio-appdir.vercel.app/_next/image?url=%2Fimages%2Fresource%2Fblog%2F3.jpg&w=1920&q=75"
];
@endphp

@section('title')
HR | Job Board
@endsection

@section("content")

<div class="_land_">
    <div class="top d-flex justify-content-between">
        <h3 class="fw-bold"><a href="/" class="text-dark text-decoration-none"><img src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/favicon.svg" alt=""> Logo</a></h3>
        <div class="d-flex">
            <p class="btn um_ ft ftr text-muted mx-3"><i class="fa-regular fa-user"></i></p>
            <p type="button" data-bs-toggle="offcanvas" data-bs-target="#demo" class="btn ft ftr text-muted"><i class="fa-solid fa-bars"></i></p>
        </div>
    </div>

    <div class="section_1 sections_all d-flex">
        <div class="text_ mt-5">
            <h1>There Are <span class="text-primary"> {{number_format(count($rand_jobs))}}</span> Postings Here For you!</h1>
            <p class="text-muted ft ftr">Find Jobs, Employment & Career Opportunities</p>
            <div class="inputs_">
                <form action="/search-jobs" method="post">
                    @csrf
                    <input name="search" required class="mb-3" type="text" placeholder="job title, keywords or company name">
                    <input name="location" required class="mb-3" type="text" placeholder="city, state or country">
                    <button class="btn btn-primary">Find Job</button>
                </form>
            </div>
            <p class="text-muted ft ftr"><strong>Popular Searches</strong> : Designer, Developer, Web, IOS, PHP, Senior, Engineer,</p>
        </div>

        <div class="img_">
            <div class="posit__ mt-3">
                <img src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/banner/congratulation.svg" alt="" class="sec">
                <img src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/banner/web-dev.svg" alt="" class="third">
            </div>
            <img class="all_" src="https://superio-appdir.vercel.app/_next/image?url=%2Fimages%2Fresource%2Fbanner-img-1.png&w=1920&q=75" alt="">
        </div>
    </div>

    <div class="section_2 sections_all">
        <h4 class="text-center mt-5">Popular Job Categories</h4>
        <p class="text-muted text-center ft ftr">{{number_format(count($rand_jobs))}} jobs live - {{number_format(count($rand_jobs))}} added today.</p>

        <div class="d-flex _cont flex-wrap justify-content-evenly">
            @foreach ($category as $item)
            <a href="/browse-jobs?category={{$item["name"]}}" class="_box text-decoration-none d-flex">
                <div class="icon_ text-center text-primary">
                    <img src="{{$item["image"]}}" alt="">
                </div>
                <div class="mx-3">
                    <h6 class="text-dark">{{$item["name"]}}</h6>
                    <p class="text-muted ft">(2 open positions)</p>
                </div>
            </a>                
            @endforeach
        </div>

    </div>

    <hr style="color: rgb(197, 197, 197)">

    <div class="section_3 sections_all">
        <h4 class="text-center mt-5">Featured Jobs</h4>
        <p class="text-muted text-center ft ftr">Know your worth and find the job that qualify your life</p>
        <div class="d-flex _cont flex-wrap justify-content-evenly">
            
			@foreach ($rand_jobs as $item)
            <a href="/job/{{str_replace(" ", "-", $item->title)}}/{{$item->id}}" class="_box d-flex text-decoration-none">
                <div class="icon_ text-center text-primary">
                    <img src="{{$item->avatar ?? 'https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/icons/marketing-director.svg'}}" alt="">
                </div>
                <div class="mx-3">
                    <h6 class="text-dark text-capitalize">{{$item->title}}</h6>
                    <div class="d-flex mb-2">
                        <p class="mb-0 info_ text-muted fts_"><i class="fa-solid fa-bag-shopping"></i> {{str_replace("-", " ", $item->employment_type)}}</p>
                        <p class="mb-0 info_ text-muted text-capitalize fts_"><i class="fa-solid fa-location-dot"></i> {{$item->state}}, {{$item->country}}</p>
                        <p class="mb-0 info_ text-muted text-capitalize fts_"><i class="fa-regular fa-clock"></i> {{Carbon::create($item->created_at)->format('l F j, Y')}}</p>
                        <p class="mb-0 info_ text-muted text-capitalize fts_"><i class="fa-solid fa-sack-dollar"></i> ${{number_format($item->salary)}}</p>
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
        <div class="text_ mx-4">
            <h1 class="fw-bold">Millions of Jobs. Find the one that suits you.</h1>
            <p class="text-muted mt-2 mb-4 ft">Search all the open positions on the web. Get your own personalized salary estimate. Read reviews on over 600,000 companies worldwide.</p>
            <p><i class="fa-solid fa-check text-success mx-2"></i> Bring to the table win-win survival</p>
            <p><i class="fa-solid fa-check text-success mx-2"></i> Capitalize on low hanging fruit to identify</p>
            <p><i class="fa-solid fa-check text-success mx-2"></i> But I must explain to you how all this</p>
            <a href="/browse-jobs" class="btn mt-3 btn-primary">Get Started</a>
        </div>
    </div>

    <div class="section_6 sections_all mb-5 mt-5 d-flex justify-content-evenly">
        <div>            
            <h1 class="fw-bold text-center">4M</h1>
            <p class="text-muted text-center ft">4 million daily active users</p>
        </div>
        <div>            
            <h1 class="fw-bold text-center">12K</h1>
            <p class="text-muted text-center ft">Over 12k open job positions</p>
        </div>
        <div>            
            <h1 class="fw-bold text-center">20M</h1>
            <p class="text-muted text-center ft">Over 20 million stories shared</p>
        </div>
    </div>

    <div class="section_8 sections_all">
        <div class="text-center mb-5">
            <h4 class="">Recent News Articles</h4>
            <p class="text-muted ft">Fresh job related news content posted each day.</p>
        </div>

        <div style="overflow: scroll" class="d-flex justify-content-start flex-nowrap">
            @for ($i = 0; $i < 3; $i++)
                <div class="_box mx-2">
                    <div class="img">
                        <img src="{{$images_[$i]}}" alt="">
                    </div>
                    <p class="text-muted mt-2 ft">August 31, 2021</p>
                    <p class="fw-bold mb-1">Attract Sales And Profits</p>
                    <p class="text-muted ft">A job ravenously while Far much that one rank beheld after outside....</p>
                    
                    <a href="#" class="btn text-primary">Read More</a>
                </div>       
            @endfor
        </div>     
    </div>

    <div class="section_7 sections_all mt-5 mb-5 pt-5 d-flex justify-content-between">
        <div class="">
            <h2>Recruiting?</h2>
            <p class="text-muted mb-5 mt-3 ft">Advertise your jobs to millions of monthly users and search 15.8 million CVs in our database.</p>
            <a href="/candidates" class="btn px-4 py-3 btn-primary">Start Recruiting Now</a>
        </div>
        <img src="https://superio-appdir.vercel.app/images/resource/image-1.png" alt="">
    </div>
    <br>

    <hr style="color: rgb(197, 197, 197)">

    <footer class="d-flex mt-5 pb-5 justify-content-evenly">
        <div class="logo_" style="width: 40%">
            <h3 class="fw-bold mb-3"><a href="/" class="text-dark text-decoration-none"><img src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/favicon.svg" alt=""> Logo</a></h3>
            <p class="ft text-muted">Call us <strong class="text-primary">123 456 7890</strong></p>		
            <p class="text-muted ft">329 Queensberry Street, North Melbourne VIC 3051, Australia.</p>
            <p class="text-muted ft">support@superio.com</p>
        </div>
        <div class="" style="width: 15%">
            <li class="list-unstyled fw-bold mb-3">@lang("messages.footer_company")</li>
            <li class="list-unstyled mb-3 text-muted ft"><a class="text-decoration-none  text-muted ft" href="/">@lang("messages.footer_about_us")</a></li>
            <li class="list-unstyled mb-3 text-muted ft"><a class="text-decoration-none  text-muted ft" href="/">@lang("messages.footer_our_team")</a></li>
            <li class="list-unstyled mb-3 text-muted ft"><a class="text-decoration-none  text-muted ft" href="/">@lang("messages.footer_contact_us")</a></li>
            <li class="list-unstyled mb-3 text-muted ft"><a class="text-decoration-none  text-muted ft" href="/">@lang("messages.footer_products")</a></li>
        </div>
        <div class="" style="width: 15%">
            <li class="list-unstyled fw-bold mb-3">@lang("messages.footer_product")</li>
            <li class="list-unstyled mb-3 text-muted ft"><a class="text-decoration-none  text-muted ft" href="/">@lang('messages.footer_product')</a></li>
            <li class="list-unstyled mb-3 text-muted ft"><a class="text-decoration-none  text-muted ft" href="/">@lang("messages.footer_feature")</a></li>
        </div>
        <div class="" style="width: 15%">
            <li class="list-unstyled fw-bold mb-3">@lang("messages.footer_support")</li>
            <li class="list-unstyled mb-3 text-muted ft"><a class="text-decoration-none  text-muted ft" href="/">@lang("messages.footer_help")</a></li>
            <li class="list-unstyled mb-3 text-muted ft"><a class="text-decoration-none  text-muted ft" href="/">@lang("messages.footer_privacy")</a></li>
            <li class="list-unstyled mb-3 text-muted ft"><a class="text-decoration-none  text-muted ft" href="/">@lang("messages.footer_terms")</a></li>
            <li class="list-unstyled mb-3 text-muted ft"><a class="text-decoration-none  text-muted ft" href="/">@lang("messages.footer_faq")</a></li>
        </div>
    </footer>
    <hr style="color: rgb(197, 197, 197)">

    <p class="text-muted ft mt-3" style="padding: 2em">© 2023 Superio by ib-themes. All Right Reserved.</p>

    
    <div class="offcanvas offcanvas-start" id="demo">
        <div class="offcanvas-header">
            <h3 class="fw-bold"><a href="/" class="text-dark text-decoration-none"><img src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/favicon.svg" alt=""> Logo</a></h3>
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
            <a style="width: 100%" href="/login" class="btn p-3 mb-1 btn-primary">Job Post</a>

            <hr style="color: rgb(197, 197, 197)">

            <p class="text-muted ft">Call Us <strong class="fw-bold mb-3 text-primary">0123456789</strong></p>            
            <p class="text-muted ft">329 Queensberry Street, North Melbourne VIC 3051, Australia.</p>
            <p class="text-muted ft">support@superio.com</p>
        </div>
    </div>

</div>



@endsection

@push('javascript')
@endpush

