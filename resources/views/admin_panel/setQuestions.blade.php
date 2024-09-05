@extends('admin_panel._layout')


@section('stylesheet')
    
@endsection


@section('content')

<!-- Update Email Modal -->
<div class="modal fade" id="question-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Questions</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin_panel.process_addQuestion') }}">
                @csrf
                
                <input type="hidden" id="question-id" name="question_id">
                <input type="hidden" name="course_id" value="{{ $course->id }}">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg mb-3">
                            <label for="question" class="form-label mb-1 required-label">Enter Question</label>
                            <input type="text" name="question" id="question" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('question') ? 'is-invalid' : 'border-dark-subtle' }}" placeholder="Enter Question" value="{{ old('question') }}">
                            <span class="text-danger error-msg">@error('question') {{ $message }} @enderror</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col mb-3">
                            <label for="correct-option" class="form-label mb-1 required-label">Enter Correct Option</label>
                            <input type="text" name="correct_option" id="correct-option" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('correct_option') ? 'is-invalid' : 'border-success' }}" placeholder="Enter Correct Option" value="{{ old('correct_option') }}">
                            <span class="text-danger error-msg">@error('correct_option') {{ $message }} @enderror</span>
                        </div>
                    </div>
                    <div class="row flex-column">
                        <label for="other-options" class="col form-label mb-2 required-label">Enter Other Options</label>
                        <div class="col-lg-6 col mb-2">
                            <input type="text" name="option_1" id="other-option-1" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('option_1') ? 'is-invalid' : 'border-danger' }}" placeholder="Enter Other Option 1" value="{{ old('option_1') }}">
                            <span class="text-danger error-msg">@error('option_1') {{ $message }} @enderror</span>
                        </div>
                        <div class="col-lg-6 col mb-2">
                            <input type="text" name="option_2" id="other-option-2" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('option_2') ? 'is-invalid' : 'border-danger' }}" placeholder="Enter Other Option 2" value="{{ old('option_2') }}">
                            <span class="text-danger error-msg">@error('option_2') {{ $message }} @enderror</span>
                        </div>
                        <div class="col-lg-6 col mb-2">
                            <input type="text" name="option_3" id="other-option-3" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('option_3') ? 'is-invalid' : 'border-danger' }}" placeholder="Enter Other Option 3" value="{{ old('option_3') }}">
                            <span class="text-danger error-msg">@error('option_3') {{ $message }} @enderror</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
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
        $msg = "Question can't be added. Try again!
                <ul class='m-0'>";
                    foreach ($errors->all() as $error) {
                        $msg .= "<li>$error</li>";
                    }
                $msg .= "</ul>";
    @endphp
    {!! danger_msg($msg) !!}
@endif


<section class="py-3">
    <div class="row justify-content-center mb-2">
        <div class="col-auto">
            <h3 class="text-center">Questions of <b class="d-sm-inline d-block"><q>{{ $course->name }}</q></b></h3>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col">
            <h5 class="fw-semibold">Add Question</h5>
            <!-- <button class="btn btn-secondary" id="add-question-btn" data-bs-toggle="modal" data-bs-target="#question-modal">Add</button> -->
            <button class="btn btn-secondary" id="add-question-btn">Add</button>
        </div>
    </div>
    <div class="row flex-column ">
        <div class="col">
            <h5 class="fw-semibold">Questions</h5>
        </div>
        <div class="col">
            <div class="table-responsive">
                <table id="question-table" class="table table-striped table-bordered table-hover border-dark-subtle">
                    <thead>
                        <tr>
                            <th>S. No.</th>
                            <th>Questions</th>
                            <th>Correct Option</th>
                            <th>Other 3 Options</th>
                            <th class="action-btns">Action</th>
                            <th>Added On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($questions as $question)
                            <tr>
                                <td>{{ $questions_count }}.</td>
                                <td>{{ $question->question }}</td>
                                <td class="text-break">{{ $question->options->correct_option }}</td>
                                <td>
                                    <ul>
                                        <li class="text-break">{{ json_decode($question->options->other_options)[0] }}</li>
                                        <li class="text-break">{{ json_decode($question->options->other_options)[1] }}</li>
                                        <li class="text-break">{{ json_decode($question->options->other_options)[2] }}</li>
                                    </ul>
                                </td>
                                <td class="text-center">
                                    <!-- data-bs-toggle="modal" 
                                    data-bs-target="#question-modal" -->
                                    <button 
                                    class="btn btn-sm btn-primary edit-btn" 

                                    data-question-id="{{ $question->id }}" 
                                    data-question="{{ $question->question }}" 
                                    data-question-correct_option="{{ $question->options->correct_option }}" 
                                    data-question-other_option_1="{{ json_decode($question->options->other_options)[0] }}" 
                                    data-question-other_option_2="{{ json_decode($question->options->other_options)[1] }}" 
                                    data-question-other_option_3="{{ json_decode($question->options->other_options)[2] }}" 

                                    >Edit</button>
                                    <button class="btn btn-sm btn-danger del-btn" data-question-id="{{ $question->id }}">Delete</button>
                                </td>
                                <td>{!! date('h:i a <b>||</b> d M, Y', strtotime($question->created_at)) !!}</td>
                            </tr>
                            @php $questions_count-- @endphp
                        @empty
                            No questions are added.
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
$('#question-table').DataTable({
    dom: 'lBfrtip',
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ],
    "aaSorting": []

});

$(".modal form").submit(function (e) {
    let prevent = false;
    
    $(".error-msg").html("")
    
    $(".modal form input:not([type='hidden'])").each(function(i, element) {
        if ($(element).val() == "") {
            prevent = true;
            $(element).next().html("This field is required.")
        }
    });

    if (prevent) {
        e.preventDefault()
    }
})

$('#question-modal').on('hidden.bs.modal', function (e) {
    $(".modal form").trigger("reset");
    $(".error-msg").html("")
});


$("#add-question-btn").click(function() {
    $(".modal-title").text("Add Question")
    $(".modal form").attr('action', '{{ route("admin_panel.process_addQuestion") }}')

    // Opening Modal
    const questionModal = new bootstrap.Modal('#question-modal')
    questionModal.show()
})

$(".edit-btn").click(function () {
        // let question_id = $(this).data("question-id")

        let question_id = $(this).data('question-id')
        let question = $(this).data('question')
        let correct_option = $(this).data('question-correct_option')
        let option_1 = $(this).data('question-other_option_1')
        let option_2 = $(this).data('question-other_option_2')
        let option_3 = $(this).data('question-other_option_3')

        $('#question-id').val(question_id)

        $("#question").val(question)
        $("#correct-option").val(correct_option)
        $("#other-option-1").val(option_1)
        $("#other-option-2").val(option_2)
        $("#other-option-3").val(option_3)

        $(".modal-title").text("Edit Question")
        $(".modal form").attr('action', '{{ route("admin_panel.process_editQuestion") }}')

        // Opening Modal
        const questionModal = new bootstrap.Modal('#question-modal')
        questionModal.show()
        
    })

    $(".del-btn").click(function () {
        let question_id = $(this).data("question-id")

        custom_confirm(`Are you sure you want to delete this question?`, function(confirm) {
            if (confirm) {
                fetch('/admin/set_questions/process_destroyQuestion/' + question_id).then(function (response) {
                    return response.json()
                }).then(function (result) {
                    
                    if (result.success) {
                        $('button[data-question-id="' + question_id + '"]').closest('tr').remove();
                    } else {
                        console.log(result);
                    }
                })
            }
        });

    })

</script>

@endsection

