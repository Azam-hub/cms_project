<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    function index() {
        $courses = Course::with(['modules' => function ($q) {
            $q->where("is_deleted", "0");
        }])->where('is_deleted', '0')->orderBy('id', "desc")->get();
        $count = $courses->count();
        return view("admin_panel.courses", compact('courses', "count"));
    }

    function process_addCourse(Request $req) {
        $req->validate([
            "course_name" => "required",
            "questions_to_ask" => "required",
            "fees" => "required",
            "duration" => "required",
            'modules' => 'required|array',
        ]);

        $course = new Course;
        
        $course->name = $req->course_name;
        $course->fees = $req->fees;
        $course->duration = $req->duration;
        $course->questions_to_ask = $req->questions_to_ask;
        
        if ($course->save()) {
            
            foreach ($req->modules as $module) {

                if ($module != "") {

                    Module::create([
                        "name" => $module,
                        'course_id' => $course->id,
                    ]);
                }
            }
            return redirect()->route('admin_panel.courses')->with("success", "Course has been added successfully.");

        } else {
            return redirect()->route('admin_panel.courses')->with("error", "Something went wrong!");
        }
    }

    function process_editCourse(Request $req) {
        $req->validate([
            "course_name" => "required",
            "questions_to_ask" => "required",
            "fees" => "required|numeric",
            "duration" => "required|numeric",
            'modules' => 'required|array',
        ]);

        $course = Course::find($req->course_id);

        $course->name = $req->course_name;
        $course->fees = $req->fees;
        $course->duration = $req->duration;
        $course->questions_to_ask = $req->questions_to_ask;

        $module_ids_arr = json_decode($req->module_ids_arr);

        for ($i=0; $i < count($req->modules); $i++) { 
            if ($i < count($module_ids_arr)) {

                $id = $module_ids_arr[$i];
                $module = Module::find($id);
                
                if ($req->modules[$i] == "") {
                    $module->is_deleted = "1";
                    $module->save();
                } else {
                    $module->name = $req->modules[$i];
                    $module->save();
                }
                    
                continue;
            }
            // Add new module
            Module::create([
                "name" => $req->modules[$i],
                'course_id' => $course->id,
            ]);
        }        

        if ($course->save()) {
            return redirect()->route('admin_panel.courses')->with("success", "Course has been edited successfully.");
        } else {
            return redirect()->route('admin_panel.courses')->with("error", "Something went wrong!");
        }
    }

    function process_destroyCourse(string $id) {
        $course = Course::find($id);

        $course->is_deleted = '1';

        if ($course->save()) {
            return 1;
        } else {
            return 0;
        }
        
    }

    function process_statusChangeCourse($id, $action) {
        $course = Course::find($id);

        if ($action == "Active") {
            $course->deactive = '0';
        } elseif ($action == "Deactive") {
            $course->deactive = '1';
        }

        if ($course->save()) {
            return 1;
        } else {
            return 0;
        }
    }
}
