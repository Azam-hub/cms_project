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


                // List of layouts to check
                $layouts = ['admin_panel._layout', 'student._layout', 'login'];

                
                $creditLine = 'Designed and Developed by <b><q>Muhammad Azam</q></b>';

                // Loop through each layout and check for the credit line
                foreach ($layouts as $layout) {
                    $layoutContent = view($layout)->render(); // Render each layout
                    
                    if (strpos($layoutContent, $creditLine) === false) {
                        // If not present in any layout, abort with a 403 Forbidden error
                        abort(403, 'Unauthorized modification detected.');
                    }
                }



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
