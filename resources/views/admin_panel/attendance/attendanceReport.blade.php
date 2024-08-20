@extends('admin_panel._layout')


@section('stylesheet')
<!-- Light box link -->
<link rel="stylesheet" href="{{ asset('lightbox2-2.11.4/src/css/lightbox.css') }}">
@endsection


@section('content')
<section class="py-3">


    <div class="row mb-3">
        <div class="col">
            <h4 class="fw-semibold">Attendance Report</h4>
        </div>
    </div>
    <div class="row mb-1">
        <div class="col-sm mb-3">
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
        <div class="col-sm mb-3">
            <label class="form-label mb-1">Select Timing</label>
            <select id="timing" class="form-select shadow-sm py-2 rounded-3 border-1 border-dark-subtle">
                <option value="" selected>-- Select Timing --</option>
                <option value="11-12">11:00 am to 12:00 am</option>
                <option value="12-13">12:00 am to 01:00 pm</option>
                <option value="13-14">01:00 pm to 02:00 pm</option>
                <option value="14-15">02:00 pm to 03:00 pm</option>
                <option value="15-16">03:00 pm to 04:00 pm</option>
                <option value="16-17">04:00 pm to 05:00 pm</option>
                <option value="17-18">05:00 pm to 06:00 pm</option>
                <option value="18-19">06:00 pm to 07:00 pm</option>
                <option value="19-20">07:00 pm to 08:00 pm</option>
                <option value="20-21">08:00 pm to 09:00 pm</option>
                <option value="21-22">09:00 pm to 10:00 pm</option>
            </select>
        </div>
        <div class="col-sm mb-3">
            <label class="form-label mb-1">Select Start Date</label>
            <input type="date" id="start-date" class="form-control shadow-sm py-2 rounded-3 border-1 border-dark-subtle">
        </div>
        <div class="col-sm mb-3">
            <label class="form-label mb-1">Select End Date</label>
            <input type="date" id="end-date" class="form-control shadow-sm py-2 rounded-3 border-1 border-dark-subtle">
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
                        <tr class="search-row">
                            <td class="search-row-1">S. No.</td>
                            <td class="search-row-2">G.R. No.</td>
                            <td class="search-row-3">Profile Picture</td>
                            <td class="search-row-4">Name</td>
                            <td class="search-row-5">Fatder's Name</td>
                            <td class="search-row-6">Course</td>
                            <td class="search-row-7">Shift</td>
                            <td class="search-row-8">Attendance</td>
                        </tr>
                        <tr>
                            <th>S. No.</th>
                            <th>G.R. No.</th>
                            <th>Profile Picture</th>
                            <th>Name</th>
                            <th>Father's Name</th>
                            <th>Course</th>
                            <th>Shift</th>
                            <th>Attendance</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
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

    function fetch_students(room, timing, startDate, endDate) {

        fetch('/admin/attendance/report/fetch_students/'+room+'/'+timing+'/'+startDate+'/'+endDate).then(function (response) {
            return response.json()
        }).then(function (data) {
            console.log(data);
            
            if ( $.fn.DataTable.isDataTable('#attendance-table') ) {
                $('#attendance-table').DataTable().destroy();
            }

            let rows = "";
            let count = data.length;

            if (count == 0) {
                let html = `<h5 class="text-center my-4">No Attendance found of this room, time and range.</h5>`
                $(".msg").html(html)
                $("tbody").html("")
                
            } else {
                $(".msg").html("")

                // Retrieving all students
                data.forEach(student => {

                    // let attendance = false;
                    // if (student.attendance != null) {
                    //     attendance = student.attendance.status
                    // }
                    
                    rows += `<tr data-user-id="${student.id}" class="cursor-pointer">
                                <td>${count}.</td>
                                <td>${student.gr_no}</td>
                                <td class="profile-pic-td">
                                    <a 
                                    href="${student.profile_pic == '0' ? `${window.location.origin}/img/static/user.png` : `${window.location.origin}/storage/${student.profile_pic}`}" 
                                    data-lightbox="profile-pic-${count}">
                                        <img 
                                        src="${window.location.origin}/storage/${student.profile_pic}" 
                                        onerror="this.onerror=null;this.src='${window.location.origin}/img/static/user.png';"
                                        width="100px" alt="Profile Pic">
                                    </a>
                                </td>
                                <td>${student.user_name}</td>
                                <td>${student.father_name}</td>
                                <td>${student.course_name}</td>
                                <td>${(student.shift == "regular" ? "Regular" : "Weekend")}</td>
                                <td class="status-td text-center" style="font-size: 14px; width: 120px;">
                                    <span class="fw-bold text-success" style="font-size: 16px;">Presents: ${student.present}</span>
                                    <span class="fw-bold text-danger" style="font-size: 16px;">Absents: ${student.absent}</span>
                                </td>
                            </tr>`
                    count--
                });
                $("tbody").html(rows)

                $('#attendance-table').DataTable({
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
                    },
                    dom: 'lBfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ],
                    "aaSorting": [], 

                });

            }
        })
    }

    

    $("#room, #timing, #start-date, #end-date").change(function () {
        $("tbody").html("")

        let room = $("#room").val()
        let timing = $("#timing").val()
        let inputStartDate = $("#start-date").val()
        let inputEndDate = $("#end-date").val()

        let startDate = new Date(inputStartDate);
        startDate.setHours(0, 0, 0, 0);
        let endDate = new Date(inputEndDate);
        endDate.setHours(0, 0, 0, 0);

        let currentDate = new Date();
        currentDate.setHours(0, 0, 0, 0);

        if (room == "" || timing == "" || inputStartDate == "" || inputEndDate == "") {
            $(".msg").html(`<p class="text-center my-4">Please select all fields.</p>`)
        } else if (startDate > currentDate || endDate > currentDate ) {
            $(".msg").html(`<p class="text-center my-4">Please select both date before <b>${currentDate.getDate()}-${currentDate.getMonth()}-${currentDate.getYear()}</b></p>`)
        } else {
            fetch_students(room, timing, inputStartDate, inputEndDate);            
        }
    })



    // Show student data on index page
    $(document).on('dblclick', "table tr", function(evt){
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