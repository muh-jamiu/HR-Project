@php
    $isjobs = $isjobs ?? false;
    $ishome = $ishome ?? false;
    $isemploy = $isemploy ?? false;
    $iscand = $iscand ?? false;
    $iscontact = $iscontact ?? false;
    $isabout = $isabout ?? false;
    $islogin = session("hr_id");
@endphp

<div class="navbar d-flex flex-start">
    <h3 class="fw-bold"><a href="/" class="text-dark text-decoration-none"><img src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/favicon.svg" alt=""> Logo</a></h3>
    <li class="list-unstyled {{$ishome ? "active" : ""}}"><a href="/" class="text-dark text-decoration-none">Home</a></li>
    <li class="list-unstyled {{$isjobs ? "active" : ""}}"><a href="/browse-jobs" class="text-dark text-decoration-none">Browse Jobs</a></li>
    <li class="list-unstyled {{$isemploy ? "active" : ""}}" ><a href="/employers" class="text-dark text-decoration-none">Employers</a></li>
    <li class="list-unstyled {{$iscand ? "active" : ""}}"><a href="/candidates" class="text-dark text-decoration-none">Candidates</a></li>
    @if ($islogin)
        <li class="list-unstyled"><a href="/account-check" class="text-dark text-decoration-none">Dashboard</a></li>        
    @else
        <li class="list-unstyled"><a href="/get-started" class="text-dark text-decoration-none">Get Started</a></li>        
    @endif
    <li class="list-unstyled {{$iscontact ? "active" : ""}}"><a href="/contact-us" class="text-dark text-decoration-none">Contact Us</a></li>
    <li class="list-unstyled {{$isabout ? "active" : ""}} "><a href="/about-us" class="text-dark text-decoration-none">About Us</a></li>
</div>