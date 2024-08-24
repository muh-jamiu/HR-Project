@extends("layouts.app")

@php
$iscontact = true;
$role = request()->query("role");
@endphp

@section('title')
Sign up to continue | HR
@endsection

@section("content")

<div class="d-flex login">
    <div class="img __reg">
        <img src="https://superio-appdir.vercel.app/images/background/12.jpg" alt="">
    </div>

    <div class="form" style="height: 100vh; overflow:scroll">
        <br>
            <div class="text-center">
                <h4 class="mb-4 text-dark" >Create a Free HR Account</h4>   

                <div class="nav nav_ d-flex justify-content-evenly nav-pills">
                    <li class="nav-item">
                      <a class="nav-link active" data-bs-toggle="pill" href="#home"><i class="fa-regular fa-user"></i> Candidate</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link mx-4" data-bs-toggle="pill" href="#menu1"><i class="fa-regular fa-bag-shopping"></i> Employer</a>
                    </li>
                </div>

                @if ($errors->any())
                    <div class="alert mt-2 alert-danger">
                        @foreach ($errors->all() as $error)
                            <li style="width: fit-content" class="list-unstyled mb-0">{{ $error }}</li>
                        @endforeach
                    </div>
                @endif
                @if (session("msg"))
                    <div class="alert alert-danger mt-2 text-center">
                        <li style="width: fit-content" class="list-unstyled">{{session("msg")}}</li>
                    </div>
                @endif

                <div class="tab-content">
                    <div class="tab-pane container active" id="home">  
                        <form action="/register?role={{$role}}" method="POST">  
                            @csrf    
                            <input class="cdi" name="first_name" required type="text" placeholder="First Name" value="{{old('first_name')}}">
                            <input class="cdi" name="last_name" required value="{{old('last_name')}}" type="text" placeholder="Last Name">       
                            <input class="cdi" name="username" required value="{{old('username')}}" type="text" placeholder="Username">   
            
                            <input name="email" required value="{{old('email')}}" type="email" placeholder="Enter email address">
                            <input name="password" required type="password" placeholder="Password">
                            <br>
                            <button style="width: 80%" class="btn p-3 mt-4 mx-5 btn-primary">Sign up</button>
                        </form>
                    </div>

                    <div class="tab-pane container fade" id="menu1">  
                        <form action="/register?role={{$role}}" method="POST">
                            @csrf
                            <input class="d-none cpi" name="company_name" required type="text" placeholder="Company Name" value="{{old('company_name')}}">
                            <input class="cpi" name="company_type" required type="text" placeholder="Company Type" value="{{old('company_type')}}">                    
                            <input class="cpi" name="phone" required type="text" placeholder="Phone Number" value="{{old('phone')}}">
            
                            <input name="email" required value="{{old('email')}}" type="email" placeholder="Enter email address">
                            <input name="password" required type="password" placeholder="Password">
                            <br>
                            <button style="width: 80%" class="btn p-3 mt-4 mx-5 btn-primary">Sign up</button>
                        </form>
                    </div>
                </div>
            </div>
        <p class="text-center mt-5 text-muted ft">Already have an account? <a href="/login" class="text-decoration-none text-primary">Login instead</a></p>
    </div>
</div>

<p class="d-none bang">{{$role}}</p>

@endsection

@push('javascript')
    <script>
        var role = document.querySelector(".bang").innerHTML
        if(role == "company"){
            role = "Company"
        }else{
            role = "Candidate"
        }
        
        function show__(){
            Swal.fire({
                title: "Are you sure?",
                text: `You are signing up as a ${role}`,
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Continue!"
            }).then((result) => {
            });
        }
        
        setTimeout(() => {
            // show__();
        }, 1000);
        
    </script>
@endpush