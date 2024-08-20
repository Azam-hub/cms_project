<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    function index() {
        $announcements = Announcement::where("is_deleted", "0")->orderBy("id", "desc")->get();
        $count = $announcements->count();
        return view("admin_panel.announcements", compact("announcements", "count"));
    }

    function process_addAnnouncement(Request $req) {
        $req->validate([
            "title" => "required",
            "description" => "required",
        ]);

        $announcement = new Announcement;

        $announcement->title = $req->title;
        $announcement->description = $req->description;

        if ($announcement->save()) {
            return redirect()->route('admin_panel.announcements')->with('success', 'Announcement has been added successfully.');
        } else {
            return redirect()->route('admin_panel.announcements')->with('error', 'Something went wrong!');
        }
        
    }

    function process_editAnnouncement(Request $req) {
        $req->validate([
            "announcement_id" => "required",
            "title" => "required",
            "description" => "required",
        ]);

        $announcement = Announcement::find($req->announcement_id);

        $announcement->title = $req->title;
        $announcement->description = $req->description;

        if ($announcement->save()) {
            return redirect()->route('admin_panel.announcements')->with('success', 'Announcement has been updated successfully.');
        } else {
            return redirect()->route('admin_panel.announcements')->with('error', 'Something went wrong!');
        }
        
    }

    function process_destroyAnnouncement($id) {

        $announcement = Announcement::find($id);

        $announcement->is_deleted = "1";

        if ($announcement->save()) {
            return response()->json(['success' => 'Room has been deleted successfully.']);
        } else {
            return response()->json(['error' => 'Something went wrong!.']);
        }
        
    }
}
