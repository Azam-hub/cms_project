<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class AccountController extends Controller
{
    function index() {
        $exists = User::exists();

        if (!$exists) {
            // return view("login", compact('exists'));
            return view("login", ["is_new" => true]);
        } else {
            return view("login");
        } 
    }

    function process_superAdminSignup(Request $req) {
        // Validating Information
        $req->validate([
            "profile_pic" => "image|max:5000",
            "first_name" => "required",
            "last_name" => "required",
            "father_name" => "required",
            "cnic_bform_no" => "required|numeric|digits:13",
            "dob" => "required",
            "mobile_no" => "required|numeric|digits:11",
            "address" => "required",
            "password" => "required|confirmed",
            "password_confirmation" => "required",
        ]);

        // Uploading profile pic
        $profile_pic = "0";
        
        if (isset($req->profile_pic)) {
            $name = $req->profile_pic->hashName();
            $req->profile_pic->move(public_path('storage/admin_profile_pics/'), $name);
            $profile_pic = "admin_profile_pics/".$name;
        }


        $email = strtolower(str_replace(' ', '', $req->first_name)) . "." . strtolower(str_replace(' ', '', $req->last_name)) . "@simsatedu.com";

        // Save data in database
        $user = new User;

        $user->name = $req->first_name . " " . $req->last_name;
        $user->father_name = $req->father_name;
        $user->cnic_bform_no = $req->cnic_bform_no;
        $user->date_of_birth = $req->dob;
        $user->email = $email;
        $user->password = Hash::make($req->password);
        $user->mobile_no = $req->mobile_no;
        $user->profile_pic = $profile_pic;
        $user->address = $req->address;
        $user->role = "super_admin";
        $user->token = "-1";
        $user->is_deleted = "0";

        if ($user->save()) {
            return redirect()->route('account.login')->with("success", "Account has been created successfully and <b><q>".$email."</q></b> email has been generated..");
        } else {
            return redirect()->route('account.login')->with("error", "Something went wrong!");
        }
    }

    function process_login(Request $req) {

        $creditLine = 'Designed and Developed by <b><q>Muhammad Azam</q></b>';

        $admin_layout = File::get(resource_path('views/admin_panel/_layout.blade.php'));
        $student_layout = File::get(resource_path('views/student/_layout.blade.php'));

        if (strpos($admin_layout, $creditLine) === false || 
        strpos($student_layout, $creditLine) === false) {
            // If not present, abort with a 403 Forbidden error
            abort(403, 'Unauthorized modification detected.');
        }

        $credentials = $req->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $req->email)->where('is_deleted', "0")->first();

        $login = false;

        if ($user) {
            if ($user->role !== "student") {
                if (Auth::attempt($credentials)) {
                    $login = "admin";
                }
            } else {
                if ($credentials['email'] === $user->email && $credentials['password'] === $user->password) {
                    Auth::login($user);
                    $login = "student";
                }
                // if ($credentials['email'] === $user->email && $credentials['password'] === $user->password) {
                //     // Auth::login($user);
                //     // $login = "student";
                //     $fee = Fee::join("students", "students.id", "=", "fees.student_id")
                    
                //     ->get()
                //     ;
                //     dd($fee);

                // }
            }
        }
        
        if ($login === "admin") {
            return redirect()->route('admin_panel.home');
        } elseif ($login === "student") {
            return redirect()->route('student.home');
        } else {
            return redirect()->route("account.login")->with('error', "Invalid email address or password");            
        }
        
    }

    function logout() {
        Auth::logout();
        return redirect()->route('account.login');
    }
}
