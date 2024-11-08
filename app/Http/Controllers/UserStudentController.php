<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Attendance;
use App\Models\Fee;
use App\Models\Module;
use App\Models\Option;
use App\Models\Result;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserStudentController extends Controller
{
    function fetch_single_student() {
        $id = Auth::user()->id;

        $user = User::
        with([
            'studentData',
            'studentData.room_row',
            'studentData.course'
        ])
        ->where("id", $id)
        ->first();
        
        $total_modules_ids = json_decode($user->studentData->total_modules);
        $modules = Module::whereIn('id', $total_modules_ids)->get(['id', 'name']);

        // dd($student);
        return view('student.profile', compact('user', "modules"));
    }

    function announcement() {
        $id = Auth::id();

        // $pending_fees = Fee::join("students", "students.id", "=", "fees.student_id")
        // ->where("students.user_id", $id)
        // ->whereNotIn('students.id', function ($query) {
        //     $query->select('fees.student_id')
        //     ->from('fees')
        //     ->where('fees.purpose', '=', 'monthly')
        //     ->where('fees.is_deleted', '=', '0')
        //     ->where('fees.created_at', '>', Carbon::now()->subMonth());
        // })
        // ->get();

        $pending_fees = Fee::join("students", "students.id", "=", "fees.student_id")
        ->selectRaw("fees.created_at AS fee_created_at, fees.month, students.status")
        ->where("students.user_id", $id)
        ->orderBy("fees.id", "desc")
        ->first();

        $announcements = Announcement::leftJoin("students", "students.id", "=", "announcements.student_id")
        ->select("announcements.title", "announcements.description", "announcements.created_at")
        ->where(function ($q) use ($id) {
            $q->where("announcements.student_id", "0")
            ->orWhere("students.user_id", $id);
        })
        ->where("announcements.is_deleted", "0")
        ->orderBy("announcements.id", "desc")
        ->get();

        $announcements = collect($announcements);
        $currentDate = Carbon::now();

        $student = Student::where("user_id", $id)->first();

        if ($student->status == "completed") {
            $custom_announcement = [
                "title" => "Examination Process",
                "description" => "You are ready for exam. Please pay examination fees and concern your teacher.",
                "created_at" => "",
            ];
            $announcements->prepend((object) $custom_announcement);
        } elseif ($student->status == "pending") {
            $custom_announcement = [
                "title" => "Examination Reminder",
                "description" => "You are allowed for exam. Please concern your teacher for exam.",
                "created_at" => "",
            ];
            $announcements->prepend((object) $custom_announcement);
        }
        
        if ($student->exclude == "0") {
            
            if ($pending_fees) {
                if ($pending_fees->status == "running") {
                    $lastPaymentDate = Carbon::parse($pending_fees->fee_created_at);
                    $nextDueDate = $lastPaymentDate->addMonth();
                
                    $daysLeft = $currentDate->diffInDays($nextDueDate, false);
                
                    if ($pending_fees->month == "-") {
                        $custom_announcement = [
                            "title" => "Fee Reminder",
                            "description" => "Please pay monthly fees.",
                            "created_at" => "",
                        ];
                        $announcements->prepend((object) $custom_announcement);
                    } 
                    elseif ($daysLeft <= 5 && $daysLeft > 0) {
                        $custom_announcement = [
                            "title" => "Fee Reminder",
                            "description" => "Your current month is about to end after $daysLeft day(s).",
                            "created_at" => "",
                        ];
                        $announcements->prepend((object) $custom_announcement);
                    } 
                    elseif ($daysLeft == 0) {
                        $custom_announcement = [
                            "title" => "Fee Reminder",
                            "description" => "Your month is about to end tomorrow.",
                            "created_at" => "",
                        ];
                        $announcements->prepend((object) $custom_announcement);
                    }
                    elseif ($daysLeft < 0) {
                        $last_month = Carbon::createFromFormat('n-Y', $pending_fees->month);
                        $last_month = $last_month->format('F Y');
    
                        $custom_announcement = [
                            "title" => "Fee Reminder",
                            "description" => "Your month ($last_month) has been ended. Please pay your fees.",
                            "created_at" => "",
                        ];
                        $announcements->prepend((object) $custom_announcement);
                    }
                }
            } else {
                $custom_announcement = [
                    "title" => "Fee Reminder",
                    "description" => "Please pay registration and monthly fees.",
                    // "created_at" => $currentDate->format("Y-m-d H:i:s"),
                    "created_at" => "",
                ];
                $announcements->prepend((object) $custom_announcement);
            }
        }
        
        return view("student.announcements", compact("announcements"));
    }

    function attendance() {
        $id = Auth::user()->id;
        $user = User::with('studentData')->where("id", $id)->first();

        $attendances = Attendance::where('student_id', $user->studentData->id)->orderBy('date', 'desc')->get();
        $month_attendances = Attendance::selectRaw("
                    DATE_FORMAT(date, '%Y-%m') as month,
                    SUM(CASE WHEN status = 'present' THEN 1 ELSE 0 END) as present,
                    SUM(CASE WHEN status = 'absent' THEN 1 ELSE 0 END) as absent
                ")
                ->where('student_id', $user->studentData->id)
                ->groupBy('month')
                ->orderBy('month', 'desc')
                ->get();

        return view("student.attendance", compact("attendances", "month_attendances"));
    }
    
    function fees_record() {
        $id = Auth::user()->id;
        $user = User::with('studentData')->where("id", $id)->first();
        
        $fees = Fee::where("student_id", $user->studentData->id)->where("is_deleted", "0")->orderBy('id', 'desc')->get();
        $total_paid_fees = Fee::where("student_id", $user->studentData->id)->where("purpose", 'monthly')->where("is_deleted", '0')->sum("fees.amount");

        return view("student.fees_record", compact("fees", "total_paid_fees"));
    }

    function assessment() {
        $id = Auth::user()->id;
        $user = User::with('studentData')->with('studentData.course')->where("id", $id)->first();

        if ($user->studentData->status == 'pending') {
            $course_name = $user->studentData->course->name;
            return view('student.assessment', compact('course_name'));
        } else {
            return redirect()->route("student.home");
        }
    }

    function questions_fetcher(Request $req) {
        
        $user = User::with([
            'studentData',
            'studentData.course',
        ])->where('id', $req->student_id)->first();
        
        if ($user && $user->studentData && $user->studentData->course) {
            $course = $user->studentData->course;
            $limit = $course->questions_to_ask;
        
            $user->load([
                'studentData.course.questions' => function ($q) use ($limit) {
                    $q->where('is_deleted', '0')->inRandomOrder()->limit($limit);
                },
                'studentData.course.questions.options'
            ]);
        }
        
        
        // $questions_arr = [
        //     $user->studentData->course->questions_to_ask,
        // ];

        $questions_arr = [];
        
        foreach ($user->studentData->course->questions as $question_row) {
            
            $question_id = $question_row->id;
            $question = $question_row->question;
            $correct_option = $question_row->options->correct_option;
            $other_options_arr = json_decode($question_row->options->other_options);

            $other_option_1 = $other_options_arr[0];
            $other_option_2 = $other_options_arr[1];
            $other_option_3 = $other_options_arr[2];

            $question_arr = [
                "question_id" => $question_id,
                "question" => $question,
                "options" => [$correct_option, $other_option_1, $other_option_2, $other_option_3]
            ];

            array_push($questions_arr, $question_arr);
        }

        return response()->json($questions_arr);
    }

    function answer_checker(Request $req) {
        // Function to count occurences
        function occurences_count($arr, $value) {
            $occurences = count(array_filter($arr, function ($item) use ($value) {
                return $item == $value;
            }));
            return $occurences;
        }

        $answers_arr = $req->answers_arr;

        $result = [];

        foreach ($answers_arr as $question_id => $answer) {

            $options_row = Option::where('question_id', $question_id)->first();
            $correct_option = $options_row->correct_option;
    
            if ($answer != "skipped-by-student") {
                if ($answer == $correct_option) {
                    array_push($result, "correct");
                } else {
                    array_push($result, "wrong");
                }
            } else {
                array_push($result, "skipped");
            }
        }

        $number_of_correct = occurences_count($result, "correct");
        $number_of_wrong = occurences_count($result, "wrong");
        $number_of_skipped = occurences_count($result, "skipped");


        $user_id = Auth::user()->id;

        $result = new Result;
        $result->correct_answers = $number_of_correct;
        $result->wrong_answers = $number_of_wrong;
        $result->skipped_questions = $number_of_skipped;
        $result->user_id = $user_id;
        $result->is_deleted = '0';

        if ($result->save()) {

            $student_row = Student::where("user_id", $user_id)->first();
            $student_row->status = 'done';
            $student_row->save();
        }

        $output = [$number_of_correct, $number_of_wrong, $number_of_skipped];

        return response()->json($output);
    }


    function results() {
        $user_id = Auth::user()->id;
        $result = Result::where("user_id", $user_id)->first();
        if ($result) {
            $results = Result::with(['user', "user.studentData", "user.studentData.course"])->where('user_id', $user_id)->where('is_deleted', "0")->get();
            // dd($user);
            return view('student.results', compact('results'));
        } else {
            return redirect()->route("student.home");
        }
    }
}
