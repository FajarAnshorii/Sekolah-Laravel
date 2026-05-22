<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login - Portal Mahasiswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Google Fonts: Outfit & Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('Assets/Frontend/css/bootstrap.min.css') }}">
    
    <!-- Font-awesome 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <style>
        :root {
            --bg-gradient: linear-gradient(135deg, #7f53ac 0%, #647dee 100%);
            --card-bg: rgba(255, 255, 255, 0.95);
            --primary: #6f42c1;
            --primary-gradient: linear-gradient(135deg, #5034b0 0%, #8c52ff 100%);
            --text-dark: #2c2e3e;
            --text-muted: #8a8a9e;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-gradient);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            margin: 0;
        }

        .login-card {
            background: var(--card-bg);
            border-radius: 24px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 540px;
            padding: 3.5rem 3rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
            background: var(--primary-gradient);
            margin: -3.5rem -3rem 2.5rem -3rem;
            padding: 3rem 2.5rem;
            border-top-left-radius: 24px;
            border-top-right-radius: 24px;
            color: #ffffff;
        }

        .login-header i {
            font-size: 4rem;
            margin-bottom: 1rem;
            display: block;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.1));
        }

        .login-header h2 {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 2.3rem;
            margin: 0;
            letter-spacing: -0.5px;
        }

        .login-header p {
            font-family: 'Outfit', sans-serif;
            font-size: 1.15rem;
            margin: 0.6rem 0 0 0;
            opacity: 0.9;
        }

        .login-info-box {
            background-color: #e8f0fe;
            border-left: 5px solid #1a73e8;
            padding: 1.2rem 1.5rem;
            border-radius: 12px;
            font-size: 1.15rem;
            color: #1a73e8;
            margin-bottom: 2.2rem;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            line-height: 1.5;
        }

        .login-info-box i {
            font-size: 1.3rem;
            margin-top: 3px;
        }

        .form-group label {
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            font-size: 1.2rem;
            color: var(--text-dark);
            margin-bottom: 0.75rem;
            display: block;
        }

        .form-control {
            border-radius: 12px;
            padding: 1rem 1.25rem;
            font-size: 1.2rem;
            border: 1.5px solid #ebe9f1;
            transition: all 0.2s ease;
            color: var(--text-dark);
            background-color: #ffffff;
            height: auto;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(111, 66, 193, 0.15);
            outline: none;
        }

        .btn-portal-submit {
            background: var(--primary-gradient);
            border: none;
            color: #ffffff;
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            font-size: 1.3rem;
            padding: 1rem;
            width: 100%;
            border-radius: 12px;
            transition: all 0.2s ease;
            box-shadow: 0 4px 15px rgba(111, 66, 193, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-top: 2.2rem;
            cursor: pointer;
        }

        .btn-portal-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(111, 66, 193, 0.4);
        }

        .btn-portal-submit:active {
            transform: translateY(0);
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 1.8rem;
            font-size: 1.15rem;
            color: var(--primary);
            font-family: 'Outfit', sans-serif;
            font-weight: 500;
            text-decoration: none;
            transition: opacity 0.2s ease;
        }

        .back-link:hover {
            opacity: 0.8;
            text-decoration: none;
            color: var(--primary);
        }

        .back-link i {
            margin-right: 5px;
        }

        .invalid-feedback {
            display: block;
            font-size: 1.05rem;
            color: #ea5455;
            margin-top: 0.35rem;
            font-weight: 500;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <!-- HEADER -->
        <div class="login-header">
            <i class="fas fa-graduation-cap"></i>
            <h2>Portal Mahasiswa</h2>
            <p>SMK Riwata Piarsoinar - Sistem Portofolio & Prestasi</p>
        </div>

        <!-- NOTIFICATION BANNER -->
        <div class="login-info-box">
            <i class="fas fa-info-circle"></i>
            <span>Login menggunakan <strong>Nama Lengkap</strong> Anda sebagai Nama Pengguna, dan <strong>NIM</strong> sebagai Kata Sandi.</span>
        </div>

        @if(Session::has('error'))
            <div class="alert alert-danger font-weight-bold" style="border-radius: 8px; font-size: 0.85rem;">
                <i class="fas fa-exclamation-triangle mr-2"></i> {{ Session::get('error') }}
            </div>
        @endif

        @if(Session::has('success'))
            <div class="alert alert-success font-weight-bold" style="border-radius: 8px; font-size: 0.85rem;">
                <i class="fas fa-check-circle mr-2"></i> {{ Session::get('success') }}
            </div>
        @endif

        <!-- ERROR STATE FROM FORM -->
        @if($errors->has('login_error'))
            <div class="alert alert-danger font-weight-bold" style="border-radius: 8px; font-size: 0.85rem;">
                <i class="fas fa-exclamation-circle mr-2"></i> {{ $errors->first('login_error') }}
            </div>
        @endif

        <!-- FORM -->
        <form action="{{ route('portal-mahasiswa.login.post') }}" method="POST">
            @csrf
            
            <div class="form-group mb-3">
                <label for="username">Nama Pengguna (Nama Lengkap)</label>
                <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" placeholder="Contoh: ACHMAD MUBAROK NUR AFENDI" value="{{ old('username') }}" required autocomplete="name">
                @error('username')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="password">Kata Sandi (NIM)</label>
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan NIM sebagai sandi" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-portal-submit">
                <i class="fas fa-sign-in-alt"></i> Masuk
            </button>
        </form>

        <!-- KEMBALI KE WEBSITE SEKOLAH -->
        <a href="/" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Website Sekolah
        </a>
    </div>

</body>
</html>
