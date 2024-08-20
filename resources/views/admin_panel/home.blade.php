@extends('admin_panel._layout')


@section('stylesheet')
<link rel="stylesheet" href="{{ asset("admin_panel/css/home.css") }}">
@endsection


@section('content')
{{--
<!-- Update Email Modal -->
<div class="modal fade" id="update-email-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Email</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <!-- <input type="hidden" name="id">
                    <div class="fields">
                        <div class="field">
                            <label for="update-email">Enter Email</label>
                            <input type="text" name="email" id="update-email" placeholder="Enter Email">
                        </div>
                    </div> -->
                    <div class="row">
                        <div class="col px-1">
                            <label for="update-email" class="form-label">Enter Email</label>
                            <input type="email" name="email" id="update-email" class="form-control border-1 border-dark"
                                placeholder="Enter Email">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="update-email">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Password Modal -->
<div class="modal fade" id="update-password-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Email</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col px-1">
                            <label for="old-password" class="form-label mb-1">Enter Password</label>
                            <div class="position-relative">
                                <input type="password" name="old-password" id="old-password"
                                    class="w-100 form-control shadow-sm py-2 rounded-3 border-1 border-dark-subtle"
                                    placeholder="Enter Old Password">
                                <ion-icon name="eye-outline"
                                    class="eye cursor-pointer position-absolute top-50 end-0 translate-middle fs-4">
                                </ion-icon>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col px-1">
                            <label for="new-password" class="form-label mb-1">Enter Password</label>
                            <div class="position-relative">
                                <input type="password" name="new-password" id="new-password"
                                    class="w-100 form-control shadow-sm py-2 rounded-3 border-1 border-dark-subtle"
                                    placeholder="Enter New Password">
                                <ion-icon name="eye-outline"
                                    class="eye cursor-pointer position-absolute top-50 end-0 translate-middle fs-4">
                                </ion-icon>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col px-1">
                            <label for="confirm-new-password" class="form-label mb-1">Enter Confirm Password</label>
                            <div class="position-relative">
                                <input type="password" name="confirm-new-password" id="confirm-new-password"
                                    class="w-100 form-control shadow-sm py-2 rounded-3 border-1 border-dark-subtle"
                                    placeholder="Re-enter New Password">
                                <ion-icon name="eye-outline"
                                    class="eye cursor-pointer position-absolute top-50 end-0 translate-middle fs-4">
                                </ion-icon>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="update-password">Update</button>
                </div>
            </form>
        </div>
    </div>
</div> --}}

{{-- {{ Auth::user() }} --}}
<section class="py-3">
    <div class="row mb-2">
        <div class="col">
            <h4 class="fw-bolder">General</h4>
        </div>
        {{-- <div class="col">
            <div class="box"></div>
        </div> --}}
    </div>
    <div class="row">
        <div class="charts d-none">
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
<script>
    const enrollment_chart = document.getElementById('enrollment-chart');
    const enrollment_data = {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul","Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [
            {
                label: 'Last Year',
                data: [2, 3, 9, 5, 7, 3, 7, 4, 2, 6, 2, 5],
                borderColor: '#c5c5c5',
                backgroundColor: '#dadada',
                barThickness: 15,
                borderWidth: 1, 
            },
            {
                label: 'This Year',
                data: [5, 4, 6, 7, 6, 6, 7, 3, 6, 3, 6, 3],
                borderColor: '#e30b13',
                backgroundColor: '#ff1f27',
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

    let courses = [
        {
            name: "Web",
            students: 30,
        },
        {
            name: "Graphics",
            students: 40,
        },
        {
            name: "PCIT",
            students: 70,
        },
    ]
    const coursePopularity_chart = document.getElementById('course-popularity-chart');
    const coursePopularity_data = {
        labels: courses.map((x) => x.name),
        datasets: [{
            label: 'My First Dataset',
            data: courses.map((x) => x.students),
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

    const revenue_chart = document.getElementById('revenue-chart');
    const revenue_data = {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul","Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [
            {
                label: 'Last Year',
                data: [5, 4, 6, 7, 6, 6, 7, 3, 6, 3, 6, 3],
                // borderColor: '#36A2EB',
                // backgroundColor: '#9BD0F5',
                borderColor: '#c5c5c5',
                backgroundColor: '#dadada',
                barThickness: 15,
                borderWidth: 1, 
            },
            {
                label: 'This Year',
                data: [2, 3, 9, 5, 7, 3, 7, 4, 2, 6, 2, 5],
                // borderColor: '#FF6384',
                // backgroundColor: '#FFB1C1',
                borderColor: '#e30b13',
                backgroundColor: '#ff1f27',
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

    const attendance_chart = document.getElementById('attendance-chart');
    const attendance_data = {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul","Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
            label: 'My First Dataset',
            data: [65, 59, 80, 81, 56, 55, 40, 59, 80, 81, 56, 55],
            fill: false,
            borderColor: '#ff1f27',
            backgroundColor: '#ff1f27',

            tension: 0.1
        }]
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