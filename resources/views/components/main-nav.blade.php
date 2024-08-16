@php
    $isjobs = $isjobs ?? false;
    $ishome = $ishome ?? false;
    $isemploy = $isemploy ?? false;
    $iscand = $iscand ?? false;
    $iscontact = $iscontact ?? false;
    $isabout = $isabout ?? false;
    $islogin = session("hr_id");
    $lang = session("locale");
@endphp

<div class="navbar d-flex flex-start">
    <h3 class="fw-bold"><a href="/" class="text-dark text-decoration-none"><img src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/theme/favicon.svg" alt=""> Logo</a></h3>
    <div class="dropdown flags_">
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
    <li class="list-unstyled {{$ishome ? "active" : ""}}"><a href="/" class="text-dark text-decoration-none">@lang("messages.nav_home")</a></li>
    <li class="list-unstyled {{$isjobs ? "active" : ""}}"><a href="/browse-jobs" class="text-dark text-decoration-none">@lang("messages.nav_browse_jobs")</a></li>
    <li class="list-unstyled {{$isemploy ? "active" : ""}}" ><a href="/employers" class="text-dark text-decoration-none">@lang("messages.nav_employers")</a></li>
    <li class="list-unstyled {{$iscand ? "active" : ""}}"><a href="/candidates" class="text-dark text-decoration-none">@lang("messages.nav_candidates")</a></li>
    @if ($islogin)
        <li class="list-unstyled"><a href="/account-check" class="text-dark text-decoration-none">@lang('messages.nav_dashboard')</a></li>        
    @else
        <li class="list-unstyled"><a href="/signup" class="btn btn-danger text-decoration-none">@lang("messages.nav_get_started")</a></li>        
    @endif
    <li class="list-unstyled {{$iscontact ? "active" : ""}}"><a href="/contact-us" class="text-dark text-decoration-none">@lang("messages.nav_contact_us")</a></li>
    {{-- <li class="list-unstyled {{$isabout ? "active" : ""}} "><a href="/about-us" class="text-dark text-decoration-none">About Us</a></li> --}}
</div>