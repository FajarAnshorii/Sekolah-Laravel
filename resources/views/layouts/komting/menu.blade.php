<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ route('komting.dashboard') }}"><span class="brand-logo">
                        <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                            <defs>
                                <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                    <stop stop-color="#000000" offset="0%"></stop>
                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                </lineargradient>
                            </defs>
                        </svg></span>
                    <h2 class="brand-text" style="font-size: 1.15rem; padding-left: 0; margin-left: 5px;">Dashboard Komting</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>

    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item {{ (request()->is('komting/dashboard')) ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('komting.dashboard') }}"><i data-feather="home"></i>
                    <span class="menu-title text-truncate">Dashboard</span>
                </a>
            </li>

            <li class="navigation-header"><span>Menu Absensi</span></li>

            <li class="nav-item {{ (request()->is('komting/absensi*')) ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('komting.absensi') }}"><i data-feather="check-square"></i>
                    <span class="menu-title text-truncate">Input Absensi</span>
                </a>
            </li>

            <li class="nav-item {{ (request()->is('komting/riwayat-absensi*')) ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('komting.riwayat') }}"><i data-feather="book-open"></i>
                    <span class="menu-title text-truncate">Riwayat Absensi</span>
                </a>
            </li>

            <li class="navigation-header"><span>Lainnya</span></li>
            <li class="nav-item">
                <a class="d-flex align-items-center" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();">
                    <i data-feather="power"></i>
                    <span class="menu-title text-truncate">Logout</span>
                </a>
                <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>
