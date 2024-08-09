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

        return view("admin_panel.fees", compact("rooms"));
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
        $per_month_fees = $total_annual_fees / $duration;

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
            return redirect()->route('admin_panel.fees')->with('success', 'Fee Record has been added successfully.');
        } else {
            return redirect()->route('admin_panel.fees')->with('error', 'Something went wrong!');
        }

        // return $req;
    }
}
