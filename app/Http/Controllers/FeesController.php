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
        $submitted_fees = Fee::orderBy('id', "desc")->get();

        // $pending_fees = Fee::orderBy('id', "desc")->get();

        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Fetch rows older than a month where student_id hasn't been added in the current month
        // $pending_fees = Fee::join("students", "students.id", "=", "fees.student_id")
        // ->join("users", "users.id",  "=", "students.user_id")
        // ->join("rooms", "rooms.id",  "=", "students.room")
        // ->selectRaw('
        // gr_no, 
        // users.name AS user_name, 
        // timing, 
        // rooms.name AS room_name, 
        // student_id, 
        // MAX(fees.month) AS last_month, 
        // MAX(fees.created_at) AS last_created_at, 
        // MAX(fees.id) AS last_id'
        // )
        // ->where('students.status', "running")
        // ->where('fees.created_at', '<', Carbon::now()->subMonth())
        // ->whereNotIn('fees.student_id', function ($query) use ($startOfMonth, $endOfMonth) {
        //     $query
        //     ->select('fees.student_id')
        //     ->from('fees')
        //     ->whereBetween('fees.created_at', [$startOfMonth, $endOfMonth]);
        // })
        // ->groupBy("student_id")
        // ->where('students.exclude', '0')
        // ->get();

        // $pending_fees = Student::join("fees", "fees.student_id", "=", "students.id")
        // ->join("users", "users.id",  "=", "students.user_id")
        // ->join("rooms", "rooms.id",  "=", "students.room")
        // ->selectRaw('
        // gr_no, 
        // users.name AS user_name, 
        // timing, 
        // rooms.name AS room_name, 
        // student_id AS fee_student_id'
        // )
        // ->where('students.status', "running")
        // ->where(function ($query) use ($startOfMonth, $endOfMonth) {
        //     // $query->where('fees.created_at', '<', Carbon::now()->subMonth())
        //     // ->orWhere("");
        //     $query->whereNotIn('fees.student_id', function ($query) use ($startOfMonth, $endOfMonth) {
        //         $query
        //         ->select('fees.student_id')
        //         ->from('fees')
        //         ->whereBetween('fees.created_at', [$startOfMonth, $endOfMonth]);
        //     })
            
        //     ;
        // })
        // ->where('purpose', "=", "monthly")
        // ->groupBy("fees.student_id")
        // ->where('students.exclude', '0')
        // ->get()
        // ;
        
        $pending_fees = Student::leftJoin('fees', function ($join) use ($startOfMonth, $endOfMonth) {
            $join->on('fees.student_id', '=', 'students.id')
                 ->where('fees.purpose', '=', 'monthly')
                 ->whereBetween('fees.created_at', [$startOfMonth, $endOfMonth]);
        })
        ->join("users", "users.id",  "=", "students.user_id")
        ->join("rooms", "rooms.id",  "=", "students.room")
        ->selectRaw('
        students.gr_no, 
        users.name AS user_name, 
        students.timing, 
        rooms.name AS room_name, 
        fees.student_id AS fee_student_id,
        students.id AS student_p_id
        ')
        ->whereNull('fees.id') // Check where no entry exists in fees for the current month with purpose 'monthly'
        ->where('students.status', 'running')
        ->where('students.exclude', '0')
        // ->where('students.room', '3')
        // ->where('students.timing', '17-18')
        // ->orderBy("students.gr_no", "asc")
        ->orderBy("users.name", "asc")
        ->get();

        // return dd($pending_fees);
        foreach ($pending_fees as $pending_fee) {
            echo $pending_fee->gr_no. " : " .$pending_fee->user_name;
            echo "<br>";
            echo $pending_fee->month. " : " .$pending_fee->created_at;
            echo "<br>";
            echo "<br>";
        }

        return view("admin_panel.fees", compact("rooms", "submitted_fees"));

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
        $total_paid_fees = Fee::where("student_id", $id)->where("purpose", 'monthly')->sum("fees.amount");
        $last_two_entries = Fee::where("student_id", $id)->orderBy('id', 'desc')->take(2)->get();
        $last_month_row = Fee::where("month", "!=", "-")->where("student_id", $id)->orderBy("id", 'desc')->first();

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
}
