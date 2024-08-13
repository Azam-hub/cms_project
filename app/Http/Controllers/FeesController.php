<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Student;
use Illuminate\Support\Carbon;

class FeesController extends Controller
{
    
    function index() {
        $rooms = Room::where('is_deleted', '0')->orderBy('id', 'desc')->get();
        $submitted_fees = Fee::with(['student', 'student.room_row', 'student.user'])->where("is_deleted", "0")->orderBy('id', "desc")->get();
        $submitted_fees_count = $submitted_fees->count();

        // $pending_fees = Fee::orderBy('id', "desc")->get();

        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // $pending_fees = Student::leftJoin('fees', function ($join) use ($startOfMonth, $endOfMonth) {
        //     $join->on('fees.student_id', '=', 'students.id')
        //          ->where('fees.purpose', '=', 'monthly')
        //         //  ->whereBetween('fees.created_at', [$startOfMonth, $endOfMonth]);
        //         ->where('fees.created_at', '>', Carbon::now()->subMonth());
        // })
        // ->join("users", "users.id",  "=", "students.user_id")
        // ->join("rooms", "rooms.id",  "=", "students.room")
        // ->selectRaw('
        // students.gr_no, 
        // users.name AS user_name, 
        // students.timing, 
        // rooms.name AS room_name, 
        // fees.student_id AS fee_student_id,
        // students.id AS student_p_id
        // ')
        // ->whereNull('fees.id') // Check where no entry exists in fees for the current month with purpose 'monthly'
        // ->where('students.status', 'running')
        // ->where('students.exclude', '0')    
        // ->orderBy("users.name", "asc")
        // ->get();

        $pending_fees = Student::leftJoin('fees', 'fees.student_id', '=', 'students.id')
        ->join("users", "users.id", "=", "students.user_id")
        ->join("rooms", "rooms.id", "=", "students.room")
        ->selectRaw('
            students.id AS student_id,
            students.gr_no, 
            users.id AS user_id, 
            users.name AS user_name, 
            users.father_name, 
            students.timing, 
            rooms.name AS room_name, 
            (SELECT fees.purpose 
                FROM fees 
                WHERE fees.student_id = students.id 
                AND fees.is_deleted = 0 
                ORDER BY fees.created_at DESC 
                LIMIT 1
            ) AS last_fee_purpose,
            MAX(CASE WHEN fees.is_deleted = 0 THEN fees.month ELSE NULL END) AS last_fee_month, 
            MAX(CASE WHEN fees.is_deleted = 0 THEN fees.created_at ELSE NULL END) AS last_fee_date
        ')
        ->whereNotIn('students.id', function ($query) use ($startOfMonth, $endOfMonth) {
            $query->select('fees.student_id')
            ->from('fees')
            ->where('fees.purpose', '=', 'monthly')
            ->where('fees.is_deleted', '=', '0')
            // ->whereBetween('fees.created_at', [$startOfMonth, $endOfMonth]);
            ->where('fees.created_at', '>', Carbon::now()->subMonth());
        })
        ->where('students.status', 'running')
        ->where('students.exclude', '0')
        // ->groupBy('students.id', 'students.gr_no', 'users.name', 'students.timing', 'rooms.name', 'fees.student_id')
        ->groupBy('students.id')
        ->orderBy('users.name', 'asc')
        ->get();

        $pending_fees_count = $pending_fees->count();


        
        // foreach ($pending_fees as $pending_fee) {
        //     echo $pending_fee->gr_no. " : " .$pending_fee->user_name;
        //     echo "<br>";
        //     echo $pending_fee->last_fee_date. " : " .$pending_fee->last_fee_month. " : " .$pending_fee->last_fee_purpose;
        //     echo "<br>";
        //     echo "<br>";
        // }
        // dd($pending_fees);

        return view("admin_panel.fees", compact("rooms", "submitted_fees", "submitted_fees_count", "pending_fees", "pending_fees_count"));
    }

    function fetch_students($room, $timing) {
        $students = Student::where('room', $room)
        ->where("timing", $timing)
        ->where(function ($q) {
            $q->where("status", "running")
            ->orWhere("status", "completed")
            ->orWhere("status", "done");
        })
        ->join('users', 'students.user_id', '=', 'users.id')
        ->where("users.is_deleted", "0")
        ->orderBy('users.name', 'asc')
        ->select('students.id AS student_p_id', 'students.gr_no', "users.name", "users.father_name")
        ->get();
        
        return response()->json($students);
    }

    function fetch_student_fee_record($id) {
        $student_row = Student::with(['user', 'course'])->where("id", $id)->first();
        $total_paid_fees = Fee::where("student_id", $id)->where("purpose", 'monthly')->where("is_deleted", '0')->sum("fees.amount");
        $last_two_entries = Fee::where("student_id", $id)->where("is_deleted", '0')->orderBy('id', 'desc')->take(2)->get();
        $last_month_row = Fee::where("month", "!=", "-")->where("student_id", $id)->where("is_deleted", '0')->orderBy("id", 'desc')->first();

        $current_month = Carbon::now();

        if ($last_month_row) {
            // Get the next month using Carbon
            list($month, $year) = explode('-', $last_month_row->month);
            // Create a Carbon date from the month and year
            $date = Carbon::createFromDate($year, $month, 1);

            // Add one month
            $next_month_year = $date->addMonth();
        } else {
            // If no fee records exist, start from the current month
            $next_month_year = $current_month;
        }



        $next_month = $next_month_year->format('n');
        $next_year = $next_month_year->year;
        $current_month_year = $current_month->format('F') . " " . $current_month->year;

        $total_annual_fees = $student_row->annual_fees;
        $name = $student_row->user->name;
        $status = $student_row->status;

        $duration = $student_row->course->duration;
        $per_month_fees = ceil(($total_annual_fees / $duration) / 10) * 10;

        $arr = [
            "name" => $name, 
            "status" => $status, 
            "total_annual_fees" => $total_annual_fees, 
            "per_month_fees" => $per_month_fees, 
            "total_paid_fees" => $total_paid_fees, 
            "last_two_entries" => $last_two_entries, 
            "current_month_year" => $current_month_year, 
            "next_month" => $next_month,
            "next_year" => $next_year
        ];

        return response()->json($arr);
    }

    function process_addRecord(Request $req) {
        // return $req;
        $req->validate([
            "amount" => "required|numeric",
            "purpose" => "required",
            "description" => "required",
        ]);

        $fee = new Fee;

        $fee->amount = $req->amount;
        $fee->purpose = $req->purpose;
        $fee->description = $req->description;
        $fee->student_id = $req->student_id;

        if ($req->purpose == "monthly") {
            $req->validate([
                "month" => "required",
                "year" => "required",
            ]);

            $fee->month = $req->month . "-" . $req->year;
        } else {
            $fee->month = "-";
        }

        if ($fee->save()) {

            $fee_student = Fee::with(["student", "student.user", "student.course"])->where("id", $fee->id)->first();
            $total_paid_fees = Fee::where("student_id", $req->student_id)->where("purpose", 'monthly')->sum("fees.amount");

            list($startTime, $endTime) = explode('-', $fee_student->student->timing);
            $formattedTimeRange = date('g A', strtotime($startTime . ':00')) . ' to ' . date('g A', strtotime($endTime . ':00'));

            $formattedDate = "";
            if ($fee_student->month == "-") {
                $formattedDate = "-";
            } else {
                $date = Carbon::createFromFormat('n-Y', $fee_student->month);
                $formattedDate = $date->format('M Y');
            }

            $duration = $fee_student->student->course->duration;
            
            $per_month_fees = ceil(($fee_student->student->annual_fees / $duration) / 10) * 10;

            return redirect()->route('admin_panel.fees')->with([
                'success' => 'Fee Record has been added successfully.',
                'data' => [
                    "slip_no" => $fee_student->id,
                    "gr_no" => $fee_student->student->gr_no,
                    "name" => $fee_student->student->user->name,
                    "father_name" => $fee_student->student->user->father_name,
                    "timing" => $formattedTimeRange,
                    "course" => $fee_student->student->course->name,
                    "purpose" => $fee_student->purpose,
                    "fee_month" => $formattedDate,
                    "monthly_fee" => $per_month_fees,
                    "balance" => ($fee_student->student->annual_fees - $total_paid_fees),
                    "amount" => $fee_student->amount,
                    "date" => Carbon::now()->format('d M, Y'),
                ],
            ]);
        } else {
            return redirect()->route('admin_panel.fees')->with('error', 'Something went wrong!');
        }

        // return $req;
    }

    function process_editRecord(Request $req) {
        $req->validate([
            "student_id" => "required",
            "fees_id" => "required",
            "amount" => "required|numeric",
            "purpose" => "required",
            "description" => "required",
        ]);

        $fee = Fee::find($req->fees_id);

        $fee->amount = $req->amount;
        $fee->purpose = $req->purpose;
        $fee->description = $req->description;

        if ($req->purpose == "monthly") {
            $req->validate([
                "month" => "required",
                "year" => "required",
            ]);

            $fee->month = $req->month . "-" . $req->year;
        } else {
            $fee->month = "-";
        }

        if ($fee->save()) {

            $fee_student = Fee::with(["student", "student.user", "student.course"])->where("id", $fee->id)->first();
            $total_paid_fees = Fee::where("student_id", $req->student_id)->where("purpose", 'monthly')->sum("fees.amount");

            list($startTime, $endTime) = explode('-', $fee_student->student->timing);
            $formattedTimeRange = date('g A', strtotime($startTime . ':00')) . ' to ' . date('g A', strtotime($endTime . ':00'));

            $formattedDate = "";
            if ($fee_student->month == "-") {
                $formattedDate = "-";
            } else {
                $date = Carbon::createFromFormat('n-Y', $fee_student->month);
                $formattedDate = $date->format('M Y');
            }

            $duration = $fee_student->student->course->duration;
            
            $per_month_fees = ceil(($fee_student->student->annual_fees / $duration) / 10) * 10;

            return redirect()->route('admin_panel.fees')->with([
                'success' => 'Fee Record has been added successfully.',
                'data' => [
                    "slip_no" => $fee_student->id,
                    "gr_no" => $fee_student->student->gr_no,
                    "name" => $fee_student->student->user->name,
                    "father_name" => $fee_student->student->user->father_name,
                    "timing" => $formattedTimeRange,
                    "course" => $fee_student->student->course->name,
                    "purpose" => $fee_student->purpose,
                    "fee_month" => $formattedDate,
                    "monthly_fee" => $per_month_fees,
                    "balance" => ($fee_student->student->annual_fees - $total_paid_fees),
                    "amount" => $fee_student->amount,
                    "date" => Carbon::now()->format('d M, Y'),
                ],
            ]);
        } else {
            return redirect()->route('admin_panel.fees')->with('error', 'Something went wrong!');
        }
    }
    
    function process_destroyRecord($id) {
        // return $id;
        $fee = Fee::find($id);
        $fee->is_deleted = "1";
        
        if ($fee->save()) {
            return 1;
        }
    }

    function process_excludeStudent($id) {
        // return $id;
        $student = Student::find($id);
        $student->exclude = "1";
        if ($student->save()) {
            return 1;
        }
    }
}
