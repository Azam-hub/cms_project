@extends('admin_panel._layout')


@section('stylesheet')
{{-- <link rel="stylesheet" href="{{ asset("admin_panel/css/courses.css") }}"> --}}
    
@endsection


@section('content')
<!-- Update Email Modal -->
<div class="modal fade" id="course-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="course-name">Add Course</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">  {{-- action will set by js --}}
                @csrf
                <input type="hidden" id="course-id" name="course_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg mb-3">
                            <label for="course-name" class="form-label mb-1">Enter Course Name</label>
                            <input type="text" name="course_name" id="course-name" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('course_name') ? 'is-invalid' : 'border-dark-subtle' }}" placeholder="Enter Course Name" value="{{ old('course_name') }}">
                            <span class="text-danger">@error('course_name') {{ $message }} @enderror</span>
                        </div>
                        <div class="col-lg mb-3">
                            <label for="questions-to-ask" class="form-label mb-1">Enter number of Questions to ask</label>
                            <input type="number" name="questions_to_ask" id="questions-to-ask" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('questions_to_ask') ? 'is-invalid' : 'border-dark-subtle' }}" placeholder="Enter number" value="{{ old('questions_to_ask') }}">
                            <span class="text-danger">@error('questions_to_ask') {{ $message }} @enderror</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg mb-3">
                            <label for="fees" class="form-label mb-1">Enter Course Monthly Fees</label>
                            <input type="number" name="fees" id="fees" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('fees') ? 'is-invalid' : 'border-dark-subtle' }}" placeholder="Enter Fees" value="{{ old('fees') }}">
                            <span class="text-danger">@error('fees') {{ $message }} @enderror</span>
                        </div>
                        <div class="col-lg mb-3">
                            <label for="duration" class="form-label mb-1">Enter Duration (in Months)</label>
                            <input type="number" name="duration" id="duration" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('duration') ? 'is-invalid' : 'border-dark-subtle' }}" placeholder="Enter duration" value="{{ old('duration') }}">
                            <span class="text-danger">@error('duration') {{ $message }} @enderror</span>
                        </div>
                    </div>
                    <div class="row justify-content-end my-2">
                        <div class="col-auto">
                            <button type="button" class="btn btn-primary" id="add-module-btn">Add Module</button>
                        </div>
                    </div>

                    <div class="row modules-row">
                        <div class="col-6 mb-3">
                            <label for="module-1" class="form-label mb-1">Enter Module 1 Name</label>
                            <input type="text" name="modules[]" id="module-1" class="module w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('modules.0') ? 'is-invalid' : 'border-dark-subtle' }}" placeholder="Enter Module Name" value="{{ old('modules.0') }}">
                            <span class="text-danger">@error('modules.0') {{ $message }} @enderror</span>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="module-2" class="form-label mb-1">Enter Module 2 Name</label>
                            <input type="text" name="modules[]" id="module-2" class="module w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('modules.1') ? 'is-invalid' : 'border-dark-subtle' }}" placeholder="Enter Module Name" value="{{ old('modules.1') }}">
                            <span class="text-danger">@error('modules.1') {{ $message }} @enderror</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Course</button>
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
        $msg = "Course can't be added. Try again!
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
            <h5 class="fw-semibold">Add Course</h5>
            <button class="btn btn-secondary" id="add-course-btn" data-bs-toggle="modal" data-bs-target="#course-modal">Add</button>
        </div>
    </div>
    <div class="row flex-column ">
        <div class="col">
            <h5 class="fw-semibold">Courses</h5>
        </div>
        <div class="col">
            <div class="table-responsive">
                <table id="course-table" class="table table-striped table-bordered table-hover border-dark-subtle">
                    <thead>
                        <tr>
                            <th>S. No.</th>
                            <th>Course Name</th>
                            <th>Duration</th>
                            <th>Monthly Fees</th>
                            <th>Modules</th>
                            <th>Questions to ask</th>
                            <th class="action-btns">Action</th>
                            <th>Added On</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($courses as $course)
                            <tr>
                                <td>{{ $count }}.</td>
                                <td>{{ $course->name }}</td>
                                <td>{{ $course->duration }} months</td>
                                <td>{{ $course->fees }}</td>
                                <td>
                                    <ul class="m-0 ps-3">
                                        @foreach ($course->modules as $module)
                                            <li data-module-id="{{ $module->id }}">{{ $module->name }}</li>        
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ $course->questions_to_ask }}</td>
                                <td class="action-btns">
                                    <button class="btn btn-primary edit-btn" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#course-modal"

                                    data-course-id="{{ $course->id }}" 
                                    data-course-name="{{ $course->name }}" 
                                    data-course-duration="{{ $course->duration }}" 
                                    data-course-fees="{{ $course->fees }}" 
                                    data-course-questions_to_ask="{{ $course->questions_to_ask }}" 
                                    data-course-modules_array='@json($course->modules)' 

                                    {{-- @foreach ($course->modules as $module)
                                        data-course-module="{{ $module->name }}" 
                                    @endforeach --}}
                                    >Edit</button>
                                    <button class="btn btn-danger del-btn" data-course-id="{{ $course->id }}">Delete</button>
                                </td>
                                <td>{!! date('h:i a <b>||</b> d M, Y', strtotime($course->created_at)) !!}</td>
                            </tr>

                            @php $count-- @endphp
                        @empty
                            No courses added
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
    $('#course-table').DataTable({
        dom: 'lBfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "aaSorting": []
    
    });

    $('#course-modal').on('hidden.bs.modal', function () {
        $(".modal form").trigger("reset");
        $(".modal .row input").val("");
    });

    $("#add-course-btn").click(function () {
        $(".modal-title").text("Add Course")
        $(".modal button[type=submit]").text("Add Course")
        $(".modal form").attr('action', '{{ route("admin_panel.process_addCourse") }}')
    })

    $("#add-module-btn").click(function () {
        // console.log($('.module')[($('.module')).length - 1])

        let html = `<div class="col-6 mb-3">
                        <label for="module-${$('.module').length + 1}" class="form-label mb-1">Enter Module ${$('.module').length + 1} Name</label>
                        <input type="text" name="modules[]" id="module-${$('.module').length + 1}" 
                        class="module w-100 form-control shadow-sm py-2 rounded-3 border-1 border-dark-subtle" placeholder="Enter Module Name">
                    </div>`;

        $(".modules-row").append(html)
        
    })
    
    $(document).on("click", ".edit-btn", function () {
        
        let course_id = $(this).data("course-id")
        let course_name = $(this).data("course-name")
        let course_duration = $(this).data("course-duration")
        let course_fees = $(this).data("course-fees")
        let questions_to_ask = $(this).data("course-questions_to_ask")
        let modules_array = $(this).data("course-modules_array")
    
        // Change modal for editting
        $(".modal-title").text("Edit Course")
        $(".modal button[type=submit]").text("Edit Course")
        $(".modal form").attr('action', `{{ route("admin_panel.process_editCourse") }}`)

        // console.log(modules_array);
        $("#course-id").val(course_id)
        $(".modal #course-name").val(course_name)
        $(".modal #fees").val(course_fees)
        $(".modal #duration").val(course_duration)
        $(".modal #questions-to-ask").val(questions_to_ask)

        let i = 1;
        let html = "";
        
        let module_ids_arr = [];
        modules_array.forEach(single_module => {
            html += `<div class="col-6 mb-3">
                        <label for="module-${i}" class="form-label mb-1">Enter Module ${i} Name</label>
                        <input type="text" name="modules[]" id="module-${i}" 
                        class="module w-100 form-control shadow-sm py-2 rounded-3 border-1 border-dark-subtle" placeholder="Enter Module Name" value="${single_module.name}">
                    </div>`;
            i++;
            module_ids_arr.push(single_module.id);
        })

        html += `<input name="module_ids_arr" value=${JSON.stringify(module_ids_arr)} type="hidden">`

        $(".modules-row").html(html);

        // console.log(module_ids_arr);
    })
    
    // Ajax call to delete course
    $(document).on('click', ".del-btn", function () {
        let course_id = $(this).data('course-id')
    
        fetch('/admin/courses/process_destroyCourse/'+course_id).then(function (response) {
            return response.json()
        }).then(function (result) {
            if (result == 1) {
                $('button[data-course-id="' + course_id + '"]').closest('tr').remove();
            } else {
                console.log(result);
            }
        })
    
    });

</script>
@endsection