@extends('frontend.portal-mahasiswa.layouts.app')

@section('title', 'Daftar Portofolio')

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
        color: #00cfdd;
    }

    .btn-portal-add {
        background: linear-gradient(135deg, #00cfdd 0%, #00b5c2 100%);
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
        box-shadow: 0 4px 12px rgba(0, 207, 221, 0.25);
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .btn-portal-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(0, 207, 221, 0.35);
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

    .badge-kategori {
        font-family: 'Outfit', sans-serif;
        font-weight: 600;
        font-size: 0.8rem;
        padding: 0.4rem 0.8rem;
        border-radius: 50px;
        text-transform: uppercase;
        display: inline-block;
    }

    .badge-kategori-web {
        background-color: #e5f9f6;
        color: #00cfdd;
    }

    .badge-kategori-design {
        background-color: #fff4e5;
        color: #ff9f43;
    }

    .badge-kategori-mobile {
        background-color: #eae8fd;
        color: #7367f0;
    }

    .badge-kategori-default {
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
        background-color: rgba(0, 207, 221, 0.1);
        color: #00cfdd !important;
    }

    .btn-portal-view:hover {
        background-color: #00cfdd;
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
                <i class="fas fa-briefcase"></i>
                <span>Daftar Portofolio Mahasiswa</span>
            </h3>
            <a href="{{ route('portal-mahasiswa.portofolio.create') }}" class="btn-portal-add">
                <i class="fas fa-plus"></i> Tambah Portofolio
            </a>
        </div>

        <!-- TABLE SECTION -->
        @if($portofolio->count() > 0)
            <div class="table-responsive">
                <table class="table table-portal">
                    <thead>
                        <tr>
                            <th style="width: 60px;">No</th>
                            <th>Judul Portofolio</th>
                            <th>Kategori</th>
                            <th>Link External</th>
                            <th>Tanggal Terbit</th>
                            <th>File</th>
                             <th style="width: 240px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($portofolio as $key => $p)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td style="text-align: left; font-weight: 600; color: var(--text-dark);">{{ $p->judul }}</td>
                                <td>
                                    @php
                                        $catLower = strtolower(trim($p->kategori));
                                        $badgeClass = 'badge-kategori-default';
                                        if (strpos($catLower, 'web') !== false || strpos($catLower, 'aplikasi') !== false) {
                                            $badgeClass = 'badge-kategori-web';
                                        } elseif (strpos($catLower, 'design') !== false || strpos($catLower, 'desain') !== false || strpos($catLower, 'ui') !== false) {
                                            $badgeClass = 'badge-kategori-design';
                                        } elseif (strpos($catLower, 'mobile') !== false || strpos($catLower, 'android') !== false || strpos($catLower, 'ios') !== false) {
                                            $badgeClass = 'badge-kategori-mobile';
                                        }
                                    @endphp
                                    <span class="badge-kategori {{ $badgeClass }}">{{ $p->kategori }}</span>
                                </td>
                                <td>
                                    @if($p->link)
                                        <a href="{{ $p->link }}" target="_blank" class="btn-portal-action btn-portal-view" style="padding: 0.3rem 0.6rem; font-size: 0.8rem;">
                                            <i class="fas fa-external-link-alt"></i> Buka Link
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($p->tanggal)->format('d M Y') }}</td>
                                <td>
                                    @if($p->file_portofolio)
                                        <a href="{{ asset('storage/files/prestasi/' . $p->file_portofolio) }}" class="btn-portal-action btn-portal-view" download>
                                            <i class="fas fa-download"></i> Download
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td style="white-space: nowrap; text-align: center; vertical-align: middle;">
                                    <a href="{{ route('portal-mahasiswa.portofolio.edit', $p->id) }}" class="btn-portal-action btn-portal-edit" style="margin: 4px 6px !important; display: inline-block !important; vertical-align: middle !important;">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    
                                    <form action="{{ route('portal-mahasiswa.portofolio.destroy', $p->id) }}" method="POST" style="display: inline-block !important; margin: 4px 6px !important; vertical-align: middle !important;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data portofolio ini?')">
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
                <h5>Belum Ada Data Portofolio</h5>
                <p>Klik tombol "Tambah Portofolio" di atas untuk mendokumentasikan karya terbaik Anda.</p>
            </div>
        @endif
    </div>

@endsection
