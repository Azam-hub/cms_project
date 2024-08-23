<?php

namespace App\Http\Middleware;

use App\Models\Course;
use App\Models\Result;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class ValidUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (Auth::check()) {
            
            if (in_array(Auth::user()->role, $roles)) {

                $courses = Course::select('id', 'name')->where('is_deleted', '0')->orderBy('id', "desc")->get();
                
                $status = "";
                $has_result = false;
                if (Auth::user()->role == "student") {
                    // Getting status for showing assessment tab if it is pending means allowed by admin
                    $user = User::with('studentData')->where('id', Auth::user()->id)->first();
                    $status = $user->studentData->status;

                    // Check if a single result exist of logged-in student
                    $result = Result::where("user_id", Auth::user()->id)->first();
                    if ($result) {
                        $has_result = true;
                    }
                }

                View::share([
                    'courses' => $courses,
                    'status' => $status,
                    'has_result' => $has_result,
                ]);

                return $next($request);
            } else {
                if (Auth::user()->role == "student") {
                    return redirect()->route('student.home');                
                } elseif (Auth::user()->role == "admin") {
                    return redirect()->route('admin_panel.attendanceToday');
                } else {
                    return redirect()->route('admin_panel.home');
                }
            }
            
        } elseif (Auth::guest() && in_array('not_loggedin', $roles)) {
            return $next($request);            
        } else {
            return redirect()->route('account.login');
        }
    }
}
