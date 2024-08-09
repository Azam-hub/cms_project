@extends('admin_panel._layout')


@section('stylesheet')
    <!-- Light box link -->
    <link rel="stylesheet" href="{{ asset('lightbox2-2.11.4/src/css/lightbox.css') }}">
@endsection


@section('content')
<section class="py-3">

    <div class="row mb-4">
        <div class="col-3">
            <label class="form-label mb-1">Select Room</label>
            <select id="room" class="form-select shadow-sm py-2 rounded-3 border-1 border-dark-subtle">
                <option value="">-- Select Room --</option>
                @forelse ($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                @empty
                    No rooms added.
                @endforelse
            </select>
        </div>
        <div class="col-3">
            <label class="form-label mb-1">Select Timing</label>
            <select id="timing" class="form-select shadow-sm py-2 rounded-3 border-1 border-dark-subtle">
                <option value="" selected>-- Select Timing --</option>
                <option value="11-12">11:00 am to 12:00 am</option>
                <option value="12-1">12:00 am to 01:00 pm</option>
                <option value="1-2">01:00 pm to 02:00 pm</option>
                <option value="2-3">02:00 pm to 03:00 pm</option>
                <option value="3-4">03:00 pm to 04:00 pm</option>
                <option value="4-5">04:00 pm to 05:00 pm</option>
                <option value="5-6">05:00 pm to 06:00 pm</option>
                <option value="6-7">06:00 pm to 07:00 pm</option>
                <option value="7-8">07:00 pm to 08:00 pm</option>
                <option value="8-9">08:00 pm to 09:00 pm</option>
                <option value="9-10">09:00 pm to 10:00 pm</option>
            </select>
        </div>
        <div class="col-3">
            <label class="form-label mb-1">Select Room</label>
            <input type="date" id="date" class="form-control shadow-sm py-2 rounded-3 border-1 border-dark-subtle">
        </div>
        
    </div>

    <div class="row flex-column ">
        <div class="col">
            <h5 class="fw-semibold">Students</h5>
        </div>
        <div class="col">
            <div class="table-responsive">
                <table id="attendance-table" class="table table-striped table-bordered table-hover border-dark-subtle">
                    <thead>
                        <tr>
                            <th>S. No.</th>
                            <th>G.R. No.</th>
                            <th>Profile Picture</th>
                            <th>Name</th>
                            <th>Father's Name</th>
                            <th>Course</th>
                            <th>Status</th>
                            <th class="action-btns">Action</th>
                            <th>Added On</th>
                        </tr>
                    </thead>
                    <tbody>

                        {{-- @forelse ($students as $student)
                            <tr>
                                <td>{{ $count }}.</td>
                                <td>{{ $student->studentData->gr_no }}</td>
                                <td class="profile-pic-td">
                                    <a href="{{ asset('storage/'.$student->profile_pic) }}" data-lightbox="profile-pic-{{ $count }}">
                                        <img src="{{ asset('storage/'.$student->profile_pic) }}" width="100px" alt="Profile Pic">
                                    </a>
                                </td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->father_name }}</td>
                                <td class="status-td text-center" style="font-size: 14px;">
                                    <span class="px-2 py-1 rounded-2 text-light bg-danger">Absent</span>
                                </td>
                                <td class="action-btns text-center">
                                    <button class="btn btn-primary " data-course-id="{{ $student->id }}">Present</button>
                                </td>
                                <td class="w-25">{!! date('h:i a <b>||</b> d M, Y', strtotime($student->created_at)) !!}</td>
                            </tr>

                            @php $count-- @endphp
                        @empty
                            No courses added
                        @endforelse --}}
                        

                    </tbody>
                    <!-- <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                            <th>Start date</th>
                            <th>Salary</th>
                            <th>Salary</th>
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
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script> -->

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

    

    $("#room, #timing, #date").change(function () {
        let room = $("#room").val()
        let timing = $("#timing").val()
        let inputDate = $("#date").val()

        // Convert the input date to a Date object
        let date = new Date(inputDate);
        // Reset time part to zero
        date.setHours(0, 0, 0, 0);

        // Get the current date
        let currentDate = new Date();
        // Reset time part to zero
        currentDate.setHours(0, 0, 0, 0);

        if (room == "" || timing == "" || inputDate == "") {
            $(".msg").html(`<p class="text-center my-4">Please select all fields.</p>`)
            $("tbody").html("")
        } else if (date > currentDate) {
            $(".msg").html(`<p class="text-center my-4">Please select date before <b>${currentDate.getDate()}-${currentDate.getMonth()}-${currentDate.getYear()}</b></p>`)
            $("tbody").html("")
        } else {
            
            fetch('/admin/attendance/fetch_students/'+room+'/'+timing+'/'+inputDate).then(function (response) {
                return response.json()
            }).then(function (data) {
                // console.log(data);

                let rows = "";
                let count = data.length;

                if (count == 0) {
                    let html = `<h5 class="text-center my-4">No students found of room <b><q>${room}</q></b> of this time.</h5>`
                    $(".msg").html(html)
                    $("tbody").html("")
                    
                } else {
                    $(".msg").html("")

                    // Retrieving all students
                    data.forEach(student => {

                        let attendance = false;
                        // console.log(student.attendance);
                        
                        if (student.attendance != null) {
                            attendance = student.attendance.status
                        }

                        // console.log(student);
                        
                        rows += `<tr data-user-id="${student.user.id}">
                                    <td>${count}.</td>
                                    <td>${student.gr_no}</td>
                                    <td class="profile-pic-td">
                                        <a href="${window.location.origin}/storage/${student.user.profile_pic}" data-lightbox="profile-pic-${count}">
                                            <img src="${window.location.origin}/storage/${student.user.profile_pic}" width="100px" alt="Profile Pic">
                                        </a>
                                    </td>
                                    <td>${student.user.name}</td>
                                    <td>${student.user.father_name}</td>
                                    <td>${student.course.name}</td>
                                    <td class="status-td text-center" style="font-size: 14px; width: 120px;">`
                                        if (attendance == "present") {
                                            rows += `<span class="px-2 py-1 rounded-2 text-light bg-success">Present</span>`
                                        } else if (attendance == "absent") {
                                            rows += `<span class="px-2 py-1 rounded-2 text-light bg-danger">Absent</span>`
                                        } else {
                                            rows += `<span class="px-2 py-1 rounded-2 text-light bg-warning">Not Marked</span>`                                        
                                        }
                                    rows += `</td>
                                    <td class="action-btns text-center" style="width: 200px;">`
                                        if (attendance == 'present') {
                                            rows += `<button class="btn btn-danger attendance-btn" data-student-id="${student.id}">Absent</button>`
                                        } else if (attendance == "absent") {
                                            rows += `<button class="btn btn-primary attendance-btn" data-student-id="${student.id}">Present</button>`
                                        } else {
                                            rows += `
                                                <button class="btn btn-primary attendance-btn" data-student-id="${student.id}">Present</button>
                                                <button class="btn btn-danger attendance-btn" data-student-id="${student.id}">Absent</button>`
                                        }
                                    rows += `</td>
                                    <td class="w-25">${formatDateTime(student.created_at)}</td>
                                </tr>`
                        count--
                    });
                    $("tbody").html(rows)

                    $('#attendance-table').DataTable({
                        
                        dom: 'lBfrtip',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ],
                        "aaSorting": [], 

                    });
                    // new DataTable('#attendance-table', {
                    //     initComplete: function () {
                    //         this.api()
                    //             .columns()
                    //             .every(function () {
                    //                 let column = this;
                    //                 let title = column.footer().textContent;
                    
                    //                 // Create input element
                    //                 let input = document.createElement('input');
                    //                 input.placeholder = title;
                    //                 column.footer().replaceChildren(input);
                    
                    //                 // Event listener for user input
                    //                 input.addEventListener('keyup', () => {
                    //                     if (column.search() !== this.value) {
                    //                         column.search(input.value).draw();
                    //                     }
                    //                 });
                    //             });
                    //     }
                    // });
                }

            })
        }
    })


    $(document).on('click', '.attendance-btn', function () {
        let status_td = $(this).parent().prev()
        let btn_td = $(this).parent()
        let student_id = $(this).data('student-id');
        let action = $(this).text()
        let date = $("#date").val()

        if ($(this).text() == "Present") {
            action = "present";
        } else {
            action = "absent";
        }

        fetch("/admin/attendance/marking_attendance/"+ student_id + "/" + action + "/" + date).then(function (response) {
            return response.json()
        }).then(function (result) {
            if (result == 1) {
                $(".msg").html("")
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


