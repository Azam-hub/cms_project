<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    function index() {
        $results = Result::with('user')->with("user.studentData")->with('user.studentData.course')->where('is_deleted', '0')->get();
        $resultCount = $results->count();
        return view("admin_panel.results", compact('results', 'resultCount'));
    }

    function process_destroyResult(int $id) {
        $result = Result::find($id);

        $result->is_deleted = '1';

        if ($result->save()) {
            return response()->json(['success' => 'Admin has been deleted successfully.']);
        } else {
            return response()->json(['error' => 'Something went wrong!.']);
        }
    }
}
