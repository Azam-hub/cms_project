@extends('student._layout')


@section('stylesheet')
<link rel="stylesheet" href="{{ asset('css/result.css') }}">
@endsection


@section('title')
    Results
@endsection


@section('content')
    
<div class="section py-3">
    <div class="row  my-2">
        <div class="col-auto">
            <h2 class="fw-semibold">Results</h2>
        </div>
    </div>
    @forelse ($results as $result)
        <div class="row justify-content-end my-2">
            <div class="col-auto">
                <button class="btn btn-secondary print-result-btn">Print Result</button>
            </div>
        </div>
        @php
            
            $total_marks = $result->correct_answers;
            $percentage = number_format(($total_marks / $result->user->studentData->course->questions_to_ask) * 100, 2);

            $grade;
            if ($percentage > 90) {
                $grade = "A+";
            } elseif ($percentage > 80) {
                $grade = "A1";
            } elseif ($percentage > 70) {
                $grade = "A";
            } elseif ($percentage > 60) {
                $grade = "B";
            } elseif ($percentage > 50) {
                $grade = "C";
            } elseif ($percentage > 40) {
                $grade = "D";
            } else {
                $grade = "FAIL!";
            }
        
        @endphp

        <!-- <div class="row mb-2">
            <div class="col-auto">
                <button class="btn btn-secondary print-result-btn">Print Result</button>
            </div>
        </div> -->
        <div class="result-div">
            <div class="result" id="result">
                <h2>Result of <q>{{ $result->user->studentData->course->name }}</q></h2>
                <div class="fields">
                    <div class="field">
                        <span class="label">G.R. No.</span>
                        <span class="text">{{ $result->user->studentData->gr_no }}</span>
                    </div>
                    <div class="field">
                        <span class="label">Name</span>
                        <span class="text">{{ $result->user->name }}</span>
                    </div>
                    <div class="field">
                        <span class="label">Date of Assessment</span>
                        <span class="text">{!! date('h:i a <b>||</b> d M, Y', strtotime($result->created_at)) !!}</span>
                    </div>
                    <div class="field">
                        <span class="label">Total number of questions</span>
                        <span class="text">{{ $result->user->studentData->course->questions_to_ask }}</span>
                    </div>
                    <div class="field">
                        <span class="label">Correct Questions</span>
                        <span class="text">{{ $result->correct_answers }}</span>
                    </div>
                    <div class="field">
                        <span class="label">Wrong Questions</span>
                        <span class="text">{{ $result->wrong_answers }}</span>
                    </div>
                    <div class="field">
                        <span class="label">Skipped Questions</span>
                        <span class="text">{{ $result->skipped_questions }}</span>
                    </div>
                    <div class="field">
                        <span class="label">Total Marks</span>
                        <span class="text">{{ $total_marks }}</span>
                    </div>
                    <div class="field">
                        <span class="label">Percentage</span>
                        <span class="text">{{ $percentage }}%</span>
                    </div>
                    <div class="field">
                        <span class="label">Grade</span>
                        <span class="text">{{ $grade }}</span>
                    </div>
                </div>
            </div>
        </div>
    @empty
        No result Added
    @endforelse
        

</div>

@endsection


@section('script')
<script>
    $(".print-result-btn").click(function () {
        var contents = $(this).parent().parent().next().html();
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html><head><title>Result</title>');
        frameDoc.document.write('</head><body>');
        //Append the external CSS file.
        frameDoc.document.write('<link href="css/result.css" rel="stylesheet" type="text/css" />');
        //Append the DIV contents.
        frameDoc.document.write(contents);
        frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);
    });
</script>
@endsection




{{-- @if (session('success'))
    {!! success_msg(session('success')) !!}
@elseif (session('error'))
    {!! danger_msg(session('error')) !!}
@endif

@if ($errors->any())
    @php
        $msg = "{}{}{}{} can't be added. Try again!
                <ul class='m-0'>";
                    foreach ($errors->all() as $error) {
                        $msg .= "<li>$error</li>";
                    }
                $msg .= "</ul>";
    @endphp
    {!! danger_msg($msg) !!}
@endif --}}