
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href=" {{ asset("bootstrap/css/bootstrap.min.css") }}">
    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href=" {{ asset("jquery_ui/jquery-ui.min.css") }}">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href=" {{ asset("fontawesome-icons/css/all.min.css") }}">
    <!-- Data Table Link -->
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href=" {{ asset("css/_utils.css") }}">
    <link rel="stylesheet" href=" {{ asset("css/_sidebar_header.css") }}">
    {{-- -------------------------------- Stylesheet Yield ---------------------------------- --}}
    @yield('stylesheet')

    <link rel="shortcut icon" href=" {{ asset("img/static/favicon.png") }}" type="image/x-icon">

    <title>Admin Panel - Simsat</title>

</head>

<body>
    <div class="container-fluid px-0">
        <div class="row flex-nowrap h-100">

            <div class="bg d-xl-none d-none"></div>
            
            <div class="sidebar py-3 px-1" id="sidebar">
                <div class="logo-row row align-items-center justify-content-center gap-2">
                    <div class="col-auto px-0">
                        {{-- <img src="{{ asset("img/static/logo.png") }}" class="logo" alt=""> --}}
                        <img src="{{ asset("img/static/favicon.png") }}" width="50px" class="logo" alt="">
                    </div>
                    <div class="right col-auto d-flex align-items-center px-0">
                        <h3 class="my-0">SIMSAT</h3>
                    </div>
                </div>
                <hr class="border-2 border-white">
                <div class="row align-items-center px-1">
                    
                    <div class="left col-3 ps-0">
                        <img src="{{ asset('storage/'.Auth::user()->profile_pic) }}"
                        onerror="this.onerror=null;this.src='{{ asset('img/static/user.png') }}';"
                        class="user-pic rounded-circle" alt="">
                    </div>
                    <div class="right col pe-2 ps-0 d-flex align-items-center text-center">
                        <p class="mb-0">{{ Auth::user()->name }}</p>
                    </div>
                </div>
                <hr class="border-2 border-white">
                
                {{-- <div class="link-section mb-1">
                    <div class="head row justify-content-between py-2 cursor-pointer">
                        <div class="col-auto pe-0">
                            <i class="fa-solid fa-circle-minus"></i>
                            <span class="ms-1">Deleted Items</span>
                        </div>
                        <div class="col-auto ps-0">
                            <i class="chevron fa-solid fa-chevron-right"></i>
                        </div>
                    </div>
                    <div class="ps-3 links">
                        <div class="row flex-column border-start border-2">
                            <a href="deleted_items.php?mode=deleted_admins" class="col row mt-1 py-2 text-decoration-none">
                                <div class="col-auto">Deleted Admins</div>
                            </a>
                            <a href="deleted_items.php?mode=deleted_courses" class="col row mt-1 py-2 text-decoration-none">
                                <div class="col-auto">Deleted Courses</div>
                            </a>
                            <a href="deleted_items.php?mode=deleted_results" class="col row mt-1 py-2 text-decoration-none">
                                <div class="col-auto">Deleted Results</div>
                            </a>
                            <a href="deleted_items.php?mode=deleted_questions" class="col row mt-1 py-2 text-decoration-none">
                                <div class="col-auto">Deleted Questions</div>
                            </a>
                            <a href="deleted_items.php?mode=deleted_students" class="col row mt-1 py-2 text-decoration-none">
                                <div class="col-auto">Deleted Students</div>
                            </a>
                        </div>
                    </div>
                </div> --}}

                @if (Auth::user()->role == "super_admin")
                    
                    <div class="link-section mb-1">
                        <div class="head row justify-content-between cursor-pointer">
                            <a href="{{ route("admin_panel.announcements") }}" class="col row ps-3 pe-2 py-2 bg-transparent text-decoration-none">
                                <div class="left col-auto px-0">
                                    <i class="fa-solid fa-bullhorn"></i>
                                </div>
                                <div class="right row col px-0 justify-content-between">
                                    <div class="col">
                                        <span class="ms-1">Announcements</span>
                                    </div>  
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="link-section mb-1">
                        <div class="head row justify-content-between cursor-pointer">
                            <a href="{{ route("admin_panel.admins") }}" class="col row ps-3 pe-2 py-2 bg-transparent text-decoration-none">
                                <div class="left col-auto px-0">
                                    <i class="fa-solid fa-user-tie"></i>
                                </div>
                                <div class="right row col px-0 justify-content-between">
                                    <div class="col">
                                        <span class="ms-1">Admins</span>
                                    </div>  
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="link-section mb-1">
                        <div class="head row justify-content-between cursor-pointer">
                            <a href="{{ route("admin_panel.rosters") }}" class="col row ps-3 pe-2 py-2 bg-transparent text-decoration-none">
                                <div class="left col-auto px-0">
                                    <i class="fa-regular fa-calendar-days"></i>
                                </div>
                                <div class="right row col px-0 justify-content-between">
                                    <div class="col">
                                        <span class="ms-1">Rosters</span>
                                    </div>  
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="link-section mb-1">
                        <div class="head row justify-content-between cursor-pointer">
                            <a href="{{ route('admin_panel.rooms') }}" class="col row ps-3 pe-2 py-2 bg-transparent text-decoration-none">
                                <div class="left col-auto px-0">
                                    <i class="fa-solid fa-house"></i>
                                </div>
                                <div class="right row col px-0 justify-content-between">
                                    <div class="col">
                                        <span class="ms-1">Rooms</span>
                                    </div>  
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="link-section mb-1">
                        <div class="head row justify-content-between cursor-pointer">
                            <a href="{{ route('admin_panel.courses') }}" class="col row ps-3 pe-2 py-2 bg-transparent text-decoration-none">
                                <div class="left col-auto px-0">
                                    <i class="fa-solid fa-book"></i>
                                </div>
                                <div class="right row col px-0 justify-content-between">
                                    <div class="col">
                                        <span class="ms-1">Courses</span>
                                    </div>  
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="link-section mb-1">
                        <div class="head row justify-content-between cursor-pointer">
                            <a href="{{ route('admin_panel.students') }}" class="col row ps-3 pe-2 py-2 bg-transparent text-decoration-none">
                                <div class="left col-auto px-0">
                                    <i class="fa-solid fa-circle-user"></i>
                                </div>
                                <div class="right row col px-0 justify-content-between">
                                    <div class="col">
                                        <span class="ms-1">Students</span>
                                    </div>  
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="link-section mb-1">
                        <div class="head row justify-content-between cursor-pointer">
                            <a href="{{ route('admin_panel.fees') }}" class="col row ps-3 pe-2 py-2 bg-transparent text-decoration-none">
                                <div class="left col-auto px-0">
                                    <i class="fa-solid fa-dollar-sign"></i>
                                </div>
                                <div class="right row col px-0 justify-content-between">
                                    <div class="col">
                                        <span class="ms-1">Fees Tracking</span>
                                    </div>  
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="link-section mb-1">
                        <div class="head row justify-content-between cursor-pointer">
                            <a href="{{ route('admin_panel.results') }}" class="col row ps-3 pe-2 py-2 bg-transparent text-decoration-none">
                                <div class="left col-auto px-0">
                                    <i class="fa-solid fa-square-poll-vertical"></i>
                                </div>
                                <div class="right row col px-0 justify-content-between">
                                    <div class="col">
                                        <span class="ms-1">Results</span>
                                    </div>  
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="link-section mb-1">
                        <div class="head row ps-3 pe-2 py-2 cursor-pointer">
                            <div class="left col-auto px-0">
                                <i class="fa-solid fa-file-circle-question"></i>
                            </div>
                            <div class="right row col px-0 justify-content-between">
                                <div class="col">
                                    <span class="ms-1">Set Questions</span>
                                    
                                </div>
                                <div class="col-auto">
                                    <i class="chevron fa-solid fa-chevron-right"></i>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="ps-3 links">
                            <div class="row flex-column border-start border-2">
                                @forelse ($courses as $course)
                                    <a href="{{ route('admin_panel.setQuestions', $course->id) }}" class="col row mt-1 py-2 text-decoration-none">
                                        <div class="col-auto">{{ $course->name }}</div>
                                    </a>
                                @empty
                                    <p>No courses added.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                @endif
                
                <div class="link-section mb-1">
                    <div class="head row ps-3 pe-2 py-2 cursor-pointer">
                        <div class="left col-auto px-0">
                            <i class="fa-solid fa-address-book"></i>
                        </div>
                        <div class="right row col px-0 justify-content-between">
                            <div class="col">
                                <span class="ms-1">Attendance</span>
                                
                            </div>
                            <div class="col-auto">
                                <i class="chevron fa-solid fa-chevron-right"></i>
                                
                            </div>
                        </div>
                    </div>
                    <div class="ps-3 links">
                        <div class="row flex-column border-start border-2">
                            <a href="{{ route("admin_panel.attendanceToday") }}" class="col row mt-1 py-2 text-decoration-none">
                                <div class="col-auto">Today's Attendance</div>
                            </a>
                            @if (Auth::user()->role == "super_admin")
                                <a href="{{ route("admin_panel.attendancePast") }}" class="col row mt-1 py-2 text-decoration-none">
                                    <div class="col-auto">Past Attendance</div>
                                </a>
                            @endif
                            <a href="{{ route("admin_panel.attendanceReport") }}" class="col row mt-1 py-2 text-decoration-none">
                                <div class="col-auto">Attendance Report</div>
                            </a>
                        </div>
                    </div>
                </div>
                
                
                {{-- <div class="link-section mb-1">
                    <div class="head row justify-content-between cursor-pointer">
                        <a href="{{ route("admin_panel.admins") }}" class="col row ps-3 pe-2 py-2 bg-transparent text-decoration-none">
                            <div class="left col-auto px-0">
                                <i class="fa-regular fa-copy"></i>
                            </div>
                            <div class="right row col px-0 justify-content-between">
                                <div class="col">
                                    <span class="ms-1">Layout</span>
                                </div>  
                            </div>
                        </a>
                    </div>
                </div>

                <div class="link-section mb-1">
                    <div class="head row ps-3 pe-2 py-2 cursor-pointer">
                        <div class="left col-auto px-0">
                            <i class="fa-regular fa-copy"></i>
                        </div>
                        <div class="right row col px-0 justify-content-between">
                            <div class="col">
                                <span class="ms-1">Layout</span>
                                
                            </div>
                            <div class="col-auto">
                                <i class="chevron fa-solid fa-chevron-right"></i>
                                
                            </div>
                        </div>
                    </div>
                    <div class="ps-3 links">
                        <div class="row flex-column border-start border-2">
                            <a href="#" class="col row mt-1 py-2 text-decoration-none">
                                <div class="col-auto px-0">
                                    <i class="fa-regular fa-copy"></i>
                                </div>
                                <div class="col-auto">Link 1</div>
                            </a>
                            <a href="#" class="col row mt-1 py-2 text-decoration-none">
                                <div class="col-auto px-0">
                                    <i class="fa-regular fa-copy"></i>
                                </div>
                                <div class="col-auto">Link 1</div>
                            </a>
                            <a href="#" class="col row mt-1 py-2 text-decoration-none">
                                <div class="col-auto px-0">
                                    <i class="fa-regular fa-copy"></i>
                                </div>
                                <div class="col-auto">Link 1</div>
                            </a>
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="placeholder"></div>

            <div class="content col-xl bg-light">

                <header class="border-bottom  py-2" id="header">
                    <div class="row align-items-center justify-content-between position-relative">
                        <div class="col-auto ">
                            <i class="fa-solid fa-bars fs-5 cursor-pointer"></i>
                        </div>
                        <div class="col-auto row column-gap-4 align-items-center">
                            <!-- <div class="col-auto">
                                <i class="fa-solid fa-magnifying-glass cursor-pointer"></i>
                            </div> -->
                            <div class="user-btn col-auto row column-gap-2 align-items-center px-0 cursor-pointer">
                                <div class="col-auto px-0">
                                    <img 
                                    src="{{ asset('storage/'.Auth::user()->profile_pic) }}" 
                                    onerror="this.onerror=null;this.src='{{ asset('img/static/user.png') }}';"
                                    class=" rounded-circle user-pic" alt="User Pic">
                                </div>
                                <div class="col-auto px-0 d-sm-block d-none">
                                    <p class="m-0">{{ Auth::user()->name }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="user-dialog-box border border-2 border-dark-subtle rounded-3 px-0 shadow">
                            <div class="user-details py-3 rounded-top-3">
                                <div class="row justify-content-center">
                                    <div class="col-auto">
                                        <img src="{{ asset('storage/'.Auth::user()->profile_pic) }}"
                                        onerror="this.onerror=null;this.src='{{ asset('img/static/user.png') }}';"
                                        class="rounded-circle " width="80px" height="80px" alt="User Pic">
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-auto">
                                        <p class="my-0 text-center">
                                            {{ (Auth::user()->role == "super_admin" ? "Super Admin" : (Auth::user()->role == "admin" ? "Admin" : "Student")) }}
                                        </p>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-auto">
                                        <p class="my-0 mt-1" style="font-size: 12px;">
                                            Admin Since {{ date("d M, Y", strtotime(Auth::user()->created_at)) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="actions bg-light rounded-bottom-3">
                                <div class="row justify-content-center py-2">
                                    <!-- <div class="col-auto">
                                        <button class="btn btn-outline-dark ">Profile</button>
                                    </div> -->
                                    <div class="col-auto">
                                        <a href="{{ route("account.logout") }}" class="btn btn-outline-dark ">Sign out</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                {{-- -------------------------------- Main Content Yield ---------------------------------- --}}
                @yield('content')
                
            </div>
        </div>
    </div>
</body>

<!-- jQuery File -->
<script src="{{ asset("js/jquery.js") }}"></script>
<!-- Bootstrap JS -->
<script src="{{ asset("bootstrap/js/bootstrap.min.js") }}"></script>
<!-- Font Awesome Icon -->
<script src="{{ asset("fontawesome-icons/js/all.min.js") }}" crossorigin="anonymous"></script>
<!-- Ionicons Icon -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<!-- jQuery UI -->
<script src="{{ asset("jquery_ui/jquery-ui.min.js") }}"></script>
<!-- Data Table Link -->
<script src="{{ asset('DataTables/datatables.min.js') }}"></script>

{{-- -------------------------------- Script Yield ---------------------------------- --}}
@yield('script')

<script>
    // --------- Sidebar ---------
    $(".head").click(function () {
        $(this).next().slideToggle()
        if (parseInt($(this).next().css("height").slice(0, 1)) >= 1) {
            $(this).find('.chevron').css("transform", 'rotate(0deg)')
        } else {
            $(this).find('.chevron').css("transform", 'rotate(90deg)')
        }
    })
    
    $(document).on("mouseleave", ".sidebar.close", function () {
        $(this).find('.chevron').css("transform", 'rotate(0deg)')
        $(".links").hide()
    })


    $(document).on("click", ".fa-bars", function () {
        
        if ($('.sidebar').hasClass('close')) {
            $(".sidebar").removeClass("close")

        } else {
            $(".sidebar").addClass("close")

            $('.bg').removeClass('d-none')
            $('.bg').addClass('d-block')
        }

    })
    
    $(".bg").click(function () {
        
        $(".sidebar").removeClass("close")

        $(this).removeClass('d-block')
        $(this).addClass('d-none')
    })

    // ------ Header --------
    $(".user-btn").click(function() {
        $(".user-dialog-box").toggle()
    })

    $('body').click(function(evt) {
        if ($(evt.target).closest('.user-dialog-box, .user-btn').length) {
            return;
        }
        $('.user-dialog-box').hide()
    });
</script>

</html>