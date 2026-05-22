@extends('layouts.komting.app')

@section('title')
    Dashboard Komting - {{ $kelas }}
@endsection

@section('content')
<div class="content-wrapper container-xxl p-0">
    <div class="content-body">
        <div class="row">
            <!-- Welcome Card -->
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="card card-congratulations">
                    <div class="card-body text-center">
                        <img src="{{asset('Assets/backend/images/pages/decore-left.png')}}" class="congratulations-img-left" alt="card-img-left" />
                        <img src="{{asset('Assets/backend/images/pages/decore-right.png')}}" class="congratulations-img-right" alt="card-img-right" />
                        <div class="avatar avatar-xl bg-primary shadow">
                            <div class="avatar-content">
                                <i data-feather="award" class="font-large-1"></i>
                            </div>
                        </div>
                        <div class="text-center">
                            <h1 class="mb-1 text-white">Selamat Datang {{ $user->name }},</h1>
                            <p class="card-text m-auto w-75">
                                Anda bertugas sebagai Komting Kelas <strong>{{ $kelas }}</strong>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Column 1 -->
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div>
                                    <h2 class="font-weight-bolder mb-0">{{ $totalSiswa }}</h2>
                                    <p class="card-text">Mahasiswa Kelas</p>
                                </div>
                                <div class="avatar bg-light-primary p-50 m-0">
                                    <div class="avatar-content">
                                        <i data-feather="users" class="font-medium-5"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div>
                                    <h2 class="font-weight-bolder mb-0">{{ $totalSesi }}</h2>
                                    <p class="card-text">Total Sesi Absensi</p>
                                </div>
                                <div class="avatar bg-light-danger p-50 m-0">
                                    <div class="avatar-content">
                                        <i data-feather="calendar" class="font-medium-5"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Column 2 -->
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div>
                                    <h2 class="font-weight-bolder mb-0">{{ $totalPoin }}</h2>
                                    <p class="card-text">Total Poin Absensi</p>
                                </div>
                                <div class="avatar bg-light-success p-50 m-0">
                                    <div class="avatar-content">
                                        <i data-feather="award" class="font-medium-5"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div>
                                    <h2 class="font-weight-bolder mb-0">{{ $totalSiswa > 0 ? round($totalPoin / $totalSiswa, 1) : 0 }}</h2>
                                    <p class="card-text">Rata-rata Poin / Siswa</p>
                                </div>
                                <div class="avatar bg-light-warning p-50 m-0">
                                    <div class="avatar-content">
                                        <i data-feather="trending-up" class="font-medium-5"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Attendance Summary -->
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Ringkasan Status Kehadiran</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <div class="d-flex align-items-center">
                                <span class="bullet bullet-success font-small-3 mr-50"></span>
                                <span>Hadir (5 Poin)</span>
                            </div>
                            <h5 class="font-weight-bold mb-0">{{ $rekapKehadiran['Hadir'] ?? 0 }}</h5>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <div class="d-flex align-items-center">
                                <span class="bullet bullet-info font-small-3 mr-50"></span>
                                <span>Sakit (3 Poin)</span>
                            </div>
                            <h5 class="font-weight-bold mb-0">{{ $rekapKehadiran['Sakit'] ?? 0 }}</h5>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <div class="d-flex align-items-center">
                                <span class="bullet bullet-warning font-small-3 mr-50"></span>
                                <span>Izin (2 Poin)</span>
                            </div>
                            <h5 class="font-weight-bold mb-0">{{ $rekapKehadiran['Izin'] ?? 0 }}</h5>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <span class="bullet bullet-danger font-small-3 mr-50"></span>
                                <span>Tidak Hadir / Alfa (0 Poin)</span>
                            </div>
                            <h5 class="font-weight-bold mb-0">{{ $rekapKehadiran['Tidak Hadir'] ?? 0 }}</h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Action -->
            <div class="col-md-6 col-12">
                <div class="card text-center">
                    <div class="card-body">
                        <h4 class="card-title mb-1">Aksi Cepat Absensi</h4>
                        <p class="card-text text-muted">Isi kehadiran kelas {{ $kelas }} hari ini untuk mendistribusikan poin absensi kepada mahasiswa aktif.</p>
                        <a href="{{ route('komting.absensi') }}" class="btn btn-primary">Mulai Absensi Hari Ini</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
