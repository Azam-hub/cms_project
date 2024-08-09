<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoomController extends Controller
{
    function index() {
        $rooms = Room::where('is_deleted', '0')->orderBy('id', 'desc')->get();
        $count = $rooms->count();
        return view('admin_panel.rooms', compact("rooms", 'count'));
    }
    function process_addRoom(Request $req) {
        $req->validate([
            "room_name" => "required|unique:rooms,name",
            "seats" => "required",
        ]);

        $room = new Room();

        $room->name = $req->room_name;
        $room->seats = $req->seats;

        if ($room->save()) {
            return redirect()->route('admin_panel.rooms')->with('success', 'Room has been added successfully.');
        } else {
            return redirect()->route('admin_panel.rooms')->with('error', 'Something went wrong!');
        }
    }
    function process_editRoom(Request $req) {
        $req->validate([
            "room_name" => [
                "required",
                Rule::unique('rooms', 'name')->ignore($req->room_id),
            ],
            "seats" => "required",
        ]);

        $room = Room::find($req->room_id);

        $room->name = $req->room_name;
        $room->seats = $req->seats;

        if ($room->save()) {
            return redirect()->route('admin_panel.rooms')->with('success', 'Room has been updated successfully.');
        } else {
            return redirect()->route('admin_panel.rooms')->with('error', 'Something went wrong!');
        }
    }

    function process_destroyRoom(int $id) {
        $room = Room::find($id);

        $room->is_deleted = '1';

        if ($room->save()) {
            return response()->json(['success' => 'Room has been deleted successfully.']);
        } else {
            return response()->json(['error' => 'Something went wrong!.']);
        }
    }
}
