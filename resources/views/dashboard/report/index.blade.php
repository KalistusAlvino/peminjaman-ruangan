@extends('dashboard.dashboard')
@section('dashboard-content')
    <div class="py-2">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Peminjam</th>
                                <th scope="col">Nama Ruangan</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Jam</th>
                                <th scope="col">Tujuan</th>
                                <th scope="col">Diajukan</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bookings as $index => $booking)
                                <tr class="border-bottom">
                                    <td class="ps-4">
                                        <span class="badge bg-light text-dark border">
                                            {{ $bookings->firstItem() + $index }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 rounded p-2 me-2">
                                                <i class="fa-solid fa-user-tie text-primary"></i>
                                            </div>
                                            <span class="fw-semibold">{{ ucwords($booking->user->username) }}</span>
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
                                                <i class="fa-solid fa-alarm-clock text-primary"></i>
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
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 rounded p-2 me-2">
                                                <i class="fa-solid fa-alarm-clock text-primary"></i>
                                            </div>
                                            <span class="fw-semibold">{{ $booking->created_at }}</span>
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
                                            <p class="text-muted mb-0 fst-italic">Belum pengajuan pinjaman</p>
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
