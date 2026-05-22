@extends('layouts.backend.app')

@section('title')
Edit Komting Kelas
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
                <div class="card">
                    <div class="card-header header-bottom">
                        <h4>Edit Komting Kelas</h4>
                    </div>
                    <div class="card-body">
                        <form action=" {{route('backend-pengguna-komting.update', $komting->id)}} " method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group mb-2">
                                        <label class="form-label" for="name">Nama Komting</label> <span class="text-danger">*</span>
                                        <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name', $komting->name)}}" placeholder="Nama Lengkap" required />
                                        @error('name')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group mb-2">
                                        <label class="form-label" for="username">Username</label> <span class="text-danger">*</span>
                                        <input type="text" id="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{old('username', $komting->username)}}" placeholder="Username untuk login" required />
                                        @error('username')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group mb-2">
                                        <label class="form-label" for="email">Email</label> <span class="text-danger">*</span>
                                        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email', $komting->email)}}" placeholder="Alamat Email" required />
                                        @error('email')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group mb-2">
                                        <label class="form-label" for="password">Password (Kosongkan jika tidak ingin diubah)</label>
                                        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password minimal 6 karakter" />
                                        @error('password')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group mb-2">
                                        <label class="form-label" for="no_hp">Nomor HP</label>
                                        <input type="text" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" value="{{old('no_hp', $komting->komtingKelas->no_hp ?? '')}}" placeholder="Nomor Handphone" />
                                        @error('no_hp')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group mb-2">
                                        <label class="form-label" for="kelas">Kelas yang Ditugaskan</label> <span class="text-danger">*</span>
                                        <select id="kelas" name="kelas" class="form-control @error('kelas') is-invalid @enderror" required>
                                            <option value="">-- Pilih Kelas --</option>
                                            @foreach($kelas_options as $kls)
                                                <option value="{{ $kls }}" {{ old('kelas', $komting->komtingKelas->kelas ?? '') == $kls ? 'selected' : '' }}>{{ $kls }}</option>
                                            @endforeach
                                        </select>
                                        @error('kelas')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group mb-2">
                                        <label class="form-label" for="status">Status</label> <span class="text-danger">*</span>
                                        <select id="status" name="status" class="form-control @error('status') is-invalid @enderror" required>
                                            <option value="Aktif" {{ old('status', $komting->komtingKelas->status ?? 'Aktif') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                            <option value="Nonaktif" {{ old('status', $komting->komtingKelas->status ?? '') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                        </select>
                                        @error('status')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="row mt-1">
                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit">Update</button>
                                    <a href="{{route('backend-pengguna-komting.index')}}" class="btn btn-warning">Batal</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
