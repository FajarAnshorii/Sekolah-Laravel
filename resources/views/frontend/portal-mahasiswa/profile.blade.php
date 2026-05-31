@extends('frontend.portal-mahasiswa.layouts.app')

@section('title', 'Pengaturan Profil')

@section('styles')
<style>
    .portal-form-block {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: none;
        padding: 2.5rem;
        margin-bottom: 2rem;
        position: relative;
    }

    .portal-form-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2.2rem;
        border-bottom: 1px solid #ebe9f1;
        padding-bottom: 1.2rem;
    }

    .portal-form-title {
        font-size: 1.6rem;
        font-weight: 700;
        color: var(--text-dark);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .portal-form-title i {
        color: #7367f0;
    }

    .btn-portal-back {
        background-color: #ff9f43;
        border-color: #ff9f43;
        color: #ffffff !important;
        border-radius: 8px;
        padding: 0.5rem 1.2rem;
        font-family: 'Outfit', sans-serif;
        font-weight: 600;
        font-size: 0.95rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 4px 10px rgba(255, 159, 67, 0.2);
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .btn-portal-back:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 15px rgba(255, 159, 67, 0.35);
    }

    .form-group label {
        font-family: 'Outfit', sans-serif;
        font-weight: 600;
        font-size: 1.05rem;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
    }

    .form-group label span.required {
        color: #ea5455;
    }

    .form-control {
        border-radius: 10px;
        padding: 0.8rem 1rem;
        font-size: 1.05rem;
        border: 1.5px solid #ebe9f1;
        background-color: #ffffff;
        color: var(--text-dark);
        height: auto;
        transition: all 0.2s ease;
    }

    .form-control:focus {
        border-color: #7367f0;
        box-shadow: 0 0 0 3px rgba(115, 103, 240, 0.15);
        outline: none;
    }

    .form-actions-footer {
        display: flex;
        gap: 12px;
        margin-top: 2.2rem;
        border-top: 1px solid #ebe9f1;
        padding-top: 1.5rem;
    }

    .btn-portal-submit {
        background: linear-gradient(135deg, #7367f0 0%, #8c52ff 100%);
        border: none;
        color: #ffffff;
        font-family: 'Outfit', sans-serif;
        font-weight: 600;
        font-size: 1.1rem;
        padding: 0.75rem 2rem;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(115, 103, 240, 0.25);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-portal-submit:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(115, 103, 240, 0.35);
    }

    .btn-portal-cancel {
        background-color: #ffb800;
        border: none;
        color: #ffffff !important;
        font-family: 'Outfit', sans-serif;
        font-weight: 600;
        font-size: 1.1rem;
        padding: 0.75rem 2rem;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(255, 184, 0, 0.2);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-portal-cancel:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(255, 184, 0, 0.3);
    }

    .invalid-feedback {
        font-size: 0.9rem;
        color: #ea5455;
        font-weight: 500;
        display: block;
        margin-top: 0.3rem;
    }

    .profile-card-static {
        background: linear-gradient(135deg, rgba(115, 103, 240, 0.05) 0%, rgba(156, 82, 255, 0.05) 100%);
        border: 1px solid rgba(115, 103, 240, 0.15);
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .profile-card-static h5 {
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        color: #7367f0;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .profile-card-static-item {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem 0;
        border-bottom: 1.5px dashed rgba(115, 103, 240, 0.1);
    }

    .profile-card-static-item:last-child {
        border-bottom: none;
    }

    .profile-card-static-label {
        font-weight: 600;
        color: var(--text-main);
    }

    .profile-card-static-val {
        font-weight: 700;
        color: var(--text-dark);
    }
</style>
@endsection

@section('content')

    <div class="portal-form-block">
        <!-- HEADER -->
        <div class="portal-form-header">
            <h3 class="portal-form-title">
                <i class="fas fa-user-cog"></i>
                <span>Pengaturan Profil Anda</span>
            </h3>
            <a href="{{ route('portal-mahasiswa.dashboard') }}" class="btn-portal-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="profile-card-static">
                    <div class="text-center mb-3">
                        @if ($student->foto_profile)
                            <img class="rounded-circle border border-primary p-1 bg-white" src="{{ asset('storage/images/profile/' . $student->foto_profile) }}" alt="foto profile" height="150" width="150" style="object-fit: cover; box-shadow: 0 4px 15px rgba(115, 103, 240, 0.15);">
                        @else
                            <img class="rounded-circle border border-primary p-1 bg-white" src="{{ asset('Assets/Backend/images/user.png') }}" alt="avatar default" height="150" width="150" style="object-fit: cover; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);">
                        @endif
                    </div>
                    <h5><i class="fas fa-university"></i> Detail Akademik</h5>
                    <div class="profile-card-static-item">
                        <span class="profile-card-static-label">Program Studi</span>
                        <span class="profile-card-static-val">{{ $student->program_studi }}</span>
                    </div>
                    <div class="profile-card-static-item">
                        <span class="profile-card-static-label">Kelas</span>
                        <span class="profile-card-static-val">{{ $student->kelas }}</span>
                    </div>
                    <div class="profile-card-static-item">
                        <span class="profile-card-static-label">Status Akun</span>
                        <span class="profile-card-static-val text-success font-weight-bold">{{ ucfirst($student->status) }}</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <!-- FORM -->
                <form action="{{ route('portal-mahasiswa.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- NAMA -->
                        <div class="col-md-6 form-group mb-4">
                            <label for="nama">Nama Lengkap <span class="required">*</span></label>
                            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan Nama Lengkap..." value="{{ old('nama', $student->nama) }}" required>
                            @error('nama')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- NIM / KATA SANDI -->
                        <div class="col-md-6 form-group mb-4">
                            <label for="nim">NIM / Kata Sandi <span class="required">*</span></label>
                            <input type="text" name="nim" id="nim" class="form-control @error('nim') is-invalid @enderror" placeholder="Masukkan NIM..." value="{{ old('nim', $student->nim) }}" required>
                            <small class="text-muted d-block mt-1"><i class="fas fa-info-circle mr-1"></i>NIM digunakan sebagai kata sandi login Anda.</small>
                            @error('nim')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- EMAIL -->
                        <div class="col-md-6 form-group mb-4">
                            <label for="email">E-mail <span class="required">*</span></label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan E-mail..." value="{{ old('email', $student->email) }}" required>
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- NO HP -->
                        <div class="col-md-6 form-group mb-4">
                            <label for="no_hp">Nomor Handphone</label>
                            <input type="text" name="no_hp" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror" placeholder="Masukkan Nomor Handphone..." value="{{ old('no_hp', $student->no_hp) }}">
                            @error('no_hp')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- FOTO PROFILE -->
                        <div class="col-12 form-group mb-4">
                            <label for="foto_profile">Foto Profil</label>
                            <div class="custom-file">
                                <input type="file" name="foto_profile" id="foto_profile" class="custom-file-input @error('foto_profile') is-invalid @enderror">
                                <label class="custom-file-label" for="foto_profile">Pilih foto profil baru...</label>
                            </div>
                            <small class="text-muted d-block mt-1"><i class="fas fa-info-circle mr-1"></i>Format yang diizinkan: <strong>JPG, JPEG, PNG</strong> (Maksimal 2 MB)</small>
                            @error('foto_profile')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- ACTIONS FOOTER -->
                    <div class="form-actions-footer">
                        <button type="submit" class="btn-portal-submit">
                            <i class="fas fa-save"></i> Perbarui Profil
                        </button>
                        <a href="{{ route('portal-mahasiswa.dashboard') }}" class="btn-portal-cancel">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    document.getElementById('foto_profile').addEventListener('change', function (e) {
        var name = e.target.files[0].name;
        var label = e.target.nextElementSibling;
        label.innerText = name;
    });
</script>
@endsection
