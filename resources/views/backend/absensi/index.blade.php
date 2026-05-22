@extends('layouts.backend.app')

@section('title')
    Absensi Mahasiswa
@endsection

@section('content')

@if ($message = Session::get('success'))
    <div class="alert alert-success" role="alert">
        <div class="alert-body">
            <strong>{{ $message }}</strong>
            <button type="button" class="close" data-dismiss="alert">×</button>
        </div>
    </div>
@elseif($message = Session::get('error'))
    <div class="alert alert-danger" role="alert">
        <div class="alert-body">
            <strong>{{ $message }}</strong>
            <button type="button" class="close" data-dismiss="alert">×</button>
        </div>
    </div>
@endif

<div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Absensi Mahasiswa</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">

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
                            <h5 class="font-weight-bolder mb-0">{{ $sesi_absensi->count() }}</h5>
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
                            <h5 class="font-weight-bolder mb-0">{{ $sesi_absensi->sum('jumlah_hadir') }}</h5>
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
                                <i data-feather="award" class="font-medium-5"></i>
                            </div>
                        </div>
                        <div>
                            <h5 class="font-weight-bolder mb-0">{{ $sesi_absensi->sum('total_poin') }}</h5>
                            <small>Total Poin Dibagikan</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <div class="avatar bg-light-info p-50 mr-1">
                            <div class="avatar-content">
                                <i data-feather="bar-chart-2" class="font-medium-5"></i>
                            </div>
                        </div>
                        <div>
                            <h5 class="font-weight-bolder mb-0">5</h5>
                            <small>Poin per Kehadiran</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filter --}}
        <div class="card">
            <div class="card-body">
                <form method="GET" action="{{ route('backend-absensi.index') }}">
                    <div class="row align-items-end">
                        <div class="col-md-3 col-12 mb-1 mb-md-0">
                            <label class="font-weight-bold">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" value="{{ $filter_tanggal }}">
                        </div>
                        <div class="col-md-3 col-12 mb-1 mb-md-0">
                            <label class="font-weight-bold">Kelas</label>
                            <select name="kelas" class="form-control">
                                <option value="">-- Semua Kelas --</option>
                                @foreach ($kelas_options as $opt)
                                    <option value="{{ $opt }}" {{ $filter_kelas == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 col-12">
                            <button type="submit" class="btn btn-primary mr-1"><i data-feather="filter" class="mr-50"></i>Filter</button>
                            <a href="{{ route('backend-absensi.index') }}" class="btn btn-outline-secondary mr-1"><i data-feather="x" class="mr-50"></i>Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Tabel Sesi Absensi --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Daftar Sesi Absensi</h4>
                        <div>
                            <a href="{{ route('backend-absensi.rekap') }}" class="btn btn-outline-info mr-1">
                                <i data-feather="bar-chart-2" class="mr-50"></i>Rekap Poin
                            </a>
                            <a href="{{ route('backend-absensi.create') }}" class="btn btn-primary">
                                <i data-feather="plus" class="mr-50"></i>Tambah Absensi
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width:50px;">No</th>
                                        <th>Tanggal</th>
                                        <th>Kelas</th>
                                        <th class="text-center">Total Siswa</th>
                                        <th class="text-center">
                                            <span class="badge badge-success">Hadir</span>
                                        </th>
                                        <th class="text-center">Tidak Hadir</th>
                                        <th class="text-center text-warning">Poin Dibagikan</th>
                                        <th class="text-center" style="width:120px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($sesi_absensi as $key => $sesi)
                                        @php
                                            $tidak_hadir = $sesi->total_siswa - $sesi->jumlah_hadir;
                                            $persen = $sesi->total_siswa > 0 ? round(($sesi->jumlah_hadir / $sesi->total_siswa) * 100) : 0;
                                            $key_encoded = base64_encode($sesi->tanggal . '|' . $sesi->kelas);
                                        @endphp
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>
                                                <strong>{{ \Carbon\Carbon::parse($sesi->tanggal)->translatedFormat('l, d F Y') }}</strong>
                                            </td>
                                            <td><span class="badge badge-light-primary">{{ $sesi->kelas }}</span></td>
                                            <td class="text-center">{{ $sesi->total_siswa }}</td>
                                            <td class="text-center">
                                                <span class="badge badge-success">{{ $sesi->jumlah_hadir }}</span>
                                                <small class="text-muted d-block">{{ $persen }}%</small>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-danger">{{ $tidak_hadir }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-warning font-medium-1">
                                                    <i data-feather="star" style="width:12px;height:12px;"></i>
                                                    {{ $sesi->total_poin }} poin
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center" style="gap:6px;">
                                                    <a href="{{ route('backend-absensi.show', $key_encoded) }}"
                                                       class="btn btn-info btn-sm" title="Lihat Detail">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                    <a href="{{ route('backend-absensi.create') }}?tanggal={{ $sesi->tanggal }}&kelas={{ urlencode($sesi->kelas) }}"
                                                       class="btn btn-warning btn-sm" title="Edit Absensi">
                                                        <i data-feather="edit-2"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-3 text-muted">
                                                Belum ada data absensi. <a href="{{ route('backend-absensi.create') }}">Tambah sekarang</a>
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
