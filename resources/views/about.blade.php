@extends($role == "student" ? 'student._layout' : 'admin_panel._layout')


@section('stylesheet')
    
@endsection

@section('title')
    About Developer
@endsection


@section('content')

    <style>
        @media (max-width: 700px) {
            .para {
                width: 100% !important;
            }
        }
    </style>

    <div class="mt-3 py-3 px-3 d-flex flex-column align-items-center border border-2 border-success rounded-2" style="border-style: dashed !important;">
        <!-- <div>
        </div> -->
        <img 
            src="https://res.cloudinary.com/de2kb2ond/image/upload/v1755393930/about_dev.png" 
            onerror="this.onerror=null;this.src='{{ asset('img/static/user.png') }}';"
            style="width: 140px; height: 140px;"
            class=" rounded-circle border border-secondary" alt="Profile Pic">
        <h4 class="mt-3 mb-0 fw-semibold">Muhammad Azam</h4>
        <p class="my-0 text-secondary fst-italic" style="font-size: 15px;">Full Stack Developer</p>
        <p class="para w-50 text-center my-3" style="font-size: 14px;">I <span class="fw-semibold">designed</span> and <span class="fw-semibold">developed</span> this LMS, providing a complete solution for managing students, teachers, courses, fees, exams and more.</p>

        <!-- <div class="w-75">
            <div class="row gap-3">
                <div
                style="border-bottom-color: #0d6efd !important; border-bottom-width: 6px !important;"
                class="col row justify-content-between align-items-center px-3 py-4 border border-dark-subtle border-1 rounded-3 ">
                    <div class="col-auto">Frontend Developer</div>
                </div>
                <div
                style="border-bottom-color: #0d6efd !important; border-bottom-width: 6px !important;"
                class="col row justify-content-between align-items-center px-3 py-4 border border-dark-subtle border-1 rounded-3 ">
                    <div class="col-auto">Backend Developer</div>
                </div>
            </div>
            <div class="row gap-3 mt-2">
                <div
                style="border-bottom-color: #0d6efd !important; border-bottom-width: 6px !important;"
                class="col row justify-content-between align-items-center px-3 py-4 border border-dark-subtle border-1 rounded-3 ">
                    <div class="col-auto">API Developer</div>
                </div>
                <div
                style="border-bottom-color: #0d6efd !important; border-bottom-width: 6px !important;"
                class="col row justify-content-between align-items-center px-3 py-4 border border-dark-subtle border-1 rounded-3 ">
                    <div class="col-auto">Database Designer</div>
                </div>
            </div>
        </div> -->

        <div class="my-4">
            <a href="mailto:azam.pro.dev@gmail.com" class="bg-white border border-secondary py-2 px-3 rounded-2">
                <i class="fa-solid fa-envelope me-2 text-black"></i>azam.pro.dev@gmail.com
            </a>
        </div>

        <div class="row gap-2 justify-content-center">
            <a href="https://www.github.com/Azam-hub" target="_blank"
            class="col-auto d-flex justify-content-center align-items-center gap-2 py-2 px-3 text-decoration-none text-white bg-black border border-secondary rounded-2">
                <i class="fa-brands fa-github " style="font-size: 18px;"></i> Github
            </a>
            <a href="https://www.linkedin.com/in/azam-hub/" target="_blank"
            class="col-auto d-flex justify-content-center align-items-center gap-2 py-2 px-3 text-decoration-none text-white bg-black border border-secondary rounded-2">
                <i class="fa-brands fa-linkedin " style="font-size: 18px;"></i> LinkedIn 
            </a>
            <a href="https://bit.ly/azam-portfolio" target="_blank"
            class="col-auto d-flex justify-content-center align-items-center gap-2 py-2 px-3 text-decoration-none text-white bg-black border border-secondary rounded-2">
                <i class="fa-solid fa-briefcase " style="font-size: 18px;"></i> My Portfolio 
            </a>
        </div>
    </div>
@endsection


@section('script')
    
@endsection




{{-- @if (session('success'))
    {!! success_msg(session('success')) !!}
@elseif (session('error'))
    {!! danger_msg(session('error')) !!}
@endif

@if ($errors->any())
    @php
        $msg = "{}{}{}{} can't be added. Try again!
                <ul class='m-0'>";
                    foreach ($errors->all() as $error) {
                        $msg .= "<li>$error</li>";
                    }
                $msg .= "</ul>";
    @endphp
    {!! danger_msg($msg) !!}
@endif --}}