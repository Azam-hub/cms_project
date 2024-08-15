@extends('admin_panel._layout')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('admin_panel/css/admins.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection


@section('content')

<!-- Add/Update admin Modal -->
<div class="modal fade" id="admin-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Admin</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" enctype="multipart/form-data"> {{-- Action attribute set from JS --}}
                @csrf
                <input type="hidden" name="admin_id" id="admin-id">
                <div class="modal-body">
                    <div class="row justify-content-center mb-3">
                        <div class="col-auto">
                            <label for="profile-pic">
                                <img src="{{ asset('img/static/default_image-removebg-preview.png') }}" width="180px" class="d-block" id="preview_image" alt="Default Pic">
                                <span class="btn btn-secondary mt-2 position-relative start-50 translate-middle-x">Upload Image</span>
                            </label>
                            <input type="file" class="d-none" id="profile-pic" name="profile_pic" accept=".png, .jpg, .jpeg, .jfif">
                            <div class="text-danger">@error('profile_pic') {{ $message }} @enderror</div>
                        </div>
                    </div>
                    <div class="row variable-row">
                        {{-- this row is set from JS --}}
                    </div>
                    <div class="row">
                        <div class="col-lg mb-3">
                            <label for="father-name" class="form-label mb-1">Enter Father Name</label>
                            <input type="text" name="father_name" id="father-name" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('father_name') ? 'is-invalid' : 'border-dark-subtle' }}" placeholder="Enter Father Name" value="{{ old('father_name') }}">
                            <div class="text-danger">@error('father_name') {{ $message }} @enderror</div>
                        </div>
                        <div class="col-lg mb-3">
                            <label for="cnic-bform-no" class="form-label mb-1">Enter CNIC/B-Form No</label>
                            <input type="number" name="cnic_bform_no" id="cnic-bform-no" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('cnic_bform_no') ? 'is-invalid' : 'border-dark-subtle' }}" placeholder="Enter CNIC/B-Form No." value="{{ old('cnic_bform_no') }}">
                            <div class="text-danger">@error('cnic_bform_no') {{ $message }} @enderror</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg mb-3">
                            <label for="dob" class="form-label mb-1">Enter Date of Birth</label>
                            <input type="date" name="dob" id="dob" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('dob') ? 'is-invalid' : 'border-dark-subtle' }}" placeholder="Enter Date of Birth" value="{{ old('dob') }}">
                            <div class="text-danger">@error('dob') {{ ($message == 'The dob field is required.' ? "The date of birth is required." : $message) }} @enderror</div>
                        </div>
                        {{-- <div class="col-lg mb-3">
                            <label for="email" class="form-label mb-1">Enter Email ID</label>
                            <input type="email" name="email" id="email" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 border-dark-subtle" placeholder="Enter Email ID">
                            @error('') {{ $message }} @enderror
                        </div> --}}
                        <div class="col-lg mb-3">
                            <label for="mobile-no" class="form-label mb-1">Enter Mobile No</label>
                            <input type="number" name="mobile_no" id="mobile-no" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('mobile_no') ? 'is-invalid' : 'border-dark-subtle' }}" placeholder="Enter Mobile No." value="{{ old('mobile_no') }}">
                            <div class="text-danger">@error('mobile_no') {{ $message }} @enderror</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg mb-3">
                            <label for="select-role" class="form-label mb-1">Select Role</label>
                                <select name="role" id="select-role" class="w-100 form-select shadow-sm py-2 rounded-3 border-1 {{ $errors->has('role') ? 'is-invalid' : 'border-dark-subtle' }}">
                                    <option value="">-- Select role --</option>
                                    <option {{ (old('role') == "admin") ? "selected" : "" }} value="admin">Admin</option>
                                    <option {{ (old('role') == "super_admin") ? "selected" : "" }} value="super_admin">Super Admin</option>
                                    
                                </select>
                                <div class="text-danger">@error('role') {{ $message }} @enderror</div>
                        </div>
                        <div class="col-lg mb-3">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg mb-3">
                            <label for="address" class="form-label mb-1">Enter Address</label>
                            <textarea name="address" id="address" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('address') ? 'is-invalid' : 'border-dark-subtle' }}" placeholder="Enter Address">{{ old('address') }}</textarea>
                            <div class="text-danger">@error('address') {{ $message }} @enderror</div>
                        </div>
                        <!-- <div class="col-lg mb-3">
                        <label for="email" class="form-label mb-1"></label>
                        <input type="email" name="email" id="email" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 border-dark-subtle" placeholder="Enter your Email">
                    </div> -->
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Admin</button>
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

@if ($errors->any())
    @php
        $msg = "Admin can't be added. Try again!
                <ul class='m-0'>";
                    foreach ($errors->all() as $error) {
                        $msg .= "<li>$error</li>";
                    }
                $msg .= "</ul>";
    @endphp
    {!! danger_msg($msg) !!}
@endif

<section class="py-3">
    <div class="row mb-4">
        <div class="col">
            <h5 class="fw-semibold">Add Admin</h5>
            <button class="btn btn-secondary" id="add-admin-btn" data-bs-toggle="modal" data-bs-target="#admin-modal">Add</button>
        </div>
    </div>
    <div class="row flex-column ">
        <div class="col">
            <h5 class="fw-semibold">Admins</h5>
        </div>
        <div class="col">
            <div class="table-responsive">
                <table id="admin-table" class="table table-striped table-bordered table-hover border-dark-subtle">
                    <thead>
                        <tr class="search-row">
                            <td class="search-row-1">S. No.</td>
                            <td class="search-row-2">Profile Picture</td>
                            <td class="search-row-3">Name</td>
                            <td class="search-row-4">Father's Name</td>
                            <td class="search-row-5">CNIC/B-Form No.</td>
                            <td class="search-row-6">Date of Birth</td>
                            <td class="search-row-7">Email ID</td>
                            <td class="search-row-8">Mobile No.</td>
                            <td class="search-row-9">Address</td>
                            <td class="search-row-10">Post</td>
                            <td class="search-row-11">Action</td>
                            <td class="search-row-12">Added On</td>
                        </tr>
                        <tr>
                            <th class="text-center">S. No.</th>
                            <th class="text-center">Profile Picture</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Father's Name</th>
                            <th class="text-center">CNIC/B-Form No.</th>
                            <th class="text-center">Date of Birth</th>
                            <th class="text-center">Email ID</th>
                            <th class="text-center">Mobile No.</th>
                            <th class="text-center">Address</th>
                            <th class="text-center">Post</th>
                            <th class="action-btns text-center">Action</th>
                            <th class="text-center">Added On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($admins as $admin)
                            <tr data-admin-id="{{ $admin->id }}" class="cursor-pointer">
                                <td>{{ $count }}.</td>
                                <td><img src="{{ asset('storage/'.$admin->profile_pic) }}" class="w-100" alt="Profile Pic" ></td>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->father_name }}</td>
                                <td>{{ $admin->cnic_bform_no }}</td>
                                <td>{{ date('d M, Y', strtotime($admin->date_of_birth)) }}</td>
                                <td class="text-break">{{ $admin->email }}</td>
                                <td>{{ $admin->mobile_no }}</td>
                                <td>{{ $admin->address }}</td>
                                <td>{!! $admin->role == "admin" ? 
                                '<span class="px-2 py-1 rounded-2 text-light bg-primary d-block text-center" style="font-size: 13px;">Admin</span>' : 
                                '<span class="px-2 py-1 rounded-2 text-light bg-success d-block text-center" style="font-size: 13px;">Super Admin</span>' !!}</td>
                                <td class="action-btns">

                                    <button class="btn btn-primary edit-btn" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#admin-modal"
                                    data-admin-id="{{ $admin->id }}" 
                                    data-admin-profile_pic="{{ $admin->profile_pic }}" 
                                    data-admin-name="{{ $admin->name }}" 
                                    data-admin-father_name="{{ $admin->father_name }}" 
                                    data-admin-cnic_bform_no="{{ $admin->cnic_bform_no }}" 
                                    data-admin-date_of_birth="{{ $admin->date_of_birth }}" 
                                    data-admin-email="{{ $admin->email }}" 
                                    data-admin-mobile_no="{{ $admin->mobile_no }}" 
                                    data-admin-address="{{ $admin->address }}" 
                                    data-admin-role="{{ $admin->role }}" 
                                    >Edit</button>

                                    <button class="btn btn-danger del-btn" data-admin-id="{{ $admin->id }}">Delete</button>

                                </td>
                                <td>{!! date('h:i a <b>||</b> d M, Y', strtotime($admin->created_at)) !!}</td>
                            </tr>

                            @php $count--; @endphp
                        @empty
                            No admins added.
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>

@endsection


@section('script')
<script>
    $('#admin-table').DataTable({
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

    // Showing image after select
    var preview_image = document.getElementById('preview_image')
    $('#profile-pic').change(function (e) {
        var image_type = URL.createObjectURL(e.target.files[0]);
        console.log(image_type)
        preview_image.setAttribute('src', image_type)

    })

    // Password show/hide
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

    // On hiding modal resetting form
    $('#admin-modal').on('hidden.bs.modal', function (e) {
        $(".modal form").trigger("reset");
        $("#preview_image").attr('src', "{{ asset('img/static/default_image-removebg-preview.png') }}")
    });

    // Modifying Modal for adding admin
    $("#add-admin-btn").click(function() {
        $(".modal-title").text("Add Admin")
        $(".modal button[type=submit]").text("Add Admin")
        $(".modal form").attr('action', '{{ route("admin_panel.process_addAdmin") }}')

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

    })

    // Modifying Modal for editting admin
    $(document).on('click', ".edit-btn", function() {
        // Fetching and assigning
        let admin_id = $(this).data("admin-id")
        let profile_pic = $(this).data("admin-profile_pic")
        let name = $(this).data("admin-name")
        let father_name = $(this).data("admin-father_name")
        let cnic_bform_no = $(this).data("admin-cnic_bform_no")
        let dob = $(this).data("admin-date_of_birth")
        let email = $(this).data("admin-email")
        let mobile_no = $(this).data("admin-mobile_no")
        let address = $(this).data("admin-address")
        let role = $(this).data("admin-role")

        // Change modal for editting
        $(".modal-title").text("Edit Admin")
        $(".modal button[type=submit]").text("Edit Admin")
        $(".modal form").attr('action', `{{ route("admin_panel.process_editAdmin") }}`)
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

        

        $('.modal input#admin-id').val(admin_id)
        $("#preview_image").attr('src', "{{ asset('storage') }}" + "/" + profile_pic)
        $("#name").val(name)
        $("#father-name").val(father_name)
        $("#cnic-bform-no").val(cnic_bform_no)
        $("#dob").val(dob)
        $("#email").val(email)
        $("#mobile-no").val(mobile_no)
        $("#address").val(address)
        $("#select-role").val(role)
        

    })    

    // Delete data method
    $(document).on("click", ".del-btn", function() {
        let admin_id = $(this).data("admin-id")


        fetch('/admin/admins/process_destroyAdmin/'+admin_id, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(function (response) {
            return response.json();
        }).then(function (result) {
            if (result.success) {
                $('button[data-admin-id="' + admin_id + '"]').closest('tr').remove();
            } else {
                console.log(result);
            }
        })

    })

    // Show admin roster
    $(document).on("dblclick", "table tr", function(evt){
        if($(evt.target).closest('.action-btns').length) {
            return;             
        }
        let admin_id = $(this).data("admin-id");
        if (admin_id != undefined) {
            window.open(`/admin/rosters/${admin_id}`, '_blank');
        }
    });
</script>
@endsection