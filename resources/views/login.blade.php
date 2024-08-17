<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset("bootstrap/css/bootstrap.min.css") }}">

    <link rel="shortcut icon" href="{{ asset("img/static/favicon.png") }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset("css/_utils.css") }}">
    <link rel="stylesheet" href="{{ asset("css/login.css") }}">

    <title>Login - Simsat</title>
</head>

<body>
    
    @if (session('success'))
        {!! success_msg(session('success')) !!}
    @elseif (session('error'))
        {!! danger_msg(session('error')) !!}
    @endif

    <div id="particles-js" class="p-3  container d-flex justify-content-center align-items-center flex-column">
        
    @if (isset($is_new))
        
        <div class="w-100 signup-box border border-1 rounded-4 p-2 p-sm-4">
            <div class="row justify-content-center align-items-center mb-3">
                <img src="img/static/logo.png" class="logo" style="width: 240px;" alt="">
            </div>
            <div class="row mb-3">
                <h3 class="head">Register as Super Admin</h3>
            </div>

            <form action="{{ route("account.process_superAdminSignup") }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center mb-3">
                    <div class="col-auto">
                        <label for="profile-pic">
                            <img src="{{ asset('img/static/default_image-removebg-preview.png') }}" width="180px" class="d-block" id="preview_image" alt="Default Pic">
                            <span class="btn btn-secondary mt-2 position-relative start-50 translate-middle-x">Upload Image</span>
                        </label>
                        <input type="file" class="d-none" id="profile-pic" name="profile_pic" accept=".png, .jpg, .jpeg, .jfif">
                        <div class="text-danger error-msg">@error('profile_pic') {{ $message }} @enderror</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md mb-3">
                        <label for="first-name" class="form-label mb-1">Enter First Name</label>
                        <input type="text" name="first_name" id="first-name" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 @error('first-name') is-invalid @enderror" placeholder="Enter First Name" value="{{ old('first_name') }}">
                        <div class="text-danger error-msg">@error('first_name') {{ $message }} @enderror</div>
                    </div>
                    <div class="col-md mb-3">
                        <label for="last-name" class="form-label mb-1">Enter Last Name</label>
                        <input type="text" name="last_name" id="last-name" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 @error('last-name') is-invalid @enderror" placeholder="Enter Last Name" value="{{ old('last_name') }}">
                        <div class="text-danger error-msg">@error('last_name') {{ $message }} @enderror</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md mb-3">
                        <label for="father-name" class="form-label mb-1">Enter Father Name</label>
                        <input type="text" name="father_name" id="father-name" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 @error('father-name') is-invalid @enderror" placeholder="Enter Father Name" value="{{ old('father_name') }}">
                        <div class="text-danger error-msg">@error('father_name') {{ $message }} @enderror</div>
                    </div>
                    <div class="col-md mb-3">
                        <label for="cnic-bform-no" class="form-label mb-1">Enter CNIC/B-Form No (without <b>-</b>)</label>
                        <input type="number" name="cnic_bform_no" id="cnic-bform-no" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 @error('cnic-bform-no') is-invalid @enderror" placeholder="Enter CNIC/B-Form No." value="{{ old('cnic_bform_no') }}">
                        <div class="text-danger error-msg">@error('cnic_bform_no') {{ $message }} @enderror</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md mb-3">
                        <label for="dob" class="form-label mb-1">Enter Date of Birth</label>
                        <input type="date" name="dob" id="dob" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 @error('dob') is-invalid @enderror" value="{{ old('dob') }}">
                        <div class="text-danger error-msg">@error('dob') {{ ($message == 'The dob field is required.' ? "The date of birth is required." : $message) }} @enderror</div>
                    </div>
                    {{-- <div class="col-md mb-3">
                        <label for="email" class="form-label mb-1">Enter Email ID</label>
                        <input type="email" name="email" id="email" class="w-100 form-control shadow-sm py-2 rounded-3 border-1" placeholder="Enter Email ID">
                    </div> --}}

                    <div class="col-md mb-3">
                        <label for="mobile-no" class="form-label mb-1">Enter Mobile No</label>
                        <input type="number" name="mobile_no" id="mobile-no" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 @error('mobile-no') is-invalid @enderror" placeholder="Enter Mobile No." value="{{ old('mobile_no') }}">
                        <div class="text-danger error-msg">@error('mobile_no') {{ $message }} @enderror</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md mb-3">
                        <label for="address" class="form-label mb-1">Enter Address</label>
                        <textarea name="address" id="address" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 @error('address') is-invalid @enderror" placeholder="Enter Address" >{{ old("address") }}</textarea>
                        <div class="text-danger error-msg">@error('address') {{ $message }} @enderror</div>
                    </div>
                    <!-- <div class="col-md mb-3">
                        <label for="email" class="form-label mb-1"></label>
                        <input type="email" name="email" id="email" class="w-100 form-control shadow-sm py-2 rounded-3 border-1" placeholder="Enter your Email">
                    </div> -->
                </div>

                <div class="row">
                    <div class="col-md mb-3">
                        <label for="password" class="form-label mb-1">Enter Password</label>
                        <div class="position-relative">
                            <input type="password" name="password" id="password" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 @error('password') is-invalid @enderror" placeholder="Enter Password">
                            <ion-icon name="eye-outline" class="eye cursor-pointer position-absolute top-50 end-0 translate-middle fs-4"></ion-icon>
                            <div class="text-danger error-msg">@error('password') {{ $message }} @enderror</div>
                        </div>
                    </div>
                    <div class="col-md mb-3">
                        <label for="confirm-password" class="form-label mb-1">Enter Confirm Password</label>
                        <div class="position-relative">
                            <input type="password" name="password_confirmation" id="confirm-password" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 @error('password_confirmation') is-invalid @enderror" placeholder="Enter Confirm Password">
                            <ion-icon name="eye-outline" class="eye cursor-pointer position-absolute top-50 end-0 translate-middle fs-4"></ion-icon>
                            <div class="text-danger error-msg">@error('password_confirmation') {{ $message }} @enderror</div>
                        </div>
                    </div>
                </div>  
                <div class="row justify-content-center mt-4">
                    <div class="col-md-auto mb-3">
                        <button type="submit" name="signup" class="btn btn-primary px-5 py-2 rounded-4">Signup</button>
                    </div>
                </div>
            </form>
        </div>

    @else

        <div class="login-box border border-1 rounded-4 p-3 p-sm-4">
            <div class="row justify-content-center align-items-center mb-4">
                <img src="img/static/logo.png" class="logo w-50" alt="">
            </div>
            {{-- <div class="row mb-4 px-3">
                <div class="switch d-flex rounded-4 px-0 position-relative border border-1 border-light">
                    <div class="background w-50 h-100 rounded-4 z-n1 position-absolute"></div>
                    <div class="col px-0">
                        <div class="student-btn text-center py-2 cursor-pointer fw-semibold text-light">Student</div>
                    </div>
                    <div class="col px-0">
                        <div class="admin-btn text-center py-2 cursor-pointer fw-semibold">Admin</div>
                    </div>
                </div>
            </div> --}}
            <div class="row mb-3">
                <h4 class="head ">Login</h4>
            </div>

            <!-- Student Form -->
            {{-- <form method="POST" id="student-form">
                <div class="row mb-3">
                    <div class="col">
                        <label for="cnic" class="form-label mb-1">CNIC/B-Form No.</label>
                        <input type="text" name="cnic-bform-no" id="cnic" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 border-dark-subtle" placeholder="Enter your CNIC/B-Form No.">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="gr-no" class="form-label mb-1">G.R. No.</label>
                        <input type="text" name="gr-no" id="gr-no" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 border-dark-subtle" placeholder="Enter your G.R. No.">
                    </div>
                </div>
                <div class="row ">
                    <div class="col ">
                        <button type="submit" name="student-submit" class="btn btn-primary w-100 rounded-4">Login</button>
                    </div>
                </div>
            </form> --}}

            <!-- Admin Form -->
            <form action="{{ route("account.process_login") }}" method="POST" id="admin-form">
                @csrf
                <div class="row mb-3">
                    <div class="col">
                        <label for="email" class="form-label mb-1">Email</label>
                        <input type="email" name="email" id="email" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('email') ? 'is-invalid' : 'border-dark-subtle' }}" placeholder="Enter your Email">
                        <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="password" class="form-label mb-1">Password</label>
                        <div class="position-relative">
                            <input type="password" name="password" id="password" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('password') ? 'is-invalid' : 'border-dark-subtle' }}" placeholder="Enter your Password">
                            <ion-icon name="eye-outline" class="eye cursor-pointer position-absolute top-50 end-0 translate-middle fs-4"></ion-icon>
                            <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                        </div>
                    </div>
                </div>  
                <div class="row ">
                    <div class="col ">
                        <button type="submit" name="admin-submit" class="btn btn-primary w-100 rounded-4">Login</button>
                    </div>
                </div>
            </form>
        </div>

    @endif
</div>
</body>
<!-- Bootstrap JS -->
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>

<script src="{{ asset("fontawesome-icons/js/all.min.js") }}" crossorigin="anonymous"></script>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<script src="{{ asset('particle_js/particles.js') }}"></script>
<script src="{{ asset('particle_js/app.js') }}"></script>

<script src="{{ asset('js/jquery.js') }}"></script>
<script>

    // Showing image after select
    var preview_image = document.getElementById('preview_image')
    $('#profile-pic').change(function (e) {
        var image_type = URL.createObjectURL(e.target.files[0]);
        console.log(image_type)
        preview_image.setAttribute('src', image_type)

    })

    $(".eye").click(function () {
        let name = $(this).attr('name')
        if (name == "eye-outline") {
            $(this).prev().attr("type", "text")
            $(this).attr("name", "eye-off-outline")
        } else {
            $(this).prev().attr("type", "password")
            $(this).attr("name", "eye-outline")
        }
    })

    // $(".admin-btn").click(function () {
    //     $('.student-btn').removeClass("text-light")
    //     $('.admin-btn').addClass("text-light")
    //     $(".background").css("transform", 'translateX(100%)')
    //     $("form#admin-form").show()
    //     $("form#student-form").hide()
    //     $(".head").text("Admin Login")
    //     // $(".box").addClass("signup-box")
    // })
    // $(".student-btn").click(function () {
    //     $('.admin-btn').removeClass("text-light")
    //     $('.student-btn').addClass("text-light")
    //     $(".background").css("transform", 'translateX(0%)')
    //     $("form#admin-form").hide()
    //     $("form#student-form").show()
    //     $(".head").text("Student Login")
    //     // $(".box").addClass("signup-box")
    // })
</script>

</html>