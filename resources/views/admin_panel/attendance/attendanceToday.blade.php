@extends('admin_panel._layout')


@section('stylesheet')
    <!-- Light box link -->
    <link rel="stylesheet" href="{{ asset('lightbox2-2.11.4/src/css/lightbox.css') }}">
@endsection


@section('content')

@if (session('success'))
    {!! success_msg(session('success')) !!}
@elseif (session('error'))
    {!! danger_msg(session('error')) !!}
@endif

<section class="py-3">

    <div class="row flex-column ">
        <div class="col">
            <h5 class="fw-semibold">Students</h5>
        </div>
        <div class="col">
            <div class="table-responsive">
                <table id="attendance-table" class="table table-striped table-bordered table-hover border-dark-subtle">
                    <thead>
                        <tr class="search-row">
                            <td class="search-row-1">S. No.</td>
                            <td class="search-row-2">G.R. No.</td>
                            <td class="search-row-3">Profile Picture</td>
                            <td class="search-row-4">Name</td>
                            <td class="search-row-5">Fatder's Name</td>
                            <td class="search-row-6">Course</td>
                            <td class="search-row-7">Shift</td>
                            <td class="search-row-8">Status</td>
                            <td class="search-row-9" class="action-btns">Action</td>
                            <td class="search-row-10">Added On</td>
                        </tr>
                        <tr>
                            <th>S. No.</th>
                            <th>G.R. No.</th>
                            <th>Profile Picture</th>
                            <th>Name</th>
                            <th>Father's Name</th>
                            <th>Course</th>
                            <th>Shift</th>
                            <th>Status</th>
                            <th class="action-btns">Action</th>
                            <th>Added On</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($students as $student)
                            <tr data-user-id="{{ $student->user->id }}" class="cursor-pointer">
                                <td>{{ $count }}.</td>
                                <td>{{ $student->gr_no }}</td>
                                <td class="profile-pic-td">
                                    <a href="{{ asset('storage/'.$student->user->profile_pic) }}" data-lightbox="{{ $count }}">
                                        <img src="{{ asset('storage/'.$student->user->profile_pic) }}" width="100px" alt="Profile Pic">
                                    </a>
                                </td>
                                <td>{{ $student->user->name }}</td>
                                <td>{{ $student->user->father_name }}</td>
                                <td>{{ $student->course->name }}</td>
                                <td>{{ $student->shift }}</td>
                                <td class="status-td text-center" style="font-size: 14px; width: 120px;">
                                    @if ($student->attendance)
                                        @if ($student->attendance->status == "present")
                                            <span class="px-2 py-1 rounded-2 text-light bg-success">Present</span>
                                        @elseif ($student->attendance->status == "absent")
                                            <span class="px-2 py-1 rounded-2 text-light bg-danger">Absent</span>
                                        @endif
                                        
                                    @else
                                        <span class="px-2 py-1 rounded-2 text-light bg-warning">Not Marked</span>
                                        
                                    @endif
                                </td>
                                <td class="action-btns text-center" style="width: 200px;">
                                    @if ($student->attendance)

                                        @if ($student->attendance->status == 'present')
                                            <button class="btn btn-danger attendance-btn" data-student-id="{{ $student->id }}">Absent</button>
                                        @elseif ($student->attendance->status == "absent")
                                            <button class="btn btn-primary attendance-btn" data-student-id="{{ $student->id }}">Present</button>
                                        @endif
                                    @else
                                        <button class="btn btn-primary attendance-btn" data-student-id="{{ $student->id }}">Present</button>
                                        <button class="btn btn-danger attendance-btn" data-student-id="{{ $student->id }}">Absent</button>

                                    @endif
                                </td>
                                <td >{!! date('h:i a <b>||</b> d M, Y', strtotime($student->created_at)) !!}</td>
                            </tr>

                            @php $count-- @endphp
                        @empty
                            <span class="text-danger"><b>No Students found of this time or check your roster.</b></span>
                        @endforelse
                        

                    </tbody>
                    <!-- <tfoot>
                        <tr>
                            <td>Name</td>
                            <td>Position</td>
                            <td>Office</td>
                            <td>Age</td>
                            <td>Start date</td>
                            <td>Salary</td>
                            <td>Start date</td>
                            <td>Salary</td>
                            <td>Salary</td>
                        </tr>
                    </tfoot> -->
                </table>
                <div class="msg"></div>
            </div>
        </div>
    </div>

</section>

    
@endsection


@section('script')
<!-- Light box link -->
<script src="{{ asset('lightbox2-2.11.4/src/js/lightbox.js') }}"></script>

<script>
    
    function formatDateTime(dateString) {
        // Create a new Date object from the dateString
        const date = new Date(dateString);

        // Extract the components of the date
        const hours = date.getHours();
        const minutes = date.getMinutes();
        const ampm = hours >= 12 ? 'pm' : 'am';
        const formattedHours = hours % 12 || 12; // Convert to 12-hour format
        const formattedMinutes = minutes < 10 ? '0' + minutes : minutes;

        const day = date.getDate();
        const month = date.toLocaleString('default', { month: 'short' }); // Get abbreviated month name
        const year = date.getFullYear();

        // Construct the formatted date string
        const formattedDate = `${formattedHours}:${formattedMinutes} ${ampm} <b>||</b> ${day} ${month}, ${year}`;

        return formattedDate;
    }

    new DataTable('#attendance-table', {
        
        initComplete: function () {
            let i = 1;
            this.api()
                .columns()
                .every(function () {
                    var column = this;
                    var title = column.header().textContent;
    
                    // Create input element and add event listener
                    $('<input type="text" placeholder="Search ' + title + '" />')
                        .appendTo($(`.search-row-${i}`).empty())
                        .on('keyup change clear', function () {
                            if (column.search() !== this.value) {
                                column.search(this.value).draw();
                            }
                        });

                    i++;
                });
            // console.log(this.api().column("#shift"))
        },

        dom: 'lBfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "aaSorting": [],
    });

    // var table = new DataTable('#attendance-table');
    // console.log(table.columns(".text-input"))


    $(document).on('click', '.attendance-btn', function () {
        let status_td = $(this).parent().prev()
        let btn_td = $(this).parent()
        let student_id = $(this).data('student-id');
        let action;

        if ($(this).text() == "Present") {
            action = "present";
        } else {
            action = "absent";
        }

        fetch("/admin/attendance/marking_attendance/"+ student_id + "/" + action).then(function (response) {
            return response.json()
        }).then(function (result) {
            if (result == 1) {
                if (action == "present") {
                    $(this).hide()
                    $(btn_td).html(`<button class="btn btn-danger attendance-btn" data-student-id="${student_id}">Absent</button>`)
                    $(status_td).html(`<span class="px-2 py-1 rounded-2 text-light bg-success">Present</span>`)
                } else {
                    $(this).hide()
                    $(btn_td).html(`<button class="btn btn-primary attendance-btn" data-student-id="${student_id}">Present</button>`)
                    $(status_td).html(`<span class="px-2 py-1 rounded-2 text-light bg-danger">Absent</span>`)
                }
            } else {
                console.log(result);
            }
        })
    })
    

    // Show student data on index page
    $(document).on('click', "table tr", function(evt){
        if($(evt.target).closest('.profile-pic-td, .action-btns').length) {
            return;             
        }
        let user_id = $(this).data("user-id");
        if (user_id != undefined) {
            window.open(`/admin/single_student/${user_id}`, '_blank');
        }
    });


</script>

@endsection




