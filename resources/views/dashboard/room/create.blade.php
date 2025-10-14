@extends('dashboard.dashboard')
@section('dashboard-content')
@section('button-add')
    <a href="{{ route('room.index') }}" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-left"></i>
        Kembali
    </a>
@endsection

<div class="py-2">
    <div class="card border-0 shadow-lg px-4 py-4">
        <div class="card-header bg-white border-bottom">
            <h5 class="mb-0 fw-bold">Tambah Ruangan Baru</h5>
        </div>
        <div class="card-body">
            <form action="{{ isset($room) ? route('room.update', $room->id) : route('room.store') }}" method="POST">
                @csrf
                @if (isset($room))
                    @method('PUT')
                @endif
                @csrf
                <div class="mb-3">
                    <label for="room_name" class="form-label fw-semibold">
                        Nama Ruangan <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" id="room_name" name="room_name"
                        value="{{ old('room_name', $room->room_name ?? '') }}" placeholder="Contoh: Ruang Meeting A"
                        required>
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label fw-semibold">
                        Lokasi <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" id="location" name="location"
                        value="{{ old('location', $room->location ?? '') }}"
                        placeholder="Contoh: Lantai 2, Gedung Utama" required>
                </div>
                <div class="mb-3">
                    <label for="capacity" class="form-label fw-semibold">
                        Kapasitas <span class="text-danger">*</span>
                    </label>
                    <input type="number" class="form-control" id="capacity" name="capacity"
                        value="{{ old('capacity', $room->capacity ?? '') }}" placeholder="Jumlah orang" min="1"
                        required>
                </div>
                <div class="mb-4">
                    <label for="description" class="form-label fw-semibold">
                        Deskripsi <span class="text-danger">*</span>
                    </label>
                    <textarea class="form-control" id="description" name="description" rows="4"
                        placeholder="Masukkan deskripsi ruangan, fasilitas yang tersedia, dll." required>{{ old('description', $room->description ?? '') }}</textarea>

                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="fa-solid fa-save"></i>
                        Simpan
                    </button>
                    <a href="{{ route('room.index') }}" class="btn btn-outline-secondary">
                        <i class="fa-solid fa-times"></i>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
