<!-- ===============================
     STICKY BLUR HEADER
     LOGO SEBELAH BERANDA
     =============================== -->

<style>
/* ===== HEADER FIXED ===== */
#header2 {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 9999;
}

/* AREA HEADER */
.header-top-area,
.main-menu-area {
    position: relative;
    background: transparent !important;
}

/* ===== BLUR LAYER ===== */
.header-top-area::before,
.main-menu-area::before {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to bottom,
        rgba(0, 0, 0, 0.65),
        rgba(0, 0, 0, 0.25)
    );
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    opacity: 0.6;
    transition: opacity 0.25s ease;
    z-index: -1;
}

#header2.scrolled .header-top-area::before,
#header2.scrolled .main-menu-area::before {
    opacity: 1;
}

.header-top-area > *,
.main-menu-area > * {
    position: relative;
    z-index: 2;
}

/* WARNA MENU */
.main-menu-area a {
    color: #fff !important;
}

/* LOGO DI MENU */
.menu-logo img {
    height: 40px;
    margin-right: 15px;
}

/* ===== BUTTON PORTAL MAHASISWA ===== */
.apply-now-btn-mahasiswa {
    background: linear-gradient(135deg, #7367f0 0%, #9c52ff 100%);
    color: #ffffff !important;
    padding: 10px 18px;
    font-weight: 700;
    font-size: 12px;
    text-transform: uppercase;
    display: inline-block;
    transition: all 0.3s ease;
    border-radius: 0px; /* Rectangular like MASUK for cohesive look */
    box-shadow: 0 4px 15px rgba(115, 103, 240, 0.2);
    border: none;
    line-height: 1.5;
    text-decoration: none;
    vertical-align: middle;
}

.apply-now-btn-mahasiswa:hover {
    box-shadow: 0 4px 20px rgba(115, 103, 240, 0.4);
    background: linear-gradient(135deg, #8c52ff 0%, #7367f0 100%);
    color: #ffffff !important;
}

.header4-area .header-top-area .header-top-right ul li.btn-li {
    margin-left: 6px !important;
    padding-right: 0 !important;
    border-right: none !important;
    vertical-align: middle;
}

@media (min-width: 768px) and (max-width: 991px) {
    .header4-area .header-top-area .header-top-right ul li.btn-li {
        display: inline-block !important;
    }
}

/* BODY OFFSET */
body {
    padding-top: 120px;
}
</style>

<div id="header2" class="header4-area">

    <!-- HEADER TOP (TELP & LOGIN SAJA) -->
    <div class="header-top-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-top-right text-right">
                        <ul>
                            <li><i class="fa fa-phone"></i><a href="tel:{{@$footer->telp}}"> {{@$footer->telp}} </a></li>
                            <li><i class="fa fa-envelope"></i><a href="#">{{@$footer->email}}</a></li>
                            <li class="btn-li">
                                @auth
                                    <a href="/home" class="apply-now-btn2">Home</a>
                                @else
                                    <a class="apply-now-btn2" href="{{route('login')}}"> Masuk</a>
                                @endauth
                            </li>
                            <li class="btn-li">
                                @if(Session::has('portal_mahasiswa_id'))
                                    <a class="apply-now-btn-mahasiswa" href="{{ route('portal-mahasiswa.dashboard') }}"><i class="fa fa-user-circle mr-1"></i> Panel Mahasiswa</a>
                                @else
                                    <a class="apply-now-btn-mahasiswa" href="{{ route('portal-mahasiswa.login') }}"><i class="fa fa-graduation-cap mr-1"></i> Panel Mahasiswa</a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN MENU -->
    <div class="main-menu-area bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav id="desktop-nav">
                        <ul>

                            <!-- LOGO -->
                            <li class="menu-logo">
                                <a href="/">
                                    @if (@$footer->logo == NULL)
                                        <img src="{{asset('Assets/Frontend/img/logo-footer.png')}}" alt="logo">
                                    @else
                                        <img src="{{asset('storage/images/logo/' .$footer->logo)}}" alt="logo">
                                    @endif
                                </a>
                            </li>

                            <!-- MENU -->
                            <li class="{{ (request()->is('/')) ? 'active' : '' }}">
                                <a href="/">Beranda</a>
                            </li>

                            <li><a href="#">Tentang Kami</a>
                                <ul>
                                    <li><a href="{{route('profile.sekolah')}}">Profile Sekolah</a></li>
                                    <li><a href="{{route('visimisi.sekolah')}}">Visi dan Misi</a></li>
                                </ul>
                            </li>

                            <li><a href="#">Program</a>
                                <ul>
                                    <li class="has-child-menu"><a href="#">Program Studi</a>
                                        <ul class="thired-level">
                                            @foreach ($jurusanM as $jurusans)
                                                <li><a href="{{ url('program', $jurusans->slug)}}">{{$jurusans->nama}}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li class="has-child-menu"><a href="#">Kegiatan</a>
                                        <ul class="thired-level">
                                            @foreach ($kegiatanM as $kegiatans)
                                                <li><a href="{{url('kegiatan', $kegiatans->slug)}}">{{$kegiatans->nama}}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <li class="{{ (request()->is('berita')) ? 'active' : '' }}">
                                <a href="{{route('berita')}}">Berita</a>
                            </li>

                            <li class="{{ (request()->is('portal-mahasiswa*')) ? 'active' : '' }}">
                                <a href="{{ route('portal-mahasiswa.login') }}">Portal Mahasiswa</a>
                            </li>

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
window.addEventListener('scroll', function () {
    document.getElementById('header2')
        .classList.toggle('scrolled', window.scrollY > 10);
});
</script>
