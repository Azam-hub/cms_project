@extends('admin_panel._layout')


@section('stylesheet')
    <!-- Light box link -->
    <link rel="stylesheet" href="{{ asset('lightbox2-2.11.4/src/css/lightbox.css') }}">
    <!-- Custom link -->
    <link rel="stylesheet" href="{{ asset('admin_panel/css/students.css') }}">
@endsection


@section('content')

    <!-- Add/update student Modal -->
    <div class="modal fade" id="student-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Student</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" enctype="multipart/form-data">   {{-- Action attribute set from JS --}}
                    @csrf
                    <input type="hidden" name="student_id" id="student-id">
                    <div class="modal-body">
                        <div class="row justify-content-center mb-3">
                            <div class="col-auto">
                                <label for="profile-pic">
                                    <img src="{{ asset('img/static/default_image-removebg-preview.png') }}" class="d-block" id="preview_image" alt="Default Pic">
                                    <span class="btn btn-secondary mt-2 position-relative start-50 translate-middle-x">Upload Image</span>
                                </label>
                                <input type="file" class="d-none" id="profile-pic" name="profile_pic" accept=".png, .jpg, .jpeg, .jfif">
                                <div class="text-danger">@error('profile_pic') {{ $message }} @enderror</div>
                            </div>
                        </div>
                        <div class="row variable-row">
                            {{-- This row set from JS --}}
                        </div>
                        <div class="row">
                            <div class="col-lg mb-3">
                                <label for="father-name" class="form-label mb-1">Enter Father Name</label>
                                <input type="text" name="father_name" id="father-name" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('father_name') ? 'is-invalid' : 'border-dark-subtle' }}" placeholder="Enter Father Name" value="{{ old('father_name') }}">
                                <div class="text-danger">@error('father_name') {{ $message }} @enderror</div>
                            </div>
                            <div class="col-lg mb-3">
                                <label for="select-course" class="form-label mb-1">Select Course</label>
                                <select name="course_id" id="select-course" class="w-100 form-select shadow-sm py-2 rounded-3 border-1 {{ $errors->has('course_id') ? 'is-invalid' : 'border-dark-subtle' }}">
                                    <option value="" selected>-- Select Course --</option>
                                    @forelse ($courses as $course)
                                        <option value="{{ $course->id }}" {{ (old('course_id') == $course->id) ? "selected" : "" }}>{{ $course->name }}</option>                                        
                                    @empty
                                        <option value="">No course added</option>                                        
                                    @endforelse
                                </select>
                                <div class="text-danger">@error('course_id') {{ $message }} @enderror</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg mb-3">
                                <label for="cnic-bform-no" class="form-label mb-1">Enter CNIC/B-Form No</label>
                                <input type="number" name="cnic_bform_no" id="cnic-bform-no" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('cnic_bform_no') ? 'is-invalid' : 'border-dark-subtle' }}" placeholder="Enter CNIC/B-Form No." value="{{ old('cnic_bform_no') }}">
                                <div class="text-danger">@error('cnic_bform_no') {{ $message }} @enderror</div>
                            </div>
                            <div class="col-lg mb-3">
                                <label for="dob" class="form-label mb-1">Enter Date of Birth</label>
                                <input type="date" name="dob" id="dob" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('dob') ? 'is-invalid' : 'border-dark-subtle' }}" placeholder="Enter Date of Birth" value="{{ old('dob') }}">
                                <div class="text-danger">@error('dob') {{ ($message == 'The dob field is required.' ? "The date of birth is required." : $message) }} @enderror</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg mb-3">
                                <label for="mobile-no" class="form-label mb-1">Enter Mobile No</label>
                                <input type="number" name="mobile_no" id="mobile-no" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('mobile_no') ? 'is-invalid' : 'border-dark-subtle' }}" placeholder="Enter Mobile No." value="{{ old('mobile_no') }}">
                                <div class="text-danger">@error('mobile_no') {{ $message }} @enderror</div>
                            </div>
                            <div class="col-lg mb-3">
                                <label for="select-shift" class="form-label mb-1">Select Shift</label>
                                <select name="shift" id="select-shift" class="w-100 form-select shadow-sm py-2 rounded-3 border-1 {{ $errors->has('shift') ? 'is-invalid' : 'border-dark-subtle' }}">
                                    <option value="">-- Select shift --</option>
                                    <option {{ (old('shift') == "regular") ? "selected" : "" }} value="regular">Regular</option>
                                    <option {{ (old('shift') == "weekend") ? "selected" : "" }} value="weekend">Weekend</option>
                                </select>
                                <div class="text-danger">@error('shift') {{ $message }} @enderror</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg mb-3">
                                <label for="discount" class="form-label mb-1">Enter Discount(%) <span class="text-danger">(IF)</span></label>
                                <input type="number" name="discount" id="discount" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('discount') ? 'is-invalid' : 'border-dark-subtle' }}" placeholder="Enter Discount" value="{{ old('discount') }}">
                                <div class="text-danger">@error('discount') {{ $message }} @enderror</div>
                            </div>
                            <div class="col-lg mb-3"></div>
                            {{-- <div class="col-lg mb-3">
                                <label for="registration-fees" class="form-label mb-1">Enter Registration Fees</label>
                                <input type="number" name="registration_fees" id="registration-fees" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('registration_fees') ? 'is-invalid' : 'border-dark-subtle' }}" placeholder="Enter Registration Fees" value="{{ old('registration_fees') }}">
                                <div class="text-danger">@error('registration_fees') {{ $message }} @enderror</div>
                            </div> --}}
                        </div>
                        {{-- <div class="row">
                            <div class="col-lg mb-3">
                                <label for="description" class="form-label mb-1">Enter Fee Description</label>
                                <textarea name="fee_description" id="description" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('fee_description') ? 'is-invalid' : 'border-dark-subtle' }}" placeholder="Enter Fee Description">{{ old('fee_description') }}</textarea>
                                <div class="text-danger">@error('fee_description') {{ $message }} @enderror</div>
                            </div>
                        </div> --}}

                        <div class="row">
                            <div class="col-lg mb-3">
                                <label for="address" class="form-label mb-1">Enter Address</label>
                                <textarea name="address" id="address" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('address') ? 'is-invalid' : 'border-dark-subtle' }}" placeholder="Enter Address">{{ old('address') }}</textarea>
                                <div class="text-danger">@error('address') {{ $message }} @enderror</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg mb-3">
                                <label for="password" class="form-label mb-1">Enter Password</label>
                                <div class="position-relative">
                                    <input type="password" name="password" id="password" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('password') ? 'is-invalid' : 'border-dark-subtle' }}" placeholder="Enter Password">
                                    <ion-icon name="eye-outline" class="eye cursor-pointer position-absolute top-50 end-0 translate-middle fs-4"></ion-icon>
                                    <div class="text-danger">@error('password') {{ $message }} @enderror</div>
                                </div>
                            </div>
                            <div class="col-lg mb-3">
                                <label for="confirm-password" class="form-label mb-1">Enter Confirm Password</label>
                                <div class="position-relative">
                                    <input type="password" name="password_confirmation" id="confirm-password" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('password_confirmation') ? 'is-invalid' : 'border-dark-subtle' }}" placeholder="Enter Confirm Password">
                                    <ion-icon name="eye-outline" class="eye cursor-pointer position-absolute top-50 end-0 translate-middle fs-4"></ion-icon>
                                    <div class="text-danger">@error('password_confirmation') {{ $message }} @enderror</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg mb-3">
                                <label for="select-room" class="form-label mb-1">Select Room</label>
                                <select name="room" id="select-room" class="w-100 form-select shadow-sm py-2 rounded-3 border-1 {{ $errors->has('room') ? 'is-invalid' : 'border-dark-subtle' }}">
                                    <option value="">-- Select Room --</option>
                                    @forelse ($rooms as $room)
                                        <option value="{{ $room->id }}">{{ $room->name }}</option>                                        
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
                                <div class="text-danger">@error('timing') {{ $message }} @enderror</div>
                            </div>
                            <div class="col-lg mb-3">
                                <label for="select-seat" class="form-label mb-1">Select Seat</label>
                                <select disabled name="seat" id="select-seat" class="w-100 form-select shadow-sm py-2 rounded-3 border-1 {{ $errors->has('seat') ? 'is-invalid' : 'border-dark-subtle' }}">
                                    <option value="" selected>-- Select Seat --</option>
                                    
                                </select>
                                <div class="text-danger">@error('seat') {{ $message }} @enderror</div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer justify-content-between">
                            <div class="col-auto">
                                <div class="form-check">
                                    <input class="form-check-input border-dark" type="checkbox" value="exclude" name="exclude" id="exclude">
                                    <label class="form-check-label" for="exclude">Exclude from fees reminder</label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add Student</button>
                            </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div id="msg">
    @if (session('success'))
        {!! success_msg(session('success')) !!}
    @elseif (session('error'))
        {!! danger_msg(session('error')) !!}
    @endif

    @if ($errors->any())
        @php
            $msg = "Student can't be added. Try again!
                    <ul class='m-0'>";
                        foreach ($errors->all() as $error) {
                            $msg .= "<li>$error</li>";
                        }
                    $msg .= "</ul>";
        @endphp
        {!! danger_msg($msg) !!}
    @endif

    </div>

    <section class="py-3">

        <div class="row mb-4">
            <div class="col">
                <h5 class="fw-semibold">Add Student</h5>
                <button class="btn btn-secondary" id="add-student-btn" data-bs-toggle="modal" data-bs-target="#student-modal">Add</button>
            </div>
            <div class="col">
                <h5 class="fw-semibold">Import Data</h5>
                <input type="file" id="excel-file" style="font-size: 14px;">
                <button class="btn btn-secondary d-block mt-2" id="import-data">Import</button>
            </div>
        </div>
        <div class="row flex-column ">
            <div class="col">
                <h5 class="fw-semibold">Students</h5>
            </div>
            <div class="col">
                <div class="table-responsive">
                    <table id="student-table" class="table table-striped table-bordered table-hover border-dark-subtle">
                        <thead>
                            <tr class="search-row">
                                <td class="search-row-1">G.R. No.</td>
                                <td class="search-row-2">Profile Picture</td>
                                <td class="search-row-3">Name</td>
                                <td class="search-row-4">Father's Name</td>
                                <td class="search-row-5">Course</td>
                                <td class="search-row-6">Status</td>
                                <td class="search-row-7">Mobile No.</td>
                                <td class="search-row-8">Annual Fees</td>
                                <td class="search-row-9">Discount (%)</td>
                                <td class="search-row-10">Action</td>
                                <td class="search-row-11">Action</td>
                                <td class="search-row-12">Added On</td>
                            </tr>
                            <tr>
                                {{-- <th>S. No.</th> --}}
                                <th>G.R. No.</th>
                                <th>Profile Picture</th>
                                <th>Name</th>
                                <th>Father's Name</th>
                                <th>Course</th>
                                <th>Status</th>
                                {{-- <th>CNIC/B-Form No.</th> --}}
                                {{-- <th>Date of Birth</th> --}}
                                {{-- <th>Email ID</th> --}}
                                <th>Mobile No.</th>
                                {{-- <th>Address</th> --}}
                                <th>Annual Fees</th>
                                <th>Discount (%)</th>
                                <th>Action</th>
                                <th>Action</th>
                                <th>Added On</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($students as $student)
                                <tr data-student-id="{{ $student->id }}">
                                    {{-- <td>{{ $studentsCount }}.</td> --}}
                                    <td>{{ $student->studentData->gr_no }}</td>
                                    <td class="profile-pic-td">
                                        <a href="{{ asset('storage/'.$student->profile_pic) }}" data-lightbox="profile-pic-{{ $studentsCount }}">
                                            <img src="{{ asset('storage/'.$student->profile_pic) }}" class="w-100" alt="Profile Pic">
                                        </a>
                                    </td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->father_name }}</td>
                                    <td>{{ $student->studentData->course->name }}</td>
                                    <td class="status-td text-center" style="font-size: 14px;">
                                        {{-- Running(secondary) - Freeze(primary) - Left(danger) - Completed(warning) - Passed Out(success) --}}
                                        @if ($student->studentData->status == 'running')
                                            <span class="px-2 py-1 rounded-2 text-light bg-primary">Running</span>
                                        @elseif ($student->studentData->status == 'freezed')
                                            <span class="px-2 py-1 rounded-2 text-light bg-secondary">Freezed</span>
                                        @elseif ($student->studentData->status == "left")
                                            <span class="px-2 py-1 rounded-2 text-light bg-danger">Left</span>
                                        @elseif ($student->studentData->status == "completed")
                                            <span class="px-2 py-1 rounded-2 text-light bg-danger d-inline-block mb-1">Disallowed</span>
                                            <span class="px-2 py-1 rounded-2 text-light bg-warning">Completed</span>
                                        @elseif ($student->studentData->status == "pending")
                                            <span class="px-2 py-1 rounded-2 text-light bg-primary d-inline-block mb-1">Pending</span>
                                            <span class="px-2 py-1 rounded-2 text-light bg-warning">Completed</span>
                                        @elseif ($student->studentData->status == "done")
                                            <span class="px-2 py-1 rounded-2 text-light bg-success d-inline-block mb-1">Done</span>
                                            <span class="px-2 py-1 rounded-2 text-light bg-warning">Completed</span>
                                        @elseif ($student->studentData->status == "passed-out")
                                            <span class="px-1 py-1 rounded-2 text-light bg-success d-block text-center"  style="font-size: 11px">Passed Out</span>
                                        @endif
                                    </td>
                                    {{-- <td>{{ $student->cnic_bform_no }}</td> --}}
                                    {{-- <td>{{ $student->date_of_birth }}</td> --}}
                                    {{-- <td>{{ $student->email }}</td> --}}
                                    <td>{{ $student->mobile_no }}</td>
                                    {{-- <td>{{ $student->address }}</td> --}}
                                    <td>{{ $student->studentData->annual_fees }}</td>
                                    <td>{{ $student->studentData->discount }}%</td>
                                    <td class="before-action-btns text-center">
                                        @if ($student->studentData->status == "running")
                                            <div class="row justify-content-center column-gap-1">
                                                <div class="col-auto p-0">
                                                    <button class="btn btn-secondary status-change-btn" data-student-id="{{ $student->id }}">Freeze</button>
                                                </div>
                                                <div class="col-auto p-0">
                                                    <button class="btn btn-danger status-change-btn" data-student-id="{{ $student->id }}">Left</button>
                                                </div>
                                            </div>
                                        @elseif ($student->studentData->status == "freezed")
                                            <div class="row justify-content-center column-gap-1">
                                                <div class="col-auto p-0">
                                                    <button class="btn btn-secondary status-change-btn" data-student-id="{{ $student->id }}" style="font-size: 14px">Unfreeze</button>
                                                </div>
                                                <div class="col-auto p-0">
                                                    <button class="btn btn-danger status-change-btn" data-student-id="{{ $student->id }}" style="font-size: 14px">Left</button>
                                                </div>
                                            </div>
                                        @elseif ($student->studentData->status == "left")
                                            <div class="row justify-content-center column-gap-1">
                                                <div class="col-auto p-0">
                                                    <button class="btn btn-primary status-change-btn" data-student-id="{{ $student->id }}" style="font-size: 14px">Re-enroll</button>
                                                </div>
                                            </div>
                                        @elseif ($student->studentData->status == "completed")
                                            <div class="row justify-content-center column-gap-1">
                                                <div class="col-auto p-0">
                                                    <button class="btn btn-primary status-change-btn" data-student-id="{{ $student->id }}">Allow</button>
                                                </div>
                                                <div class="col-auto p-0">
                                                    <button class="btn btn-danger status-change-btn" data-student-id="{{ $student->id }}">Left</button>
                                                </div>
                                            </div>
                                        @elseif ($student->studentData->status == "pending")
                                            <div class="row justify-content-center column-gap-1">
                                                <div class="col-auto p-0">
                                                    <button class="btn btn-primary status-change-btn" data-student-id="{{ $student->id }}" style="font-size: 14px">Disallow</button>
                                                </div>
                                                <div class="col-auto p-0">
                                                    <button class="btn btn-danger status-change-btn" data-student-id="{{ $student->id }}" style="font-size: 14px">Left</button>
                                                </div>
                                            </div>
                                        @elseif ($student->studentData->status == "done")
                                            <div class="row justify-content-center column-gap-1">
                                                <div class="col-auto p-0 mb-1">
                                                    <button class="btn btn-primary status-change-btn" data-student-id="{{ $student->id }}" style="font-size: 14px">Again</button>
                                                </div>
                                                <div class="col-auto p-0">
                                                    <button class="btn btn-success status-change-btn" data-student-id="{{ $student->id }}" style="font-size: 14px">Pass Out</button>
                                                </div>
                                                <div class="col-auto p-0">
                                                    <button class="btn btn-danger status-change-btn" data-student-id="{{ $student->id }}" style="font-size: 14px">Left</button>
                                                </div>
                                            </div>
                                        @elseif ($student->studentData->status == "passed-out")
                                            <span class="px-1 py-1 rounded-2 text-light bg-success" style="font-size: 14px">Passed Out</span>
                                        @endif
                                    </td>
                                    <td class="action-btns">
                                        <div class="row justify-content-center column-gap-1">
                                            <div class="col-auto p-0">
                                                <button 
                                                class="btn btn-primary edit-btn" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#student-modal" 
                                                data-student-id="{{ $student->id }}" 
                                                data-student-profile_pic="{{ $student->profile_pic }}" 
                                                data-student-name="{{ $student->name }}" 
                                                data-student-father_name="{{ $student->father_name }}" 
                                                data-student-course="{{ $student->studentData->course->id }}" 
                                                data-student-cnic_bform_no="{{ $student->cnic_bform_no }}" 
                                                data-student-date_of_birth="{{ $student->date_of_birth }}" 
                                                data-student-email="{{ $student->email }}" 
                                                data-student-mobile_no="{{ $student->mobile_no }}" 
                                                data-student-address="{{ $student->address }}" 
                                                data-student-password="{{ $student->password }}" 
                                                data-student-room="{{ $student->studentData->room }}" 
                                                data-student-timing="{{ $student->studentData->timing }}" 
                                                data-student-seat="{{ $student->studentData->seat }}" 
                                                data-student-shift="{{ $student->studentData->shift }}" 
                                                data-student-exclude="{{ $student->studentData->exclude }}" 
                                                >Edit</button>
                                            </div>
                                            <div class="col-auto p-0">
                                                <button class="btn btn-danger del-btn" data-student-id="{{ $student->id }}">Delete</button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{!! date('h:i a <b>||</b> d M, Y', strtotime($student->created_at)) !!}</td>
                                </tr>
                                {{-- @php $studentsCount-- @endphp --}}
                            @empty
                                No students added.
                            
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>

@endsection


@section('script')
<!-- Light box link -->
<script src="{{ asset('lightbox2-2.11.4/src/js/lightbox.js') }}"></script>

<script>

    // Showing image after select
    var preview_image = document.getElementById('preview_image')
    $('#profile-pic').change(function (e) {
        var image_type = URL.createObjectURL(e.target.files[0]);
        console.log(image_type)
        preview_image.setAttribute('src', image_type)

    })

    // Datatable plugin
    $('#student-table').DataTable({
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
        "aaSorting": []

    });

    // Password eye
    $(".eye").click(function() {
        let name = $(this).attr('name')
        if (name == "eye-outline") {
            $(this).prev().attr("type", "text")
            $(this).attr("name", "eye-off-outline")
        } else {
            $(this).prev().attr("type", "password")
            $(this).attr("name", "eye-outline")
        }
    })



    // On hiding modal resetting form
    $('#student-modal').on('hidden.bs.modal', function (e) {
        $(".modal form").trigger("reset");
        $("#preview_image").attr('src', "{{ asset('img/static/default_image-removebg-preview.png') }}")
    });

    // Manage rooms, seats and timing
    var students = @json($students);
    var rooms = @json($rooms);
    
    function seats(room, timing, callback) {

        let total_seats;
        rooms.forEach(element => {
            if (element.id == room) {
                total_seats = parseInt(element.seats);
            }
        });

        let reserved_seats = []
        students.forEach(student => {
            if (student.student_data.room == room && student.student_data.timing == timing && student.student_data.status == "running") {
                reserved_seats.push(parseInt(student.student_data.seat))
            }
        });


        let option = '<option value="">-- Select Seat --</option>';
        for (let i = 1; i <= total_seats; i++) {

            if ($.inArray(i, reserved_seats) != -1) {
                continue;
            }
            option += "<option value="+i+">"+i+"</option>"
        }

        $("#select-seat").html(option)

    }
    $('#select-room, #select-timing').on('change', function () {
        if ($('#select-timing').val() == "" || $("#select-room").val() == "") {
            $("#select-seat").attr('disabled', 'disabled')
        } else {
            $("#select-seat").removeAttr('disabled')
            seats($("#select-room").val(), $('#select-timing').val())
        }
    })

    // readying modal for add student
    $("#add-student-btn").click(function() {
        $(".modal-title").text("Add Student")
        $(".modal button[type=submit]").text("Add Student")
        $(".modal form").attr('action', '{{ route("admin_panel.process_addStudent") }}')

        let fields = `<div class="col-lg mb-3">
                            <label for="first-name" class="form-label mb-1">Enter First Name</label>
                            <input type="text" name="first_name" id="first-name" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('first_name') ? 'is-invalid' : 'border-dark-subtle' }}" placeholder="Enter First Name" value="{{ old('first_name') }}">
                            <div class="text-danger">@error('first_name') {{ $message }} @enderror</div>
                        </div>
                        <div class="col-lg mb-3">
                            <label for="last-name" class="form-label mb-1">Enter Last Name</label>
                            <input type="text" name="last_name" id="last-name" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('last_name') ? 'is-invalid' : 'border-dark-subtle' }}" placeholder="Enter Last Name" value="{{ old('last_name') }}">
                            <div class="text-danger">@error('last_name') {{ $message }} @enderror</div>
                        </div>`
        $('.variable-row').html(fields)

        $("#discount").prev().show()
        $("#discount").show()
    })

    // Edit data, method
    $(document).on('click', ".edit-btn", function () {
        let student_id = $(this).data("student-id")
    
        
        let profile_pic = $(this).data('student-profile_pic')
        let name = $(this).data('student-name')
        let father_name = $(this).data('student-father_name')
        let course = $(this).data('student-course')
        let cnic_bform_no = $(this).data('student-cnic_bform_no')
        let date_of_birth = $(this).data('student-date_of_birth')
        let email = $(this).data('student-email')
        let mobile_no = $(this).data('student-mobile_no')
        let address = $(this).data('student-address')
        let password = $(this).data('student-password')
        let room = $(this).data('student-room')
        let timing = $(this).data('student-timing')
        let seat = $(this).data('student-seat')
        let shift = $(this).data('student-shift')
        let exclude = $(this).data('student-exclude')
        // let img_src = $(img_td_tag[0].children[0].children[0]).attr("src");

        // Change modal for editting
        $(".modal-title").text("Edit Student")
        $(".modal button[type=submit]").text("Edit Student")
        $(".modal form").attr('action', `{{ route("admin_panel.process_editStudent") }}`)
        let fields = `<div class="col-lg mb-3">
                            <label for="name" class="form-label mb-1">Enter Name</label>
                            <input type="text" name="name" id="name" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('name') ? 'is-invalid' : 'border-dark-subtle' }}" placeholder="Enter Name" value="{{ old('name') }}">
                            <div class="text-danger">@error('name') {{ $message }} @enderror</div>
                        </div>
                        <div class="col-lg mb-3">
                            <label for="email" class="form-label mb-1">Enter Email</label>
                            <input type="email" name="email" id="email" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('email') ? 'is-invalid' : 'border-dark-subtle' }}" placeholder="Enter Email" value="{{ old('email') }}">
                            <div class="text-danger">@error('email') {{ $message }} @enderror</div>
                        </div>`;
        $('.variable-row').html(fields)

        $('#student-id').val(student_id)

        $("#preview_image").attr('src', "{{ asset('storage') }}" + "/" + profile_pic)
        $("#name").val(name)
        $("#email").val(email)
        $("#father-name").val(father_name)
        $("#select-course").val(course)
        $("#cnic-bform-no").val(cnic_bform_no)
        $("#dob").val(date_of_birth)
        $("#mobile-no").val(mobile_no)
        $("#address").val(address)
        $("#password").val(password)
        $("#confirm-password").val(password)
        $("#select-room").val(room)
        $("#select-timing").val(timing)
        $("#select-shift").val(shift)
        exclude == "1" ? $("#exclude").prop("checked", true) : "";

        $("#discount").prev().hide()
        $("#discount").hide()

        $("#select-seat").removeAttr('disabled')
        seats(room, timing)
        $("#select-seat").prepend("<option value='" + seat + "' selected>" + seat + "</option>");

    })

    // Delete data, method
    $(document).on("click", ".del-btn", function () {
        let student_id = $(this).data("student-id")
        
        fetch('/admin/students/process_destroyStudent/' + student_id).then(function (response) {
            return response.json()
        }).then(function (result) {
            
            if (result.success) {
                $('button[data-student-id="' + student_id + '"]').closest('tr').remove();
            } else {
                console.log(result);
            }
        })
        
    })

    // Status change ajax
    $(document).on("click", ".status-change-btn", function () {
        let student_id = $(this).data("student-id")
        let action = $(this).text()

        fetch('/admin/students/process_statusChangeStudent/' + student_id + '/' + action).then(function (response) {
            return response.json()
        }).then(function (result) {
            console.log(result)
            if (result == 1) {
                location.reload()
            } else if (result.status == "seat not available") {
                let html = `<div class="alert alert-danger d-flex align-items-center column-gap-2" role="alert">
                                <ion-icon class="icon fs-4 md hydrated" name="alert-circle-outline" role="img"></ion-icon>
                                <div>You can't resume this student because position of this student has been reserved by <b>${result.name}</b> with GR No. <b>${result.gr_no}</b></div>
                            </div>`
                // $(html).insertBefore('section')
                $("#msg").html(html)
                $('html, body').animate({scrollTop: 0}, 'slow');
            }
        })
    })

    // Show student data on index page
    $("table tr").dblclick(function(evt){
        if($(evt.target).closest('.profile-pic-td, .action-btns, .before-action-btns').length) {
            return;             
        }
        let student_id = $(this).data("student-id");
        if (student_id != undefined) {
            window.open(`/admin/single_student/${student_id}`, '_blank');
        }
    });
</script>
    
    
<!-- Excel Reader -->

<script src="{{ asset('excel_reader/js_lib/read-excel-file.min.js')}}"></script>
<script>
    var excel_file = document.getElementById("excel-file")
    $("#import-data").click(function() {
        readXlsxFile(excel_file.files[0]).then(function(rows) {
            // `rows` is an array of rows
            // each row being an array of cells.
            console.log(rows);
            rows.shift()
            console.log(rows);
        })
    })
</script>
@endsection
