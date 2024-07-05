@extends("layouts.app")

@section('title')
Get Started | HR
@endsection

@section("content")
<div class="biz_type d-flex">
    <div class="box box1 text-center">
        <h2 class="fw-bold mb-3 text-uppercase" style="margin-top: 4em">
            Continue as a company
        </h2>
        <p style="width: 6s0%" class="ft mb-3 text-muted">List job applications on the platform, candidate will be able view and apply for your company job listing.</p>
        <a href="/signup?role=company" class="btn btn-light px-4">Continue</a>
    </div>

    <div class="box box2 text-center">
        <h2 class="fw-bold mb-3 text-uppercase" style="margin-top: 4em">
            Continue as a candidate
        </h2>
        <p style="widtsh: 60%" class="ft mb-3 text-muted">Access to job listing, job applications, manage your job activity at one go.</p>
        <a href="signup?role=candidate" class="btn btn-dark px-4">Continue</a>
    </div>
</div>
@endsection