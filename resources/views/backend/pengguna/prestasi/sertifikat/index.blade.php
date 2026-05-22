@extends('layouts.backend.app')

@section('title')
    Sertifikat Mahasiswa
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
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
                    <h2>Sertifikat Mahasiswa</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <section>
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h4 class="card-title">Daftar Sertifikat <a href="{{ route('backend-prestasi-sertifikat.create') }}" class="btn btn-primary ml-1">Tambah</a> </h4>
                        </div>
                        <div class="card-datatable">
                            <table class="dt-responsive table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>No</th>
                                        <th>Mahasiswa</th>
                                        <th>Nama Sertifikat</th>
                                        <th>Tingkat</th>
                                        <th>Penyelenggara</th>
                                        <th>Jenis</th>
                                        <th>Jumlah Jam</th>
                                        <th>Tanggal</th>
                                        <th>File</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>    
                                <tbody>
                                   @foreach ($sertifikat as $key => $s)
                                        <tr>
                                            <td></td>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $s->mahasiswa->nama }} ({{ $s->mahasiswa->nim }})</td>
                                            <td>{{ $s->nama_sertifikat }}</td>
                                            <td><span class="badge badge-light-success">{{ $s->tingkat }}</span></td>
                                            <td>{{ $s->penyelenggara }}</td>
                                            <td>{{ $s->jenis }}</td>
                                            <td>{{ $s->jumlah_jam }} Jam</td>
                                            <td>{{ \Carbon\Carbon::parse($s->tanggal)->format('d/m/Y') }}</td>
                                            <td>
                                                <a href="{{ asset('storage/files/prestasi/' . $s->file_sertifikat) }}" class="btn btn-success btn-sm font-weight-bold" style="background-color: #28c76f; border-color: #28c76f;" download>
                                                    <i data-feather="download" style="width: 12px; height: 12px;"></i> Download
                                                </a>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="{{ route('backend-prestasi-sertifikat.edit', $s->id) }}" class="btn btn-success btn-sm mr-50">Edit</a>
                                                    <form action="{{ route('backend-prestasi-sertifikat.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data sertifikat ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                   @endforeach
                                </tbody>                                   
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
