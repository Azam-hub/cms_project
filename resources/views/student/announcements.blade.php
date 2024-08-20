@extends('student._layout')


@section('stylesheet')
    <!-- Light box link -->
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('title')
Announcements
@endsection


@section('content')

<section class="py-3">

    <div class="row flex-column ">
        <div class="section">
            <div class="col">
                <div class="col">
                    <h4 class="mb-3">Announcements</h4>
                </div>
            </div>

            <div class="col">
                <div class="announcements">
                    @forelse ($announcements as $announcement)
                        <div class="announcement bg-white my-3 p-3 border rounded-3 shadow">
                            <div class="head row justify-content-between border-bottom border-dark-subtle">
                                <div class="col-auto px-0">
                                    <h4>{{ $announcement->title }}</h4>
                                </div>
                                <div class="col-auto px-0">
                                    <i class="fa-regular fa-calendar-days"></i> 
                                    <span class="ms-1">11 August, 2024</span>
                                </div>
                            </div>
                            <div class="description mt-3 mb-1">
                                {{ $announcement->description }}
                            </div>
                        </div>
                    @empty
                        "No Announcements yet."
                    @endforelse
                    <!-- <div class="announcement bg-white p-3 rounded-2 my-3 shadow">
                        <div class="head border-bottom border-dark-subtle">
                            <h4>Fee Reminder</h4>
                        </div>
                        <div class="description mt-3 mb-1">
                            Your Month is about to end.
                        </div>
                    </div>
                    <div class="announcement bg-white p-3 rounded-2 my-3 shadow">
                        <div class="head border-bottom border-dark-subtle">
                            <h4>Fee Reminder</h4>
                        </div>
                        <div class="description mt-3 mb-1">
                            Your Month is about to end.
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>

</section>
@endsection


@section('script')

<script>

$('#fees-table').DataTable({
    dom: 'lBfrtip',
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ],
    "aaSorting": []

});



</script>

@endsection
