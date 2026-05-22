@extends('layouts.komting.app')

@section('title')
    Input Absensi Kelas {{ $kelas }}
@endsection

@section('content')
<div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Input Absensi Kelas {{ $kelas }}</h2>
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
        @elseif(Session::has('error'))
            <div class="alert alert-danger" role="alert">
                <div class="alert-body">
                    <strong>{{ Session::get('error') }}</strong>
                    <button type="button" class="close" data-dismiss="alert">×</button>
                </div>
            </div>
        @endif

        {{-- Pilih Tanggal --}}
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i data-feather="calendar" class="mr-50"></i>Pilih Tanggal Absensi</h4>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('komting.absensi') }}">
                    <div class="row align-items-end">
                        <div class="col-md-6 col-12 mb-1 mb-md-0">
                            <label class="font-weight-bold">Tanggal Absensi <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal" class="form-control" value="{{ $selected_tanggal }}" required>
                        </div>
                        <div class="col-md-6 col-12">
                            <button type="submit" class="btn btn-primary">
                                <i data-feather="refresh-cw" class="mr-50"></i>Muat Tanggal
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @if ($mahasiswa->count() > 0)
            {{-- Notif jika sudah ada data absensi --}}
            @if($existing->count() > 0)
                <div class="alert alert-warning">
                    <div class="alert-body">
                        <i data-feather="alert-triangle" class="mr-50"></i>
                        <strong>Perhatian:</strong> Absensi kelas <strong>{{ $kelas }}</strong> tanggal <strong>{{ \Carbon\Carbon::parse($selected_tanggal)->translatedFormat('d F Y') }}</strong> sudah pernah diinput. Data akan <strong>diperbarui</strong> jika Anda menyimpannya kembali.
                    </div>
                </div>
            @endif

            {{-- Form Input Absensi --}}
            <form action="{{ route('komting.absensi.store') }}" method="POST" id="form-absensi">
                @csrf
                <input type="hidden" name="tanggal" value="{{ $selected_tanggal }}">
                <input type="hidden" name="kelas" value="{{ $kelas }}">

                <div class="card">
                    <div class="card-header border-bottom d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <h4 class="card-title mb-0">
                                Daftar Siswa — <span class="badge badge-light-primary">{{ $kelas }}</span>
                                <span class="text-muted font-small-3 ml-50">{{ \Carbon\Carbon::parse($selected_tanggal)->translatedFormat('l, d F Y') }}</span>
                            </h4>
                            <small class="text-muted">Distribusi poin: Hadir <span class="badge badge-success">+5</span>, Sakit <span class="badge badge-info">+3</span>, Izin <span class="badge badge-warning">+2</span>, Alfa <span class="badge badge-danger">0</span></small>
                        </div>
                        <div class="d-flex align-items-center mt-1 mt-md-0">
                            {{-- Quick select buttons --}}
                            <button type="button" class="btn btn-outline-success btn-sm mr-50" id="btn-hadir-semua">
                                <i data-feather="check-circle" class="mr-25"></i>Hadir Semua
                            </button>
                            <button type="button" class="btn btn-outline-secondary btn-sm" id="btn-reset-status">
                                <i data-feather="rotate-ccw" class="mr-25"></i>Reset
                            </button>
                        </div>
                    </div>

                    {{-- Counter realtime --}}
                    <div class="card-body py-1 border-bottom bg-light-primary">
                        <div class="row text-center">
                            <div class="col">
                                <span class="font-weight-bolder text-success font-medium-2" id="count-hadir">0</span>
                                <small class="d-block text-muted">Hadir</small>
                            </div>
                            <div class="col">
                                <span class="font-weight-bolder text-info font-medium-2" id="count-sakit">0</span>
                                <small class="d-block text-muted">Sakit</small>
                            </div>
                            <div class="col">
                                <span class="font-weight-bolder text-warning font-medium-2" id="count-izin">0</span>
                                <small class="d-block text-muted">Izin</small>
                            </div>
                            <div class="col">
                                <span class="font-weight-bolder text-danger font-medium-2" id="count-alfa">0</span>
                                <small class="d-block text-muted">Alfa</small>
                            </div>
                            <div class="col">
                                <span class="font-weight-bolder text-success font-medium-2" id="count-poin">0</span>
                                <small class="d-block text-muted">Total Poin Absensi</small>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" style="width:50px;">No</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>NIM</th>
                                        <th class="text-center" style="width:320px;">Status Kehadiran</th>
                                        <th class="text-center" style="width:80px;">Poin</th>
                                        <th style="width:200px;">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mahasiswa as $key => $mhs)
                                        @php
                                            $currentStatus = $existing->get($mhs->id, 'Tidak Hadir');
                                        @endphp
                                        <tr data-row="{{ $key }}">
                                            <td class="text-center align-middle">{{ $key + 1 }}</td>
                                            <td class="align-middle">
                                                <input type="hidden" name="absensi[{{ $key }}][mahasiswa_id]" value="{{ $mhs->id }}">
                                                <strong>{{ $mhs->nama }}</strong>
                                            </td>
                                            <td class="align-middle"><code>{{ $mhs->nim }}</code></td>
                                            <td class="text-center align-middle" style="min-width:240px;">
                                                <div class="status-btn-group d-flex flex-nowrap justify-content-center" data-row="{{ $key }}" style="gap:3px;">
                                                    <button type="button" onclick="setStatus({{ $key }}, 'Hadir')"
                                                        class="btn btn-xs status-btn {{ $currentStatus == 'Hadir' ? 'btn-success' : 'btn-outline-secondary' }}"
                                                        data-value="Hadir" style="font-size:11px;padding:3px 8px;">✓ Hadir</button>
                                                    <button type="button" onclick="setStatus({{ $key }}, 'Sakit')"
                                                        class="btn btn-xs status-btn {{ $currentStatus == 'Sakit' ? 'btn-info' : 'btn-outline-secondary' }}"
                                                        data-value="Sakit" style="font-size:11px;padding:3px 8px;">+ Sakit</button>
                                                    <button type="button" onclick="setStatus({{ $key }}, 'Izin')"
                                                        class="btn btn-xs status-btn {{ $currentStatus == 'Izin' ? 'btn-warning' : 'btn-outline-secondary' }}"
                                                        data-value="Izin" style="font-size:11px;padding:3px 8px;">~ Izin</button>
                                                    <button type="button" onclick="setStatus({{ $key }}, 'Tidak Hadir')"
                                                        class="btn btn-xs status-btn {{ $currentStatus == 'Tidak Hadir' ? 'btn-danger' : 'btn-outline-secondary' }}"
                                                        data-value="Tidak Hadir" style="font-size:11px;padding:3px 8px;">✗ Alfa</button>
                                                </div>
                                                <input type="hidden" name="absensi[{{ $key }}][status]" id="status-{{ $key }}" value="{{ $currentStatus }}">
                                            </td>
                                            <td class="text-center align-middle">
                                                <span class="badge badge-warning poin-badge" data-row="{{ $key }}">
                                                    @if($currentStatus == 'Hadir') +5
                                                    @elseif($currentStatus == 'Sakit') +3
                                                    @elseif($currentStatus == 'Izin') +2
                                                    @else 0
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="align-middle">
                                                <input type="text" name="absensi[{{ $key }}][keterangan]"
                                                       class="form-control form-control-sm"
                                                       placeholder="Opsional...">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <a href="{{ route('komting.dashboard') }}" class="btn btn-outline-secondary">
                            <i data-feather="arrow-left" class="mr-50"></i>Dashboard
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg" id="btn-simpan">
                            <i data-feather="save" class="mr-50"></i>Simpan Absensi
                        </button>
                    </div>
                </div>
            </form>
        @else
            <div class="alert alert-info mt-1">
                <div class="alert-body">
                    <i data-feather="info" class="mr-50"></i>
                    Tidak ada mahasiswa aktif di kelas <strong>{{ $kelas }}</strong>.
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
var statusMap = {};

function setStatus(row, value) {
    statusMap[row] = value;
    document.getElementById('status-' + row).value = value;

    // Update button styles
    var group = document.querySelector('.status-btn-group[data-row="' + row + '"]');
    if (!group) return;
    group.querySelectorAll('.status-btn').forEach(function(btn) {
        var v = btn.dataset.value;
        btn.className = 'btn btn-xs status-btn btn-outline-secondary';
        btn.style.fontSize = '11px';
        btn.style.padding = '3px 8px';
        if (v === value) {
            if (v === 'Hadir')            btn.className = 'btn btn-xs status-btn btn-success';
            else if (v === 'Tidak Hadir') btn.className = 'btn btn-xs status-btn btn-danger';
            else if (v === 'Izin')        btn.className = 'btn btn-xs status-btn btn-warning';
            else if (v === 'Sakit')       btn.className = 'btn btn-xs status-btn btn-info';
            btn.style.fontSize = '11px';
            btn.style.padding = '3px 8px';
        }
    });

    // Update poin badge
    var badge = document.querySelector('.poin-badge[data-row="' + row + '"]');
    if (badge) {
        if (value === 'Hadir') badge.textContent = '+5';
        else if (value === 'Sakit') badge.textContent = '+3';
        else if (value === 'Izin') badge.textContent = '+2';
        else badge.textContent = '0';
    }

    updateCounters();
}

function updateCounters() {
    var hadir = 0, alfa = 0, izin = 0, sakit = 0;
    document.querySelectorAll('input[id^="status-"]').forEach(function(inp) {
        var v = inp.value;
        if (v === 'Hadir')        hadir++;
        else if (v === 'Tidak Hadir') alfa++;
        else if (v === 'Izin')    izin++;
        else if (v === 'Sakit')   sakit++;
    });
    document.getElementById('count-hadir').textContent = hadir;
    document.getElementById('count-alfa').textContent = alfa;
    document.getElementById('count-izin').textContent = izin;
    document.getElementById('count-sakit').textContent = sakit;
    
    var totalPoin = (hadir * 5) + (sakit * 3) + (izin * 2);
    document.getElementById('count-poin').textContent = totalPoin;
}

document.addEventListener('DOMContentLoaded', function () {
    // Hadir semua
    var btnHadirSemua = document.getElementById('btn-hadir-semua');
    if (btnHadirSemua) {
        btnHadirSemua.addEventListener('click', function () {
            document.querySelectorAll('input[id^="status-"]').forEach(function(inp) {
                var row = inp.id.replace('status-', '');
                setStatus(parseInt(row), 'Hadir');
            });
        });
    }

    // Reset semua ke Tidak Hadir
    var btnReset = document.getElementById('btn-reset-status');
    if (btnReset) {
        btnReset.addEventListener('click', function () {
            document.querySelectorAll('input[id^="status-"]').forEach(function(inp) {
                var row = inp.id.replace('status-', '');
                setStatus(parseInt(row), 'Tidak Hadir');
            });
        });
    }

    updateCounters();
});
</script>
@endsection
