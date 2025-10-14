<nav class="navbar navbar-expand-lg py-3 bg-third-color">
    <div class="container">
        <div class="header">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('storage/asset/header-logo.png') }}" alt="logo_ukdw" width="25" height="25">
                <p class="primary-color fs-4 fw-semibold mb-0 ms-3">Room</p>
            </a>
        </div>
        <div class="justify-content-end">
            <ul class="navbar-nav fs-6 gap-4">
                <li class="nav-item d-flex align-items-center">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip"
                            title="Delete Ruangan">
                            <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
                        </button>
                    </form>

                </li>
            </ul>
        </div>
    </div>
</nav>
<nav class="navbar navbar-expand-lg py-3 bg-third-color">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-start" id="navbarNavDropdown">
            <ul class="navbar-nav fs-6 gap-4">
                @if (Auth::user()->role->role_name === 'admin')
                    <li class="nav-item">
                        <a class="nav-link primary-color {{ request()->routeIs('booking.*') ? 'text-success' : '' }}"
                            href="{{ route('booking.index') }}">Booking Approval</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link primary-color {{ request()->routeIs('room.*') ? 'text-success' : '' }}"
                            href="{{ route('room.index') }}">Room Management</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link primary-color {{ request()->routeIs('report.*') ? 'text-success' : '' }}"
                            href="{{ route('report.index') }}">Report</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link primary-color {{ request()->routeIs('user.booking.*') ? 'text-success' : '' }}"
                            href="{{ route('user.booking.index') }}">Peminjaman Ruangan</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
