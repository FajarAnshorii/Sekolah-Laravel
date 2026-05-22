@extends('layouts.backend.app')

@section('title')
    Rekap Poin Absensi
@endsection

@section('content')
<div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Rekap Poin Absensi</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">

        {{-- Filter --}}
        <div class="card">
            <div class="card-body">
                <form method="GET" action="{{ route('backend-absensi.rekap') }}">
                    <div class="row align-items-end">
                        <div class="col-md-4 col-12 mb-1 mb-md-0">
                            <label class="font-weight-bold">Filter Kelas</label>
                            <select name="kelas" class="form-control">
                                <option value="">-- Semua Kelas --</option>
                                @foreach ($kelas_options as $opt)
                                    <option value="{{ $opt }}" {{ $selected_kelas == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 col-12">
                            <button type="submit" class="btn btn-primary mr-1"><i data-feather="filter" class="mr-50"></i>Filter</button>
                            <a href="{{ route('backend-absensi.rekap') }}" class="btn btn-outline-secondary"><i data-feather="x" class="mr-50"></i>Reset</a>
                        </div>
                        <div class="col-md-4 col-12 text-md-right mt-1 mt-md-0">
                            <a href="{{ route('backend-absensi.index') }}" class="btn btn-outline-secondary btn-sm">
                                <i data-feather="arrow-left" class="mr-25"></i>Kembali ke Absensi
                            </a>
                            <a href="{{ route('backend-prestasi-overview') }}" class="btn btn-outline-info btn-sm ml-50">
                                <i data-feather="award" class="mr-25"></i>Lihat Ranking
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Tabel Rekap --}}
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">Rekap Kehadiran & Poin per Siswa</h4>
                <p class="card-text text-muted font-small-3">Setiap kehadiran = <span class="badge badge-warning">+5 Poin</span> yang masuk ke ranking prestasi</p>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <th class="text-center" style="width:50px;">Rank</th>
                                <th>Nama Mahasiswa</th>
                                <th>Kelas</th>
                                <th class="text-center">
                                    <span class="badge badge-success">Hadir</span>
                                </th>
                                <th class="text-center">
                                    <span class="badge badge-danger">Alfa</span>
                                </th>
                                <th class="text-center">
                                    <span class="badge badge-warning">Izin</span>
                                </th>
                                <th class="text-center">
                                    <span class="badge badge-info">Sakit</span>
                                </th>
                                <th class="text-center">Total Sesi</th>
                                <th class="text-center text-warning font-weight-bolder">Poin Absensi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($mahasiswa as $key => $mhs)
                            <tr>
                                <td class="text-center">
                                    @if($key == 0)
                                        <span class="badge badge-warning">🥇 1</span>
                                    @elseif($key == 1)
                                        <span class="badge badge-secondary">🥈 2</span>
                                    @elseif($key == 2)
                                        <span class="badge badge-danger">🥉 3</span>
                                    @else
                                        <span class="text-muted">{{ $key + 1 }}</span>
                                    @endif
                                </td>
                                <td><strong>{{ $mhs->nama }}</strong></td>
                                <td><span class="badge badge-light-primary">{{ $mhs->kelas }}</span></td>
                                <td class="text-center"><span class="badge badge-light-success">{{ $mhs->total_hadir }}</span></td>
                                <td class="text-center"><span class="badge badge-light-danger">{{ $mhs->total_alfa }}</span></td>
                                <td class="text-center"><span class="badge badge-light-warning">{{ $mhs->total_izin }}</span></td>
                                <td class="text-center"><span class="badge badge-light-info">{{ $mhs->total_sakit }}</span></td>
                                <td class="text-center text-muted">
                                    {{ $mhs->total_hadir + $mhs->total_alfa + $mhs->total_izin + $mhs->total_sakit }}
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-warning font-medium-1 px-1">
                                        <i data-feather="star" style="width:12px;height:12px;"></i>
                                        {{ $mhs->absensis_sum_poin ?? 0 }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center py-3 text-muted">Belum ada data absensi.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
