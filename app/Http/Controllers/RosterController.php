<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Roster;
use App\Models\User;
use Illuminate\Http\Request;

class RosterController extends Controller
{
    function rosters() {
        $users = User::where(function ($query) {
            $query->where('role', 'admin')
            ->orWhere('role', 'super_admin');
        })
        ->where('is_deleted', '0')
        ->where('email', '!=', env('RECOVERY_EMAIL'))
        ->orderBy('id', 'desc')
        ->get();

        $rooms = Room::where('is_deleted', '0')->orderBy('id', 'desc')->get();

        $rosters = Roster::with('room')->with("user")->where("is_deleted", "0")->orderBy('id', 'desc')->get();
        $rosters_count = $rosters->count();

        return view("admin_panel.rosters.rosters", compact("users", "rooms", "rosters", "rosters_count"));
    }
    
    function single_admin_roster(Request $req) {
        $id = $req->id;

        $user = User::where("id", $id)->first();
        $rooms = Room::where('is_deleted', '0')->orderBy('id', 'desc')->get();
        $rosters = Roster::with('room')->where("admin_id", $id)->where("is_deleted", "0")->get();

        $rosters_count = $rosters->count();

        return view('admin_panel.rosters.single_admin_roster', compact("user", "rooms", 'rosters', "rosters_count"));
    }

    function process_addRoster(Request $req) {
        $req->validate([
            'user_id' => 'required',
            'room' => 'required',
            'timing' => 'required'
        ]);

        $check_one_room_two_teacher_roster = Roster::with("user")
        ->where('room_id', $req->room)
        ->where('timing', $req->timing)
        ->where("is_deleted", "0")
        ->first();

        $check_two_room_one_teacher_roster = Roster::with("room")
        ->where('admin_id', $req->user_id)
        ->where('timing', $req->timing)
        ->where("is_deleted", "0")
        ->first();

        if ($check_one_room_two_teacher_roster) {
            return back()->with('error', 'This room and time is already assigned to <b><q>' . $check_one_room_two_teacher_roster->user->name . '</q></b>.');
        } elseif ($check_two_room_one_teacher_roster) {
            return back()->with('error', 'This time is already assigned with <b><q>' . $check_two_room_one_teacher_roster->room->name . '</q></b> room.');
        } else {
            
            $roster = new Roster;
    
            $roster->admin_id = $req->user_id;
            $roster->room_id = $req->room;
            $roster->timing = $req->timing;
    
            if ($roster->save()) {
                return back()->with('success', 'Roster has been added successfully.');
            } else {
                return back()->with('error', 'Something went wrong!');
            }
        }
        

    }

    function process_editRoster(Request $req) {
        $req->validate([
            'user_id' => 'required',
            'roster_id' => 'required',
            'room' => 'required',
            'timing' => 'required'
        ]);

        $check_one_room_two_teacher_roster = Roster::with("user")
        ->where('room_id', $req->room)
        ->where('timing', $req->timing)
        ->where("is_deleted", "0")
        ->where('id', "!=", $req->roster_id)
        ->first();
        
        $check_two_room_one_teacher_roster = Roster::with("room")
        ->where('admin_id', $req->user_id)
        ->where('timing', $req->timing)
        ->where("is_deleted", "0")
        ->where('id', "!=", $req->roster_id)
        ->first();


        if ($check_one_room_two_teacher_roster) {
            return back()->with('error', 'This room and time is already assigned to <b><q>' . $check_one_room_two_teacher_roster->user->name . '</q></b>.');
        } elseif ($check_two_room_one_teacher_roster) {
            return back()->with('error', 'This time is already assigned with <b><q>' . $check_two_room_one_teacher_roster->room->name . '</q></b> room.');
        } else {
            
            $roster = Roster::find($req->roster_id);

            $roster->admin_id = $req->user_id;
            $roster->room_id = $req->room;
            $roster->timing = $req->timing;
    
            if ($roster->save()) {
                return back()->with('success', 'Roster has been updated successfully.');
            } else {
                return back()->with('error', 'Something went wrong!');
            }
        }
    }

    function process_destroyRoster(int $id) {
        $roster = Roster::find($id);

        $roster->is_deleted = '1';

        if ($roster->save()) {
            return response()->json(['success' => 'Roster has been deleted successfully.']);
        } else {
            return response()->json(['error' => 'Something went wrong!.']);
        }
    }
}
