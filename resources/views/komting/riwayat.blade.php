@extends('layouts.komting.app')

@section('title')
    Riwayat Absensi Kelas {{ $kelas }}
@endsection

@section('content')
<div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Riwayat Absensi Kelas {{ $kelas }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                <div class="alert-body">
                    <strong>{{ Session::get('success') }}</strong>
                    <button type="button" class="close" data-dismiss="alert">×</button>
                </div>
            </div>
        @endif

        {{-- Stat Cards --}}
        <div class="row">
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <div class="avatar bg-light-primary p-50 mr-1">
                            <div class="avatar-content">
                                <i data-feather="calendar" class="font-medium-5"></i>
                            </div>
                        </div>
                        <div>
                            <h5 class="font-weight-bolder mb-0">{{ $riwayat->count() }}</h5>
                            <small>Total Sesi</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <div class="avatar bg-light-success p-50 mr-1">
                            <div class="avatar-content">
                                <i data-feather="check-circle" class="font-medium-5"></i>
                            </div>
                        </div>
                        <div>
                            <h5 class="font-weight-bolder mb-0">{{ $riwayat->sum('jumlah_hadir') }}</h5>
                            <small>Total Kehadiran</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <div class="avatar bg-light-warning p-50 mr-1">
                            <div class="avatar-content">
                                <i data-feather="star" class="font-medium-5"></i>
                            </div>
                        </div>
                        <div>
                            <h5 class="font-weight-bolder mb-0">{{ $riwayat->sum('total_poin') }}</h5>
                            <small>Total Poin Absensi</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <div class="avatar bg-light-info p-50 mr-1">
                            <div class="avatar-content">
                                <i data-feather="info" class="font-medium-5"></i>
                            </div>
                        </div>
                        <div>
                            <h5 class="font-weight-bolder mb-0">{{ $kelas }}</h5>
                            <small>Kelas Ditugaskan</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel Riwayat Absensi --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom d-flex justify-content-between align-items-center flex-wrap">
                        <h4 class="card-title">Daftar Sesi Absensi</h4>
                        <a href="{{ route('komting.absensi') }}" class="btn btn-primary">
                            <i data-feather="plus" class="mr-50"></i>Input Absensi Baru
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width:50px;">No</th>
                                        <th>Tanggal Sesi</th>
                                        <th class="text-center">Total Siswa</th>
                                        <th class="text-center"><span class="badge badge-success">Hadir</span></th>
                                        <th class="text-center"><span class="badge badge-info">Sakit</span></th>
                                        <th class="text-center"><span class="badge badge-warning">Izin</span></th>
                                        <th class="text-center"><span class="badge badge-danger">Alfa</span></th>
                                        <th class="text-center">Poin Terdistribusi</th>
                                        <th class="text-center" style="width:140px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($riwayat as $key => $row)
                                        @php
                                            $hadirPersen = $row->total_siswa > 0 ? round(($row->jumlah_hadir / $row->total_siswa) * 100) : 0;
                                        @endphp
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>
                                                <strong>{{ \Carbon\Carbon::parse($row->tanggal)->translatedFormat('l, d F Y') }}</strong>
                                            </td>
                                            <td class="text-center">{{ $row->total_siswa }}</td>
                                            <td class="text-center">
                                                <span class="badge badge-success">{{ $row->jumlah_hadir }}</span>
                                                <small class="text-muted d-block">{{ $hadirPersen }}%</small>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-info">{{ $row->jumlah_sakit }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-warning">{{ $row->jumlah_izin }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-danger">{{ $row->jumlah_alfa }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-light-warning font-medium-1 font-weight-bolder">
                                                    {{ $row->total_poin }} Poin
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('komting.absensi') }}?tanggal={{ $row->tanggal }}"
                                                   class="btn btn-warning btn-sm d-inline-flex align-items-center">
                                                    <i data-feather="edit-3" class="mr-25"></i> Lihat & Edit
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center py-3 text-muted">
                                                Belum ada sesi absensi yang diinput untuk kelas ini. <a href="{{ route('komting.absensi') }}">Mulai input sekarang</a>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
