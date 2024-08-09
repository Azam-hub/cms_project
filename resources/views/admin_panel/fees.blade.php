@extends('admin_panel._layout')


@section('stylesheet')
    
@endsection

@section('content')


<!-- Add/Update fees Modal -->
<div class="modal fade" id="fees-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" enctype="multipart/form-data"> {{-- Action attribute set from JS --}}
                @csrf
                <input type="hidden" name="fees_id" id="fees-id">
                <input type="hidden" name="student_id" id="student-id">
                <div class="modal-body">
                    <div class="row">
                        <h6>Last Entries</h6>
                        <div class="table-responsive">
                            <table class="entries-table table table-striped table-hover table-bordered ">
                                <thead>
                                    <tr>
                                        <th class="border border-0 text-center">S. No.</th>
                                        <th class="border border-0 text-center">Amount</th>
                                        <th class="border border-0 text-center">Purpose</th>
                                        <th class="border border-0 text-center">Month</th>
                                        <th class="border border-0 text-center">Description</th>
                                        <th class="border border-0 text-center">Added On</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <hr class="border border-dark-subtle border-1 opacity-75">
                    <div class="row">
                        <h6>Fees Record</h6>
                        <div class="table-responsive">
                            <table class="record-table table table-striped table-hover table-bordered ">
                                <thead>
                                    <tr>
                                        <th class="border border-0 text-center">Total Annual Fees</th>
                                        <th class="border border-0 text-center">Paid Fees</th>
                                        <th class="border border-0 text-center">Remaining Fees</th>
                                        <th class="border border-0 text-center">Per Month Fees</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr class="border border-dark-subtle border-1 opacity-75">

                    <div class="row">
                        <div class="row my-2">
                            <div class="col">Current Date: <b><span id="current-date"></span></b></div>
                        </div>
                        <div class="row">
                            <div class="col-lg mb-3">
                                <label for="amount" class="form-label mb-1">Enter Amount (Rs.)</label>
                                <input type="number" name="amount" id="amount" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('amount') ? 'is-invalid' : 'border-dark-subtle' }}" placeholder="Enter Amount" value="{{ old('amount') }}">
                                <div class="text-danger">@error('amount') {{ $message }} @enderror</div>
                            </div>
                            <div class="col-lg mb-3">
                                <label for="purpose" class="form-label mb-1">Select Purpose</label>
                                <select name="purpose" id="purpose" class="w-100 form-select shadow-sm py-2 rounded-3 border-1 {{ $errors->has('purpose') ? 'is-invalid' : 'border-dark-subtle' }}">
                                    <option value="">-- Select Purpose --</option>
                                    <option {{ (old('purpose') == "monthly") ? "selected" : "" }} value="monthly">Monthly</option>
                                    <option {{ (old('purpose') == "registration") ? "selected" : "" }} value="registration">Registration</option>
                                    <option {{ (old('purpose') == "examination") ? "selected" : "" }} value="examination">Examination</option>
                                    <option {{ (old('purpose') == "certificate") ? "selected" : "" }} value="certificate">Certificate</option>
                                </select>
                                <div class="text-danger">@error('purpose') {{ $message }} @enderror</div>
                            </div>
                        </div>
                        <div class="row month-year-select">
                            {{-- <div class="col current-month"></div>
                            <div class="col next-month"></div> --}}
                            <div class="col-lg mb-3">
                                <label for="month" class="form-label mb-1">Select Month</label>
                                <select name="month" id="month" class="w-100 form-select shadow-sm py-2 rounded-3 border-1 {{ $errors->has('month') ? 'is-invalid' : 'border-dark-subtle' }}">
                                    <option value="">-- Select month --</option>
                                    <option {{ (old('month') == "") ? "selected" : "1" }} value="1">January</option>
                                    <option {{ (old('month') == "") ? "selected" : "2" }} value="2">February</option>
                                    <option {{ (old('month') == "") ? "selected" : "3" }} value="3">March</option>
                                    <option {{ (old('month') == "") ? "selected" : "4" }} value="4">April</option>
                                    <option {{ (old('month') == "") ? "selected" : "5" }} value="5">May</option>
                                    <option {{ (old('month') == "") ? "selected" : "6" }} value="6">June</option>
                                    <option {{ (old('month') == "") ? "selected" : "7" }} value="7">July</option>
                                    <option {{ (old('month') == "") ? "selected" : "8" }} value="8">August</option>
                                    <option {{ (old('month') == "") ? "selected" : "9" }} value="9">September</option>
                                    <option {{ (old('month') == "") ? "selected" : "10" }} value="10">October</option>
                                    <option {{ (old('month') == "") ? "selected" : "11" }} value="11">November</option>
                                    <option {{ (old('month') == "") ? "selected" : "12" }} value="12">December</option>
                                </select>
                                <div class="text-danger">@error('month') {{ $message }} @enderror</div>
                            </div>
                            <div class="col-lg mb-3">
                                <label for="year" class="form-label mb-1">Select Year</label>
                                <select name="year" id="year" class="w-100 form-select shadow-sm py-2 rounded-3 border-1 {{ $errors->has('year') ? 'is-invalid' : 'border-dark-subtle' }}">
                                    {{-- <option value="">-- Select Year --</option> --}}
                                </select>
                                <div class="text-danger">@error('year') {{ $message }} @enderror</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg mb-3">
                                <label for="description" class="form-label mb-1">Enter Description</label>
                                <textarea name="description" id="description" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('description') ? 'is-invalid' : 'border-dark-subtle' }}" placeholder="Enter Description">{{ old('description') }}</textarea>
                                <div class="text-danger">@error('description') {{ $message }} @enderror</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add </button>
                </div>
            </form>
        </div>
    </div>
</div>



@if (session('success'))
    {!! success_msg(session('success')) !!}
@elseif (session('error'))
    {!! danger_msg(session('error')) !!}
@endif

{{-- @if ($errors->any())
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


<section class="py-3">
    <div class="row mb-4">
        <div class="col-lg mb-3">
            <label for="select-room" class="form-label mb-1">Select Room</label>
            <select name="room" id="select-room" class="w-100 form-select shadow-sm py-2 rounded-3 border-1 {{ $errors->has('room') ? 'is-invalid' : 'border-dark-subtle' }}">
                <option value="">-- Select Room --</option>
                @forelse ($rooms as $room)
                    <option value="{{ $room->name }}">{{ $room->name }}</option>                                        
                @empty
                    <option value="">No room added</option>                                        
                @endforelse
            </select>
            <div class="text-danger">@error('room') {{ $message }} @enderror</div>
        </div>
        <div class="col-lg mb-3">
            <label for="select-timing" class="form-label mb-1">Select Timing</label>
            <select name="timing" id="select-timing" class="w-100 form-select shadow-sm py-2 rounded-3 border-1 {{ $errors->has('timing') ? 'is-invalid' : 'border-dark-subtle' }}">
                <option value="">-- Select Timing --</option>
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
            <div class="text-danger">@error('timing') {{ $message }} @enderror</div>
        </div>
        <div class="col-lg mb-3">
            <label for="select-students" class="form-label mb-1">Select Student</label>
            <select  disabled name="student_id" id="select-student" class="w-100 form-select shadow-sm py-2 rounded-3 border-1 {{ $errors->has('students') ? 'is-invalid' : 'border-dark-subtle' }}">
                <option value="">-- Select Student --</option>
            </select>
            <div class="text-danger">@error('students') {{ $message }} @enderror</div>
        </div>
    </div>
    <div class="row flex-column ">
        <div class="col">
            <h5 class="fw-semibold">Fees Records</h5>
        </div>
        <div class="col">
            <div class="table-responsive">
                <table id="fees-table" class="table table-striped table-bordered table-hover border-dark-subtle">
                    <thead>
                        <tr>
                            <th class="text-center">S. No.</th>
                            <th class="text-center">Amount</th>
                            <th class="text-center">Purpose</th>
                            <th class="text-center">Student</th>
                            <th class="action-btns text-center">Action</th>
                            <th class="text-center">Added On</th>
                        </tr>
                    </thead>
                    {{-- <tbody>
                        @forelse ($rooms as $room)
                            <tr>
                                <td class="text-center">{{ $count }}.</td>
                                <td class="text-center">{{ $room->name }}</td>
                                <td class="text-center">{{ $room->seats }}</td>
                                <td class="action-btns">

                                    <button class="btn btn-primary edit-btn" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#fees-modal"
                                    data-room-id="{{ $room->id }}" 
                                    data-room-name="{{ $room->name }}" 
                                    data-room-seats="{{ $room->seats }}" 
                                    >Edit</button>

                                    <button class="btn btn-danger del-btn" data-room-id="{{ $room->id }}">Delete</button>

                                </td>
                                <td>{!! date('h:i a <b>||</b> d M, Y', strtotime($room->created_at)) !!}</td>
                            </tr>

                            @php $count--; @endphp
                        @empty
                            No rooms added.
                        @endforelse
                    </tbody> --}}
                </table>
            </div>
        </div>
    </div>

</section>


@endsection


@section('script')
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

function convertMonthYear(monthYear) {
    // Split the input to get month and year
    const [month, year] = monthYear.split('-').map(Number);

    // Array of month names
    const monthNames = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    // Get the full month name
    const fullMonthName = monthNames[month - 1];

    // Return the formatted result
    return `${fullMonthName} ${year}`;
}

$('#fees-table').DataTable({
    dom: 'lBfrtip',
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ],
    "aaSorting": []

});

// On hiding modal resetting form
$('#fees-modal').on('hidden.bs.modal', function (e) {
    $(".modal form").trigger("reset");
});



$('#select-room, #select-timing').on('change', function () {
    if ($('#select-timing').val() == "" || $("#select-room").val() == "") {
        $("#select-student").attr('disabled', 'disabled')
    } else {
        $("#select-student").removeAttr('disabled')
        
        fetch("/admin/fees/fetch_students/" + $("#select-room").val() + "/" + $('#select-timing').val())
        .then((res) => {return res.json()})
        .then(function (data) {

            // let options = '<option value="">{Gr No.} {Name} {Father}</option>';
            let options = '<option value="">-- Select Student --</option>';
            data.forEach(element => {
                options += `<option class='font-monospace' 
                value='${element.student_p_id}'>
                ${element.gr_no}: ${element.name} <b>||</b> ${element.father_name}</option>`
            });

            $("#select-student").html(options)
        })
    }
})

$("#select-student").on('change', function () {
    let student_id = JSON.parse($(this).val())
    
    // Change modal for editting
    $("#student-id").val(student_id)

    fetch("/admin/fees/fetch_student_fee_record/" + student_id)
    .then((res) => {return res.json()})
    .then(function (data) {
        
        console.log(data);

        $(".modal-title").html(`Add record of <q>${data['name']}</q>`)
        $(".modal button[type=submit]").text("Add Record")
        $(".modal form").attr('action', `{{ route("admin_panel.process_addRecord") }}`)

        // Displaying two old entries of student
        let entry_rows = ""
        let i = 1;
        (data["last_two_entries"].reverse()).forEach(record => {
            entry_rows += `<tr>
                        <td class="text-center">${(i == 1) ? "2nd Last Entry" : "Last Entry"}</td>
                        <td class="text-center">${record.amount}</td>
                        <td class="text-center">${record.purpose}</td>
                        <td class="text-center">${(record.month == '-') ? "-" : convertMonthYear(record.month)}</td>
                        <td class="text-center">${record.description}</td>
                        <td>${formatDateTime(record.created_at)}</td>
                    </tr>`
            i++;
        });
        $(".modal .entries-table tbody").html(entry_rows)


        // Displaying fee record
        let record_row = `<tr>
                            <td class="text-center">${data["total_annual_fees"]}</td>
                            <td class="text-center">
                                ${
                                (data['total_paid_fees'] >= data["total_annual_fees"]) ? 
                                `<span class='text-success'>${data['total_paid_fees']}</span>` : 
                                `<span class='text-danger'>${data['total_paid_fees']}</span>`
                                }
                            </td>
                            <td class="text-center">${data["total_annual_fees"] - data['total_paid_fees']}</td>
                            <td class="text-center"><b>${data['per_month_fees']}</b></td>
                        </tr>`
        $(".modal .record-table tbody").html(record_row)

        // Set purpose on condition
        let purpose = "<option value=''>-- Select Purpose --</option>";
        if (data['status'] == "running") {
            purpose += `<option value='monthly'>Monthly</option>`;
        } else if (data['status'] == "completed") {
            purpose += `<option value='monthly'>Monthly</option>
            <option value='examination'>Examination</option>`;
        } else if (data['status'] == "done") {
            purpose += `<option value='certificate'>Certificate</option>`;
        }
        $("#purpose").html(purpose)
    
        // Work to do before opening modal 
        $(".month-year-select").hide()
        $("#current-date").html(data['current_month_year'])
        // Opening Modal
        const myModal = new bootstrap.Modal('#fees-modal')
        const modalToggle = document.getElementById('fees-modal');
        myModal.show(modalToggle)

        $("#purpose").on('change', function () {
            if ($(this).val() == "monthly") {

                $(".month-year-select").show()

                current_year = (data['current_month_year'].split(' ').map(Number))[1]

                let years = "<option value=''>-- Select Year --</option>"
                for (let i = -5; i <= 5; i++) {
                    years += `<option 
                    value='${current_year - i}'>
                    ${current_year - i}</option>`
                }
                $("#year").html(years)
                
                $("#month").val(data["next_month"])
                $("#year").val(data['next_year'])
                
            } else {
                $(".month-year-select").hide()                
            }
        })


    })

    
})




// Modifying Modal for editting admin
$(document).on('click', ".edit-btn", function() {
    // Fetching and assigning
    let room_id = $(this).data("room-id")
    let name = $(this).data("room-name")
    let seats = $(this).data("room-seats")

    // Change modal for editting
    $(".modal-title").text("Edit Room")
    $(".modal button[type=submit]").text("Edit Room")
    $(".modal form").attr('action', `{{ route("admin_panel.process_editRoom") }}`)

    

    $('.modal input#room-id').val(room_id)
    $("#room-name").val(name)
    $("#seats").val(seats)
    

})    

// Delete data method
$(document).on("click", ".del-btn", function() {
    let room_id = $(this).data("room-id")


    fetch('/admin/rooms/process_destroyRoom/'+room_id, {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    }).then(function (response) {
        return response.json();
    }).then(function (data) {
        if (data.success) {
            $('button[data-room-id="' + room_id + '"]').closest('tr').remove();
        } else {
            console.log(data);
        }
    })

})
</script>

@endsection



