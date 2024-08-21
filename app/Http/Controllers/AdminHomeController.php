<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminHomeController extends Controller
{
    function index() {

        $currentYear = Carbon::now()->year;
        $previousYear = $currentYear - 1;
        
        // **************** Admissions/Enrollment trend ********************

        $admissions = DB::table('students')
        ->join("users", "users.id", "=", "students.user_id")
        ->selectRaw('YEAR(students.created_at) as year, MONTH(students.created_at) as month, COUNT(*) as count')
        ->whereIn(DB::raw('YEAR(students.created_at)'), [$currentYear, $previousYear])
        ->where(function($query) use ($currentYear, $previousYear) {
            $query->where(DB::raw('YEAR(students.created_at)'), $previousYear)
                ->orWhere(function($query) use ($currentYear) {
                    $query->where(DB::raw('YEAR(students.created_at)'), $currentYear)
                            ->where(DB::raw('MONTH(students.created_at)'), '<=', Carbon::now()->month);
                });
        })
        ->where("users.is_deleted", "0")
        ->groupBy(DB::raw('YEAR(students.created_at)'), DB::raw('MONTH(students.created_at)'))
        ->orderBy('year', 'desc')
        ->orderBy('month', 'asc')
        ->get();

        $admissions_arr = [
            $previousYear => array_fill(0, 12, 0), // Initialize months with 0 for previous year
            $currentYear => array_fill(0, 12, 0),  // Initialize months with 0 for current year
        ];

        foreach ($admissions as $admission) {
            $admissions_arr[$admission->year][$admission->month -1] = $admission->count;
        }


        // **************** Revenue ********************

        $revenues = DB::table("fees")
        ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(amount) as month_total')
        ->whereIn(DB::raw('YEAR(created_at)'), [$currentYear, $previousYear])
        ->where(function($query) use ($currentYear, $previousYear) {
            $query->where(DB::raw('YEAR(created_at)'), $previousYear)
                ->orWhere(function($query) use ($currentYear) {
                    $query->where(DB::raw('YEAR(created_at)'), $currentYear)
                            ->where(DB::raw('MONTH(created_at)'), '<=', Carbon::now()->month);
                });
        })
        ->where("fees.is_deleted", "0")
        ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
        ->orderBy('year', 'desc')
        ->orderBy('month', 'asc')
        ->get();
        
        $revenues_arr = [
            $previousYear => array_fill(0, 12, 0), // Initialize months with 0 for previous year
            $currentYear => array_fill(0, 12, 0),  // Initialize months with 0 for current year
        ];

        foreach ($revenues as $revenue) {
            $revenues_arr[$revenue->year][$revenue->month -1] = $revenue->month_total;
        }


        // **************** Courses Occupation ********************

        $courses_arr = DB::table("students")
        ->join("courses", "courses.id", "=", "students.course_id")
        ->join("users", "users.id", "=", "students.user_id")
        ->selectRaw("courses.name, COUNT(*) AS students")
        ->groupBy("courses.name")
        ->where("users.is_deleted", "0")
        ->get()
        ;
        
        
        // **************** Courses Occupation ********************

        $attendances = DB::table('attendances')
        // ->join("users", "users.id", "=", "students.user_id")
        ->selectRaw('MONTH(attendances.created_at) as month, COUNT(*) as presents')
        ->where(DB::raw('YEAR(attendances.created_at)'), $currentYear)
        ->where(function($query) use ($currentYear) {
            $query->where(DB::raw('YEAR(attendances.created_at)'), $currentYear)
            ->where(DB::raw('MONTH(attendances.created_at)'), '<=', Carbon::now()->month);
        })
        ->where("attendances.status", "present")
        ->groupBy(DB::raw('MONTH(attendances.created_at)'))
        ->orderBy('month', 'asc')
        ->get();

        // dd($attendances);

        $attendances_arr = array_fill(0, 12, 0);

        foreach ($attendances as $attendance) {
            $attendances_arr[$attendance->month - 1] = $attendance->presents;
        }

        // dd($attendances_arr);
        
        return view("admin_panel.home", compact("admissions_arr", "revenues_arr", "courses_arr", "attendances_arr"));
    }
}
