@extends('frontend.portal-mahasiswa.layouts.app')

@section('title', 'Daftar Sertifikat')

@section('styles')
<style>
    .portal-block {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: none;
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .portal-block-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.8rem;
        flex-wrap: wrap;
        gap: 15px;
    }

    .portal-block-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-dark);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .portal-block-title i {
        color: #28c76f;
    }

    .btn-portal-add {
        background: linear-gradient(135deg, #28c76f 0%, #3fe085 100%);
        color: #ffffff !important;
        border: none;
        border-radius: 10px;
        padding: 0.6rem 1.4rem;
        font-family: 'Outfit', sans-serif;
        font-weight: 600;
        font-size: 0.95rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(40, 199, 111, 0.25);
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .btn-portal-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(40, 199, 111, 0.35);
    }

    .table-responsive {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #ebe9f1;
    }

    .table-portal {
        margin: 0;
    }

    .table-portal th {
        background-color: #fafafb;
        color: var(--text-dark);
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 0.9rem;
        text-transform: uppercase;
        border-bottom: 2px solid #ebe9f1;
        padding: 1.1rem;
        text-align: center;
    }

    .table-portal td {
        padding: 1.1rem;
        vertical-align: middle;
        text-align: center;
        font-size: 0.9rem;
        border-bottom: 1px solid #ebe9f1;
    }

    .table-portal tbody tr:last-child td {
        border-bottom: none;
    }

    .badge-tingkat {
        font-family: 'Outfit', sans-serif;
        font-weight: 600;
        font-size: 0.8rem;
        padding: 0.4rem 0.8rem;
        border-radius: 50px;
        text-transform: uppercase;
        display: inline-block;
    }

    .badge-tingkat-nasional {
        background-color: #eae8fd;
        color: #7367f0;
    }

    .badge-tingkat-provinsi {
        background-color: #e8f0fe;
        color: #1a73e8;
    }

    .badge-tingkat-kabupaten {
        background-color: #fff4e5;
        color: #ff9f43;
    }

    .badge-tingkat-universitas {
        background-color: #e5f9f6;
        color: #00cfdd;
    }

    .badge-tingkat-default {
        background-color: #f3f2f7;
        color: #6e6b7b;
    }

    .btn-portal-action {
        border-radius: 8px;
        padding: 0.4rem 0.8rem;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease;
        text-decoration: none !important;
        border: none;
        cursor: pointer;
    }

    .btn-portal-view {
        background-color: rgba(115, 103, 240, 0.1);
        color: #7367f0 !important;
    }

    .btn-portal-view:hover {
        background-color: #7367f0;
        color: #ffffff !important;
    }

    .btn-portal-edit {
        background-color: rgba(40, 199, 111, 0.1);
        color: #28c76f !important;
    }

    .btn-portal-edit:hover {
        background-color: #28c76f;
        color: #ffffff !important;
    }

    .btn-portal-delete {
        background-color: rgba(234, 84, 85, 0.1);
        color: #ea5455 !important;
    }

    .btn-portal-delete:hover {
        background-color: #ea5455;
        color: #ffffff !important;
    }

    .empty-state {
        text-align: center;
        padding: 3.5rem 1.5rem;
        color: var(--text-muted);
    }

    .empty-state i {
        font-size: 4rem;
        color: var(--text-muted);
        opacity: 0.5;
        margin-bottom: 1.2rem;
    }

    .empty-state h5 {
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
    }
</style>
@endsection

@section('content')

    <!-- STATUS MESSAGES -->
    @if(Session::has('success'))
        <div class="alert alert-success font-weight-bold alert-dismissible fade show" role="alert" style="border-radius: 12px; margin-bottom: 1.5rem; box-shadow: 0 4px 10px rgba(40, 199, 111, 0.1);">
            <i class="fas fa-check-circle mr-2"></i> {{ Session::get('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="portal-block">
        <!-- BLOCK HEADER -->
        <div class="portal-block-header">
            <h3 class="portal-block-title">
                <i class="fas fa-certificate"></i>
                <span>Daftar Sertifikat Mahasiswa</span>
            </h3>
            <a href="{{ route('portal-mahasiswa.sertifikat.create') }}" class="btn-portal-add">
                <i class="fas fa-plus"></i> Tambah Sertifikat
            </a>
        </div>

        <!-- TABLE SECTION -->
        @if($sertifikat->count() > 0)
            <div class="table-responsive">
                <table class="table table-portal">
                    <thead>
                        <tr>
                            <th style="width: 60px;">No</th>
                            <th>Nama Sertifikat</th>
                            <th>Penyelenggara</th>
                            <th>Jenis</th>
                            <th>Durasi</th>
                            <th>Tingkat</th>
                            <th>Tanggal</th>
                            <th>File</th>
                             <th style="width: 240px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sertifikat as $key => $s)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td style="text-align: left; font-weight: 600; color: var(--text-dark);">{{ $s->nama_sertifikat }}</td>
                                <td style="text-align: left;">{{ $s->penyelenggara }}</td>
                                <td><span class="badge badge-light-secondary" style="font-weight: 600; text-transform: uppercase;">{{ $s->jenis }}</span></td>
                                <td style="font-weight: bold;">{{ $s->jumlah_jam }} Jam</td>
                                <td>
                                    @php
                                        $tingkatLower = strtolower(trim($s->tingkat));
                                        $badgeClass = 'badge-tingkat-default';
                                        if (strpos($tingkatLower, 'nasional') !== false) {
                                            $badgeClass = 'badge-tingkat-nasional';
                                        } elseif (strpos($tingkatLower, 'provinsi') !== false) {
                                            $badgeClass = 'badge-tingkat-provinsi';
                                        } elseif (strpos($tingkatLower, 'kabupaten') !== false || strpos($tingkatLower, 'kota') !== false) {
                                            $badgeClass = 'badge-tingkat-kabupaten';
                                        } elseif (strpos($tingkatLower, 'universitas') !== false) {
                                            $badgeClass = 'badge-tingkat-universitas';
                                        }
                                    @endphp
                                    <span class="badge-tingkat {{ $badgeClass }}">{{ $s->tingkat }}</span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($s->tanggal)->format('d M Y') }}</td>
                                <td>
                                    @if($s->file_sertifikat)
                                        <a href="{{ asset('storage/files/prestasi/' . $s->file_sertifikat) }}" class="btn-portal-action btn-portal-view" download>
                                            <i class="fas fa-download"></i> Download
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td style="white-space: nowrap; text-align: center; vertical-align: middle;">
                                    <a href="{{ route('portal-mahasiswa.sertifikat.edit', $s->id) }}" class="btn-portal-action btn-portal-edit" style="margin: 4px 6px !important; display: inline-block !important; vertical-align: middle !important;">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    
                                    <form action="{{ route('portal-mahasiswa.sertifikat.destroy', $s->id) }}" method="POST" style="display: inline-block !important; margin: 4px 6px !important; vertical-align: middle !important;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data sertifikat ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-portal-action btn-portal-delete" style="display: inline-block !important; vertical-align: middle !important; margin: 0 !important;">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <!-- EMPTY STATE -->
            <div class="empty-state">
                <i class="fas fa-box-open"></i>
                <h5>Belum Ada Data Sertifikat</h5>
                <p>Klik tombol "Tambah Sertifikat" di atas untuk mendokumentasikan sertifikat pertama Anda.</p>
            </div>
        @endif
    </div>

@endsection
