<!doctype html>
<html class="no-js" lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title') - Portal Mahasiswa Sekolah Pintar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Google Fonts: Outfit & Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS from theme -->
    <link rel="stylesheet" href="{{ asset('Assets/Frontend/css/bootstrap.min.css') }}">
    
    <!-- Font-awesome 5 CDN for perfect icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <style>
        :root {
            --primary: #6f42c1;
            --primary-gradient: linear-gradient(135deg, #4f22c1 0%, #894bfa 100%);
            --secondary: #ffb800;
            --secondary-gradient: linear-gradient(135deg, #f39c12 0%, #f1c40f 100%);
            --dark: #1e1e2d;
            --light: #f4f5f7;
            --white: #ffffff;
            --text-main: #3f4254;
            --text-muted: #b5b5c3;
            --text-dark: #2c2e3e; /* Added to fix all undefined dark text colors and hover states */
            --success: #28c76f;
            --info: #00cfdd;
            --danger: #ea5455;
            --warning: #ff9f43;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light);
            color: var(--text-main);
            margin: 0;
            padding-top: 0 !important; /* Override standard offset if any */
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-size: 1.05rem; /* Increased base body font size */
            line-height: 1.6;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
        }

        /* ===== PREMIUM NAVBAR ===== */
        .portal-navbar {
            background: var(--primary-gradient);
            box-shadow: 0 4px 20px rgba(111, 66, 193, 0.15);
            padding: 0.75rem 2rem;
            position: sticky;
            top: 0;
            z-index: 1050;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .portal-navbar .navbar-brand {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 1.4rem;
            color: var(--white) !important;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: opacity 0.2s ease;
        }

        .portal-navbar .navbar-brand:hover {
            opacity: 0.9;
        }

        .portal-navbar .navbar-brand i {
            font-size: 1.6rem;
        }

        .portal-nav-links {
            display: flex;
            align-items: center;
            gap: 5px;
            margin: 0 auto 0 2rem;
            list-style: none;
            padding: 0;
        }

        .portal-nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            font-family: 'Outfit', sans-serif;
            font-size: 0.95rem;
            font-weight: 500;
            padding: 0.6rem 1.1rem !important;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .portal-nav-link:hover {
            color: var(--white) !important;
            background: rgba(255, 255, 255, 0.1);
        }

        .portal-nav-item.active .portal-nav-link {
            color: var(--white) !important;
            background: rgba(255, 255, 255, 0.15);
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.05);
        }

        .btn-portal-logout {
            color: var(--white) !important;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            font-family: 'Outfit', sans-serif;
            font-size: 0.9rem;
            font-weight: 500;
            padding: 0.5rem 1.2rem;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .btn-portal-logout:hover {
            background: var(--danger);
            border-color: var(--danger);
            box-shadow: 0 4px 12px rgba(234, 84, 85, 0.3);
        }

        /* ===== MAIN CONTENT WRAPPER ===== */
        .portal-container {
            flex: 1;
            padding: 2.5rem 0;
        }

        /* ===== PREMIUM FOOTER ===== */
        .portal-footer {
            background-color: var(--dark);
            color: #b5b5c3;
            padding: 3rem 0 1.5rem 0;
            margin-top: auto;
            border-top: 5px solid var(--primary);
        }

        .portal-footer h5 {
            color: var(--white);
            font-family: 'Outfit', sans-serif;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1.2rem;
        }

        .portal-footer a {
            color: #b5b5c3;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .portal-footer a:hover {
            color: var(--white);
        }

        .portal-footer .footer-socials {
            display: flex;
            gap: 15px;
            margin-top: 10px;
        }

        .portal-footer .footer-socials a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            transition: all 0.2s ease;
        }

        .portal-footer .footer-socials a:hover {
            background: var(--primary);
            color: var(--white);
            transform: translateY(-2px);
        }

        .portal-footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            margin-top: 2rem;
            padding-top: 1.5rem;
            font-size: 0.85rem;
            text-align: center;
        }

        /* Responsive Navbar toggler */
        .portal-toggler {
            border: none;
            color: var(--white);
            font-size: 1.5rem;
            background: transparent;
            padding: 0;
            outline: none !important;
        }

        @media (max-width: 991px) {
            .portal-navbar {
                padding: 0.75rem 1rem;
            }
            .portal-nav-links {
                flex-direction: column;
                align-items: stretch;
                width: 100%;
                margin: 1rem 0;
                gap: 5px;
            }
            .portal-nav-link {
                padding: 0.75rem 1rem !important;
            }
            .btn-portal-logout {
                width: 100%;
                justify-content: center;
            }
        }

        /* ===== FLUID FULL-WIDTH CONTAINER ("Rata Kanan Kiri") ===== */
        .max-width-container {
            max-width: 1300px !important;
            margin-left: auto !important;
            margin-right: auto !important;
            padding-left: 3rem !important;
            padding-right: 3rem !important;
            width: 100% !important;
        }

        @media (max-width: 1200px) {
            .max-width-container {
                padding-left: 2.5rem !important;
                padding-right: 2.5rem !important;
            }
        }

        @media (max-width: 768px) {
            .max-width-container {
                padding-left: 1.5rem !important;
                padding-right: 1.5rem !important;
            }
        }

        /* ===== GLOBAL FONT SIZE & LEGIBILITY OVERRIDES ===== */
        .portal-navbar {
            padding: 1.2rem 2rem !important; /* Make navbar taller & premium */
        }
        .portal-navbar .max-width-container {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
        }
        .portal-navbar .navbar-brand {
            font-size: 1.85rem !important; /* Enlarged brand text */
            font-weight: 800 !important;
            padding-top: 0 !important;
            padding-bottom: 0 !important;
            margin-top: 0 !important;
            margin-bottom: 0 !important;
            display: flex !important;
            align-items: center !important;
            gap: 12px !important; /* Space between icon & text */
        }
        .portal-navbar .navbar-brand i {
            font-size: 2.1rem !important; /* Enlarged brand icon */
            display: inline-flex !important;
            align-items: center !important;
        }
        .portal-nav-link {
            font-size: 1.15rem !important; /* Enlarged nav links */
            padding: 0.6rem 1.2rem !important;
            display: flex !important;
            align-items: center !important;
            gap: 8px !important;
            line-height: 1.2 !important;
        }
        .portal-nav-link i {
            font-size: 1.25rem !important; /* Enlarged nav link icons */
            display: inline-flex !important;
            align-items: center !important;
        }
        .btn-portal-logout {
            font-size: 1.15rem !important; /* Enlarged logout button */
            padding: 0.6rem 1.4rem !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 8px !important;
            line-height: 1.2 !important;
        }
        .btn-portal-logout i {
            font-size: 1.2rem !important; /* Enlarged logout icon */
            display: inline-flex !important;
            align-items: center !important;
        }

        /* Explicit toggler & collapse layout handling to prevent bootstrap version conflicts */
        .portal-toggler {
            display: none !important;
        }

        /* Desktop layout (>= 992px) to prevent wrapping and ensure perfect row alignment */
        @media (min-width: 992px) {
            .portal-navbar .navbar-collapse {
                display: flex !important;
                flex-direction: row !important;
                flex-wrap: nowrap !important;
                justify-content: space-between !important;
                align-items: center !important;
                width: 100% !important;
                height: 100% !important;
                gap: 30px !important; /* Ensures Portofolio and Keluar never touch */
            }
            .portal-nav-links {
                display: flex !important;
                flex-direction: row !important;
                flex-wrap: nowrap !important;
                align-items: center !important;
                gap: 15px !important;
                margin: 0 0 0 2.5rem !important;
                padding: 0 !important;
            }
            .portal-navbar .navbar-nav.ml-auto {
                margin-left: auto !important;
                margin-right: 0 !important;
                display: flex !important;
                flex-direction: row !important;
                flex-wrap: nowrap !important;
                align-items: center !important;
            }
        }

        /* Prevent crowding on standard desktop/tablet screens (992px - 1200px) */
        @media (min-width: 992px) and (max-width: 1200px) {
            .portal-navbar {
                padding: 1rem 1.5rem !important;
            }
            .portal-navbar .navbar-brand {
                font-size: 1.55rem !important;
            }
            .portal-navbar .navbar-brand i {
                font-size: 1.8rem !important;
            }
            .portal-nav-link {
                font-size: 1.05rem !important;
                padding: 0.5rem 0.9rem !important;
            }
            .portal-nav-links {
                gap: 10px !important;
                margin-left: 1.5rem !important;
            }
            .btn-portal-logout {
                font-size: 1.05rem !important;
                padding: 0.5rem 1.1rem !important;
            }
        }

        /* Mobile layout (< 992px) */
        @media (max-width: 991px) {
            .portal-toggler {
                display: block !important;
            }
            .portal-navbar .navbar-brand {
                font-size: 1.55rem !important;
            }
            .portal-navbar .navbar-brand i {
                font-size: 1.8rem !important;
            }
            .portal-navbar .navbar-collapse {
                width: 100% !important;
            }
            .portal-navbar .navbar-collapse.show {
                display: flex !important;
                flex-direction: column !important;
                align-items: stretch !important;
            }
            .portal-nav-links {
                display: flex !important;
                flex-direction: column !important;
                align-items: stretch !important;
                margin: 1rem 0 !important;
                gap: 8px !important;
                padding: 0 !important;
            }
            .portal-nav-link {
                font-size: 1.2rem !important;
                padding: 0.75rem 1rem !important;
            }
            .portal-navbar .navbar-nav.ml-auto {
                margin-left: 0 !important;
                width: 100% !important;
                display: flex !important;
                flex-direction: column !important;
            }
            .btn-portal-logout {
                font-size: 1.2rem !important;
                padding: 0.75rem 1rem !important;
                width: 100% !important;
                justify-content: center !important;
            }
        }

        /* Dashboard specific overrides */
        .welcome-card {
            padding: 2.2rem 2.5rem !important;
            border-radius: 20px !important;
            margin-bottom: 2rem !important;
        }
        .welcome-card h2 {
            font-size: 2.6rem !important;
            font-weight: 800 !important;
            margin-bottom: 0.8rem !important;
            color: #ffffff !important;
        }
        .welcome-card p.subtitle {
            font-size: 1.35rem !important;
            margin-bottom: 1.5rem !important;
            font-weight: 600 !important;
            color: #ffffff !important;
        }
        .welcome-details {
            font-size: 1.15rem !important;
            gap: 20px !important;
        }
        .welcome-details span {
            padding: 0.5rem 1.2rem !important;
            font-size: 1.1rem !important;
            border-radius: 50px !important;
        }

        .metric-card {
            padding: 1.8rem 2rem !important;
            border-radius: 20px !important;
            margin-bottom: 2rem !important;
        }
        .metric-count {
            font-size: 3.5rem !important;
            font-weight: 800 !important;
            margin-bottom: 0.3rem !important;
            color: #ffffff !important;
        }
        .metric-title {
            font-size: 1.25rem !important;
            font-weight: 700 !important;
            margin-bottom: 1.2rem !important;
            color: #ffffff !important;
        }
        .metric-btn {
            font-size: 1.05rem !important;
            padding: 0.5rem 1.2rem !important;
            border-radius: 10px !important;
        }
        .metric-btn:hover {
            background: #ffffff !important;
            color: var(--text-dark) !important;
            border-color: #ffffff !important;
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.3) !important;
        }

        .poin-card {
            border-radius: 20px !important;
            margin-bottom: 2rem !important;
        }
        .poin-card-header {
            padding: 1.6rem 2rem !important;
        }
        .poin-card-header h4 {
            font-size: 1.45rem !important;
            font-weight: 800 !important;
        }
        .poin-card-header i {
            font-size: 1.6rem !important;
        }
        .poin-grid {
            padding: 2rem !important;
            gap: 24px !important;
        }
        .poin-box {
            padding: 1.8rem 1.5rem !important;
            border-radius: 16px !important;
        }
        .poin-box-total .count {
            font-size: 3.8rem !important;
        }
        .poin-box-total .label {
            font-size: 1.15rem !important;
            font-weight: 700 !important;
        }
        .poin-box-badge .badge-title {
            font-size: 2.0rem !important;
            font-weight: 800 !important;
        }
        .poin-box-badge .label {
            font-size: 1.05rem !important;
            font-weight: 700 !important;
        }
        .poin-box-stat .count {
            font-size: 3.0rem !important;
        }
        .poin-box-stat .label {
            font-size: 1.05rem !important;
            font-weight: 700 !important;
        }
        .poin-box-breakdown {
            padding: 1.5rem !important;
            font-size: 1.05rem !important;
        }
        .poin-box-breakdown h6 {
            font-size: 1.2rem !important;
            margin-bottom: 0.8rem !important;
        }
        .poin-box-breakdown li {
            margin-bottom: 0.5rem !important;
        }
        .poin-banner {
            font-size: 1.05rem !important;
            padding: 1.2rem 2rem !important;
        }
        .poin-banner i {
            font-size: 1.25rem !important;
        }

        .dashboard-block-header h4 {
            font-size: 1.9rem !important;
            font-weight: 800 !important;
        }
        .btn-action-portal {
            font-size: 1.45rem !important;
            padding: 2.2rem !important;
            gap: 15px !important;
            border-radius: 20px !important;
        }
        .profile-info-label, .profile-info-value {
            font-size: 1.3rem !important;
        }
        .profile-info-list {
            gap: 25px !important;
        }
        .profile-info-item {
            padding-bottom: 18px !important;
        }

        /* Modules Table & List overrides */
        .portal-block {
            padding: 3.5rem !important;
            border-radius: 24px !important;
        }
        .portal-block-title {
            font-size: 2.1rem !important;
            font-weight: 800 !important;
        }
        .btn-portal-add {
            font-size: 1.35rem !important;
            padding: 0.85rem 2rem !important;
            border-radius: 14px !important;
        }
        .table-portal th {
            font-size: 1.3rem !important;
            padding: 1.6rem 1.4rem !important;
        }
        .table-portal td {
            font-size: 1.3rem !important;
            padding: 1.6rem 1.4rem !important;
        }
        .badge-tingkat {
            font-size: 1.1rem !important;
            padding: 0.6rem 1.2rem !important;
        }
        .btn-portal-action {
            font-size: 1.2rem !important;
            padding: 0.75rem 1.4rem !important;
            border-radius: 12px !important;
        }

        /* Form elements overrides */
        .portal-form-block {
            padding: 3.5rem !important;
            border-radius: 24px !important;
        }
        .portal-form-title {
            font-size: 2.1rem !important;
            font-weight: 800 !important;
        }
        .btn-portal-back {
            font-size: 1.3rem !important;
            padding: 0.8rem 1.8rem !important;
            border-radius: 12px !important;
        }
        .form-group label {
            font-size: 1.3rem !important;
            margin-bottom: 0.85rem !important;
        }
        .form-control, select.form-control {
            font-size: 1.3rem !important;
            padding: 1.1rem 1.4rem !important;
            border-radius: 14px !important;
        }
        .custom-file-label {
            font-size: 1.3rem !important;
            padding: 1.1rem 1.4rem !important;
            height: auto !important;
            border-radius: 14px !important;
        }
        .custom-file-label::after {
            font-size: 1.3rem !important;
            padding: 1.1rem 1.8rem !important;
            height: auto !important;
            border-top-right-radius: 13px !important;
            border-bottom-right-radius: 13px !important;
        }
        .btn-portal-submit, .btn-portal-cancel {
            font-size: 1.35rem !important;
            padding: 1.1rem 2.6rem !important;
            border-radius: 14px !important;
        }
        .invalid-feedback {
            font-size: 1.1rem !important;
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- PORTAL NAVBAR -->
    <nav class="navbar navbar-expand-lg portal-navbar">
        <div class="container-fluid max-width-container">
            <a class="navbar-brand" href="{{ route('portal-mahasiswa.dashboard') }}">
                <i class="fas fa-graduation-cap"></i>
                <span>Portal Mahasiswa</span>
            </a>
            
            <button class="portal-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#portalNavbarSupportedContent" aria-controls="portalNavbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="portalNavbarSupportedContent">
                <ul class="portal-nav-links">
                    <li class="portal-nav-item {{ Route::is('portal-mahasiswa.dashboard') ? 'active' : '' }}">
                        <a class="portal-nav-link" href="{{ route('portal-mahasiswa.dashboard') }}">
                            <i class="fas fa-th-large"></i> Dashboard
                        </a>
                    </li>
                    <li class="portal-nav-item {{ Request::is('portal-mahasiswa/penghargaan*') ? 'active' : '' }}">
                        <a class="portal-nav-link" href="{{ route('portal-mahasiswa.penghargaan.index') }}">
                            <i class="fas fa-award"></i> Penghargaan
                        </a>
                    </li>
                    <li class="portal-nav-item {{ Request::is('portal-mahasiswa/sertifikat*') ? 'active' : '' }}">
                        <a class="portal-nav-link" href="{{ route('portal-mahasiswa.sertifikat.index') }}">
                            <i class="fas fa-certificate"></i> Sertifikat
                        </a>
                    </li>
                    <li class="portal-nav-item {{ Request::is('portal-mahasiswa/perlombaan*') ? 'active' : '' }}">
                        <a class="portal-nav-link" href="{{ route('portal-mahasiswa.perlombaan.index') }}">
                            <i class="fas fa-flag"></i> Perlombaan
                        </a>
                    </li>
                    <li class="portal-nav-item {{ Request::is('portal-mahasiswa/portofolio*') ? 'active' : '' }}">
                        <a class="portal-nav-link" href="{{ route('portal-mahasiswa.portofolio.index') }}">
                            <i class="fas fa-briefcase"></i> Portofolio
                        </a>
                    </li>
                    <li class="portal-nav-item {{ Route::is('portal-mahasiswa.profile') ? 'active' : '' }}">
                        <a class="portal-nav-link" href="{{ route('portal-mahasiswa.profile') }}">
                            <i class="fas fa-user-cog"></i> Profil
                        </a>
                    </li>
                </ul>
                
                <div class="navbar-nav ml-auto">
                    <form action="{{ route('portal-mahasiswa.logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn-portal-logout">
                            <i class="fas fa-sign-out-alt"></i> Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- PORTAL WRAPPER -->
    <div class="portal-container">
        <div class="container-fluid max-width-container">
            @yield('content')
        </div>
    </div>

    <!-- PORTAL FOOTER -->
    <footer class="portal-footer">
        <div class="container-fluid max-width-container">
            <div class="row">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <h5>Portal Mahasiswa</h5>
                    <p style="font-size: 0.9rem; line-height: 1.6; color: #a1a1b5;">
                        Sistem manajemen portofolio dan prestasi mahasiswa Sekolah Pintar. Platform yang dirancang untuk memfasilitasi mahasiswa dalam mendokumentasikan pencapaian akademik dan non-akademik secara terpadu.
                    </p>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0" style="padding-left: 2rem;">
                    <h5>Menu</h5>
                    <ul class="list-unstyled" style="font-size: 0.9rem; line-height: 2;">
                        <li><a href="{{ route('portal-mahasiswa.dashboard') }}"><i class="fas fa-chevron-right fa-xs mr-2 text-primary"></i> Dashboard</a></li>
                        <li><a href="{{ route('portal-mahasiswa.penghargaan.index') }}"><i class="fas fa-chevron-right fa-xs mr-2 text-primary"></i> Penghargaan</a></li>
                        <li><a href="{{ route('portal-mahasiswa.sertifikat.index') }}"><i class="fas fa-chevron-right fa-xs mr-2 text-primary"></i> Sertifikat</a></li>
                        <li><a href="{{ route('portal-mahasiswa.perlombaan.index') }}"><i class="fas fa-chevron-right fa-xs mr-2 text-primary"></i> Perlombaan</a></li>
                        <li><a href="{{ route('portal-mahasiswa.portofolio.index') }}"><i class="fas fa-chevron-right fa-xs mr-2 text-primary"></i> Portofolio</a></li>
                        <li><a href="{{ route('portal-mahasiswa.profile') }}"><i class="fas fa-chevron-right fa-xs mr-2 text-primary"></i> Profil</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h5>Kontak</h5>
                    <ul class="list-unstyled" style="font-size: 0.9rem; line-height: 2; color: #a1a1b5;">
                        <li><i class="fas fa-globe mr-2 text-primary"></i> <a href="https://www.sekolahrtpiardinar.sch.id" target="_blank">www.sekolahrtpiardinar.sch.id</a></li>
                        <li><i class="fas fa-envelope mr-2 text-primary"></i> <a href="mailto:info@sekolahrtpiardinar.sch.id">info@sekolahrtpiardinar.sch.id</a></li>
                        <li><i class="fas fa-phone mr-2 text-primary"></i> (021) 1234-5678</li>
                    </ul>
                    <div class="footer-socials">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="portal-footer-bottom">
                <p class="mb-0">&copy; {{ date('Y') }} Portal Mahasiswa Sekolah Pintar. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Core JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @yield('scripts')
</body>
</html>
