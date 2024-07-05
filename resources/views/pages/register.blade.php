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
    <div class="form" style="height: 100vh; overflow:scroll">
        <br>
        <form action="/register?role={{$role}}" method="POST">
            @csrf
            <div class="text-center">
                <h4 class="text-center mb-2 text-white" >Sign up to continue</h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li style="width: fit-content" class="list-unstyled mb-0">{{ $error }}</li>
                        @endforeach
                    </div>
                @endif
                @if (session("msg"))
                    <div class="alert alert-danger text-center">
                        <li style="width: fit-content" class="list-unstyled">{{session("msg")}}</li>
                    </div>
                @endif

                @if ($role == "company")
                <input name="company_name" required type="text" placeholder="Company Name" value="{{old('company_name')}}">
                <input name="company_type" required type="text" placeholder="Company Type" value="{{old('company_type')}}">                    
                @else
                <input name="first_name" required type="text" placeholder="First Name" value="{{old('first_name')}}">
                <input name="last_name" required value="{{old('last_name')}}" type="text" placeholder="Last Name">                    
                @endif
                <input name="username" required value="{{old('username')}}" type="text" placeholder="Username">
                <input name="email" required value="{{old('email')}}" type="email" placeholder="Enter email address">
                <input name="password" required type="password" placeholder="Password">
            </div>
            <br>
            <button class="btn px-5 mx-5 btn-outline-light">Sign up</button>
        </form>
        <p class="text-center mt-5 text-white ft">Already have an account? <a href="/login" class="text-decoration-none text-primary">Login instead</a></p>
    </div>
    <div class="img __reg">
        <img src="https://wp.alithemes.com/html/jobhub/frontend/assets/imgs/blog/img-blog-2.png" alt="">
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
            show__();
        }, 1000);
        
    </script>
@endpush