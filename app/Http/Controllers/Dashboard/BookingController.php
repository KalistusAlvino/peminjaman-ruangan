<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function userBookings()
    {
        $bookings = Booking::where('user_id', Auth::user()->id)->paginate(5);
        return view('dashboard.booking.user_index', compact('bookings'));
    }
    public function index()
    {
        $bookings = Booking::with(['user', 'room'])->paginate(5);
        return view('dashboard.booking.index', compact('bookings'));
    }

    public function create()
    {
        $bookings = Booking::with('room')
            ->where('status', 'approved')
            ->where('date', '>=', today())
            ->get();

        $rooms = Room::all();
        return view('dashboard.booking.create_booking', compact('rooms', 'bookings'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'room_id' => 'required|exists:rooms,id',
                'date' => 'required|date|after_or_equal:today',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
                'purpose' => 'required|string|max:255',
            ]);
            $isBooked = Booking::where('room_id', $validated['room_id'])
                ->where('date', $validated['date'])
                ->where('status', 'approved')
                ->where(function ($query) use ($validated) {
                    $query->whereBetween('start_time', [$validated['start_time'], $validated['end_time']])
                        ->orWhereBetween('end_time', [$validated['start_time'], $validated['end_time']])
                        ->orWhere(function ($q) use ($validated) {
                            $q->where('start_time', '<=', $validated['start_time'])
                                ->where('end_time', '>=', $validated['end_time']);
                        });
                })
                ->with(['user', 'room'])
                ->first();

            $notApproved = Booking::where('room_id', $validated['room_id'])
                ->where('date', $validated['date'])
                ->where(function ($query) use ($validated) {
                    $query->whereBetween('start_time', [$validated['start_time'], $validated['end_time']])
                        ->orWhereBetween('end_time', [$validated['start_time'], $validated['end_time']])
                        ->orWhere(function ($q) use ($validated) {
                            $q->where('start_time', '<=', $validated['start_time'])
                                ->where('end_time', '>=', $validated['end_time']);
                        });
                })
                ->with(['user', 'room'])
                ->first();

            if ($isBooked) {
                return redirect()->back()->withErrors(['error' => 'The selected room is already booked by ' . $isBooked->user->username . ' from ' . $isBooked->start_time . ' to ' . $isBooked->end_time . '. Please select a different time or room.']);
            }

            if ($notApproved != null) {
                Booking::create([
                    'user_id' => Auth::user()->id,
                    'room_id' => $validated['room_id'],
                    'date' => $validated['date'],
                    'start_time' => $validated['start_time'],
                    'end_time' => $validated['end_time'],
                    'purpose' => $validated['purpose'],
                    'status' => 'pending',
                ]);
                return redirect()->route('user.booking.index')->with('success', 'Successfully booking!. But your room already booked by ' . $notApproved->user->username . ' from ' . $notApproved->start_time . ' to ' . $notApproved->end_time . '. Please wait until the admin approve your booking.');
            }

            Booking::create([
                'user_id' => Auth::user()->id,
                'room_id' => $validated['room_id'],
                'date' => $validated['date'],
                'start_time' => $validated['start_time'],
                'end_time' => $validated['end_time'],
                'purpose' => $validated['purpose'],
                'status' => 'pending',
            ]);
            return redirect()->route('user.booking.index')->with('success', 'Successfully booking!.');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to create booking']);
        }
    }

    public function approve($id)
    {
        try {
            $booking = Booking::findOrFail($id);
            $isBooked = Booking::where('room_id', $booking->room_id)
                ->where('date', $booking->date)
                ->where('status', 'approved')
                ->where(function ($query) use ($booking) {
                    $query->whereBetween('start_time', [$booking->start_time, $booking->end_time])
                        ->orWhereBetween('end_time', [$booking->start_time, $booking->end_time])
                        ->orWhere(function ($q) use ($booking) {
                            $q->where('start_time', '<=', $booking->start_time)
                                ->where('end_time', '>=', $booking->end_time);
                        });
                })
                ->with(['user', 'room'])
                ->first();
            if ($isBooked) {
                return redirect()->back()->withErrors(['error' => 'The selected room is already booked by ' . $isBooked->user->username . ' from ' . $isBooked->start_time . ' to ' . $isBooked->end_time . '. U cannot approve this.']);
            }
            Booking::where('id', $id)->update([
                'status' => 'approved'
            ]);

            return redirect()->route('booking.index')->with('success', 'Booking status updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to approve booking']);
        }
    }

    public function reject($id)
    {
        try {
            Booking::where('id', $id)->update([
                'status' => 'rejected'
            ]);
            return redirect()->route('booking.index')->with('success', 'Booking status updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to reject booking']);
        }
    }
}
