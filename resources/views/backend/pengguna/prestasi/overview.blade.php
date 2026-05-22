@extends('layouts.backend.app')

@section('title')
    Prestasi Mahasiswa - Overview
@endsection

@section('content')
<div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2>Prestasi Mahasiswa</h2>
                    <p class="text-muted">Lihat dan download semua prestasi mahasiswa</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="content-body">
        <!-- Stats Card Section -->
        <div class="row">
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="font-weight-bolder mb-50">{{ $penghargaan_count }}</h3>
                            <p class="card-text text-muted mb-0">Penghargaan</p>
                        </div>
                        <div class="avatar bg-light-primary p-50">
                            <div class="avatar-content">
                                <i data-feather="award" class="font-medium-5 text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="font-weight-bolder mb-50">{{ $sertifikat_count }}</h3>
                            <p class="card-text text-muted mb-0">Sertifikat</p>
                        </div>
                        <div class="avatar bg-light-primary p-50">
                            <div class="avatar-content">
                                <i data-feather="file-text" class="font-medium-5 text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="font-weight-bolder mb-50">{{ $perlombaan_count }}</h3>
                            <p class="card-text text-muted mb-0">Perlombaan</p>
                        </div>
                        <div class="avatar bg-light-primary p-50">
                            <div class="avatar-content">
                                <i data-feather="flag" class="font-medium-5 text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="font-weight-bolder mb-50">{{ $portofolio_count }}</h3>
                            <p class="card-text text-muted mb-0">Portofolio</p>
                        </div>
                        <div class="avatar bg-light-primary p-50">
                            <div class="avatar-content">
                                <i data-feather="briefcase" class="font-medium-5 text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Leaderboard Table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-0">
                        <table class="table table-hover table-striped text-center mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>PERINGKAT</th>
                                    <th class="text-left">NAMA MAHASISWA</th>
                                    <th>NIM</th>
                                    <th>PENGHARGAAN</th>
                                    <th>SERTIFIKAT</th>
                                    <th>PERLOMBAAN</th>
                                    <th>PORTOFOLIO</th>
                                    <th><i data-feather="check-square" style="width:13px;height:13px;"></i> ABSENSI</th>
                                    <th>TOTAL POIN</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ranked_students as $student)
                                    <tr>
                                        <td>
                                            @if($student->rank == 1 && $student->total_poin > 0)
                                                <span class="badge badge-warning p-50 font-weight-bold" style="color: #fff; background-color: #ff9f43;">
                                                    <i data-feather="award" class="mr-25" style="width: 14px; height: 14px;"></i>1
                                                </span>
                                            @else
                                                <span class="badge badge-secondary p-50 font-weight-bold" style="border-radius: 50%; width: 24px; height: 24px; padding: 5px 0 !important; display: inline-block; text-align: center;">
                                                    {{ $student->rank }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-left font-weight-bold">
                                            {{ $student->nama }}
                                            @if($student->rank == 1 && $student->total_poin > 0)
                                                <span class="badge badge-light-warning ml-50 font-weight-normal text-capitalize" style="font-size: 80%; background-color: rgba(255, 159, 67, 0.12); color: #ff9f43;">
                                                    <i data-feather="star" class="mr-25" style="width: 10px; height: 10px; fill: #ff9f43;"></i>Superstar
                                                </span>
                                            @endif
                                        </td>
                                        <td>{{ $student->nim }}</td>
                                        <td>
                                            @if($student->penghargaans->count() > 0)
                                                <div>
                                                    <span class="badge badge-info font-weight-bolder">{{ $student->penghargaans->count() }}</span>
                                                    @php
                                                        $penghargaan_points = 0;
                                                        foreach($student->penghargaans as $p) {
                                                            switch(strtolower(trim($p->tingkat))) {
                                                                case 'nasional': $penghargaan_points += 25; break;
                                                                case 'provinsi': $penghargaan_points += 20; break;
                                                                case 'kabupaten/kota':
                                                                case 'kabupaten':
                                                                case 'kota': $penghargaan_points += 15; break;
                                                                case 'universitas': $penghargaan_points += 10; break;
                                                            }
                                                        }
                                                    @endphp
                                                    <div class="text-muted" style="font-size: 75%; font-weight: 500; margin-top: 2px;">{{ $penghargaan_points }} poin</div>
                                                </div>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($student->sertifikats->count() > 0)
                                                <div>
                                                    <span class="badge badge-success font-weight-bolder">{{ $student->sertifikats->count() }}</span>
                                                    @php
                                                        $sertifikat_points = 0;
                                                        foreach($student->sertifikats as $s) {
                                                            switch(strtolower(trim($s->tingkat))) {
                                                                case 'nasional': $sertifikat_points += 25; break;
                                                                case 'provinsi': $sertifikat_points += 20; break;
                                                                case 'kabupaten/kota':
                                                                case 'kabupaten':
                                                                case 'kota': $sertifikat_points += 15; break;
                                                                case 'universitas': $sertifikat_points += 10; break;
                                                            }
                                                        }
                                                    @endphp
                                                    <div class="text-muted" style="font-size: 75%; font-weight: 500; margin-top: 2px;">{{ $sertifikat_points }} poin</div>
                                                </div>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($student->perlombaans->count() > 0)
                                                <div>
                                                    <span class="badge badge-danger font-weight-bolder">{{ $student->perlombaans->count() }}</span>
                                                    @php
                                                        $perlombaan_points = 0;
                                                        foreach($student->perlombaans as $l) {
                                                            switch(strtolower(trim($l->tingkat))) {
                                                                case 'nasional': $perlombaan_points += 25; break;
                                                                case 'provinsi': $perlombaan_points += 20; break;
                                                                case 'kabupaten/kota':
                                                                case 'kabupaten':
                                                                case 'kota': $perlombaan_points += 15; break;
                                                                case 'universitas': $perlombaan_points += 10; break;
                                                            }
                                                        }
                                                    @endphp
                                                    <div class="text-muted" style="font-size: 75%; font-weight: 500; margin-top: 2px;">{{ $perlombaan_points }} poin</div>
                                                </div>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($student->portofolios->count() > 0)
                                                <span class="badge badge-primary font-weight-bolder" style="background-color: #7367f0;">{{ $student->portofolios->count() }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php $poin_absensi = $student->poin_absensi; @endphp
                                            @if($poin_absensi > 0)
                                                <span class="badge badge-warning font-weight-bolder">
                                                    <i data-feather="check-circle" style="width:11px;height:11px;"></i>
                                                    {{ $poin_absensi }} poin
                                                </span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-pill badge-success p-50 font-weight-bolder" style="font-size: 90%; background-color: #28c76f; color: #fff;">
                                                {{ $student->total_poin }} Poin
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('backend-prestasi-detail', $student->id) }}" class="btn btn-icon rounded-circle btn-primary" style="padding: 6px; background-color: #7367f0; border-color: #7367f0;">
                                                <i data-feather="eye" class="text-white" style="width: 16px; height: 16px;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Point System Info Box -->
        <div class="row">
            <div class="col-12 mt-1">
                <div class="alert alert-info py-2" role="alert" style="background-color: rgba(0, 207, 232, 0.12); border-color: transparent; color: #00cfe8; border-radius: 6px;">
                    <div class="alert-body">
                        <h5 class="alert-heading font-weight-bold mb-1"><i data-feather="info" class="mr-50 align-middle" style="width: 18px; height: 18px;"></i>Sistem Poin:</h5>
                        
                        <div class="row" style="font-size: 90%;">
                            <div class="col-md-6 col-12 mb-1 mb-md-0">
                                <h6 class="font-weight-bold text-info mb-50">Penghargaan & Perlombaan:</h6>
                                <ul class="pl-2 mb-0" style="list-style-type: square;">
                                    <li>Nasional = 25 poin</li>
                                    <li>Provinsi = 20 poin</li>
                                    <li>Kabupaten/Kota = 15 poin</li>
                                    <li>Universitas = 10 poin</li>
                                </ul>
                            </div>
                            <div class="col-md-6 col-12">
                                <h6 class="font-weight-bold text-info mb-50">Sertifikat, Portofolio & Absensi:</h6>
                                <ul class="pl-2 mb-0" style="list-style-type: square;">
                                    <li>Sertifikat (Nasional = 25 poin, Provinsi = 20 poin, Kabupaten/Kota = 15 poin, Universitas = 10 poin)</li>
                                    <li>Portofolio = tanpa poin</li>
                                    <li><strong class="text-warning">Absensi (Hadir) = 5 poin per sesi</strong></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
