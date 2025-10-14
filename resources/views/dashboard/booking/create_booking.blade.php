@extends('dashboard.dashboard')
@section('dashboard-content')
@section('button-add')
    <a href="{{ route('user.booking.index') }}" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-left"></i>
        Kembali
    </a>
@endsection
<div class="py-2">
    <div class="card border-0 shadow-lg px-4 py-4">
        <div class="card-header bg-white border-bottom">
            <h5 class="mb-0 fw-bold">
                <i class="fa-solid fa-calendar-plus text-primary me-2"></i>
                Booking Ruangan
            </h5>
            <small class="text-muted">Silakan lengkapi form peminjaman ruangan</small>
        </div>
        <div class="card-body">
            <form action="{{ route('user.booking.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="room_id" class="form-label fw-semibold">
                        Pilih Ruangan <span class="text-danger">*</span>
                    </label>
                    <select class="form-select" id="room_id" name="room_id" required>
                        <option value="" selected disabled>-- Pilih Ruangan --</option>
                        @foreach ($rooms as $room)
                            <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                {{ $room->room_name }} - {{ $room->location }} (Kapasitas: {{ $room->capacity }} orang)
                            </option>
                        @endforeach
                    </select>
                    <small class="form-text text-muted">
                        <i class="fa-solid fa-info-circle me-1"></i>
                        Pilih ruangan yang sesuai dengan kebutuhan Anda
                    </small>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="date" class="form-label fw-semibold">
                            Tanggal <span class="text-danger">*</span>
                        </label>
                        <input type="date" class="form-control" id="date" name="date"
                            value="{{ old('date') }}" min="{{ date('Y-m-d') }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="start_time" class="form-label fw-semibold">
                            Jam Mulai <span class="text-danger">*</span>
                        </label>
                        <input type="time" class="form-control" id="start_time" name="start_time"
                            value="{{ old('start_time', '08:00') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="end_time" class="form-label fw-semibold">
                            Jam Selesai <span class="text-danger">*</span>
                        </label>
                        <input type="time" class="form-control" id="end_time" name="end_time"
                            value="{{ old('end_time', '17:00') }}" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="purpose" class="form-label fw-semibold">
                        Tujuan Peminjaman <span class="text-danger">*</span>
                    </label>
                    <textarea class="form-control" id="purpose" name="purpose" rows="4"
                        placeholder="Contoh: Rapat koordinasi tim, Seminar internal, Workshop, dll." required>{{ old('purpose') }}</textarea>
                    <small class="form-text text-muted">
                        Jelaskan secara singkat tujuan peminjaman ruangan
                    </small>
                </div>

                <div class="alert alert-info border-0 mb-4" role="alert">
                    <div class="d-flex align-items-start">
                        <i class="fa-solid fa-info-circle fs-5 me-3 mt-1"></i>
                        <div>
                            <h6 class="alert-heading mb-1">Informasi Penting</h6>
                            <small class="mb-0">
                                • Booking Anda akan diproses oleh admin<br>
                                • Status booking akan diupdate melalui notifikasi<br>
                                • Pastikan data yang diisi sudah benar sebelum submit
                            </small>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-paper-plane me-1"></i>
                        Submit Booking
                    </button>
                    <a href="{{ route('user.booking.index') }}" class="btn btn-outline-secondary">
                        <i class="fa-solid fa-times me-1"></i>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm mt-4">
        <div class="card-header bg-primary bg-opacity-10 border-bottom">
            <h6 class="mb-0 fw-bold text-primary">
                <i class="fa-solid fa-list me-2"></i>
                Jadwal Ruangan Terpakai
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                @forelse($bookings as $room)
                    <div class="col-md-6 mb-3">
                        <div class="card h-100 border">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <div class="bg-primary bg-opacity-10 rounded p-2 me-3">
                                        <i class="fa-solid fa-door-open text-primary fs-5"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="fw-bold mb-1">{{ $room->room->room_name }}</h6>
                                        <small class="text-muted d-block mb-2">
                                            <i class="fa-solid fa-location-dot me-1"></i>
                                            {{ $room->room->location }}
                                        </small>
                                        <small class="text-muted d-block">
                                            <i class="fa-solid fa-calendar me-1"></i>
                                            {{ $room->date }}, {{ $room->start_time }} - {{ $room->end_time }}
                                        </small>
                                    </div>
                                    <span class="badge bg-info text-dark">
                                        <i class="fa-solid fa-users me-1"></i>
                                        {{ $room->room->capacity }}
                                    </span>
                                </div>
                                <p class="text-muted small mb-0">
                                    {{ Str::limit($room->description, 80) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning mb-0" role="alert">
                            <i class="fa-solid fa-triangle-exclamation me-2"></i>
                            Tidak ada jadwal ruangan yang sudah dipinjam saat ini.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
