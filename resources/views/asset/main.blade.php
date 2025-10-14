<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.8-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-7.1.0-web/css/all.css') }}">
    <title>@yield('title')</title>
</head>

<body>
    @yield('content')
    <script src="{{ asset('bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js') }}"></script>


    @if (session()->has('error') || session()->has('success') || $errors->any())
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast"
                class="toast align-items-center border-0 show
                {{ session()->has('success') ? 'text-bg-success' : 'text-bg-danger' }}"
                role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        @if (session()->has('success'))
                            {{ session('success') }}
                        @endif

                        @if (session()->has('error'))
                            {{ session('error') }}
                        @endif

                        @if ($errors->any())
                            {{ $errors->first() }}
                        @endif
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toastEl = document.getElementById('errorToast');
            if (toastEl) {
                const toast = new bootstrap.Toast(toastEl, {
                    delay: 4000
                });
                toast.show();
            }
        });
    </script>
</body>

</html>
