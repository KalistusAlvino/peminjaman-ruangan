<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'room'])->paginate(5);
        return view('dashboard.report.index', compact('bookings'));
    }
}
