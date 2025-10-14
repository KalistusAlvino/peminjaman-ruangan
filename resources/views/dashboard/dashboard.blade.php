@extends('asset.main')
@section('title', Auth::user()->role->role_name === 'admin' ? 'Admin Dashboard' : 'User Dashboard')
@section('content')
    <header class="container-fluid shadow-lg">
        @include('dashboard.header.header')
    </header>
    <main class="container px-4 py-4">
        @if (Auth::user()->role->role_name === 'admin')
            <h1>Hellooo, {{ ucwords(Auth::user()->username) }} 👋</h1>
            <div class="row d-flex justify-content-between align-items-center py-2">
                <div class="col-12 col-md-6 d-flex justify-content-start">
                    <p class="fs-4">Monitor, approve, and manage all room activities.!</p>
                </div>
                <div class="col-12 col-md-6 d-flex justify-content-end">
                    @yield('button-add')
                </div>
            </div>
        @else
            <h1>Hellooo, {{ ucwords(Auth::user()->username) }} 👋</h1>
            <div class="row d-flex justify-content-between align-items-center py-2">
                <div class="col-12 col-md-6 d-flex justify-content-start">
                    <p class="fs-4 mb-0">
                        Check your room bookings, see schedules, and request new reservations easily!
                    </p>
                </div>
                <div class="col-12 col-md-6 d-flex justify-content-end">
                    @yield('button-add')
                </div>
            </div>
        @endif
        @yield('dashboard-content')
    </main>
@endsection
