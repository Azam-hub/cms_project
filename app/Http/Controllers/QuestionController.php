<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Question;
use App\Models\Option;
use Illuminate\Http\Request;


class QuestionController extends Controller
{
    function index(int $id) {
        $course = Course::find($id);
        $questions = Question::with('options')->where("course_id", $id)->where("is_deleted", '0')->orderBy("id", 'desc')->get();
        $questions_count = $questions->count();
        
        return view('admin_panel.setQuestions', compact('course', 'questions_count', 'questions'));
    }

    function process_addQuestion(Request $req) {
        $req->validate([
            "course_id" => "required",
            "question" => "required",
            "correct_option" => "required",
            "option_1" => "required",
            "option_2" => "required",
            "option_3" => "required",
        ]);

        $question = new Question;

        $question->question = $req->question;
        $question->course_id = $req->course_id;
        $question->is_deleted = "0";

        if ($question->save()) {
            $options = new Option;

            $options->correct_option = $req->correct_option;
            // $options->other_options = json_encode([$req->option_1, $req->option_2, $req->option_3]);
            $input_options = json_encode([$req->option_1, $req->option_2, $req->option_3]);
            $options->other_options = $input_options;
            $options->question_id = $question->id;

            if ($options->save()) {
                return redirect()->route('admin_panel.setQuestions', $req->course_id)->with('success', 'Question has been added successfully.');
            } else {
                $question->delete();
                return redirect()->route('admin_panel.setQuestions', $req->course_id)->with('error', 'Something went wrong!');
            }
            
        }
    }

    function process_editQuestion(Request $req) {
        $req->validate([
            "question_id" => "required",
            "question" => "required",
            "correct_option" => "required",
            "option_1" => "required",
            "option_2" => "required",
            "option_3" => "required",
        ]);

        $question = Question::find($req->question_id);
        $options = Option::find($req->question_id);

        $question->question = $req->question;

        $options->correct_option = $req->correct_option;
        $input_options = json_encode([$req->option_1, $req->option_2, $req->option_3]);
        $options->other_options = $input_options;

        if ($options->save() && $question->save()) {
            return redirect()->route('admin_panel.setQuestions', $req->course_id)->with('success', 'Question has been edited successfully.');
        } else {
            return redirect()->route('admin_panel.setQuestions', $req->course_id)->with('error', 'Something went wrong!');
        }

    }


    function process_destroyQuestion(int $id) {
        $question = Question::find($id);

        $question->is_deleted = '1';

        if ($question->save()) {
            return response()->json(['success' => 'Admin has been deleted successfully.']);
        } else {
            return response()->json(['error' => 'Something went wrong!.']);
        }
    }
}
