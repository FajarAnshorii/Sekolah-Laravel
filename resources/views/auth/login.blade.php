<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Sekolah Pintar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- FONT --}}
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- BOOTSTRAP --}}
    <link rel="stylesheet" href="{{ asset('Assets/Backend/css/bootstrap.css') }}">

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background:
                linear-gradient(rgba(0,0,0,.45), rgba(0,0,0,.45)),
                url("{{ asset('Assets/Backend/images/bg-login.png') }}")
                no-repeat center center fixed;
            background-size: cover;
        }

        /* ===== GLASS LOGIN CARD ===== */
        .login-card {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 18px;
            border: 1px solid rgba(255, 255, 255, 0.35);
            color: #fff;

            transform: scale(1);
            transition:
                background .4s ease,
                backdrop-filter .4s ease,
                transform .4s ease,
                box-shadow .4s ease,
                color .4s ease;
        }

        /* ===== HOVER → JELAS + ZOOM ===== */
        .login-card:hover {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(0);
            -webkit-backdrop-filter: blur(0);
            color: #333;

            transform: scale(1.06);
            box-shadow: 0 20px 50px rgba(0,0,0,.35);
        }

        .login-card:hover h2,
        .login-card:hover h4,
        .login-card:hover p,
        .login-card:hover label {
            color: #333 !important;
        }

        /* INPUT */
        .form-control {
            height: 48px;
            border-radius: 10px;
        }

        /* BUTTON */
        .btn-primary {
            height: 48px;
            border-radius: 10px;
            font-weight: 600;
        }

        /* BACK BUTTON GLASS EFFECT */
        .btn-back-home {
            height: 48px;
            border-radius: 10px;
            font-weight: 600;
            border: 1px solid rgba(255, 255, 255, 0.4);
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .btn-back-home:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 255, 255, 0.6);
            color: #fff;
        }

        /* CARD HOVER COMPATIBILITY */
        .login-card:hover .btn-back-home {
            border-color: #6c757d;
            color: #495057;
            background: transparent;
        }

        .login-card:hover .btn-back-home:hover {
            background: rgba(0, 0, 0, 0.05);
            color: #212529;
            border-color: #343a40;
        }

        /* ANIMASI MASUK */
        .login-card {
            animation: fadeZoom 0.8s ease;
        }

        @keyframes fadeZoom {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
</head>

<body>

<div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="card login-card w-100 shadow-lg" style="max-width: 420px">
        <div class="card-body p-4 p-md-5">

            {{-- HEADER --}}
            <div class="text-center mb-4">
                <h2 class="fw-bold">Sekolah Pintar</h2>
                <p>Sistem Manajemen Sekolah</p>
            </div>

            {{-- ALERT --}}
            @if($message = Session::get('error'))
                <div class="alert alert-danger">{{ $message }}</div>
            @endif

            <h4 class="mb-1">Selamat Datang 👋</h4>
            <p class="mb-3">Silakan login untuk melanjutkan</p>

            {{-- FORM (BACKEND TETAP) --}}
            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="email@example.com">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password"
                           name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="••••••••">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-primary w-100 mb-2">
                    Masuk
                </button>
                <a href="{{ url('/') }}" class="btn-back-home w-100">
                    Kembali ke Halaman Utama
                </a>
            </form>

            <p class="text-center mt-4 mb-0 small">
                © {{ date('Y') }} Sekolah Pintar
            </p>

        </div>
    </div>
</div>

</body>
</html>
