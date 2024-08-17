@extends('admin_panel._layout')


@section('stylesheet')
    
@endsection


@section('content')
<section class="py-3">
    <div class="row flex-column">
        <div class="col">
            <h4 class="fw-semibold">Results</h4>
        </div>
        <div class="col">
            <div class="table-responsive">
                <table id="result-table" class="table table-striped table-bordered table-hover border-dark-subtle">
                    <thead>
                        <tr>
                            <th>S. No.</th>
                            <th>G.R. No.</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Total Question</th>
                            <th>Correct Answers</th>
                            <th>Wrong Answers</th>
                            <th>Skipped Questions</th>
                            <th>Action</th>
                            <th>Added On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($results as $result)
                            <tr data-student-id="{{ $result->user_id }}">
                                <td>{{ $resultCount }}.</td>
                                <td>{{ $result->user->studentData->gr_no }}</td>
                                <td>{{ $result->user->name }}</td>
                                <td>{{ $result->user->studentData->course->name }}</td>
                                <td>{{ $result->user->studentData->course->questions_to_ask }}</td>
                                <td>{{ $result->correct_answers }}</td>
                                <td>{{ $result->wrong_answers }}</td>
                                <td>{{ $result->skipped_questions }}</td>
                                <td>
                                    <button class="btn btn-sm btn-danger del-btn" data-result-id="{{ $result->id }}">Delete</button>
                                </td>
                                <td>{!! date ('h:i a <b>||</b> d M, Y', strtotime($result->created_at)) !!}</td>
                            </tr>    
                            @php $resultCount-- @endphp

                        @empty
                            No result Added
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
    $('#result-table').DataTable({
        dom: 'lBfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "aaSorting": []

    });

    // Delete data method
    $(document).on("click", ".del-btn", function () {
        let result_id = $(this).data("result-id")

        fetch('/admin/results/process_destroyResult/' + result_id).then(function (response) {
            return response.json()
        }).then(function (result) {
            
            if (result.success) {
                $('button[data-result-id="' + result_id + '"]').closest('tr').remove();
            } else {
                console.log(result);
            }
        })
        
    })

</script>
@endsection




