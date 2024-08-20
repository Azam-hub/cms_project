@extends('admin_panel._layout')


@section('stylesheet')
    <!-- Light box link -->
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection


@section('content')

<section class="py-3">

    <div class="row flex-column ">
        <div class="section">
            <div class="row">
                <div class="col">
                    <h4 class="text-center mb-3">Information of <b style="font-size: 26px"><q>{{ $user->name }}</q></b></h4>
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
                    <h6 class="m-0 mb-1 fw-bolder">Name</h6>
                    <p class="m-0">{{ $user->name }}</p>
                </div>
                <div class="info">
                    <h6 class="m-0 mb-1 fw-bolder">Father's Name</h6>
                    <p class="m-0">{{ $user->father_name }}</p>
                </div>
                <div class="info">
                    <h6 class="m-0 mb-1 fw-bolder">Status</h6>
                    <p class="m-0">
                        {{-- <span class="status not-allowed-status">Not Allowed</span> --}}
                        {{-- <span class="status pending-status">Pending</span>
                        <span class="status done-status">Done</span> --}}
                        @if ($user->studentData->status == 'running')
                            <span class="badge text-bg-primary">Running</span>
                        @elseif ($user->studentData->status == 'freezed')
                            <span class="badge text-bg-secondary">Freezed</span>
                        @elseif ($user->studentData->status == "left")
                            <span class="badge text-bg-danger">Left</span>
                        @elseif ($user->studentData->status == "completed")
                            <span class="badge text-bg-warning">Completed</span>
                            <span class="badge text-bg-danger">Disallowed</span>
                        @elseif ($user->studentData->status == "pending")
                            <span class="badge text-bg-warning">Completed</span>
                            <span class="badge text-bg-primary">Pending</span>
                        @elseif ($user->studentData->status == "done")
                            <span class="badge text-bg-warning">Completed</span>
                            <span class="badge text-bg-success">Done</span>
                        @elseif ($user->studentData->status == "passed-out")
                            <span class="badge text-bg-success">Passed Out</span>
                        @endif
                    </p>
                </div>
                <div class="info">
                    <h6 class="m-0 mb-1 fw-bolder">Action</h6>
                    {{-- <p class="m-0"> --}}
                        {{-- <button class="mt-1 btn btn-primary status-change-btn" data-student-id="">Allow</button>
                        <button class="mt-1 btn btn-danger status-change-btn" data-student-id="">Disallow</button> --}}
                        @if ($user->studentData->status == "running")
                            <div class="row column-gap-1">
                                <div class="col-auto p-0">
                                    <button class="btn btn-sm btn-secondary status-change-btn" data-student-id="{{ $user->id }}">Freeze</button>
                                </div>
                                <div class="col-auto p-0">
                                    <button class="btn btn-sm btn-danger status-change-btn" data-student-id="{{ $user->id }}">Left</button>
                                </div>
                            </div>
                        @elseif ($user->studentData->status == "freezed")
                            <div class="row column-gap-1">
                                <div class="col-auto p-0">
                                    <button class="btn btn-sm btn-secondary status-change-btn" data-student-id="{{ $user->id }}" style="font-size: 14px">Unfreeze</button>
                                </div>
                                <div class="col-auto p-0">
                                    <button class="btn btn-sm btn-danger status-change-btn" data-student-id="{{ $user->id }}" style="font-size: 14px">Left</button>
                                </div>
                            </div>
                        @elseif ($user->studentData->status == "left")
                            <div class="row column-gap-1">
                                <div class="col-auto p-0">
                                    <button class="btn btn-sm btn-primary status-change-btn" data-student-id="{{ $user->id }}" style="font-size: 14px">Re-enroll</button>
                                </div>
                            </div>
                        @elseif ($user->studentData->status == "completed")
                            <div class="row column-gap-1">
                                <div class="col-auto p-0">
                                    <button class="btn btn-sm btn-primary status-change-btn" data-student-id="{{ $user->id }}">Allow</button>
                                </div>
                                <div class="col-auto p-0">
                                    <button class="btn btn-sm btn-danger status-change-btn" data-student-id="{{ $user->id }}">Left</button>
                                </div>
                            </div>
                        @elseif ($user->studentData->status == "pending")
                            <div class="row column-gap-1">
                                <div class="col-auto p-0">
                                    <button class="btn btn-sm btn-primary status-change-btn" data-student-id="{{ $user->id }}" style="font-size: 14px">Disallow</button>
                                </div>
                                <div class="col-auto p-0">
                                    <button class="btn btn-sm btn-danger status-change-btn" data-student-id="{{ $user->id }}" style="font-size: 14px">Left</button>
                                </div>
                            </div>
                        @elseif ($user->studentData->status == "done")
                            <div class="row column-gap-1">
                                <div class="col-auto p-0">
                                    <button class="btn btn-sm btn-primary status-change-btn" data-student-id="{{ $user->id }}" style="font-size: 14px">Again</button>
                                </div>
                                <div class="col-auto p-0">
                                    <button class="btn btn-sm btn-success status-change-btn" data-student-id="{{ $user->id }}" style="font-size: 14px">Pass Out</button>
                                </div>
                                <div class="col-auto p-0">
                                    <button class="btn btn-sm btn-danger status-change-btn" data-student-id="{{ $user->id }}" style="font-size: 14px">Left</button>
                                </div>
                            </div>
                        @elseif ($user->studentData->status == "passed-out")
                            <span class="badge text-bg-success">Passed Out</span>
                        @endif
                    {{-- </p> --}}
                </div>
                <div class="row my-grid gap-3">
                    <div class="col-sm col-12 info room">
                        <h6 class="m-0 mb-1 fw-bolder">Room</h6>
                        <p class="m-0">{{ $user->studentData->room_row->name }}</p>
                    </div>
                    <div class="col-sm col-12 info seat">
                        <h6 class="m-0 mb-1 fw-bolder">Seat</h6>
                        <p class="m-0">{{ $user->studentData->seat }}</p>
                    </div>
                    <div class="col-sm col-12 info timing">
                        <h6 class="m-0 mb-1 fw-bolder">Timing</h6>
                        <p class="m-0">{{ \DateTime::createFromFormat('G', explode('-', $user->studentData->timing)[0])->format('h:i a') . ' to ' . \DateTime::createFromFormat('G', explode('-', $user->studentData->timing)[1])->format('h:i a') }}</p>
                    </div>
                </div>
                <div class="info">
                    <h6 class="m-0 mb-1 fw-bolder">Course</h6>
                    <p class="m-0">{{ $user->studentData->course->name }}</p>
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
                <div class="info">
                    <h6 class="m-0 mb-1 fw-bolder">Annual Fees</h6>
                    <p class="m-0">{{ $user->studentData->annual_fees }}</p>
                </div>
                <div class="info">
                    <h6 class="m-0 mb-1 fw-bolder">Discount</h6>
                    <p class="m-0">{{ $user->studentData->discount }}%</p>
                </div>
                <div class="info">
                    <h6 class="m-0 mb-1 fw-bolder">Shift</h6>
                    <p class="m-0">{{ ucfirst($user->studentData->shift) }}</p>
                </div>
                <div class="info">
                    <h6 class="m-0 mb-1 fw-bolder">Exclude from Fees Reminder</h6>
                    <p class="m-0">{{ $user->studentData->exclude == "0" ? "Not Excluded" : "Excluded" }}</p>
                </div>
            </div>

            <div class="collapse-head row my-2" data-bs-toggle="collapse" data-bs-target="#collapse-attendance" aria-expanded="false" aria-controls="collapse-attendance">
                <div class="left col-auto">
                    <h5 class="m-0">Attendance</h5>
                </div>
                <div class="middle col-auto"></div>
                <div class="right col-auto">
                    <i class="fa-solid fa-chevron-left"></i>
                </div>
            </div>
            <div class="px-3 py-2 collapse" id="collapse-attendance">
                <div class="row justify-content-start mb-2">
                    <button class="col-auto btn btn-primary" id="attendance-mode">Day wise Attendance</button>
                </div>
                <div class="table-responsive" style="display: none;" id="full-attendance-div">
                    <table id="full-attendance-table" class="table table-striped table-bordered table-hover border-dark-subtle">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Added On</th>
                            </tr>
                        </thead>
                        <tbody>
    
                            @forelse ($attendance_rows as $attendance)
                                <tr>
                                    <td class="text-center py-2">{{ date('d M, Y', strtotime($attendance->date)) }}</td>
                                    <td class="status-td text-center" style="font-size: 14px">
                                        @if ($attendance->status == "present") 
                                            <span class="px-2 py-1 rounded-2 text-light bg-success">Present</span>
                                        @elseif ($attendance->status == "absent") 
                                            <span class="px-2 py-1 rounded-2 text-light bg-danger">Absent</span>
                                        @elseif (!$attendance->status) 
                                            <span class="px-2 py-1 rounded-2 text-light bg-warning">Not Marked</span>
                                        @endif
                                    </td>
                                    <td class="w-25">{!! date('h:i a <b>||</b> d M, Y', strtotime($attendance->created_at)) !!}</td>
                                </tr>
                            @empty
                                No attendance marked.
                            @endforelse
                            
    
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive" id="month-attendance-div">
                    <table id="month-attendance-table" class="table table-striped table-bordered table-hover border-dark-subtle">
                        <thead>
                            <tr>
                                <th>Month</th>
                                <th>Attendance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($month_attendances as $attendance)
                                <tr>
                                    <td class="text-center py-2">{{ date('M-Y', strtotime($attendance->month)) }}</td>
                                    <td class="status-td text-center" style="font-size: 14px">
                                        <span class="px-2 py-1 rounded-2 text-light bg-success d-inline-block"><b style="font-size: 15px">{{ $attendance->present }}</b> Presents</span>
                                        <span class="px-2 py-1 rounded-2 text-light bg-danger d-inline-block"><b style="font-size: 15px">{{ $attendance->absent }}</b> Absents</span>
                                    </td>
                                </tr>
                            @empty
                                No attendance marked.
                            @endforelse
                    
                        </tbody>
                    </table>
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
                <div class="modules my-3">
                    @foreach ($modules as $module)
                    
                        @if (in_array($module->id, json_decode($user->studentData->completed_modules)))
                            <label for="{{ $module->id }}" class="success-div row justify-content-between align-items-center px-3 py-4 border border-dark-subtle border-1 rounded-3 cursor-pointer">
                                <div class="col-auto">{{ $module->name }}</div>
                                <div class="col-auto">
                                    <input checked class="form-check-input border-dark-subtle" type="checkbox" id="{{ $module->id }}" data-user-id="{{ $user->id }}" data-module-id="{{ $module->id }}">
                                </div>
                            </label>
                        @else
                            <label for="{{ $module->id }}" class="danger-div row justify-content-between align-items-center px-3 py-4 border border-dark-subtle border-1 rounded-3 cursor-pointer">
                                <div class="col-auto">{{ $module->name }}</div>
                                <div class="col-auto">
                                    <input class="cursor-pointer form-check-input border-dark-subtle" type="checkbox" id="{{ $module->id }}" data-user-id="{{ $user->id }}" data-module-id="{{ $module->id }}">
                                </div>
                            </label>
                        @endif
                        
                    @endforeach
                </div>
            </div>
            
            <div class="collapse-head row my-2" data-bs-toggle="collapse" data-bs-target="#collapse-fees" aria-expanded="false" aria-controls="collapse-fees">
                <div class="left col-auto">
                    <h5 class="m-0">Fees Record</h5>
                </div>
                <div class="middle col-auto"></div>
                <div class="right col-auto">
                    <i class="fa-solid fa-chevron-left"></i>
                </div>
            </div>
            <div class="px-3 py-2 collapse" id="collapse-fees">
                <div class="table-responsive">
                    <table id="fees-table" class="table table-striped table-bordered table-hover border-dark-subtle">
                        <thead>
                            <tr>
                                {{-- <th>S. no.</th> --}}
                                <th>Purpose</th>
                                <th>Month</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Added on</th>
                            </tr>
                        </thead>
                        <tbody>
    
                            @forelse ($fees as $fee)
                                <tr>
                                    <td class="text-center">{{ ucfirst($fee->purpose) }}</td>
                                    <td class="text-center">{{ ($fee->month == "-") ? "-" : DateTime::createFromFormat('m-Y', $fee->month)->format('M Y') }}</td>
                                    <td class="text-center">{{ $fee->description }}</td>
                                    <td class="text-center">{{ $fee->amount }}</td>
                                    <td class="text-center w-25">{!! date('h:i a <b>||</b> d M, Y', strtotime($fee->created_at)) !!}</td>
                                </tr>
                            @empty
                                No attendance marked.
                            @endforelse
                            <!-- <tr>
                                <td colspan="3">Total:</td>
                                <td>{{ $total_paid_fees }}</td>
                                <td></td>
                            </tr> -->
                            
    
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

</section>
@endsection


@section('script')
<!-- Light box link -->
<script src="{{ asset('lightbox2-2.11.4/src/js/lightbox.js') }}"></script>

<script>

$('#attendance-mode').click(function () {
    if ($(this).text() == "Day wise Attendance") {
        $(this).text("Month wise Attendance")
        $("#full-attendance-div").show()
        $("#month-attendance-div").hide()
    } else {
        $(this).text("Day wise Attendance")
        $("#full-attendance-div").hide()
        $("#month-attendance-div").show()
    }
})

// $.fn.dataTable.ext.errMode = 'none';
$('#full-attendance-table, #month-attendance-table, #fees-table').DataTable({
    dom: 'lBfrtip',
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ],
    "aaSorting": []

});

$(".collapse-head").click(function () {
    let chevron = $(this)[0].children[2].children[0]
    if ($(chevron).css('transform') == 'matrix(0, -1, 1, 0, 0, 0)') {
        $(chevron).css("transform", "rotate(0deg)")
    } else {
        $(chevron).css("transform", "rotate(-90deg)")
    }
})

$(".modules input[type=checkbox]").click(function () {
    
    let module_id = $(this).data('module-id')
    let user_id = $(this).data('user-id')
    let checkbox = $(this)
    let action;

    if ($(this).prop('checked')) {
        action = "add"
    } else {
        action = "remove"        
    }

    fetch('/admin/module_handler/' + user_id + "/" + action + "/" + module_id).then(function (response) {
        return response.json()
    }).then(function (result) {
        if (result == 1) {
            if (action == 'add') {
                $(checkbox).parent().parent().addClass('success-div')
                $(checkbox).parent().parent().removeClass('danger-div') 
            } else {
                $(checkbox).parent().parent().addClass('danger-div')
                $(checkbox).parent().parent().removeClass('success-div')
                
            }
        } else {
            console.log(result);
        }
    })

})


$(document).on("click", ".status-change-btn", function () {
    let student_id = $(this).data("student-id")
    let action = $(this).text()

    fetch('/admin/students/process_statusChangeStudent/' + student_id + '/' + action).then(function (response) {
        return response.json()
    }).then(function (result) {
        console.log(result)
        if (result == 1) {
            location.reload()
        }
    })
})

</script>

@endsection
