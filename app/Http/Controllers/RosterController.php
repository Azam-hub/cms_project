<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Roster;
use App\Models\User;
use Illuminate\Http\Request;

class RosterController extends Controller
{
    function index(Request $req) {
        $id = $req->id;

        $user = User::where("id", $id)->first();
        $rooms = Room::where('is_deleted', '0')->orderBy('id', 'desc')->get();
        $rosters = Roster::with('room')->where("admin_id", $id)->where("is_deleted", "0")->get();

        $rosters_count = $rosters->count();

        return view('admin_panel.rosters', compact("user", "rooms", 'rosters', "rosters_count"));
    }

    function process_addRoster(Request $req) {
        $req->validate([
            'user_id' => 'required',
            'room' => 'required',
            'timing' => 'required'
        ]);

        $check_roster = Roster::with("user")->where('room_id', $req->room)->where('timing', $req->timing)->first();

        if ($check_roster) {
            return redirect()
            ->route('admin_panel.rosters', $req->user_id)
            ->with('error', 'This room and time is already assigned to <b><q>' . $check_roster->user->name . '</q></b>.');
        } else {
            
            $roster = new Roster;
    
            $roster->admin_id = $req->user_id;
            $roster->room_id = $req->room;
            $roster->timing = $req->timing;
    
            if ($roster->save()) {
                return redirect()->route('admin_panel.rosters', $req->user_id)->with('success', 'Roster has been added successfully.');
            } else {
                return redirect()->route('admin_panel.rosters', $req->user_id)->with('error', 'Something went wrong!');
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

        $check_roster = Roster::with("user")->where('room_id', $req->room)->where('timing', $req->timing)->where('id', "!=", $req->roster_id)->first();

        if ($check_roster) {
            return redirect()
            ->route('admin_panel.rosters', $req->user_id)
            ->with('error', 'This room and time is already assigned to <b><q>' . $check_roster->user->name . '</q></b>.');
        } else {
            
            $roster = Roster::find($req->roster_id);

            $roster->room_id = $req->room;
            $roster->timing = $req->timing;
    
            if ($roster->save()) {
                return redirect()->route('admin_panel.rosters', $req->user_id)->with('success', 'Roster has been updated successfully.');
            } else {
                return redirect()->route('admin_panel.rosters', $req->user_id)->with('error', 'Something went wrong!');
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
