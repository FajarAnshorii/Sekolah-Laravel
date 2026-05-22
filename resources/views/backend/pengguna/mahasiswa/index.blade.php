@extends('layouts.backend.app')

@section('title')
    Mahasiswa
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
                    <h2>Data Mahasiswa</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- Class Filter Card -->
        <div class="card">
            <div class="card-body">
                <form method="GET" action="{{ route('backend-pengguna-mahasiswa.index') }}">
                    <div class="row align-items-end">
                        <div class="col-md-4 col-12 mb-1 mb-md-0">
                            <label for="filter-kelas" class="font-weight-bold">Kategori Kelas</label>
                            <select id="filter-kelas" name="kelas" class="form-control">
                                <option value="">-- Semua Kelas --</option>
                                @foreach ($kelas_options as $opt)
                                    <option value="{{ $opt }}" {{ $selected_kelas == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 col-12">
                            <button type="submit" class="btn btn-primary mr-1"><i data-feather="filter" class="mr-50"></i> Filter</button>
                            @if($selected_kelas)
                                <a href="{{ route('backend-pengguna-mahasiswa.index') }}" class="btn btn-outline-secondary"><i data-feather="x" class="mr-50"></i> Reset</a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <section>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                                    <h4 class="card-title">Daftar Mahasiswa</h4>
                                    <a href="{{ route('backend-pengguna-mahasiswa.create') }}" class="btn btn-primary">Tambah Mahasiswa</a>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped table-bordered mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 50px;">No</th>
                                                    <th>Nama Mahasiswa</th>
                                                    <th>NIM</th>
                                                    <th>Kelas</th>
                                                    <th class="text-center">K1</th>
                                                    <th class="text-center">K2</th>
                                                    <th class="text-center">K3</th>
                                                    <th class="text-center">K4</th>
                                                    <th class="text-center">MID</th>
                                                    <th class="text-center">UAS</th>
                                                    <th class="text-center">REMIDI</th>
                                                    <th class="text-center text-primary">TOTAL</th>
                                                    <th class="text-center">Nilai Akhir</th>
                                                    <th class="text-center">Bobot</th>
                                                    <th>Status</th>
                                                    <th class="text-center" style="width: 160px;">Action</th>
                                                </tr>
                                            </thead>    
                                            <tbody>
                                               @if($mahasiswa->count() > 0)
                                                   @foreach ($mahasiswa as $key => $mhs)
                                                        <tr>
                                                            <td class="text-center">{{ $key + 1 }}</td>
                                                            <td><strong>{{ $mhs->nama }}</strong></td>
                                                            <td><code>{{ $mhs->nim }}</code></td>
                                                            <td><span class="badge badge-light-primary">{{ $mhs->kelas }}</span></td>
                                                            <td class="text-center">{{ $mhs->k1 }}</td>
                                                            <td class="text-center">{{ $mhs->k2 }}</td>
                                                            <td class="text-center">{{ $mhs->k3 }}</td>
                                                            <td class="text-center">{{ $mhs->k4 }}</td>
                                                            <td class="text-center">{{ $mhs->mid }}</td>
                                                            <td class="text-center">{{ $mhs->uas }}</td>
                                                            <td class="text-center">{{ $mhs->remidi ?? 0 }}</td>
                                                            <td class="text-center text-primary font-weight-bold">{{ $mhs->total }}</td>
                                                            <td class="text-center">
                                                                @if(in_array($mhs->nilai_akhir, ['A', 'A-']))
                                                                    <span class="badge badge-success">{{ $mhs->nilai_akhir }}</span>
                                                                @elseif(in_array($mhs->nilai_akhir, ['B+', 'B', 'B-']))
                                                                    <span class="badge badge-info">{{ $mhs->nilai_akhir }}</span>
                                                                @elseif($mhs->nilai_akhir == 'C')
                                                                    <span class="badge badge-warning">{{ $mhs->nilai_akhir }}</span>
                                                                @else
                                                                    <span class="badge badge-danger">{{ $mhs->nilai_akhir }}</span>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">{{ number_format($mhs->bobot_nilai, 1) }}</td>
                                                            <td>
                                                                @if($mhs->status == 'Aktif')
                                                                    <span class="badge badge-light-success">Aktif</span>
                                                                @else
                                                                    <span class="badge badge-light-danger">Tidak Aktif</span>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="d-inline-flex align-items-center">
                                                                    <a href="{{ route('backend-pengguna-mahasiswa.edit', $mhs->id) }}" class="btn btn-success btn-sm mr-50">Edit</a>
                                                                    <form action="{{ route('backend-pengguna-mahasiswa.destroy', $mhs->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data mahasiswa ini?');" style="margin:0;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                   @endforeach
                                               @else
                                                   <tr>
                                                       <td colspan="16" class="text-center py-2 text-muted">Tidak ada data mahasiswa.</td>
                                                   </tr>
                                               @endif
                                            </tbody>                                   
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
