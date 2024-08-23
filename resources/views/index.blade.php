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
            <p class="btn ft ftr text-muted mx-3"><i class="fa-regular fa-user"></i></p>
            <p type="button" data-bs-toggle="offcanvas" data-bs-target="#demo" class="btn ft ftr text-muted"><i class="fa-regular fa-menu"></i></p>
        </div>
    </div>

    <div class="section_1 d-flex">
        <div class="text_ mt-5">
            <h1>There Are <span class="text-primary"> 93,178</span> Postings Here For you!</h1>
            <p class="text-muted ft ftr">Find Jobs, Employment & Career Opportunities</p>
            <div class="inputs_">
                <form action="/search-jobs" method="post">
                    @csrf
                    <input name="search" type="text" placeholder="job title, keywords or company name">
                    <input name="location" type="text" placeholder="city, state or country">
                    <button class="btn btn-primary">Find Job</button>
                </form>
            </div>
            <p class="text-muted ft ftr"><strong>Popular Searches</strong> : Designer, Developer, Web, IOS, PHP, Senior, Engineer,</p>
        </div>

        <div class="img_">
            <img class="all_" src="https://superio-appdir.vercel.app/_next/image?url=%2Fimages%2Fresource%2Fbanner-img-1.png&w=1920&q=75" alt="">
        </div>
    </div>

    <div class="section_2">
        <h4 class="text-center mt-5">Popular Job Categories</h4>
        <p class="text-muted text-center ft ftr">2020 jobs live - 293 added today.</p>

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

    <div class="section_3">
        <h4 class="text-center mt-5">Featured Jobs</h4>
        <p class="text-muted text-center ft ftr">Know your worth and find the job that qualify your life</p>
        <div class="d-flex _cont flex-wrap justify-content-evenly">
            
			@foreach ($rand_jobs as $item)
            <a href="/job/title/{{$item->id}}" class="_box d-flex text-decoration-none">
                <div class="icon_ text-center text-primary">
                    <img src="{{$item->avatar}}" alt="">
                </div>
                <div class="mx-3">
                    <h6 class="text-dark text-capitalize">{{$item->title}}</h6>
                    <div class="d-flex mb-2">
                        <p class="mb-0 info_ text-muted fts_"><i class="fa-solid fa-bag-shopping"></i> Segment</p>
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

    {{-- <div class="section_4 mt-4">
       <div class="text-center">
            <h4 class="mt-5">Testimonials From Our Customers</h4>
            <p class="text-muted ft">Testimonials from our client all over the country</p>
        </div>
        <div id="demo" class="carousel slide" data-bs-ride="carousel">

            <!-- Indicators/dots -->
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
              <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
              <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
            </div>
          
            <!-- The slideshow/carousel -->
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="la.jpg" alt="Los Angeles" class="d-block w-100">
              </div>
              <div class="carousel-item">
                <img src="chicago.jpg" alt="Chicago" class="d-block w-100">
              </div>
              <div class="carousel-item">
                <img src="ny.jpg" alt="New York" class="d-block w-100">
              </div>
            </div>
          
            <!-- Left and right controls/icons -->
            <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
              <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
              <span class="carousel-control-next-icon"></span>
            </button>
          </div>
    </div> --}}

    <div class="section_5 d-flex">
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

    <div class="section_6 mb-5 mt-5 d-flex justify-content-evenly">
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

    <div class="section_8">
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

    <div class="section_7 mt-5 mb-5 pt-5 d-flex justify-content-between">
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



{{-- <div class="landing">
	<x-main-nav :ishome="$ishome"></x-main-nav>

	<div class="section1 mb-4">
		<div class="cont">
			<p class="fw-bold text-primary">@lang('messages.best_jobs_place')</p>
			<h1 class="fw-bold mb-3">@lang("messages.easiest_way")</h1>
			<p class="ft mb-5" style="color: rgb(67, 67, 67)">@lang("messages.monthly_visitors")</p>
			<div class="input_container">
				<form action="/search-jobs" method="post">
					@csrf
					<input name="search" type="text" placeholder='{{ __('messages.search_placeholder')}}'>
					<select name="location" id="">
						<option value="">@lang("messages.select_location")</option>
						@foreach ($_countries as $item)
							<option value="{{$item}}">{{$item}}</option>
						@endforeach
					</select>
					<button class="btn mt-3">@lang("messages.find_now")</button>
				</form>
			</div>
		</div>

		<div class="posit_ mt-3">
			<img src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/banner/congratulation.svg" alt="" class="sec">
			<img src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/banner/web-dev.svg" alt="" class="third">
			<img class="larg" src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/banner/banner.png" alt="">
		</div>
		<div class="posit_">
			<img src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/banner/docs.svg" alt="" class="fourth">
		</div>
		<div class="posit_ mt-5 pt-5">
			<img src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/banner/tick.svg" alt="" class="fif">
		</div>
	</div>

	
	<div class="section3 mt-5">
		<h1 class="fw-bold">@lang("messages.recent_jobs")</h1>
		<div class="d-flex mt-3 justify-content-between">
			<p class="text-muted ft" style="width:50%">@lang("messages.new_opportunities")</p>
		</div>

		<div class="d-flex mt-3" style="overflow: scroll">
			@foreach ($jobs as $item)
			<a href="/job/title/{{$item->id}}" class="text-decoration-none text-dark">
				<div class="col-sm-4 cont_">
					<div class="img">
						<img src="{{$item->avatar}}" alt="">
					</div>
					<div class="p-3">
						<div class="d-flex mt-2 mb-4 justify-content-between">
							<h6 class="mb-0 text-muted mt-1 ">
								<img class="mx-2" width="20" height="20" style="border-radius: 50%" src="{{$item->avatar}}" alt="">{{$item->employment_type}}</h6>
							<button style="background-color: rgba(45, 249, 45, 0.088)" class="btn text-capitalize text-success ft px-4 py-1">{{$item->level}}</button>
						</div>
						<h4 class="mt-3 mb-3 text-capitalize">{{$item->title}}</h4>
						<div class="d-flex">
							<p class="ft text-muted"><i class="fa-regular fa-clock"></i> {{Carbon::create($item->created_at)->format('l F j, Y')}}</p>
							<p class="ft text-muted mx-3 text-capitalize"><i class="fa-solid fa-location-dot"></i> {{$item->country}}</p>
						</div>
						<div class="d-flex mt-2 mb-3 justify-content-between">
							<p class="fs-5 text-muted"><span class="cl fw-bold">${{number_format($item->salary)}}</span>/Month</p>
							<div class="d-flex mt-1">
								<i class="fa-regular btn text-primary fa-thumbs-up"></i>
								<i class="fa-regular btn text-danger fa-thumbs-down"></i>
							</div>
						</div>
					</div>
				</div>		
			</a>	
			@endforeach
		</div>
	</div>

	<div class="section5 row mt-5">
		<div class="col-sm-6 _cbg">			
			<h1 style="font-size: 4em" class="fw-bold mb-5 -1">@lang("messages.graphic_design_board")</h1>
			<p class="text-muted mb-5" style="width: 80%">@lang("messages.talent_search")</p>
			<div class="d-flex">
				<button class="btn px-4 py-2 text-white bg_">@lang("messages.post_a_job")</button>
				<button class="btn mx-3" >@lang("messages.learn_more")</button>
			</div>
		</div>
		<div class="col-sm-6 img_">
			<img src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/blog/img-job.png" alt="">
		</div>
	</div>

	<div class="section2 mt-5 mb-4">
		<h1 class="fw-bold">@lang("messages.browse_by_category")</h1>
		<div class="d-flex mt-3 justify-content-between">
			<p class="text-muted ft" style="width:50%">@lang("messages.find_type_of_work")</p>
			<a href="/browse-jobs?category=all" class="btn btn-outline-dark px-4 py-2" style="height: fit-content">@lang("messages.browse_all")</a>
		</div>

		<div class="row mt-3">
			@for ($i = 0; $i < count($category); $i++)
			<a href="/browse-jobs?category={{$category[$i]['name']}}" class="col-sm-3 cont text-center text-decoration-none">
				<img src="{{$category[$i]["image"]}}" alt="">
				<h4 class="mt-3 mb-3 text-dark">{{$category[$i]["name"]}}</h4>
				<p class="text-muted ft">Available Vacancy</p>
			</a>				
			@endfor
		</div>
	</div>

	<div class="section3 section4 mt-5">
		<h1 class="fw-bold">@lang("messages.recommended_jobs")</h1>
		<div class="d-flex mt-3 justify-content-between">
			<p class="text-muted ft" style="width:50%">@lang("messages.recommended_opportunities")</p>
		</div>

		<div class="d-flex justify-content-evenly mt-3 flex-wrap">
			@foreach ($rand_jobs as $item)
			<a href="/job/title/{{$item->id}}" class="text-decoration-none text-dark">
				<div class="col-sm-4 cont_">
					<div class="img">
						<img src="{{$item->avatar}}" alt="">
					</div>
					<div class="p-3">
						<div class="d-flex mt-2 mb-4 justify-content-between">
							<h6 class="mb-0 text-muted mt-1 ">
								<img class="mx-2" width="20" height="20" style="border-radius: 50%" src="{{$item->avatar}}" alt="">{{$item->employment_type}}</h6>
							<button style="background-color: rgba(45, 249, 45, 0.088)" class="btn text-capitalize text-success ft px-4 py-1">{{$item->level}}</button>
						</div>
						<h4 class="mt-3 mb-3 text-capitalize">{{$item->title}}</h4>
						<div class="d-flex">
							<p class="ft text-muted"><i class="fa-regular fa-clock"></i> {{Carbon::create($item->created_at)->format('l F j, Y')}}</p>
							<p class="ft text-muted mx-3 text-capitalize"><i class="fa-solid fa-location-dot"></i> {{$item->country}}</p>
						</div>
						<div class="d-flex mt-2 mb-3 justify-content-between">
							<p class="fs-5 text-muted"><span class="cl fw-bold">${{number_format($item->salary)}}</span>/Month</p>
							<div class="d-flex mt-1">
								<i class="fa-regular btn text-primary fa-thumbs-up"></i>
								<i class="fa-regular btn text-danger fa-thumbs-down"></i>
							</div>
						</div>
					</div>
				</div>		
			</a>	
			@endforeach
		</div>
	</div>

	<hr style="color: rgb(183, 183, 183)">

	<x-footer></x-footer>
</div> --}}

@endsection

@push('javascript')
@endpush

