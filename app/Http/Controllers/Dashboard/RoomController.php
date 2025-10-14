<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::paginate(5);
        return view('dashboard.room.index', compact('rooms'));
    }

    public function create()
    {
        return view('dashboard.room.create');
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'room_name' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'capacity' => 'required|integer|min:1',
                'description' => 'required|string',
            ]);

            Room::create($validatedData);

            return redirect()->route('room.index')->with('success', 'Room created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error'=> $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        try {
            $room = Room::findOrFail($id);
            return view('dashboard.room.create', compact('room'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error'=> 'Room not found.']);
        }
    }

    public function update($id, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'room_name' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'capacity' => 'required|integer|min:1',
                'description' => 'required|string',
            ]);

            Room::where('id', $id)->update($validatedData);

            return redirect()->route('room.index')->with('success', 'Room updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred during update data.']);
        }
    }

    public function destroy($id)
    {
        try {
            Room::where('id', $id)->delete();
            return redirect()->route('room.index')->with('success', 'Room deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
