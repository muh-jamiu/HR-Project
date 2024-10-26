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

<div class="_land_">
    <div style="background: transparent !important" class="top mb-2 web_nav d-flex justify-content-between">
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
           
            <li class="list-unstyled"><a href="/" class="text-decoration-none">Home</a></li>
            <li class="list-unstyled"><a href="/browse-jobs" class="text-decoration-none {{$isjobs ? "active" : ""}}">Find Jobs</a></li>
            <li class="list-unstyled"><a href="/employers" class="text-decoration-none {{$isemploy ? "active" : ""}}">Employers</a></li>
            <li class="list-unstyled"><a href="/candidates" class="text-decoration-none {{$iscand ? "active" : ""}}">Candidates</a></li>
            <li class="list-unstyled"><a href="/contact-us" class="text-decoration-none {{$iscontact ? "active" : ""}}">Contact Us</a></li>
            @if ($islogin)                
                <a href="/account-check" class="btn _btnl">Dashboard</a>
            @else
                <a href="/login" class="btn _btnl">Login / Register</a>
                <a href="/login" class="btn btn-primary">Post Job</a>                
            @endif
        </div>
    </div>

    <div style="background: transparent !important" class="top mobile_nav d-flex justify-content-between d-none">
        <h3 class="fw-bold"><a style="height: fit-content" href="/" class="text-dark text-decoration-none"><img style="width: 70px" src="/img/logo_.png" alt=""></a></h3>
        <div data-bs-toggle="offcanvas" data-bs-target="#demo" style="position:absolute; right:0; font-size:1.5em" class="mx-3 mt-2"><i class="fa-solid fa-bars"></i></div>
    </div>


    <div class="offcanvas offcanvas-start" id="demo">
        <div class="offcanvas-header">
            <h3 class="fw-bold"><a href="/" class="text-dark text-decoration-none"><img style="width: 70px" src="/img/logo_.png" alt=""></a></h3>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
        </div>

        <hr style="color: rgb(197, 197, 197)">

        <div class="offcanvas-body">
            <li class="list-unstyled"><a href="/" class="text-dark text-decoration-none">@lang("messages.nav_home")</a></li>
            <li class="list-unstyled"><a href="/browse-jobs" class="text-dark text-decoration-none {{$isjobs ? "active" : ""}}">@lang("messages.nav_browse_jobs")</a></li>
            <li class="list-unstyled" ><a href="/employers" class="text-dark text-decoration-none {{$isemploy ? "active" : ""}}">@lang("messages.nav_employers")</a></li>
            <li class="list-unstyled"><a href="/candidates" class="text-dark text-decoration-none {{$iscand ? "active" : ""}}">@lang("messages.nav_candidates")</a></li>
            @if ($islogin)
                <li class="list-unstyled"><a href="/account-check" class="text-dark text-decoration-none">@lang('messages.nav_dashboard')</a></li>        
            @else
                <li class="list-unstyled"><a href="/login" class="text-dark text-decoration-none">Login</a></li>        
                <li class="list-unstyled"><a href="/signup" class="text-dark text-decoration-none">@lang("messages.nav_get_started")</a></li>        
            @endif
            <li class="list-unstyled"><a href="/contact-us" class="text-dark text-decoration-none {{$iscontact ? "active" : ""}}">@lang("messages.nav_contact_us")</a></li>
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
                    <li  style="margin-right: 0 !important"><h5 class="dropdown-header">Choose Language</h5></li>
                    <li  style="margin-right: 0 !important"><hr class="dropdown-divider"></hr></li>
                    <li  style="margin-right: 0 !important"><a class="text-muted fr mt-3 mb-3 dropdown-item" href="/lang/en"><img src="https://upload.wikimedia.org/wikipedia/en/thumb/a/ae/Flag_of_the_United_Kingdom.svg/1280px-Flag_of_the_United_Kingdom.svg.png" alt=""> English</a></li>
                    <li  style="margin-right: 0 !important"><a class="text-muted fr mb-3 dropdown-item" href="/lang/de"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcScBXsZhOLWG9aaZzvy5KdAR39CVFsvM2e3DA&s" alt=""> German</a></li>
                    <li  style="margin-right: 0 !important"><a class="text-muted fr mb-3 dropdown-item" href="/lang/fr"><img src="https://m.media-amazon.com/images/I/4109Z2o0HuL._AC_UF894,1000_QL80_.jpg" alt=""> French</a></li>
                </ul>
            </div>

            <br>
        </div>
    </div>
</div>

