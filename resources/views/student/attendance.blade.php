@extends('student._layout')


@section('stylesheet')
    <!-- Light box link -->
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('title')
Home
@endsection


@section('content')

<section class="py-3">

    <div class="row flex-column ">
        <div class="section">
            
            <div class="col">
                <div class="col">
                    <h4 class="mb-3">Attendace Record</h4>
                </div>
            </div>
            <div class="col">
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
    
                            @forelse ($attendances as $attendance)
                                <tr>
                                    <td class="text-center py-2">{{ $attendance->date }}</td>
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
                                
                            @endforelse
                    
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection


@section('script')

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

$('#full-attendance-table, #month-attendance-table').DataTable({
    dom: 'lBfrtip',
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ],
    "aaSorting": []

});



</script>

@endsection
