@extends('layouts.backend.app')

@section('title')
    Admin Komting Kelas
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
                    <h2> Admin Komting Kelas</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <section>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-bottom">
                                    <h4 class="card-title">Daftar Akun Komting <a href=" {{route('backend-pengguna-komting.create')}} " class="btn btn-primary ml-1">Tambah</a> </h4>
                                </div>
                                <div class="card-datatable">
                                    <table class="dt-responsive table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>No</th>
                                                <th>Nama Komting</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Nomor HP</th>
                                                <th>Kelas Ditugaskan</th>
                                                <th>Status</th>
                                                <th class="text-center" style="width: 200px;">Aksi</th>
                                            </tr>
                                        </thead>    
                                        <tbody>
                                           @foreach ($komting as $key => $row)
                                                <tr>
                                                    <td></td>
                                                    <td> {{$key+1}} </td>
                                                    <td> {{$row->name}} </td>
                                                    <td> {{$row->username}} </td>
                                                    <td> {{$row->email}} </td>
                                                    <td> {{$row->komtingKelas->no_hp ?? '-'}} </td>
                                                    <td> <span class="badge badge-light-primary">{{$row->komtingKelas->kelas ?? '-'}}</span> </td>
                                                    <td> 
                                                        @if(($row->komtingKelas->status ?? 'Nonaktif') == 'Aktif')
                                                            <span class="badge badge-light-success">Aktif</span>
                                                        @else
                                                            <span class="badge badge-light-danger">Nonaktif</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="d-flex justify-content-center" style="gap:6px;">
                                                            <a href=" {{route('backend-pengguna-komting.edit', $row->id)}} " class="btn btn-success btn-sm">Edit</a>
                                                            <form action="{{ route('backend-pengguna-komting.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun komting ini?');">
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
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
