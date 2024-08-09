<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            "profile_pic" => "required|image|max:5000",
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
        $profile_pic = $req->profile_pic->store('admin_profile_pics', 'public');


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
            return redirect()->route('account.login')->with("success", "Account has been created successfully.");
        } else {
            return redirect()->route('account.login')->with("error", "Something went wrong!");
        }
    }

    function process_login(Request $req) {
        $credentials = $req->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $req->email)->first();

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
