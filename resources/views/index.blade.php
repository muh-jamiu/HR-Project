@extends("layouts.app")

@section('title')
HR | Job Board
@endsection

@section("content")
<div class="landing">
	<div class="navbar d-flex flex-start">
		<h3 class="fw-bold"><a href="/" class="text-dark text-decoration-none"><img src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/favicon.svg" alt=""> Logo</a></h3>
		<li class="list-unstyled"><a href="/" class="text-dark text-decoration-none">Home</a></li>
		<li class="list-unstyled"><a href="" class="text-dark text-decoration-none">Browse Jobs</a></li>
		<li class="list-unstyled"><a href="" class="text-dark text-decoration-none">Employers</a></li>
		<li class="list-unstyled"><a href="" class="text-dark text-decoration-none">Candidates</a></li>
		<li class="list-unstyled"><a href="" class="text-dark text-decoration-none">Contact Us</a></li>
		<li class="list-unstyled"><a href="" class="text-dark text-decoration-none">About Us</a></li>
	</div>

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
	</div>

	<div class="section2 mt-5 mb-4">
		<h1 class="fw-bold">Browse by category</h1>
		<div class="d-flex mt-3 justify-content-between">
			<p class="text-muted ft" style="width:50%">Find the type of work you need, clearly defined and ready to start. Work begins as soon as you purchase and provide requirements.</p>
			<a href="" class="btn btn-outline-dark px-4 py-2" style="height: fit-content">Browse All</a>
		</div>

		<div class="row mt-3">
			@for ($i = 0; $i < 10; $i++)
			<div class="col-sm-3 cont text-center">
				<img src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/icons/marketing.svg" alt="">
				<h4 class="mt-3 mb-3">Marketing & Communication</h4>
				<p class="text-muted ft">156 Available Vacancy</p>
			</div>				
			@endfor
		</div>
	</div>

	
	<div class="section2 section3 mt-5">
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

		<div class="row mt-3">
			@for ($i = 0; $i < 8; $i++)
			<div class="col-sm-3 cont text-center">
				<img src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/icons/marketing.svg" alt="">
				<h4 class="mt-3 mb-3">Marketing & Communication</h4>
				<p class="text-muted ft">156 Available Vacancy</p>
			</div>				
			@endfor
		</div>
	</div>

</div>

    
@endsection

