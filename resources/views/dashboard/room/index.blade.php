@extends('dashboard.dashboard')
@section('dashboard-content')
@section('button-add')
    <a href="{{ route('room.create') }}" type="button" class="btn btn-success">
        <i class="fa-solid fa-clone"></i>
        Create Room
    </a>
@endsection
<div class="py-2">
    <div class="card border-0 shadow-lg mb-4">
        <div class="card-header bg-white border-bottom py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1 fw-bold">Daftar Ruangan</h5>
                    <small class="text-muted">Kelola semua ruangan yang tersedia</small>
                </div>
                <span class="badge bg-primary fs-6 px-3 py-2">
                    Total: {{ $rooms->total() }} Ruangan
                </span>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="fw-semibold ps-4" style="width: 5%;">#</th>
                            <th scope="col" class="fw-semibold" style="width: 20%;">Nama Ruangan</th>
                            <th scope="col" class="fw-semibold" style="width: 20%;">
                                <i class="fa-solid fa-location-dot text-danger me-1"></i>Lokasi
                            </th>
                            <th scope="col" class="fw-semibold text-center" style="width: 10%;">
                                <i class="fa-solid fa-users text-primary me-1"></i>Kapasitas
                            </th>
                            <th scope="col" class="fw-semibold" style="width: 30%;">Deskripsi</th>
                            <th scope="col" class="fw-semibold text-center" style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rooms as $index => $room)
                            <tr class="border-bottom">
                                <td class="ps-4">
                                    <span class="badge bg-light text-dark border">
                                        {{ $rooms->firstItem() + $index }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 rounded p-2 me-2">
                                            <i class="fa-solid fa-door-open text-primary"></i>
                                        </div>
                                        <span class="fw-semibold">{{ $room->room_name }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted">
                                        <i class="fa-solid fa-building me-1"></i>
                                        {{ $room->location }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center ">
                                        <div class="bg-primary bg-opacity-10 rounded p-2 me-2">
                                            <i class="fa-solid fa-chair text-primary"></i>
                                        </div>
                                        <span class="fw-semibold">{{ $room->capacity }}</span>
                                    </div>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        {{ Str::limit($room->description, 60) }}
                                    </small>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('room.edit', $room->id) }}"
                                            class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip"
                                            title="Edit Ruangan">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('room.destroy', $room->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                data-bs-toggle="tooltip" title="Delete Ruangan">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="py-4">
                                        <i class="fa-solid fa-inbox fa-3x text-muted mb-3"></i>
                                        <p class="text-muted mb-0 fst-italic">Belum ada ruangan tersedia.</p>
                                        <small class="text-muted">Silakan tambahkan ruangan baru.</small>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white border-top py-3">
                <div>
                    {{ $rooms->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
