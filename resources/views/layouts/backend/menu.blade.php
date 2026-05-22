<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="/home"><span class="brand-logo">
                        <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                            <defs>
                                <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                    <stop stop-color="#000000" offset="0%"></stop>
                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                </lineargradient>
                                <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                                    <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                </lineargradient>
                            </defs>
>
                        </svg></span>
                    <h2 class="brand-text">Dashboard Adm</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>

    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item {{ (request()->is('home')) ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="/home"><i data-feather="home"></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboards">Dashboard</span>
                </a>
            </li>

            {{-- MENU ADMIN --}}
            @if (Auth::user()->role == 'Admin')
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="#"><i data-feather="credit-card"></i>
                    <span class="menu-title text-truncate" data-i18n="Card">Website</span>
                </a>
                <ul class="menu-content">
                    <li class="nav-item {{ (request()->is('program-studi')) ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href=" {{route('program-studi.index')}} "><i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Basic">Program</span>
                        </a>
                    </li>
                    <li class="nav-item {{ (request()->is('backend-kegiatan')) ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href=" {{route('backend-kegiatan.index')}} "><i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Basic">Kegiatan</span>
                        </a>
                    </li>
                    <li class="nav-item {{ (request()->is('backend-imageslider')) ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href=" {{route('backend-imageslider.index')}} "><i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Basic">Gambar Slider</span>
                        </a>
                    </li>
                    <li class="nav-item {{ (request()->is('backend-about')) ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href=" {{route('backend-about.index')}} "><i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Basic">About</span>
                        </a>
                    </li>
                    <li class="nav-item {{ (request()->is('backend-video')) ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href=" {{route('backend-video.index')}} "><i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Basic">Video</span>
                        </a>
                    </li>
                    <li class="nav-item {{ (request()->is('backend-kategori-berita')) ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href=" {{route('backend-kategori-berita.index')}} "><i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Basic">Kategori Berita</span>
                        </a>
                    </li>
                    <li class="nav-item {{ (request()->is('backend-berita')) ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href=" {{route('backend-berita.index')}} "><i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Basic">Berita</span>
                        </a>
                    </li>
                    <li class="nav-item {{ (request()->is('backend-event')) ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href=" {{route('backend-event.index')}} "><i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Basic">Event</span>
                        </a>
                    </li>
                    <li class="nav-item {{ (request()->is('backend-footer')) ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href=" {{route('backend-footer.index')}} "><i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Basic">Footer</span>
                        </a>
                    </li>
                    <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Second Level">Tentang</span></a>
                        <ul class="menu-content">
                            <li class="nav-item {{ (request()->is('backend-profile-sekolah')) ? 'active' : '' }}">
                                <a class="d-flex align-items-center" href="{{route('backend-profile-sekolah.index')}}"><span class="menu-item text-truncate" data-i18n="Third Level">Profile Sekolah</span></a>
                            </li>
                            <li class="nav-item {{ (request()->is('backend-visimisi')) ? 'active' : '' }}">
                                <a class="d-flex align-items-center" href="{{route('backend-visimisi.index')}}"><span class="menu-item text-truncate" data-i18n="Third Level">Visi dan Misi</span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li class=" nav-item">
                <a class="d-flex align-items-center" href="#"><i data-feather="users"></i>
                    <span class="menu-title text-truncate" data-i18n="Card">Pengguna</span>
                </a>
                <ul class="menu-content">
                    <li class="nav-item {{ (request()->is('backend-pengguna-pengajar')) ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href=" {{route('backend-pengguna-pengajar.index')}} "><i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Basic">Pengajar</span>
                        </a>
                    </li>
                    <li class="nav-item {{ (request()->is('backend-pengguna-mahasiswa*')) ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('backend-pengguna-mahasiswa.index') }}"><i data-feather="circle"></i>
                            <span class="menu-item text-truncate">Mahasiswa</span>
                        </a>
                    </li>
                    <li class="nav-item {{ (request()->is('backend-pengguna-komting*')) ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('backend-pengguna-komting.index') }}"><i data-feather="circle"></i>
                            <span class="menu-item text-truncate">Komting Kelas</span>
                        </a>
                    </li>
                    <li class="{{ (request()->is('backend-absensi*')) ? 'sidebar-group-active open' : '' }}">
                        <a class="d-flex align-items-center" href="#"><i data-feather="check-square"></i><span class="menu-item text-truncate">Absensi</span></a>
                        <ul class="menu-content">
                            <li class="{{ (request()->is('backend-absensi') || request()->is('backend-absensi/create*')) ? 'active' : '' }}">
                                <a class="d-flex align-items-center" href="{{ route('backend-absensi.index') }}"><span class="menu-item text-truncate">Input Absensi</span></a>
                            </li>
                            <li class="{{ (request()->is('backend-absensi-rekap*')) ? 'active' : '' }}">
                                <a class="d-flex align-items-center" href="{{ route('backend-absensi.rekap') }}"><span class="menu-item text-truncate">Rekap Poin</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ (request()->is('backend-prestasi-*')) ? 'sidebar-group-active open' : '' }}">
                        <a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate">Prestasi Mahasiswa</span></a>
                        <ul class="menu-content">
                            <li class="{{ (request()->is('backend-prestasi-overview') || request()->is('backend-prestasi-detail*')) ? 'active' : '' }}">
                                <a class="d-flex align-items-center" href="{{ route('backend-prestasi-overview') }}"><span class="menu-item text-truncate">Overview</span></a>
                            </li>
                            <li class="{{ (request()->is('backend-prestasi-penghargaan*')) ? 'active' : '' }}">
                                <a class="d-flex align-items-center" href="{{ route('backend-prestasi-penghargaan.index') }}"><span class="menu-item text-truncate">Penghargaan</span></a>
                            </li>
                            <li class="{{ (request()->is('backend-prestasi-sertifikat*')) ? 'active' : '' }}">
                                <a class="d-flex align-items-center" href="{{ route('backend-prestasi-sertifikat.index') }}"><span class="menu-item text-truncate">Sertifikat</span></a>
                            </li>
                            <li class="{{ (request()->is('backend-prestasi-perlombaan*')) ? 'active' : '' }}">
                                <a class="d-flex align-items-center" href="{{ route('backend-prestasi-perlombaan.index') }}"><span class="menu-item text-truncate">Perlombaan</span></a>
                            </li>
                            <li class="{{ (request()->is('backend-prestasi-portofolio*')) ? 'active' : '' }}">
                                <a class="d-flex align-items-center" href="{{ route('backend-prestasi-portofolio.index') }}"><span class="menu-item text-truncate">Portofolio</span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            @endif
        </ul>
    </div>
</div>