@extends('dashboard.dashboard')
@section('dashboard-content')
@section('button-add')
    <a href="{{ route('user.booking.create') }}" type="button" class="btn btn-success">
        <i class="fa-solid fa-book"></i>
        Pinjam Ruangan
    </a>
@endsection
<div class="py-2">
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Ruangan</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Jam</th>
                            <th scope="col">Tujuan</th>
                            <th scope="col">Stasus</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookings as $index => $booking)
                            <tr class="border-bottom">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-light text-dark border">
                                            {{ $bookings->firstItem() + $index }}
                                        </span>
                                    </div>

                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 rounded p-2 me-2">
                                            <i class="fa-solid fa-door-open text-primary"></i>
                                        </div>
                                        <span class="fw-semibold">{{ ucwords($booking->room->room_name) }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 rounded p-2 me-2">
                                            <i class="fa-solid fa-calendar text-primary"></i>
                                        </div>
                                        <span class="fw-semibold">{{ $booking->date }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 rounded p-2 me-2">
                                            <i class="fa-solid fa-clock text-primary"></i>
                                        </div>
                                        <span class="fw-semibold">{{ $booking->start_time }} -
                                            {{ $booking->end_time }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="fw-semibold">{{ $booking->purpose }}</span>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $badgeClass = match ($booking->status) {
                                            'pending' => 'bg-warning text-dark',
                                            'rejected' => 'bg-danger',
                                            'approved' => 'bg-success',
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="py-4">
                                        <i class="fa-solid fa-inbox fa-3x text-muted mb-3"></i>
                                        <p class="text-muted mb-0 fst-italic">Belum ada ruangan dipinjam.</p>
                                        <small class="text-muted">Silakan pinjam ruangan baru.</small>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white border-top py-3">
                <div>
                    {{ $bookings->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
