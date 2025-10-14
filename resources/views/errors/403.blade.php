@extends('asset.main')
@section('title', '403 - Forbidden')
@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-8 col-lg-6">
            <div class="text-center">
                <h1 class="display-1 fw-bold text-danger">403</h1>
                <h2 class="mb-4">Akses Ditolak</h2>
                <p class="lead text-muted mb-4">
                    Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
