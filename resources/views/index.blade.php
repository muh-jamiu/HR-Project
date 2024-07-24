@extends("layouts.app")
@php
$ishome = true;
$jobs = $data["jobs"] ?? [];
$rand_jobs = $data["rand_jobs"] ?? [];
use Carbon\Carbon;
$category = [
	["name" => "Content Writer", "image" => "https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/icons/content-writer.svg"],
	["name" => "Marketing Director", "image" => "https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/icons/marketing-director.svg"],
	["name" => "System Analyst", "image" => "https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/icons/system-analyst.svg"],
	["name" => "Marketing & Communication", "image" => "https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/icons/marketing.svg"],
	["name" => "Digital Designer", "image" => "https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/icons/business-development.svg"],
	["name" => "Market Research", "image" => "https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/icons/proof-reading.svg"],
	["name" => "Human Resource", "image" => "https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/icons/proof-reading.svg"],
]
@endphp

@section('title')
HR | Job Board
@endsection

@section("content")
<div class="landing">
	<x-main-nav :ishome="$ishome"></x-main-nav>

	<div class="section1 mb-4">
		<div class="cont">
			<p class="fw-bold text-primary">BEST JOBS PLACE</p>
			<h1 class="fw-bold mb-3">The Easiest Way to Get Your New Job</h1>
			<p class="ft mb-5" style="color: rgb(67, 67, 67)">Each month, more than 3 million job seekers turn to website in their search for work, making over 140,000 applications every single day</p>
			<div class="input_container">
				<input type="text" placeholder="Search job description, title etc">
				<select name="" id="">
					<option value="">Select Location</option>
				</select>
				<button class="btn mt-3">Find Now</button>
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
		<h1 class="fw-bold">Recent Jobs</h1>
		<div class="d-flex mt-3 justify-content-between">
			<p class="text-muted ft" style="width:50%">8 new opportunities posted today!</p>
			<div class="d-flex">
				<p class="mx-3 tg active">Software</p>
				<p class="mx-3 tg">Design</p>
				<p class="mx-3 tg">Marketing</p>
				<p class="mx-3 tg">Service</p>
				<p class="mx-3 tg">Writing</p>
				<p class="mx-3 tg">Health Care</p>
			</div>
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
			<h1 style="font-size: 4em" class="fw-bold mb-5 -1">The #1 Job Board for Graphic Design Jobs</h1>
			<p class="text-muted mb-5" style="width: 80%">Search and connect with the right candidates faster. This talent seach gives you the opportunity to find candidates who may be a perfect fit for your role</p>
			<div class="d-flex">
				<button class="btn px-4 py-2 text-white bg_">Post A Job</button>
				<button class="btn mx-3" >Learn More</button>
			</div>
		</div>
		<div class="col-sm-6 img_">
			<img src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/blog/img-job.png" alt="">
		</div>
	</div>

	<div class="section2 mt-5 mb-4">
		<h1 class="fw-bold">Browse by category</h1>
		<div class="d-flex mt-3 justify-content-between">
			<p class="text-muted ft" style="width:50%">Find the type of work you need, clearly defined and ready to start. Work begins as soon as you purchase and provide requirements.</p>
			<a href="/browse-jobs?category=all" class="btn btn-outline-dark px-4 py-2" style="height: fit-content">Browse All</a>
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
		<h1 class="fw-bold">Recommended Jobs</h1>
		<div class="d-flex mt-3 justify-content-between">
			<p class="text-muted ft" style="width:50%">Recommended job opportunities posted today!</p>
			{{-- <div class="d-flex">
				<p class="mx-3 tg active">Software</p>
				<p class="mx-3 tg">Design</p>
				<p class="mx-3 tg">Marketing</p>
				<p class="mx-3 tg">Service</p>
				<p class="mx-3 tg">Writing</p>
				<p class="mx-3 tg">Health Care</p>
			</div> --}}
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
			{{-- @for ($i = 0; $i < 6; $i++)
			<a href="/job/title/{{$i}}" class="text-decoration-none text-dark">
				<div class="col-sm-4 cont_">
					<div class="img">
						<img src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/jobs/job-1.png" alt="">
					</div>
					<div class="p-3">
						<div class="d-flex mt-2 mb-4 justify-content-between">
							<h6 class="mb-0 text-muted mt-1 ">
								<img class="mx-2" width="20" height="20" style="border-radius: 50%" src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/jobs/job-1.png" alt="">Company Name</h6>
							<button style="background-color: rgba(45, 249, 45, 0.088)" class="btn text-success ft px-4 py-1">Fulltime</button>
						</div>
						<h4 class="mt-3 mb-3">Senior Full Stack Engineer, Creator Success Full Time</h4>
						<div class="d-flex">
							<p class="ft text-muted"><i class="fa-regular fa-clock"></i> 3 mins ago</p>
							<p class="ft text-muted mx-3"><i class="fa-solid fa-location-dot"></i> Chicago</p>
						</div>
						<div class="d-flex mt-2 mb-3 justify-content-between">
							<p class="fs-5 text-muted"><span class="cl fw-bold">$3200</span>/Month</p>
							<div class="d-flex mt-1">
								<i class="fa-regular btn text-primary fa-thumbs-up"></i>
								<i class="fa-regular btn text-danger fa-thumbs-down"></i>
							</div>
						</div>
					</div>
				</div>		
			</a>		
			@endfor --}}
		</div>
	</div>

	<hr style="color: rgb(183, 183, 183)">

	<x-footer></x-footer>
</div>

    
@endsection

