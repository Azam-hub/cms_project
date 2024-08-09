<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use App\Models\Student;
use App\Models\Course;
use App\Models\Fee;
use App\Models\Module;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use function PHPUnit\Framework\fileExists;

class StudentController extends Controller
{
    function index() {
        $students = User::with('studentData')->with("studentData.course")->where('role', 'student')->where('is_deleted', '0')->orderBy('id', 'desc')->get();
        $courses = Course::where('is_deleted', '0')->orderBy('id', 'desc')->get();
        $rooms = Room::where('is_deleted', '0')->orderBy('id', 'desc')->get();

        $studentsCount = $students->count();
        return view('admin_panel.students', compact("students", 'studentsCount', 'courses', 'rooms'));
    }

    function process_addStudent(Request $req) {

        // ----------------------- Course 2 letters GR no ----------------------------

        // $course = Course::find($req->course_id);
        // $code = "";
        // foreach (explode(" ", $course->course_name) as $word) {
        //     $code .= strtoupper($word[0]);
        // }
        // return $code;



        // Validating Information
        $req->validate([
            "profile_pic" => "required|image|max:5000",
            "first_name" => "required",
            "last_name" => "required",
            "father_name" => "required",
            "course_id" => "required",
            "cnic_bform_no" => "required|numeric|digits:13|unique:users,cnic_bform_no",
            "dob" => "required",
            "mobile_no" => "required|numeric|digits:11",
            "discount" => "numeric",
            "address" => "required",
            "password" => "required|confirmed",
            "password_confirmation" => "required",
            "room" => "required",
            "timing" => "required",
            "seat" => "required",
            "shift" => "required",
        ]);

        // Uploading profile pic
        $profile_pic = $req->profile_pic->store('student_profile_pics', 'public');

        // Calculating Fees
        $course_row = Course::find($req->course_id);
        $monthly_fees = $course_row->fees;
        $duration = $course_row->duration;

        $annual_fees = $monthly_fees * $duration;
        if ($req->discount) {
            $annual_fees = $annual_fees - (($req->discount / 100) * ($annual_fees));
        }
        

        // Generating Email
        $email = strtolower(str_replace(' ', '', $req->first_name)) . "." . strtolower(str_replace(' ', '', $req->last_name)) . "@simsatedu.com";

        // Check whether email exist and make it correct form to store in database
        $check_email_row = User::where("email", $email)->first();
        if ($check_email_row) {
            $first_part = explode("@", $email)[0];
            $last_email_row = User::where("email", "like", $first_part."\_%")->orderBy("id", 'desc')->first();
            
            if ($last_email_row) {
                $last_email = $last_email_row->email;

                $number = explode("_", explode("@", $last_email)[0])[1];
                $email = strtolower(str_replace(' ', '', $req->first_name)) . "." . strtolower(str_replace(' ', '', $req->last_name)) . "_" . ($number + 1) . "@simsatedu.com";
            } else {
                $email = strtolower(str_replace(' ', '', $req->first_name)) . "." . strtolower(str_replace(' ', '', $req->last_name)) . "_1@simsatedu.com";
            }
        }
        
        // Define validation rules
        // $rules = [
        //     'email' => 'required|email|unique:users,email'
        // ];

        // // Create a Validator instance
        // $validator = Validator::make(['email' => $email], $rules);

        // if ($validator->fails()) {
        //     return redirect()->route('admin_panel.students')->with("error", "Email <b>$email</b> already exists!");
            
        // } else {}
        
        $last_gr_no = Student::orderBy('id', 'desc')->first();
        
        $number = 1;
        if ($last_gr_no) {
            $number = intval(explode("-", $last_gr_no->gr_no)[1]) + 1;
        }
        $gr_no = "SS-" . str_pad($number, 6, '0', STR_PAD_LEFT);

        // Save data in database
        $user = new User;
        $student = new Student;

        $user->name = $req->first_name . " " . $req->last_name;
        $user->father_name = $req->father_name;
        $user->cnic_bform_no = $req->cnic_bform_no;
        $user->date_of_birth = $req->dob;
        $user->email = $email;
        $user->password = $req->password;
        $user->mobile_no = $req->mobile_no;
        $user->profile_pic = $profile_pic;
        $user->address = $req->address;
        $user->role = "student";
        $user->token = "-1";
        $user->is_deleted = "0";
        
        
        // Save the user first
        if ($user->save()) {
            $student->gr_no = $gr_no;
            $student->course_id = $req->course_id;
            $student->discount = $req->discount;
            $student->annual_fees = $annual_fees;
            $student->completed_modules = json_encode([]);
            $student->status = 'running';
            $student->room = $req->room;
            $student->seat = $req->seat;
            $student->timing = $req->timing;
            $student->shift = $req->shift;
            $student->user_id = $user->id; // Assign the user's ID to the student

            // Save the student
            if ($student->save()) {
                return redirect()->route('admin_panel.students')->with("success", "Student has been added successfully and <b><q>".$email."</q></b> email has been generated.");
            } else {
                // If saving the student fails, delete the user to avoid orphan records
                $user->delete();
                return redirect()->route('admin_panel.students')->with("error", "Something went wrong!");
            }
        } else {
            return redirect()->route('admin_panel.students')->with("error", "Something went wrong!");
        }
        
    }

    function process_editStudent(Request $req) {

        $req->validate([
            "name" => "required",
            "father_name" => "required",
            "email" => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($req->student_id),
            ],
            "course_id" => "required",
            "cnic_bform_no" => [
                'required',
                'numeric',
                'digits:13',
                Rule::unique('users', 'cnic_bform_no')->ignore($req->student_id),
            ],
            "dob" => "required",
            "mobile_no" => "required|numeric|digits:11",
            "address" => "required",
            "password" => "required|confirmed",
            "password_confirmation" => "required",
            "room" => "required",
            "timing" => "required",
            "seat" => "required",
            "shift" => "required",
        ]);


        $user = User::find($req->student_id);
        $student = Student::where("user_id", $req->student_id)->first();

        $user->name = $req->name;
        $user->father_name = $req->father_name;
        $user->cnic_bform_no = $req->cnic_bform_no;
        $user->date_of_birth = $req->dob;
        $user->email = $req->email;
        $user->mobile_no = $req->mobile_no;
        $user->address = $req->address;
        $user->password = $req->password;

        $student->course_id = $req->course_id;
        $student->room = $req->room;
        $student->timing = $req->timing;
        $student->seat = $req->seat;
        $student->shift = $req->shift;

        if (isset($req->profile_pic)) {
            $image_path = storage_path('app/public/' . $user->profile_pic);
            if (fileExists($image_path)) {

                if (@unlink($image_path)) {
                    $profile_pic = $req->profile_pic->store('student_profile_pics', 'public');
                    $user->profile_pic = $profile_pic;
                } else {
                    return redirect()->route('admin_panel.students')->with("error", "Profile Picture can't be updated.");
                }

            }
        }


        if ($user->save() && $student->save()) {
            return redirect()->route('admin_panel.students')->with("success", "Student data has been updated successfully.");
        } else {
            return redirect()->route('admin_panel.students')->with("error", "Something went wrong!");
        }

    }

    function process_destroyStudent(int $id) {
        $user = User::find($id);

        $user->is_deleted = '1';

        if ($user->save()) {
            return response()->json(['success' => 'Admin has been deleted successfully.']);
        } else {
            return response()->json(['error' => 'Something went wrong!.']);
        }
    }

    function process_statusChangeStudent(int $id, string $action) {
        $student = Student::where('user_id', $id)->first();

        function check_seat($student) {
            $room = $student->room;
            $seat = $student->seat;
            $timing = $student->timing;

            $check_student = Student::with('user')->where('room', $room)->where('seat', $seat)->where('timing', $timing)->where('status', "running")->first();
            if ($check_student) {
                $name = $check_student->user->name;
                $gr_no = $check_student->gr_no;
                return [$name, $gr_no];
            } else {
                return true;
            }
        }

        $check = "";
        $ok = false;
        // $gr_no = "";
        if ($action == "Freeze") {
            $student->status = 'freezed';
            $ok = true;
        } elseif ($action == "Unfreeze") {
            $check = check_seat($student);
            if ($check === true) {
                $student->status = 'running';
                $ok = true;            
            }
        } elseif ($action == "Left") {
            $student->status = 'left';
            $ok = true;
        } elseif ($action == 'Re-enroll') {
            $check = check_seat($student);
            if ($check === true) {
                $student->status = 'running';
                $ok = true;
            }
        } elseif ($action == "Allow") {
            $student->status = 'pending';
            $ok = true;
        } elseif ($action == "Disallow") {
            $student->status = 'completed';
            $ok = true;
        } elseif ($action == "Again") {
            $student->status = 'pending';
            $ok = true;
        } elseif ($action == "Pass Out") {
            $student->status = 'passed-out';
            $ok = true;
        }


        if ($ok == true) {
            if ($student->save()) {
                return 1;
            }
        } else {
            return response()->json([
                "status" => "seat not available",
                "name" => $check[0],
                "gr_no" => $check[1],
            ]);
        }
        
    }




    function fetch_single_student(int $id) {
        $user = User::with('studentData')->with('studentData.course')->with('studentData.course.modules')->where("id", $id)->first();
        $attendance_rows = Attendance::where('student_id', $user->studentData->id)->orderBy('id', 'desc')->get();
        $fees = Fee::where("student_id", $user->studentData->id)->get();

        $month_attendances = [];
        foreach ($attendance_rows as $i => $attendance_row) {
            $date = $attendance_row->date;
            $date = substr($date, 0, 7);
            $status = $attendance_row->status;
            
            if (array_key_exists($date, $month_attendances)) {
                $presents = $month_attendances[$date]["present"];
                $absents = $month_attendances[$date]["absent"];

                if ($status == 'present') {
                    $month_attendances[$date]["present"] = $presents + 1;
                } elseif ($status == 'absent') {
                    $month_attendances[$date]["absent"] = $absents + 1;
                }

            } else {
                if ($status == 'present') {
                    $month_attendances[$date] = ["present" => 1, "absent" => 0];
                } elseif ($status == 'absent') {
                    $month_attendances[$date] = ["present" => 0, "absent" => 1];
                }
            }            
        }
        // dd($attendances);
        return view('admin_panel.singleStudent', compact('user', 'attendance_rows', 'month_attendances', 'fees'));
    }

    function module_handler(int $userId, string $action, int $moduleId) {
        $_module = Module::find($moduleId);
        $modules = Module::where('course_id', $_module->course_id)->get();

        $total_modules = $modules->count();
        // return $total_modules;

        $student = Student::where("user_id", $userId)->first();
        $modules_arr = json_decode($student->completed_modules);

        // return $modules_arr;
        if ($action == "add") {
            array_push($modules_arr, $moduleId);
            if ($total_modules == count($modules_arr)) {
                $student->status = 'completed';
            }
        } elseif ($action == "remove") {
            if (($key = array_search($moduleId, $modules_arr)) !== false) {
                array_splice($modules_arr, $key, 1);
            }
            $student->status = 'running';
        }

        // return [$userId, $action, $moduleId, $student];
        $student->completed_modules = json_encode($modules_arr);

        if ($student->save()) {
            return 1;
        }
    }
}

// INSERT INTO `users`(`gr_no`, `name`, `father_name`, `course_id`, `cnic_bform_no`, `date_of_birth`, `email`, `password`, `mobile_no`, `profile_pic`, `address`, `assessment_status`, `role`, `token`, `is_deleted`, `created_at`, `updated_at`) VALUES ('SS-123455','Muhammad Azam','checks','4','42201','qqsxw','bb@fwdf.com','-1','03333333333','SS-123455.jpg','Lal qila','not-allowed','student','-1','1','2023-09-26 04:23:31', '')
// ["A","4","11-12"]
// ["C","3","5-6"]
// ["C","7","7-8"]
// ["B","4","5-6"]