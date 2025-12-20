<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="horizontal">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon.ico') }}" />

    <!-- Core Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />

    <title>{{ config('app.name') }} | Login</title>

    <style>
        .auth-card .card {
            box-shadow: 0 20px 27px 0 rgba(0, 0, 0, 0.05);
        }

        .input-group:focus-within {
            border-color: #5D87FF !important;
            box-shadow: 0 0 0 0.25rem rgba(93, 135, 255, 0.1);
        }

        .fs-10 {
            font-size: 2.5rem !important;
        }

        .bg-primary-subtle {
            background-color: #ecf2ff !important;
        }
    </style>
</head>

<body>
    <div id="main-wrapper" class="auth-customizer-none">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 w-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-11 col-md-8 col-lg-5 col-xxl-3 auth-card">
                        <div class="card mb-0 border-0 rounded-4">
                            <div class="card-body p-4 p-md-5">
                                <div class="text-center mb-4">
                                    <div class="mb-3">
                                        <img src="{{ asset('assets/images/logos/logo.png') }}" alt="logo" width="70">
                                    </div>
                                    <h3 class="fw-semibold mb-1">{{ config('app.name') }}</h3>
                                    <p class="text-muted">Silakan masuk ke panel admin</p>
                                </div>

                                <form method="POST" action="{{ route('admin.login.submit') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <div
                                            class="input-group border rounded-2 overflow-hidden @error('username') is-invalid @enderror">
                                            <span class="input-group-text bg-white border-0 text-muted">
                                                <i class="ti ti-user"></i>
                                            </span>
                                            <input type="text" class="form-control border-0 ps-0 shadow-none"
                                                name="username" placeholder="Masukkan username"
                                                value="{{ old('username') }}" required autofocus>
                                        </div>
                                        @error('username')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Password</label>
                                        <div class="input-group border rounded-2 overflow-hidden"
                                            id="show_hide_password">
                                            <span class="input-group-text bg-white border-0 text-muted">
                                                <i class="ti ti-lock"></i>
                                            </span>
                                            <input type="password" class="form-control border-0 ps-0 shadow-none"
                                                name="password" placeholder="********" required>
                                            <span class="input-group-text bg-white border-0">
                                                <a href="javascript:void(0)" class="text-muted"><i
                                                        class="ti ti-eye-off fs-5"></i></a>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input primary" type="checkbox"
                                                id="flexCheckChecked" checked name="remember">
                                            <label class="form-check-label text-dark small" for="flexCheckChecked">
                                                Tetap masuk di perangkat ini
                                            </label>
                                        </div>
                                    </div>

                                    <button type="submit"
                                        class="btn btn-primary w-100 py-2 fs-4 rounded-2 fw-bold">
                                        Masuk Sekarang
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <p class="mb-0 text-muted small">&copy; {{ date('Y') }} {{ config('app.name') }}. All
                                Rights Reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dark-transparent sidebartoggler"></div>
    <!-- Import Js Files -->
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/theme/app.horizontal.init.js') }}"></script>
    <script src="{{ asset('assets/js/theme/theme.js') }}"></script>
    <script src="{{ asset('assets/js/theme/app.min.js') }}"></script>

    <!-- solar icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("ti-eye-off");
                    $('#show_hide_password i').removeClass("ti-eye");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("ti-eye-off");
                    $('#show_hide_password i').addClass("ti-eye");
                }
            });
        });
    </script>
</body>

</html>
