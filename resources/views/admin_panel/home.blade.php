@extends('admin_panel._layout')


@section('stylesheet')
<link rel="stylesheet" href="{{ asset("admin_panel/css/home.css") }}">
@endsection


@section('content')


<section class="py-3">
    <div class="row mb-2">
        <div class="col">
            <h4 class="fw-bolder">General</h4>
        </div>
    </div>
    <div class="row">
        <div class="charts">
            <div class="chart">
                <h5>Enrollment Trend</h5>
                <canvas id="enrollment-chart"></canvas>
            </div>
            <div class="chart" >
                <h5>Revenue</h5>
                <canvas id="revenue-chart"></canvas>
            </div>
            <div class="chart course-popularity-div" >
                <h5>Course Occupation</h5>
                <canvas id="course-popularity-chart"></canvas>
            </div>
            <div class="chart" >
                <h5>Attendance</h5>
                <canvas id="attendance-chart"></canvas>
            </div>
        </div>
    </div>

</section>

@endsection

@section("script")
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset("chartjs/chart.js") }}"></script>
<script>

    let admissions_arr = @json($admissions_arr);
    const enrollment_chart = document.getElementById('enrollment-chart');
    const enrollment_data = {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul","Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [
            {
                label: 'Last Year',
                // data: [2, 3, 9, 5, 7, 3, 7, 4, 2, 6, 2, 5],
                // data: admissions_arr["2023"],
                data: admissions_arr[Object.keys(admissions_arr)[0]],
                // borderColor: '#c5c5c5',
                borderColor: '#b6bfc8',
                // backgroundColor: '#dadada',
                backgroundColor: '#ced4da',
                hoverBackgroundColor: "#b6bfc8",
                barThickness: 15,
                borderWidth: 1, 
            },
            {
                label: 'This Year',
                // data: [5, 4, 6, 7, 6, 6, 7, 3, 6, 3, 6, 3],
                // data: admissions_arr["2024"],
                data: admissions_arr[Object.keys(admissions_arr)[1]],
                // borderColor: '#e30b13',
                borderColor: '#0063cc',
                // backgroundColor: '#ff1f27',
                backgroundColor: '#007bff',
                hoverBackgroundColor: "#0063cc",
                barThickness: 15,
                borderWidth: 1, 
            },
        ]
    };
    new Chart(enrollment_chart, {
        type: 'bar',
        data: enrollment_data,
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


    let revenues_arr = @json($revenues_arr);
    const revenue_chart = document.getElementById('revenue-chart');
    const revenue_data = {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul","Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [
            {
                label: 'Last Year',
                // data: [5, 4, 6, 7, 6, 6, 7, 3, 6, 3, 6, 3],
                // data: revenues_arr["2023"],
                data: revenues_arr[Object.keys(revenues_arr)[0]],
                // borderColor: '#c5c5c5',
                borderColor: '#b6bfc8',
                // backgroundColor: '#dadada',
                backgroundColor: '#ced4da',
                hoverBackgroundColor: "#b6bfc8",
                barThickness: 15,
                borderWidth: 1, 
            },
            {
                label: 'This Year',
                // data: [2, 3, 9, 5, 7, 3, 7, 4, 2, 6, 2, 5],
                // data: revenues_arr["2024"],
                data: revenues_arr[Object.keys(revenues_arr)[1]],
                // borderColor: '#e30b13',
                borderColor: '#0063cc',
                // backgroundColor: '#ff1f27',
                backgroundColor: '#007bff',
                hoverBackgroundColor: "#0063cc",
                barThickness: 15,
                borderWidth: 1, 
            }
        ]
    };
    new Chart(revenue_chart, {
        type: 'bar',
        data: revenue_data,
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


    let courses_arr = @json($courses_arr);    
    const coursePopularity_chart = document.getElementById('course-popularity-chart');
    const coursePopularity_data = {
        labels: courses_arr.map((x) => x.name),
        datasets: [{
            // label: 'My First Dataset',
            data: courses_arr.map((x) => x.students),
            // backgroundColor: [
            //     'rgb(255, 99, 132)',
            //     'rgb(54, 162, 235)',
            //     'rgb(255, 205, 86)'
            // ],
            hoverOffset: 4
        }]
    };
    new Chart(coursePopularity_chart, {
        type: 'pie',
        data: coursePopularity_data,
        options: {
            radius: '70%', // Reduce the radius to shrink the chart
            responsive: true, // Ensures the chart adjusts based on canvas size
            maintainAspectRatio: false, // Allows you to customize the aspect ratio
            layout: {
                padding: 0 // Reduces padding around the chart
            },
            plugins: {
                legend: {
                    position: 'left', // Positions: 'top', 'bottom', 'left', 'right'
                    align: 'center', // Alignment: 'start', 'center', 'end'
                }
            }
        }
    });

    
    let attendances_arr = @json($attendances_arr);
    console.log(attendances_arr);
    
    const attendance_chart = document.getElementById('attendance-chart');
    const attendance_data = {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul","Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [
            {
                label: 'Presents',
                // data: [65, 59, 80, 81, 56, 55, 40, 59, 80, 81, 56, 55],
                data: attendances_arr["presents"],
                fill: false,
                borderColor: '#08a85e',
                backgroundColor: '#08a85e',

                tension: 0.1
            },
            {
                label: 'Absents',
                // data: [65, 59, 80, 81, 56, 55, 40, 59, 80, 81, 56, 55],
                data: attendances_arr["absents"],
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