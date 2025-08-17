<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    function admin_about() {
        return view("about", ["role" => "admin"]);
    }
    function student_about() {
        return view("about", ["role" => "student"]);
    }
}
