@extends('layouts.backend.app')

@section('title')
    Detail Absensi
@endsection

@section('content')
<div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Detail Absensi</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">

        {{-- Info Header --}}
        <div class="card bg-gradient-primary text-white mb-2" style="background: linear-gradient(135deg,#667eea 0%,#764ba2 100%);">
            <div class="card-body py-2">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h4 class="text-white mb-25">
                            <i data-feather="calendar" class="mr-50"></i>
                            {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y') }}
                        </h4>
                        <p class="text-white mb-0">
                            Kelas: <strong>{{ $kelas }}</strong> &nbsp;|&nbsp;
                            Total: <strong>{{ $absensi_list->count() }} siswa</strong>
                        </p>
                    </div>
                    <div class="col-md-6 text-md-right mt-1 mt-md-0">
                        <span class="badge badge-light font-medium-1 px-1 py-50 mr-50">
                            <i data-feather="award" style="width:14px;height:14px;"></i>
                            {{ $total_poin }} Poin Dibagikan
                        </span>
                        <a href="{{ route('backend-absensi.create') }}?tanggal={{ $tanggal }}&kelas={{ urlencode($kelas) }}"
                           class="btn btn-light btn-sm">
                            <i data-feather="edit-2" class="mr-25"></i>Edit Absensi
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Stat Cards --}}
        <div class="row">
            <div class="col-6 col-md-3">
                <div class="card border-left-success">
                    <div class="card-body text-center py-1">
                        <h3 class="text-success font-weight-bolder mb-25">{{ $jumlah_hadir }}</h3>
                        <small class="text-muted">Hadir</small>
                        <div class="progress mt-50" style="height:4px;">
                            <div class="progress-bar bg-success" style="width:{{ $absensi_list->count() > 0 ? round($jumlah_hadir/$absensi_list->count()*100) : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card">
                    <div class="card-body text-center py-1">
                        <h3 class="text-danger font-weight-bolder mb-25">{{ $jumlah_alfa }}</h3>
                        <small class="text-muted">Tidak Hadir</small>
                        <div class="progress mt-50" style="height:4px;">
                            <div class="progress-bar bg-danger" style="width:{{ $absensi_list->count() > 0 ? round($jumlah_alfa/$absensi_list->count()*100) : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card">
                    <div class="card-body text-center py-1">
                        <h3 class="text-warning font-weight-bolder mb-25">{{ $jumlah_izin }}</h3>
                        <small class="text-muted">Izin</small>
                        <div class="progress mt-50" style="height:4px;">
                            <div class="progress-bar bg-warning" style="width:{{ $absensi_list->count() > 0 ? round($jumlah_izin/$absensi_list->count()*100) : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card">
                    <div class="card-body text-center py-1">
                        <h3 class="text-info font-weight-bolder mb-25">{{ $jumlah_sakit }}</h3>
                        <small class="text-muted">Sakit</small>
                        <div class="progress mt-50" style="height:4px;">
                            <div class="progress-bar bg-info" style="width:{{ $absensi_list->count() > 0 ? round($jumlah_sakit/$absensi_list->count()*100) : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel Detail --}}
        <div class="card">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <h4 class="card-title">Daftar Kehadiran Siswa</h4>
                <a href="{{ route('backend-absensi.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i data-feather="arrow-left" class="mr-25"></i>Kembali
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <th class="text-center" style="width:50px;">No</th>
                                <th>Nama Mahasiswa</th>
                                <th>NIM</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Poin</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($absensi_list as $key => $item)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td><strong>{{ $item->mahasiswa->nama ?? '-' }}</strong></td>
                                <td><code>{{ $item->mahasiswa->nim ?? '-' }}</code></td>
                                <td class="text-center">
                                    @if($item->status == 'Hadir')
                                        <span class="badge badge-success">Hadir</span>
                                    @elseif($item->status == 'Tidak Hadir')
                                        <span class="badge badge-danger">Tidak Hadir</span>
                                    @elseif($item->status == 'Izin')
                                        <span class="badge badge-warning">Izin</span>
                                    @else
                                        <span class="badge badge-info">Sakit</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($item->poin > 0)
                                        <span class="badge badge-warning font-weight-bolder">+{{ $item->poin }}</span>
                                    @else
                                        <span class="text-muted">0</span>
                                    @endif
                                </td>
                                <td class="text-muted">{{ $item->keterangan ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
