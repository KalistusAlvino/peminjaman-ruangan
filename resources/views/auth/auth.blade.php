@extends('asset.main')
@section('title', 'Authentication')
@section('content')
    <main class="vh-100" style="background-color: #F8FAFC;">
        <section class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-12">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-6 d-none d-md-block">
                                <img src="{{ asset('storage/asset/meeting-room3-4.jpg') }}" alt="login form"
                                    class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-6 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black" style="background-color: #FFFFFF">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <span class="h1 fw-bold mb-0">Peminjaman Ruangan</span>
                                        </div>

                                        <h5 class="fw-normal mb-3 {{ $errors->has('error') ? 'pb-0' : 'pb-3' }} " style="letter-spacing: 1px;">Sign into your account
                                        </h5>
                                        <div data-mdb-input-init class="form-outline mb-4">
                                            @if ($errors->has('error'))
                                                <p class="text-danger">{{ $errors->first('error') }}</p>
                                            @endif

                                            <input type="text" name="username" id="usernameForm" class="form-control form-control-lg" required/>
                                            <label class="form-label" for="usernameForm">Username</label>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="password" name="password" id="passwordForm" class="form-control form-control-lg" required/>
                                            <label class="form-label" for="passwordForm">Password</label>
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
