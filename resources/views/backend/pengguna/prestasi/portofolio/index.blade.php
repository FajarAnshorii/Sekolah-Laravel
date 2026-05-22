@extends('layouts.backend.app')

@section('title')
    Portofolio Mahasiswa
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
                    <h2>Portofolio Mahasiswa</h2>
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
                            <h4 class="card-title">Daftar Portofolio <a href="{{ route('backend-prestasi-portofolio.create') }}" class="btn btn-primary ml-1">Tambah</a> </h4>
                        </div>
                        <div class="card-datatable">
                            <table class="dt-responsive table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>No</th>
                                        <th>Mahasiswa</th>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th>Link</th>
                                        <th>Tanggal</th>
                                        <th>File</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>    
                                <tbody>
                                   @foreach ($portofolio as $key => $p)
                                        <tr>
                                            <td></td>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $p->mahasiswa->nama }} ({{ $p->mahasiswa->nim }})</td>
                                            <td>{{ $p->judul }}</td>
                                            <td><span class="badge badge-light-info">{{ $p->kategori }}</span></td>
                                            <td>
                                                @if($p->link)
                                                    <a href="{{ $p->link }}" target="_blank" class="text-truncate d-inline-block" style="max-width: 150px;">
                                                        <i data-feather="external-link" style="width: 12px; height: 12px;"></i> Kunjungi Link
                                                    </a>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}</td>
                                            <td>
                                                @if($p->file_portofolio)
                                                    <a href="{{ asset('storage/files/prestasi/' . $p->file_portofolio) }}" class="btn btn-success btn-sm font-weight-bold" style="background-color: #28c76f; border-color: #28c76f;" download>
                                                        <i data-feather="download" style="width: 12px; height: 12px;"></i> Download
                                                    </a>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="{{ route('backend-prestasi-portofolio.edit', $p->id) }}" class="btn btn-success btn-sm mr-50">Edit</a>
                                                    <form action="{{ route('backend-prestasi-portofolio.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data portofolio ini?');">
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
