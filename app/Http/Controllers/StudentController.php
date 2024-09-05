<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use App\Models\Student;
use App\Models\Course;
use App\Models\Fee;
use App\Models\Module;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PhpParser\JsonDecoder;

use function PHPUnit\Framework\fileExists;

class StudentController extends Controller
{
    function index() {
        $students = User::with('studentData')->with("studentData.course")->with("studentData.room_row")->where('role', 'student')->where('is_deleted', '0')->orderBy('id', 'desc')->get();
        $courses = Course::where('deactive', '0')->where('is_deleted', '0')->orderBy('id', 'desc')->get();
        $rooms = Room::where('is_deleted', '0')->orderBy('id', 'desc')->get();

        $studentsCount = $students->count();
        // return dd($students);
        return view('admin_panel.students', compact("students", 'studentsCount', 'courses', 'rooms'));
    }

    function import_students(Request $req) {
        // dd($req);
        $students = $req->all();

        $result = false;

        // Loop through each student in the array
        foreach ($students as $student) {
            // You can access individual fields from each student
            $serial_number = $student[0];
            $name = $student[1];
            // $email = strtolower(str_replace(' ', '', explode(" ", $name, 2)[0])) . "." . strtolower(str_replace(' ', '', explode(" ", $name, 2)[1])) . "@simsatedu.com";
            $father_name = $student[2];
            // $religion = $student[3];
            $dob = $student[4];
            $admission_date = $student[5];
            // $course = $student[6];
            $contact = $student[7];
            // $batch = $student[8];
            $fee = $student[9];
            $status = $student[10];
            $duration = $student[11];


            $name_arr = explode(" ", $name, 2);
            $first = $name_arr[0];
            $last = array_key_exists(1, $name_arr) ? $name_arr[1] : "default";
            $email = strtolower(str_replace(' ', '', $first)) . "." . strtolower(str_replace(' ', '', $last)) . "@simsatedu.com";

            $password = rand(1000, 9999);

            if ($status == "Active") {
                $status = "running";
            } elseif ($status == "Left") {
                $status = "left";                
            } elseif ($status == "Complete") {
                $status = "passed-out";               
            }

            // Process each student here, for example, save to the database
            $user = User::create([
                "name" => $name,
                "father_name" => $father_name,
                "cnic_bform_no" => "",
                "date_of_birth" => $dob,
                "email" => $email,
                "password" => $password,
                "mobile_no" => $contact,
                "profile_pic" => "0",
                "address" => "",
                "role" => "student",
                "token" => "-1",
                "is_deleted" => "0",
                "created_at" => Carbon::parse($admission_date)->format('Y-m-d H:i:s'),
                "updated_at" => Carbon::parse($admission_date)->format('Y-m-d H:i:s'),
            ]);
            if ($user) {

                $last_gr_no = Student::orderBy('id', 'desc')->first();
                $number = 1;
                if ($last_gr_no) {
                    $number = intval(explode("-", $last_gr_no->gr_no)[1]) + 1;
                }
                $gr_no = "SS-" . str_pad($number, 6, '0', STR_PAD_LEFT);
    

                $student = Student::create([
                    "gr_no" => $gr_no,
                    "course_id" => 1,
                    /* ------------------------------------------ */
                    "discount" => 0,
                    "annual_fees" => ($fee * $duration),
                    /* ------------------------------------------ */
                    "total_modules" => json_encode([]),
                    "completed_modules" => json_encode([]),
                    "status" => $status,
                    "room" => 1,
                    "seat" => "",
                    "timing" => "22-23",
                    "shift" => "",
                    "user_id" => $user->id,
                    "exclude" => 0,
                    "created_at" => Carbon::parse($admission_date)->format('Y-m-d H:i:s'),
                    "updated_at" => Carbon::parse($admission_date)->format('Y-m-d H:i:s'),
                ]);

                if ($student) {
                    if (count($students) == $serial_number) {
                        $result = true;
                    }
                } else {
                    return response()->json(["error student not create"]);
                }
                
            } else {
                return response()->json(["error user not create"]);
            }
        }
        
        if ($result) {
            return response()->json(["import successfullt."]);
            
        }
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
            "profile_pic" => "image|max:5000",
            "first_name" => "required",
            "last_name" => "required",
            "father_name" => "required",
            "course_id" => "required",
            "cnic_bform_no" => "required|numeric|digits:13",
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

        // Uploading profile pic
        $profile_pic = "0";
        
        if (isset($req->profile_pic)) {
            // $profile_pic = $req->profile_pic->store('admin_profile_pics', 'public');

            $name = $req->profile_pic->hashName();
            $req->profile_pic->move(public_path('storage/student_profile_pics/'), $name);
            $profile_pic = "student_profile_pics/".$name;
        }

        // Calculating Fees
        $course_row = Course::find($req->course_id);
        $monthly_fees = $course_row->fees;
        $duration = $course_row->duration;

        $discount = 0;
        $annual_fees = $monthly_fees * $duration;
        if (isset($req->discount)) {
            $discount = $req->discount;
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
            
            $modules = Module::where('course_id', $req->course_id)->where("is_deleted", "0")->pluck('id')->toArray();
            // $gr_no = "SS-" . str_pad($user->id, 6, '0', STR_PAD_LEFT);

            $student->gr_no = $gr_no;
            $student->course_id = $req->course_id;
            $student->discount = $discount;
            $student->annual_fees = $annual_fees;
            $student->total_modules = json_encode($modules);
            $student->completed_modules = json_encode([]);
            $student->status = 'running';
            $student->room = $req->room;
            $student->seat = $req->seat;
            $student->timing = $req->timing;
            $student->shift = $req->shift;
            $student->user_id = $user->id; // Assign the user's ID to the student
            if (isset($req->exclude)) {
                $student->exclude = '1';
            }

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
                'digits:13'
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

        $modules = Module::where('course_id', $req->course_id)->where("is_deleted", "0")->pluck('id')->toArray();

        $student->course_id = $req->course_id;
        $student->total_modules = json_encode($modules);
        $student->completed_modules = json_encode([]);
        $student->room = $req->room;
        $student->timing = $req->timing;
        $student->seat = $req->seat;
        $student->shift = $req->shift;
        if (isset($req->exclude)) {
            $student->exclude = '1';
        } else {
            $student->exclude = '0';
        }

        if (isset($req->profile_pic)) {
            $name = $req->profile_pic->hashName();
            $image_path = public_path('storage/' . $user->profile_pic);
            if (fileExists($image_path)) {
                @unlink($image_path);                
            }
            $req->profile_pic->move(public_path('storage/student_profile_pics/'), $name);
            $user->profile_pic = "student_profile_pics/".$name;
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
        // $user = User::with('studentData')->with('studentData.room_row')->with('studentData.course')->with('studentData.course.modules')->where("id", $id)->first();

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

        $attendance_rows = Attendance::where('student_id', $user->studentData->id)->orderBy('date', 'desc')->get();
        $fees = Fee::where("student_id", $user->studentData->id)->where("is_deleted", "0")->orderBy('id', 'desc')->get();
        $total_paid_fees = Fee::where("student_id", $user->studentData->id)->where("purpose", 'monthly')->where("is_deleted", '0')->sum("fees.amount");

        $month_attendances = Attendance::selectRaw("
            DATE_FORMAT(date, '%Y-%m') as month,
            SUM(CASE WHEN status = 'present' THEN 1 ELSE 0 END) as present,
            SUM(CASE WHEN status = 'absent' THEN 1 ELSE 0 END) as absent
        ")
        ->where('student_id', $user->studentData->id)
        ->groupBy('month')
        ->orderBy('month', 'desc')
        ->get();

        return view('admin_panel.singleStudent', compact('user' , "modules", 'attendance_rows', 'month_attendances', 'fees', "total_paid_fees"));
    }

    function module_handler(int $userId, string $action, int $moduleId) {
        // $_module = Module::find($moduleId);
        // $modules = Module::where('course_id', $_module->course_id)->where('is_deleted', "0")->get();

        // $total_modules = $modules->count();
        // return $total_modules;
        
        $student = Student::where("user_id", $userId)->first();
        $modules_arr = json_decode($student->completed_modules);

        $total_modules = count(json_decode($student->total_modules));

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
