@extends('student._layout')


@section('stylesheet')
    <!-- Light box link -->
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('title')
Attendance
@endsection


@section('content')

<section class="py-3">

    <div class="section">
        <div class="row flex-column ">
            
            <div class="col">
                <div class="col">
                    <h4 class="mb-3">Attendace Record</h4>
                </div>
            </div>
            <div class="col-auto align-self-center" style="width: 70%">
                <div>
                    <canvas id="attendance-chart"></canvas>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset("chartjs/chart.js") }}"></script>

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

let attendances_arr = @json($month_attendances);
attendances_arr.reverse()

const attendance_chart = document.getElementById('attendance-chart');
const attendance_data = {
    // labels: attendances_arr.map((element) => element.month),
    labels: attendances_arr.map((element) => new Date(element.month).toLocaleString('en-US', { month: 'short', year: '2-digit' })),
    datasets: [
        {
            label: 'Presents',
            // data: [65, 59, 80, 81, 56, 55, 40, 59, 80, 81, 56, 55],
            // data: attendances_arr,
            data: attendances_arr.map((element) => element.present),
            fill: false,
            borderColor: '#08a85e',
            backgroundColor: '#08a85e',

            tension: 0.1
        },
        {
            label: 'Absents',
            // data: [65, 59, 80, 81, 56, 55, 40, 59, 80, 81, 56, 55],
            // data: attendances_arr,
            data: attendances_arr.map((element) => element.absent),
            fill: false,
            borderColor: '#ff1f27',
            backgroundColor: '#ff1f27',

            tension: 0.1
        }
    ]
};
new Chart(attendance_chart, {
    type: 'line',
    data: attendance_data,
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            legend: {
                position: 'bottom', // Positions: 'top', 'bottom', 'left', 'right'
                align: 'center', // Alignment: 'start', 'center', 'end'
            }
        },
    }
});

</script>

@endsection
