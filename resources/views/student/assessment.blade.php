<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css')}}">
    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="{{ asset('jquery_ui/jquery-ui.min.css')}}">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('fontawesome-icons/css/all.min.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/_utils.css')}}">
    <!-- <link rel="stylesheet" href="css/_sidebar_header.css"> -->
    <link rel="stylesheet" href="{{ asset('css/assessment.css')}}">

    <link rel="shortcut icon" href="{{ asset('admin_panel/img/static/favicon.png')}}" type="image/x-icon">

    <title>Assessment - Simsat</title>
</head>
<body>
    <header class="row justify-content-between align-items-center border-bottom border-2 border-dark py-3 px-2">
        <div class="col-3  justify-content-center">
            <img src="{{ asset('img/static/logo.png') }}" alt="">
        </div>
        <div class="col-6 d-md-block d-none justify-content-center">
            
            <h2 class="text-center">Assessment of <span class="fw-bolder "><q>{{ $course_name }}</q></span></h2>
            <p class="text-center mb-0">Welcome, <b class="name"><q>{{ Auth::user()->name }}</q></b></p>
            
        </div>
        <div class="col-3 d-flex justify-content-end">
            {{-- <a href="logout.php" class="btn btn-secondary">Logout</a> --}}
            <img src="{{ asset('storage/'.Auth::user()->profile_pic ) }}" class="rounded-circle" width="55px" height="55px" alt="">
        </div>
    </header>
    <!-- <hr> -->
    <div class="container-md">
        
        <div class="row d-md-none d-block mt-3">
            <div class="col">
                <h2 class="text-center mb-1">Assessment of <span class="fw-bolder "><q>{{ $course_name }}</q></span></h2>
                <p class="text-center mb-2">Welcome, <b class="name"><q>{{ Auth::user()->name }}</q></b></p>
            </div>
        </div>
        
        <div class="box py-3 px-3 mt-3 rounded-3 border border-1 border-dark shadow">
            <div class="intro">
                <div class="text-center border-bottom border-1 border-dark">
                    <h2>Get Started</h2>
                </div>
                <div class="para mt-3 mb-1">
                    <h4>Instructions</h4>
                    <ul class="mb-2">
                        <li>You will have 2 minutes for each question.</li>
                        <li>You must select an option of each question.</li>
                        <li>If time become over, the question will be marked as not attempt and marks will be deducted.</li>
                    </ul>
                    <p class="text-center fs-5 fw-bolder m-0"><q>Best of Luck !</q></p>
                </div>
                <div class="btn-div">
                    <button class="btn btn-secondary" id="get-started-btn">Get Started</button>
                </div>
            </div>
            <div class="question">
                <div class="row justify-content-between">
                    <div class="col-auto px-0">
                        <b>Timer:</b> <span id="timer">02:00</span>
                    </div>
                    <div class="col-auto px-0">
                        <b>Question:</b> <span id="current-question"></span>/<span id="total-questions"></span>
                    </div>
                </div>
                {{-- <div class="row my-2">
                    <div class="col px-0">
                        <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar" style="width: 100%;">02:00</div>
                        </div>
                    </div>
                </div> --}}
                <div class="question bg-secondary text-light p-3 rounded-3" id="question">
                    <p class="m-0"></p>
                </div>
                <div class="options my-3">
                    <div class="option my-2" id="option-1-div">
                        <input type="radio" class="form-check-input" name="option" id="option-1">
                        <label class="ms-1 cursor-pointer" for="option-1"></label>
                    </div>
                    <div class="option my-2" id="option-2-div">
                        <input type="radio" class="form-check-input" name="option" id="option-2">
                        <label class="ms-1 cursor-pointer" for="option-2"></label>
                    </div>
                    <div class="option my-2" id="option-3-div">
                        <input type="radio" class="form-check-input" name="option" id="option-3">
                        <label class="ms-1 cursor-pointer" for="option-3"></label>
                    </div>
                    <div class="option my-2" id="option-4-div">
                        <input type="radio" class="form-check-input" name="option" id="option-4">
                        <label class="ms-1 cursor-pointer" for="option-4"></label>
                    </div>
                </div>
                <div class="btn-div">
                    <button type="submit" class="btn btn-secondary" id="submit-btn">Submit</button>
                </div>
            </div>
            <div class="result">
                <div class="text-center border-bottom border-1 border-dark">
                    <h2>Result</h2>
                </div>
                <div class="row my-3">
                    <div class="col px-0 row flex-column">
                        <div class="col">
                            <p class="mb-2">
                                <b>Total Questions:</b> <span id="result-total-questions"></span>
                            </p>
                        </div>
                        <div class="col">
                            <p class="mb-0">
                                <b class="text-success">Correct Answers:</b> <span id="correct-answers"></span>
                            </p>
                        </div>
                        <div class="col">
                            <p class="mb-0">
                                <b class="text-danger">Wrong Answers:</b> <span id="wrong-answers"></span>
                            </p>
                        </div>
                        <div class="col">
                            <p class="mb-0">
                                <b>Skipped Questions:</b> <span id="skipped-questions"></span>
                            </p>
                        </div>
                    </div>

                    <div class="col px-0 row flex-column">
                        <p class="mb-2">
                            <b>Total marks:</b> <span id="total-marks"></span>
                        </p>
                        <p class="mb-0">
                            <b>Obtained marks:</b> <span id="obtained-marks"></span>
                        </p>
                        <p class="mb-0">
                            <b>Percentage:</b> <span id="percentage"></span> 
                        </p>
                        <p class="mb-0">
                            <b>Grade:</b> <span id="grade"></span> 
                        </p>
                    </div>
                </div>
                <div class="btn-div">
                    <a href="{{ route('student.home') }}" class="btn btn-secondary" id="finish-btn">Finish</a>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- jQuery Link -->
<script src="{{ asset('js/jquery.js')}}"></script>

<!-- Ionicon Link -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    
<script>
    // function to add leading zeros
    function padWithLeadingZeros(num, totalLength) {
        return String(num).padStart(totalLength, '0');
    }
    // function to shuffle array elements
    function shuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
        return array;
    }

    // Function to send answers and receive response
    function send_answers(answers_array) {
        $(".question").hide()
        $(".result").show()

        let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        fetch('/assessment/answer_checker', {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken // Include CSRF token in the headers
            },
            body: JSON.stringify({
                "answers_arr": answers_array,
            })
        }).then(function (response) {
            return response.json();
        }).then(function (json_data) {
            
            let result = json_data;

            let total_questions = $("#total-questions").text()
            let total_marks = parseInt(total_questions)

            let number_of_correct = result[0];
            let number_of_wrong = result[1];
            let number_of_skipped = result[2];

            $("#result-total-questions").text(total_questions)
            $("#correct-answers").text(number_of_correct)
            $("#wrong-answers").text(number_of_wrong)
            $("#skipped-questions").text(number_of_skipped)

            $("#total-marks").text(total_marks)
            $("#obtained-marks").text(number_of_correct)

            let percentage = ((number_of_correct * 100) / total_marks).toFixed(2);
            $("#percentage").text(`${percentage}%`)

            let grade;
            if (percentage > 90) {
                grade = "A+"
            } else if (percentage > 80) {
                grade = "A1"
            } else if (percentage > 70) {
                grade = "A"
            } else if (percentage > 60) {
                grade = "B"
            } else if (percentage > 50) {
                grade = "C"
            } else if (percentage > 40) {
                grade = "D"
            } else {
                grade = "FAIL!"
            }

            $("#grade").text(grade)


        })
    }

    $("#get-started-btn").click(function () {
        
        $(".intro").hide()
        $(".question").show()
        // Answers object
        let answers = {};

        let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content')

        fetch('/assessment/questions_fetcher', {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken // Include CSRF token in the headers
            },
            body: JSON.stringify({
                "student_id": '{{ Auth::user()->id }}',
            }),
        }).then(function (response) {
            return response.json();
        }).then(function (json_data) {
            
            let parent_array = json_data;
            console.log(parent_array);

            if (parent_array.length == 0) {
                alert('No question added of this course.')
                history.back()
            }
            // Printing total number of questions
            let questions_to_ask = (parent_array.length);
            $("#total-questions").text(questions_to_ask)

            // Function to push questions
            let time;
            function question_fetcher(parent_array_index) {
                
                let question_id = parent_array[parent_array_index]["question_id"]

                $("#question p").attr("data-parent-array-index", parent_array_index)
                $("#question p").attr("data-question-id", question_id)
                $("#question p").text(parent_array[parent_array_index]["question"])
    
                let options_arr = parent_array[parent_array_index]["options"]
                let shuffled_options_arr = shuffleArray(options_arr)
    
                $("#option-1-div label").text(shuffled_options_arr[0])
                $("#option-2-div label").text(shuffled_options_arr[1])
                $("#option-3-div label").text(shuffled_options_arr[2])
                $("#option-4-div label").text(shuffled_options_arr[3])
    
                $("#option-1-div input").val(shuffled_options_arr[0])
                $("#option-2-div input").val(shuffled_options_arr[1])
                $("#option-3-div input").val(shuffled_options_arr[2])
                $("#option-4-div input").val(shuffled_options_arr[3])

                $("#current-question").text(parent_array_index + 1)
                
                $(".options input").prop("checked", false);

                let seconds = 120;
                time = setInterval(() => {
                    seconds--
                    
                    // Showing time
                    let crr_minutes = padWithLeadingZeros(parseInt(seconds / 60), 2)
                    let crr_seconds = padWithLeadingZeros(parseInt(seconds - (crr_minutes * 60)), 2)
                    $("#timer").text(`${crr_minutes}:${crr_seconds}`)
                    // let percentage = (seconds/120)*100;
                    // $(".progress-bar").css("width", percentage + "%")
                    
                    if (seconds == 0) {
                        
                        // Pushing statement
                        answers[question_id] = "skipped-by-student";
                        clearInterval(time)
                        
                        // Pushing next question
                        parent_array_index++
                        if (parent_array.length > parent_array_index) {
                            // $(".progress-bar").css("width", "100%")
                            question_fetcher(parent_array_index)
                        } else {
                            send_answers(answers)
                        }
                    }
                    
                }, 1000);

            }
            
            question_fetcher(0)
            
            $("#submit-btn").click(function () {
                
                let parent_array_index = parseInt($("#question p").attr("data-parent-array-index"))
                
                // Getting user answer
                let selected_option = $(".options input:checked").val()

                if (!($(".options input").is(':checked'))) {
                    alert("Please select an option.")
                } else {
                    let question_id = parent_array[parent_array_index]["question_id"]
    
                    answers[question_id] = selected_option;
    
                    clearInterval(time)
                    // Pushing next question
                    parent_array_index++
                    if (parent_array.length > parent_array_index) {
                        question_fetcher(parent_array_index)
                    } else {
                        send_answers(answers)
                    }
                    
                }
            })

        })
    })
</script>

</html>



