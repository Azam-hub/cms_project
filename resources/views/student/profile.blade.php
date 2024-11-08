@extends('student._layout')


@section('stylesheet')
    <!-- Light box link -->
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('title')
Profile
@endsection


@section('content')

<section class="py-3">

    <div class="row flex-column ">
        <div class="section">
            <div class="row">
                <div class="col">
                    <h4 class="text-center mb-3">Portal of <b style="font-size: 26px"><q>{{ $user->name }}</q></b></h4>
                </div>
            </div>
                    
            <div class="row justify-content-center mb-4">
                <div class="col-auto">
                    <div class="profile-pic">
                        <img 
                        src="{{ asset('storage/'.$user->profile_pic ) }}" 
                        onerror="this.onerror=null;this.src='{{ asset('img/static/user.png') }}';"
                        class="rounded-circle" width="120px" height="120px" alt="">
                    </div>
                </div>
            </div>

            <div class="collapse-head row my-2" data-bs-toggle="collapse" data-bs-target="#collapse-personal-info" aria-expanded="false" aria-controls="collapse-personal-info">
                <div class="left col-auto">
                    <h5 class="m-0">Personal Information</h5>
                </div>
                <div class="middle col-auto"></div>
                <div class="right col-auto">
                    <i class="fa-solid fa-chevron-left"></i>
                </div>
            </div>
            <div class="infos px-3 my-4 collapse" id="collapse-personal-info">
                <div class="info">
                    <h6 class="m-0 mb-1 fw-bolder">G.R. No.</h6>
                    <p class="m-0">{{ $user->studentData->gr_no }}</p>
                </div>
                <div class="info">
                    <h6 class="m-0 mb-1 fw-bolder">Date of Admission</h6>
                    <p class="m-0">{!! date('h:i a <b>||</b> d M, Y', strtotime($user->created_at)) !!}</p>
                </div>
                <div class="info">
                    <h6 class="m-0 mb-1 fw-bolder">Annual Fees</h6>
                    <p class="m-0">{{ $user->studentData->annual_fees }}</p>
                </div>
                <div class="info">
                    <h6 class="m-0 mb-1 fw-bolder">Shift</h6>
                    <p class="m-0">{{ ucfirst($user->studentData->shift) }}</p>
                </div>
                <div class="info">
                    <h6 class="m-0 mb-1 fw-bolder">Name</h6>
                    <p class="m-0">{{ $user->name }}</p>
                </div>
                <div class="info">
                    <h6 class="m-0 mb-1 fw-bolder">Father's Name</h6>
                    <p class="m-0">{{ $user->father_name }}</p>
                </div>
                <div class="info status-div">
                    <h6 class="m-0 mb-1 fw-bolder">Status</h6>
                    <p class="m-0">
                        {{-- <span class="status not-allowed-status">Not Allowed</span> --}}
                        {{-- <span class="status pending-status">Pending</span>
                        <span class="status done-status">Done</span> --}}
                        @if ($user->studentData->status == 'running')
                            <span class="d-inline-block my-1 px-2 py-1 rounded-2 text-light bg-primary">Running</span>
                        @elseif ($user->studentData->status == 'freezed')
                            <span class="d-inline-block my-1 px-2 py-1 rounded-2 text-light bg-secondary">Freezed</span>
                        @elseif ($user->studentData->status == "left")
                            <span class="d-inline-block my-1 px-2 py-1 rounded-2 text-light bg-danger">Left</span>
                        @elseif ($user->studentData->status == "completed")
                            <span class="d-inline-block my-1 px-2 py-1 rounded-2 text-light bg-warning">Completed</span>
                            <span class="px-2 py-1 rounded-2 text-light bg-danger">Disallowed</span>
                        @elseif ($user->studentData->status == "pending")
                            <span class="d-inline-block my-1 px-2 py-1 rounded-2 text-light bg-warning">Completed</span>
                            <span class="px-2 py-1 rounded-2 text-light bg-primary">Pending</span>
                        @elseif ($user->studentData->status == "done")
                            <span class="d-inline-block my-1 px-2 py-1 rounded-2 text-light bg-warning">Completed</span>
                            <span class="px-2 py-1 rounded-2 text-light bg-success">Done</span>
                        @elseif ($user->studentData->status == "passed-out")
                            <span class="d-inline-block my-1 px-1 py-1 rounded-2 text-light bg-success">Passed Out</span>
                        @endif
                    </p>
                </div>
                <div class="info">
                    <h6 class="m-0 mb-1 fw-bolder">Course</h6>
                    <p class="m-0">{{ $user->studentData->course->name }}</p>
                </div>
                <div class="row my-grid gap-3">
                    <div class="col info room">
                        <h6 class="m-0 mb-1 fw-bolder">Room</h6>
                        <p class="m-0">{{ $user->studentData->room_row->name }}</p>
                    </div>
                    <div class="col info seat">
                        <h6 class="m-0 mb-1 fw-bolder">Seat</h6>
                        <p class="m-0">{{ $user->studentData->seat }}</p>
                    </div>
                    <div class="col info timing">
                        <h6 class="m-0 mb-1 fw-bolder">Timing</h6>
                        {{-- <p class="m-0">{{ convertTimeRange($user->studentData->timing) }}</p> --}}
                        <p class="m-0">{{ \DateTime::createFromFormat('G', explode('-', $user->studentData->timing)[0])->format('h:i a') . ' to ' . \DateTime::createFromFormat('G', explode('-', $user->studentData->timing)[1])->format('h:i a') }}</p>
                    </div>
                </div>
                <div class="info">
                    <h6 class="m-0 mb-1 fw-bolder">CNIC/B-Form NO.</h6>
                    <p class="m-0">{{ $user->cnic_bform_no }}</p>
                </div>
                <div class="info">
                    <h6 class="m-0 mb-1 fw-bolder">Date of Birth</h6>
                    <p class="m-0">{{ $user->date_of_birth }}</p>
                </div>
                <div class="info">
                    <h6 class="m-0 mb-1 fw-bolder">Email ID</h6>
                    <p class="m-0">{{ $user->email }}</p>
                </div>
                <div class="info">
                    <h6 class="m-0 mb-1 fw-bolder">Mobile No.</h6>
                    <p class="m-0">{{ $user->mobile_no }}</p>
                </div>
                <div class="info">
                    <h6 class="m-0 mb-1 fw-bolder">Address</h6>
                    <p class="m-0">{{ $user->address }}</p>
                </div>
            </div>

            <div class="collapse-head row my-2" data-bs-toggle="collapse" data-bs-target="#collapse-modules" aria-expanded="false" aria-controls="collapse-modules">
                <div class="left col-auto">
                    <h5 class="m-0">Course Modules</h5>
                </div>
                <div class="middle col-auto"></div>
                <div class="right col-auto">
                    <i class="fa-solid fa-chevron-left"></i>
                </div>
            </div>
            <div class="px-3 my-4 collapse" id="collapse-modules">
                <h3 class="text-center"><q>{{ $user->studentData->course->name }}</q> Modules</h3>
                <div class="row px-2 py-3 mt-3 border border-dark-subtle rounded-2 shadow">
                    <div class="col ">
                        <h5 class="fw-bold">Progress</h5>
                        <div >
                            <p class="m-0">Total Modules: <span id="total-modules" class="fw-semibold">8</span></p>
                            <p class="m-0">Completed Modules: <span id="completed-modules" class="fw-semibold">2</span></p>
                            <p class="m-0">Remaining Modules: <span id="remaining-modules" class="fw-semibold">6</span></p>
                            <p class="m-0 fw-semibold"><span id="completed-modules-percentage">30</span>% Completed</p>
                        </div>
                    </div>
                    <div class="col" >
                        <h5 class="fw-bold">Progress Chart</h5>
                        <div style="width: 400px; height: 200px">
                            <canvas id="course-completion-chart" style="height: fit-content !important;"></canvas>
                        </div>
                    </div>
                </div>
                <div class="modules my-3">

                    @foreach ($modules as $module)
                    
                        @if (in_array($module->id, json_decode($user->studentData->completed_modules)))
                            <label for="{{ $module->id }}" class="success-div row justify-content-between align-items-center px-3 py-4 border border-dark-subtle border-1 rounded-3">
                                <div class="col-auto">{{ $module->name }}</div>
                                <div class="col-auto">
                                    <span class="px-2 py-1 rounded-2 text-light bg-success" style="font-size: 13px;">Completed</span>
                                </div>
                            </label>
                        @else
                            <label for="{{ $module->id }}" class="danger-div row justify-content-between align-items-center px-3 py-4 border border-dark-subtle border-1 rounded-3">
                                <div class="col-auto">{{ $module->name }}</div>
                                <div class="col-auto">
                                    <span class="px-2 py-1 rounded-2 text-light bg-danger" style="font-size: 13px;">Pending</span>
                                </div>
                            </label>
                        @endif
                        
                    @endforeach
                </div>
            </div>

        </div>
    </div>

</section>
@endsection


@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset("chartjs/chart.js") }}"></script>

<script>

$(".collapse-head").click(function () {
    let chevron = $(this)[0].children[2].children[0]
    if ($(chevron).css('transform') == 'matrix(0, -1, 1, 0, 0, 0)') {
        $(chevron).css("transform", "rotate(0deg)")
    } else {
        $(chevron).css("transform", "rotate(-90deg)")
    }
})

let totalModules = (JSON.parse(@json($user->studentData->total_modules))).length;
let completedModules = (JSON.parse(@json($user->studentData->completed_modules))).length;
let remainingModules = totalModules - completedModules;

let completedPercentage = Math.round((completedModules/totalModules)*100);
$("#total-modules").text(totalModules)
$("#completed-modules").text(completedModules)
$("#remaining-modules").text(remainingModules)
$("#completed-modules-percentage").text(completedPercentage)
// console.log(completedPercentage);

const courseCompletion_chart = document.getElementById('course-completion-chart');
const courseCompletion_data = {
    labels: ["Remaining", "Completed"],
    datasets: [{
        // label: 'My First Dataset',
        data: [remainingModules, completedModules],
        backgroundColor: [
            // "#ff1f27",
            "rgb(220, 53, 69)",
            "#08a85e",
        ],
        borderWidth: 0,
        hoverOffset: 4
    }]
};
new Chart(courseCompletion_chart, {
    type: 'pie',
    data: courseCompletion_data,
    options: {
        radius: '70%', // Reduce the radius to shrink the chart
        responsive: true, // Ensures the chart adjusts based on canvas size
        maintainAspectRatio: false, // Allows you to customize the aspect ratio
        layout: {
            padding: 0 // Reduces padding around the chart
        },
        plugins: {
            legend: {
                position: 'bottom', // Positions: 'top', 'bottom', 'left', 'right'
                align: 'center', // Alignment: 'start', 'center', 'end'
            }
        }
    }
});

</script>

@endsection
