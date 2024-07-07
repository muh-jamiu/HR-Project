@extends("layouts.app")

@php
$is_jobs = true;
$job = $data["job"] ?? []; 
$company = $data["company"] ?? []; 
$questions = $data["questions"] ?? []; 
use Carbon\Carbon;
@endphp

@section('title')
Technical Questions | HR
@endsection

@section("content")
<div class="jobs job_single">
	<x-main-nav></x-main-nav>

    <div class="q_timer_ d-none">
        <p class="mb-0">Time remaining <span id="_timer">10:00</span></p>
    </div>

    <div class="section1">
        <h1 class="fw-bold mt-4 text-capitalize">{{$job->title}}</h1>
        <p class="fs-5 text-muted mt-3 mb-5">Discover your next career move, freelance gig, or internship</p>
    </div>
    
    <div class="section2 mb-5 d-flex flex-wrap">
        <div class="j_first">
           <div class="will_hid">
                <h4 class="fw-bold">Technical Questions</h4>
                <p class="text-muted t">You will go through an automated question-and-answer session, where questions are generated by AI based on the job description. This process helps ensure that the questions are relevant and tailored to assess your fit for the specific role. Please answer the questions to the best of your ability, as your responses will be used to evaluate your qualifications for the position.</p>
                <p class="text-muted fw-semibold mt-4 mb-2 ft">Please Note:</p>
                <ul class="text-danger">
                    <li class="text-danger mb-2 ft">Leaving this page will forfeit your scores, leading to 0 score.</li>
                    <li class="text-danger mb-2 ft">You have 15 minutes to complete all the answers.</li>
                    <li class="text-danger mb-2 ft">You will be redirected to the next page if your time runs out.</li>
                    <li class="text-danger mb-2 ft">Reloading the page will restart the timer and also generate new questions for you.</li>
                    <li class="text-danger mb-2 ft">Be sure of your answers.</li>
                </ul>
                <button class="btn-primary start_q mt-2 btn px-4">Start</button>
                <p class="text-muted mt-2 mb-2 ft">Overall questions to be answer is 20.</p>
           </div>

           <form id="_form" action="/automated-questions?type=technical" method="post" class="d-none q_form">
                @csrf
                <div class="qst_ pt-4">
                    @foreach ($questions as $key => $item)
                        <div class="mb-3">
                            <label class="text-muted fw-semibold ft" for="">{{$item}}</label>
                            <textarea name="{{$item}}" id="" cols="3" rows="3"></textarea>
                        </div>                        
                    @endforeach
                </div>
                <button class="btn btn-primary px-4 mt-5">Save and Submit</button>                
            </form>
        </div>

        <div class="j_sec">
            <div class="__job__ mb-3">
                <h5 class="fw-bold mb-3">Recruiting?</h5>
                <p class="ft">Advertise your jobs to millions of monthly users and search 16.8 million CVs in our database.</p>
                <button class="btn btn-light mt-4">Post A Job</button>
            </div>
            <hr style="color: rgb(172, 172, 172)">

            <div class="d-flex pt-2" style="border-bottom: 1px solid rgb(235, 235, 235)">
                <img style="border-radius: 50%; object-fit:cover" width="30" height="30" src="{{$company->avatar}}" alt="">
                <p class="mb-3 mx-2 fw-bold text-capitalize"> <a class="text-decoration-none text-muted" href="/employer/{{$company->unique_id}}/{{str_replace(" ", "_", $company->company_name)}}">{{$company->company_name}}</a></p>
            </div>
            <p class="text-muted mt-3">We're looking to add more candidate to our growing teams.</p>
 
            <hr style="color: rgb(172, 172, 172)">
            <p class="fw-bold text-muted mb-1"><i class="fa-solid fa-bag-shopping"></i> Employment Type</p>
            <p class="mb-4 text-muted text-capitalize">{{$job->employment_type}}</p>

            <p class="fw-bold text-muted mb-1"><i class="fa-solid fa-location-dot"></i> Location</p>
            <p class="mb-4 text-muted text-capitalize">{{$job->state}}, {{$job->country}}</p>

            
            <p class="fw-bold text-muted mb-1">Level</p>
            <p class="mb-4 text-muted text-capitalize">{{$job->level}}</p>

            <p class="fw-bold text-muted mb-1"><i class="fa-solid fa-sack-dollar"></i> Salary</p>
            <p class="mb-4 text-muted">${{number_format($job->salary)}}</p>

            <p class="fw-bold text-muted mb-1"><i class="fa-regular fa-clock"></i> Date posted</p>
            <p class="mb-4 text-muted"> {{Carbon::create($job->created_at)->format('l F j, Y')}}</p>
            <hr style="color: rgb(172, 172, 172)">

            <p class="fw-bold text-muted mb-2">Contact Info</p>
            <p class="text-muted ft"><i class="fa-solid fa-phone"></i> {{$job->phone}}</p>
            <p class="text-muted ft"><i class="fa-regular fa-envelope"></i> {{$job->email}}</p>
            <p class="text-muted ft text-capitalize"><i class="fa-solid fa-location-dot"></i> {{$job->address}}</p>

        </div>
    </div>

	<hr style="color: rgb(183, 183, 183)">

	<x-footer></x-footer>
</div>
@endsection

@push('javascript')
    <script>
        var start_q = document.querySelector(".start_q")
        var will_hid = document.querySelector(".will_hid")
        var q_timer_ = document.querySelector(".q_timer_")
        var q_form = document.querySelector(".q_form")

        function showThem (){
            q_form.classList.remove("d-none")
            q_timer_.classList.remove("d-none")
            will_hid.classList.add("d-none")
            setTimeout(() => {
                var tenMinutes = 60 * 10,
                display = document.getElementById('_timer');
                startCountdown(tenMinutes, display);
            }, 1000);
        }

        start_q.addEventListener("click", () => {
            Swal.fire({
            title: "Are you sure?",
            text: "Your time will start right away!",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Start"
            }).then((result) => {
            if (result.isConfirmed) {
                window.scrollTo({
                top: 0,
                behavior: 'smooth'
                });
                showThem()
            }
            });
        })

        function startCountdown(duration, display) {
            var timer = duration, minutes, seconds;
            var countdownInterval = setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    clearInterval(countdownInterval);
                    document.getElementById('_form').submit();
                }
            }, 1000);
        }


    </script>
@endpush