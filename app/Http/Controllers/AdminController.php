<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use function PHPUnit\Framework\fileExists;

class AdminController extends Controller
{
    function index() {
        $admins = User::where("role", 'admin')->where('is_deleted', '0')->orWhere('role', "super_admin")->orderBy('id', 'desc')->get();
        $count = $admins->count();
        return view('admin_panel.admins', compact('admins', 'count'));
    }

    function process_addAdmin(Request $req) {
        
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
            "role" => "required",
            "password" => "required|confirmed",
            "password_confirmation" => "required",
        ]);

        // Uploading profile pic
        $profile_pic = "0";
        
        if (isset($req->profile_pic)) {
            // $profile_pic = $req->profile_pic->store('admin_profile_pics', 'public');

            $name = $req->profile_pic->hashName();
            $req->profile_pic->move(public_path('storage/admin_profile_pics/'), $name);
            $profile_pic = "admin_profile_pics/".$name;
        }
        

        // Generating Email
        $email = strtolower(str_replace(' ', '', $req->first_name)) . "." . strtolower(str_replace(' ', '', $req->last_name)) . "@simsatedu.com";

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

        // Define validation rules
        // $rules = [
        //     'email' => 'required|email|unique:users,email'
        // ];

        // // Create a Validator instance
        // $validator = Validator::make(['email' => $email], $rules);

        // if ($validator->fails()) {
        //     return redirect()->route('admin_panel.admins')->with("error", "Email <b>$email</b> already exists!");
            
        // } else {}

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
        $user->role = $req->role;
        $user->token = "-1";
        $user->is_deleted = "0";

        if ($user->save()) {
            return redirect()->route('admin_panel.admins')->with("success", "Admin has been added successfully and <b><q>".$email."</q></b> email has been generated.");
        } else {
            return redirect()->route('admin_panel.admins')->with("error", "Something went wrong!");
        }
        
    }

    function process_editAdmin(Request $req) {

        // Validating Information
        $req->validate([
            "name" => "required",
            "father_name" => "required",
            "email" => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($req->admin_id),
            ],
            // "cnic_bform_no" => "required|numeric|digits:13",
            "cnic_bform_no" => [
                'required',
                'numeric',
                'digits:13'
            ],
            "dob" => "required",
            "mobile_no" => "required|numeric|digits:11",
            "address" => "required",
            "role" => "required",
        ]);

        // Uploading profile pic

        // Save data in database
        $user = User::find($req->admin_id);

        $user->name = $req->name;
        $user->father_name = $req->father_name;
        $user->cnic_bform_no = $req->cnic_bform_no;
        $user->date_of_birth = $req->dob;
        $user->email = $req->email;
        $user->mobile_no = $req->mobile_no;
        $user->address = $req->address;
        $user->role = $req->role;
        
        if (isset($req->profile_pic)) {
            $name = $req->profile_pic->hashName();
            $image_path = public_path('storage/' . $user->profile_pic);
            if (fileExists($image_path)) {
                @unlink($image_path);
            }
            $req->profile_pic->move(public_path('storage/admin_profile_pics/'), $name);
            $user->profile_pic = "admin_profile_pics/".$name;
        }

        if (isset($req->password)) {
            $req->validate([
                "password" => "confirmed"
            ]);
            $user->password = Hash::make($req->password);
        }

        if ($user->save()) {
            return redirect()->route('admin_panel.admins')->with("success", "Admin data has been updated successfully.");
        } else {
            return redirect()->route('admin_panel.admins')->with("error", "Something went wrong!");
        }
            
    }


    function process_destroyAdmin(int $id) {
        $user = User::find($id);

        $user->is_deleted = '1';

        if ($user->save()) {
            return response()->json(['success' => 'Admin has been deleted successfully.']);
        } else {
            return response()->json(['error' => 'Something went wrong!.']);
        }
        // return response()->json(['id' => $req->admin_id]);
        
    }
}
