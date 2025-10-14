<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\BookingController;
use App\Http\Controllers\Dashboard\ReportController;
use App\Http\Controllers\Dashboard\RoomController;
use App\Models\Booking;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('index');

Route::post('/login', [AuthController::class, 'login'])->name('login');



Route::middleware(['role:admin'])->group(function () {
    Route::get('/dashboard/rooms', [RoomController::class, 'index'])->name('room.index');
    Route::get('/dashboard/rooms/create', [RoomController::class, 'create'])->name('room.create');
    Route::get('/dashboard/rooms/edit/{id}', [RoomController::class, 'edit'])->name('room.edit');

    Route::get('/dashboard/bookings', [BookingController::class, 'index'])->name('booking.index');
    Route::get('/dashboard/report', [ReportController::class, 'index'])->name('report.index');

    Route::post('/dashboard/rooms/store', [RoomController::class, 'store'])->name('room.store');

    Route::put('/dashboard/rooms/update/{id}', [RoomController::class, 'update'])->name('room.update');
    Route::put('/dashboard/bookings/approve/{id}', [BookingController::class, 'approve'])->name('booking.approve');
    Route::put('/dashboard/bookings/reject/{id}', [BookingController::class, 'reject'])->name('booking.reject');

    Route::delete('/dashboard/rooms/destroy/{id}', [RoomController::class, 'destroy'])->name('room.destroy');
});
Route::middleware(['role:pengguna'])->group(function () {
    Route::get('/dashboard/user-bookings', [BookingController::class, 'userBookings'])->name('user.booking.index');
    Route::get('/dashboard/bookings/create', [BookingController::class, 'create'])->name('user.booking.create');

    Route::post('/dashboard/bookings/store', [BookingController::class, 'store'])->name('user.booking.store');
});

Route::middleware(['role:admin,user'])->group(function () {
    Route::post('/logout', [AuthController::class,'logout'])->name('logout');
});



Route::get('/403', function () {
    return view('errors.403');
})->name('403');
