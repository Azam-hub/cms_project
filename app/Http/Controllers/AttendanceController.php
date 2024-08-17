<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Room;
use App\Models\Roster;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    function today_students() {
        // Fetching students and today attendance
        // $current_date = ;
        $admin_id = Auth::user()->id;
        $date = date('Y-m-d');
        $number_of_day = Carbon::now()->format('N');
        // return $number_of_day;
        
        $hour = (int) date('G');
        $timing = $hour . "-" . ($hour + 1);

        $roster = Roster::where("timing", $timing)->where("admin_id", $admin_id)->where('is_deleted', "0")->first();

        $students = [];
        $count = '';
        
        if ($roster) {
            $room = $roster->room_id;
            $students = Student::with([
                        'user',
                        'course',
                        "attendance" => function ($query) use ($date) {
                            $query->where('date', $date);
                        }
            ])->where('room', $room)
            ->where('timing', $timing)
            ->where('status', "running")
            ->when($number_of_day > 5, 
            function ($query) {
                $query->where('shift', 'weekend');
            }, 
            function ($query) {
                $query->where('shift', 'regular');
            })
            ->orderBy('id', "desc")
            ->get();
            $count =  $students->count();
        }

        // return dd($students[1]->attendance);

        if ($students) {
            return view("admin_panel.attendance.attendanceToday", compact('students', "count"));
        } else {
            return view("admin_panel.attendance.attendanceToday", compact('students'))->with("error", "No students found or check your roster");
        }

    }

    function fetch_room_record(Request $req) {
        $rooms = Room::where("is_deleted", '0')->orderBy('id', "desc")->get();
        $currentRoute = $req->route()->getName();

        if ($currentRoute == "admin_panel.attendancePast") {
            return view("admin_panel.attendance.attendancePast", compact('rooms'));
        } elseif ($currentRoute == "admin_panel.attendanceReport") {
            return view("admin_panel.attendance.attendanceReport", compact('rooms'));
        }
    }

    function attendance_report($room, $timing, $startDate, $endDate) {
        // return [$room, $timing, $startDate, $endDate];

        // $attendances = Attendance::join("students", "students.id", "=", "attendances.student_id")
        // ->join("users", "users.id", "=", "students.user_id")
        // ->selectRaw("
        //     SUM(CASE WHEN status = 'present' THEN 1 ELSE 0 END) as present,
        //     SUM(CASE WHEN status = 'absent' THEN 1 ELSE 0 END) as absent
        // ")
        // ->where('students.room', $room)
        // ->where('students.timing', $timing)
        // ->where('students.status', "running")
        // ->whereBetween('attendances.date', [$startDate, $endDate])
        // ->orderBy('users.name', "asc")
        // ->groupBy('attendances.student_id')
        // ->get();

        $attendances = Attendance::join("students", "students.id", "=", "attendances.student_id")
        ->join("users", "users.id", "=", "students.user_id")
        ->join("courses", "courses.id", "=", "students.course_id")
        ->selectRaw("
            users.id,
            users.profile_pic,
            users.name AS user_name,
            users.father_name,
            courses.name AS course_name,
            students.gr_no,
            students.shift,
            SUM(CASE WHEN attendances.status = 'present' THEN 1 ELSE 0 END) as present,
            SUM(CASE WHEN attendances.status = 'absent' THEN 1 ELSE 0 END) as absent
        ")
        ->where('students.room', $room)
        ->where('students.timing', $timing)
        ->where('students.status', "running")
        ->whereBetween('attendances.date', [$startDate, $endDate])
        ->orderBy('users.name', "asc")
        ->groupBy('attendances.student_id', 'users.name')
        ->get();


        // $month_attendances = Attendance::selectRaw("
        //     DATE_FORMAT(date, '%Y-%m') as month,
        //     SUM(CASE WHEN status = 'present' THEN 1 ELSE 0 END) as present,
        //     SUM(CASE WHEN status = 'absent' THEN 1 ELSE 0 END) as absent
        // ")
        // ->where('student_id', $user->studentData->id)
        // ->orderBy('month', 'desc')
        // ->get();

        // $attendance = Attendance::where('date', $date)->get();

        return json_encode($attendances);
    }





    function fetch_students($room, $timing, $date) {

        // Fetching students and today attendance
        $students = Student::with([
                        'user',
                        'course',
                        "attendance" => function ($query) use ($date) {
                            $query->where('date', $date);
                        }
        ])->where('room', $room)
        ->where('timing', $timing)
        ->where('status', "running")
        ->orderBy('id', "desc")
        ->get();

        // $attendance = Attendance::where('date', $date)->get();

        return json_encode($students);

    }

    function marking_attendance(int $id, string $action, $date = null) {
        
        if (!isset($date)) {
            $date = date('Y-m-d');
        }

        if ($action == 'present') {

            $attendance = Attendance::where('student_id', $id)->where('date', $date)->first();

            if ($attendance) {
                $attendance->status = 'present';
            } else {
                $attendance = new Attendance;
        
                $attendance->student_id = $id;
                $attendance->date = $date;
                $attendance->status = 'present';
        
            }
            // return $date;
            if ($attendance->save()) {
                return 1;
            }
            
        } else {
            $attendance = Attendance::where('student_id', $id)->where('date', $date)->first();

            if ($attendance) {
                $attendance->status = 'absent';
            } else {
                $attendance = new Attendance;
        
                $attendance->student_id = $id;
                $attendance->date = $date;
                $attendance->status = "absent";
            }

            if ($attendance->save()) {
                return 1;
            }

        }
    }

}
