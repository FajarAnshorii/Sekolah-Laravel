@extends('frontend.portal-mahasiswa.layouts.app')

@section('title', 'Dashboard')

@section('styles')
<style>
    .welcome-card {
        background: linear-gradient(135deg, #7367f0 0%, #9c52ff 100%);
        border-radius: 16px;
        color: #ffffff;
        padding: 2rem;
        box-shadow: 0 8px 25px rgba(115, 103, 240, 0.2);
        margin-bottom: 2rem;
        border: none;
    }

    .welcome-card h2 {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .welcome-card p.subtitle {
        font-size: 1.05rem;
        opacity: 0.9;
        margin-bottom: 1.2rem;
        font-weight: 500;
    }

    .welcome-details {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        font-size: 0.9rem;
    }

    .welcome-details span {
        display: flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.15);
        padding: 0.4rem 1rem;
        border-radius: 50px;
        backdrop-filter: blur(5px);
    }

    .status-badge-aktif {
        background: #28c76f !important;
        color: #ffffff;
        font-weight: 600;
    }

    /* ===== METRIC CARDS ===== */
    .metric-card {
        border-radius: 16px;
        color: #ffffff;
        padding: 1.8rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border: none;
        position: relative;
        overflow: hidden;
        margin-bottom: 1.5rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .metric-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .metric-card::before {
        content: "";
        position: absolute;
        width: 120px;
        height: 120px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        top: -30px;
        right: -30px;
        pointer-events: none;
    }

    .metric-card-penghargaan {
        background: linear-gradient(135deg, #7367f0 0%, #9c52ff 100%);
    }

    .metric-card-sertifikat {
        background: linear-gradient(135deg, #28c76f 0%, #48da89 100%);
    }

    .metric-card-perlombaan {
        background: linear-gradient(135deg, #ea5455 0%, #ff7b7b 100%);
    }

    .metric-card-portofolio {
        background: linear-gradient(135deg, #00cfdd 0%, #5ce1e6 100%);
    }

    .metric-icon {
        font-size: 2.2rem;
        margin-bottom: 1rem;
    }

    .metric-count {
        font-family: 'Outfit', sans-serif;
        font-size: 3rem;
        font-weight: 800;
        line-height: 1;
        margin-bottom: 0.3rem;
    }

    .metric-title {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 1.2rem;
        opacity: 0.9;
    }

    .metric-btn {
        background: rgba(255, 255, 255, 0.2);
        color: #ffffff !important;
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 8px;
        padding: 0.4rem 1rem;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .metric-btn:hover {
        background: #ffffff;
        color: var(--text-dark) !important;
        border-color: #ffffff;
    }

    /* ===== POINTS SECTION ===== */
    .poin-card {
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: none;
        background: #ffffff;
        margin-bottom: 2rem;
        overflow: hidden;
    }

    .poin-card-header {
        background: #ffffff;
        border-bottom: 1px solid #ebe9f1;
        padding: 1.5rem 1.8rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .poin-card-header i {
        color: #ffb800;
        font-size: 1.4rem;
    }

    .poin-card-header h4 {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 700;
    }

    .poin-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        padding: 1.8rem;
    }

    @media (max-width: 991px) {
        .poin-grid {
            grid-template-columns: 1fr;
        }
    }

    .poin-box {
        border-radius: 12px;
        padding: 1.5rem;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .poin-box-total {
        background: linear-gradient(135deg, rgba(115, 103, 240, 0.1) 0%, rgba(156, 82, 255, 0.1) 100%);
        border: 2px solid #7367f0;
    }

    .poin-box-total .count {
        font-size: 3rem;
        font-weight: 800;
        color: #7367f0;
    }

    .poin-box-total .label {
        font-weight: 700;
        color: #7367f0;
        font-size: 0.95rem;
        margin-top: 0.2rem;
    }

    .poin-box-badge {
        background: #fafafb;
        border: 1.5px solid #ebe9f1;
    }

    .poin-box-badge .badge-title {
        font-family: 'Outfit', sans-serif;
        font-size: 1.6rem;
        font-weight: 800;
        color: #ff9f43;
        letter-spacing: 0.5px;
    }

    .poin-box-badge .label {
        font-size: 0.85rem;
        color: var(--text-muted);
        margin-top: 0.3rem;
        font-weight: 600;
    }

    .poin-box-stat {
        background: #fafafb;
        border: 1.5px solid #ebe9f1;
    }

    .poin-box-stat .count {
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--text-dark);
    }

    .poin-box-stat .label {
        font-size: 0.85rem;
        color: var(--text-muted);
        font-weight: 600;
    }

    .poin-box-breakdown {
        background: #fafafb;
        border: 1.5px solid #ebe9f1;
        text-align: left;
        align-items: flex-start;
        font-size: 0.85rem;
    }

    .poin-box-breakdown h6 {
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: var(--text-dark);
    }

    .poin-box-breakdown ul {
        list-style: none;
        padding: 0;
        margin: 0;
        width: 100%;
    }

    .poin-box-breakdown li {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.25rem;
        font-weight: 500;
    }

    .poin-banner {
        background-color: #fff9e6;
        border-top: 1px solid #ffeeba;
        padding: 1rem 1.8rem;
        font-size: 0.82rem;
        color: #856404;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .poin-banner i {
        font-size: 1.1rem;
    }

    /* ===== BOTTOM BLOCKS ===== */
    .dashboard-block {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: none;
        height: 100%;
        margin-bottom: 2rem;
    }

    .dashboard-block-header {
        border-bottom: 1px solid #ebe9f1;
        padding: 1.5rem 1.8rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .dashboard-block-header i {
        color: #7367f0;
        font-size: 1.25rem;
    }

    .dashboard-block-header h4 {
        margin: 0;
        font-size: 1.2rem;
        font-weight: 700;
    }

    .dashboard-block-body {
        padding: 1.8rem;
    }

    /* ===== ACTION BUTTONS ===== */
    .quick-actions-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }

    @media (max-width: 575px) {
        .quick-actions-grid {
            grid-template-columns: 1fr;
        }
    }

    .btn-action-portal {
        border: none;
        border-radius: 12px;
        color: #ffffff !important;
        padding: 1.2rem;
        font-family: 'Outfit', sans-serif;
        font-weight: 600;
        font-size: 0.95rem;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none !important;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .btn-action-portal:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 18px rgba(0,0,0,0.15);
    }

    .btn-action-penghargaan {
        background: linear-gradient(135deg, #7367f0 0%, #8c52ff 100%);
    }

    .btn-action-sertifikat {
        background: linear-gradient(135deg, #28c76f 0%, #3fe085 100%);
    }

    .btn-action-perlombaan {
        background: linear-gradient(135deg, #ea5455 0%, #ff6c6c 100%);
    }

    .btn-action-portofolio {
        background: linear-gradient(135deg, #00cfdd 0%, #46e8f2 100%);
    }

    /* ===== ACCOUNT INFO ===== */
    .profile-info-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .profile-info-item {
        display: flex;
        justify-content: space-between;
        border-bottom: 1px solid #f0f0f2;
        padding-bottom: 10px;
    }

    .profile-info-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .profile-info-label {
        font-weight: 600;
        color: var(--text-muted);
        font-size: 0.9rem;
    }

    .profile-info-value {
        font-weight: 700;
        color: var(--text-dark);
        font-size: 0.9rem;
        text-align: right;
    }

    /* ===== CHART & STATS BLOCK ===== */
    .chart-card-body {
        padding: 2rem !important;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        min-height: 380px;
    }

    .chart-container-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-around;
        width: 100%;
        gap: 30px;
        flex-wrap: wrap;
    }

    .chart-canvas-box {
        position: relative;
        width: 250px;
        height: 250px;
        flex-shrink: 0;
    }

    .chart-center-info {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        pointer-events: none;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 100%;
    }

    .chart-center-num {
        font-family: 'Outfit', sans-serif;
        font-size: 3.5rem;
        font-weight: 800;
        color: var(--text-dark);
        line-height: 1;
        margin: 0;
    }

    .chart-center-lbl {
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-top: 3px;
    }

    .chart-legend-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
        flex-grow: 1;
        width: 100%;
        max-width: 260px;
    }

    .legend-item-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.75rem 1.2rem;
        border-radius: 12px;
        background: #fafafb;
        border: 1px solid #ebe9f1;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        text-decoration: none !important;
    }

    .legend-item-card:hover {
        transform: translateX(5px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .legend-item-left {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .legend-item-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
    }

    .legend-item-name {
        font-weight: 600;
        font-size: 1.1rem;
        color: var(--text-dark);
    }

    .legend-item-count {
        font-weight: 800;
        font-size: 1.25rem;
        font-family: 'Outfit', sans-serif;
    }

    /* Colors and border styling */
    .legend-item-penghargaan {
        border-left: 5px solid #7367f0 !important;
    }
    .legend-item-penghargaan .legend-item-dot {
        background-color: #7367f0;
    }
    .legend-item-penghargaan .legend-item-count {
        color: #7367f0;
    }
    .legend-item-penghargaan:hover {
        background: rgba(115, 103, 240, 0.03);
    }

    .legend-item-sertifikat {
        border-left: 5px solid #28c76f !important;
    }
    .legend-item-sertifikat .legend-item-dot {
        background-color: #28c76f;
    }
    .legend-item-sertifikat .legend-item-count {
        color: #28c76f;
    }
    .legend-item-sertifikat:hover {
        background: rgba(40, 199, 111, 0.03);
    }

    .legend-item-perlombaan {
        border-left: 5px solid #ea5455 !important;
    }
    .legend-item-perlombaan .legend-item-dot {
        background-color: #ea5455;
    }
    .legend-item-perlombaan .legend-item-count {
        color: #ea5455;
    }
    .legend-item-perlombaan:hover {
        background: rgba(234, 84, 85, 0.03);
    }

    .legend-item-portofolio {
        border-left: 5px solid #00cfdd !important;
    }
    .legend-item-portofolio .legend-item-dot {
        background-color: #00cfdd;
    }
    .legend-item-portofolio .legend-item-count {
        color: #00cfdd;
    }
    .legend-item-portofolio:hover {
        background: rgba(0, 207, 221, 0.03);
    }

    @media (max-width: 575px) {
        .chart-container-wrapper {
            flex-direction: column;
            gap: 20px;
        }
        .chart-legend-list {
            max-width: 100%;
        }
    }
</style>
@endsection

@section('content')

    <!-- SUCCESS ALERT -->
    @if(Session::has('success'))
        <div class="alert alert-success font-weight-bold alert-dismissible fade show" role="alert" style="border-radius: 12px; margin-bottom: 1.5rem; box-shadow: 0 4px 10px rgba(40, 199, 111, 0.1);">
            <i class="fas fa-check-circle mr-2"></i> {{ Session::get('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- WELCOME ALERT CARD -->
    <div class="welcome-card">
        <h2>Selamat Datang, {{ $student->nama }}!</h2>
        <p class="subtitle">NIM. {{ $student->nim }} | {{ $student->program_studi }} - {{ $student->kelas }}</p>
        <div class="welcome-details">
            <span><i class="fas fa-envelope"></i> {{ $student->email }}</span>
            <span><i class="fas fa-phone"></i> {{ $student->no_hp ?? '-' }}</span>
            <span class="status-badge-aktif"><i class="fas fa-circle" style="font-size: 0.6rem;"></i> {{ ucfirst($student->status) }}</span>
        </div>
    </div>

    <!-- METRICS 4 CARDS -->
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="metric-card metric-card-penghargaan">
                <div class="metric-icon"><i class="fas fa-award"></i></div>
                <div class="metric-count">{{ $student->penghargaans->count() }}</div>
                <div class="metric-title">Penghargaan</div>
                <a href="{{ route('portal-mahasiswa.penghargaan.index') }}" class="metric-btn">
                    Lihat Detail <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="metric-card metric-card-sertifikat">
                <div class="metric-icon"><i class="fas fa-certificate"></i></div>
                <div class="metric-count">{{ $student->sertifikats->count() }}</div>
                <div class="metric-title">Sertifikat</div>
                <a href="{{ route('portal-mahasiswa.sertifikat.index') }}" class="metric-btn">
                    Lihat Detail <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="metric-card metric-card-perlombaan">
                <div class="metric-icon"><i class="fas fa-flag"></i></div>
                <div class="metric-count">{{ $student->perlombaans->count() }}</div>
                <div class="metric-title">Perlombaan</div>
                <a href="{{ route('portal-mahasiswa.perlombaan.index') }}" class="metric-btn">
                    Lihat Detail <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="metric-card metric-card-portofolio">
                <div class="metric-icon"><i class="fas fa-briefcase"></i></div>
                <div class="metric-count">{{ $student->portofolios->count() }}</div>
                <div class="metric-title">Portofolio</div>
                <a href="{{ route('portal-mahasiswa.portofolio.index') }}" class="metric-btn">
                    Lihat Detail <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- PEROLEHAN POIN CARD -->
    <div class="card poin-card">
        <div class="poin-card-header">
            <i class="fas fa-star"></i>
            <h4>Perolehan Poin Anda</h4>
        </div>
        <div class="poin-grid">
            <div class="poin-box poin-box-total">
                <div class="count">{{ $totalPoin }}</div>
                <div class="label">Total Poin</div>
            </div>
            <div class="poin-box poin-box-badge">
                <div class="badge-title">{{ $badgeTitle }}</div>
                <div class="label">{{ $categoriesCount }} dari 4 Kategori</div>
            </div>
            <div class="poin-box poin-box-stat">
                <div class="count">{{ $student->penghargaans->count() + $student->sertifikats->count() + $student->perlombaans->count() + $student->portofolios->count() }}</div>
                <div class="label">Total Prestasi</div>
            </div>
            <div class="poin-box poin-box-breakdown">
                <h6>Breakdown Poin:</h6>
                <ul>
                    <li><span>Penghargaan:</span> <strong>{{ $poinPenghargaan }}</strong></li>
                    <li><span>Sertifikat:</span> <strong>{{ $poinSertifikat }}</strong></li>
                    <li><span>Perlombaan:</span> <strong>{{ $poinPerlombaan }}</strong></li>
                    <li><span>Portofolio:</span> <strong>0 <span style="font-weight: normal; color: var(--text-muted); font-size: 0.8rem;">(tanpa poin)</span></strong></li>
                </ul>
            </div>
        </div>
        <div class="poin-banner">
            <i class="fas fa-info-circle"></i>
            <span><strong>Sistem Poin:</strong> Nasional = 25 poin | Provinsi = 20 poin | Kabupaten/Kota = 15 poin | Universitas = 10 poin | Portofolio = tanpa poin (hanya dihitung sebagai jumlah Prestasi)</span>
        </div>
    </div>

    <!-- BOTTOM BLOCKS -->
    <div class="row">
        <!-- DISTRIBUSI PRESTASI -->
        <div class="col-lg-6 mb-4 mb-lg-0">
            <div class="dashboard-block">
                <div class="dashboard-block-header">
                    <i class="fas fa-chart-pie"></i>
                    <h4>Distribusi Prestasi</h4>
                </div>
                <div class="chart-card-body">
                    <div class="chart-container-wrapper">
                        <div class="chart-canvas-box">
                            <canvas id="achievementsChart"></canvas>
                            <div class="chart-center-info">
                                <span class="chart-center-num">{{ $student->penghargaans->count() + $student->sertifikats->count() + $student->perlombaans->count() + $student->portofolios->count() }}</span>
                                <span class="chart-center-lbl">Total</span>
                            </div>
                        </div>
                        
                        <div class="chart-legend-list">
                            <a href="{{ route('portal-mahasiswa.penghargaan.index') }}" class="legend-item-card legend-item-penghargaan">
                                <div class="legend-item-left">
                                    <span class="legend-item-dot"></span>
                                    <span class="legend-item-name">Penghargaan</span>
                                </div>
                                <span class="legend-item-count">{{ $student->penghargaans->count() }}</span>
                            </a>
                            <a href="{{ route('portal-mahasiswa.sertifikat.index') }}" class="legend-item-card legend-item-sertifikat">
                                <div class="legend-item-left">
                                    <span class="legend-item-dot"></span>
                                    <span class="legend-item-name">Sertifikat</span>
                                </div>
                                <span class="legend-item-count">{{ $student->sertifikats->count() }}</span>
                            </a>
                            <a href="{{ route('portal-mahasiswa.perlombaan.index') }}" class="legend-item-card legend-item-perlombaan">
                                <div class="legend-item-left">
                                    <span class="legend-item-dot"></span>
                                    <span class="legend-item-name">Perlombaan</span>
                                </div>
                                <span class="legend-item-count">{{ $student->perlombaans->count() }}</span>
                            </a>
                            <a href="{{ route('portal-mahasiswa.portofolio.index') }}" class="legend-item-card legend-item-portofolio">
                                <div class="legend-item-left">
                                    <span class="legend-item-dot"></span>
                                    <span class="legend-item-name">Portofolio</span>
                                </div>
                                <span class="legend-item-count">{{ $student->portofolios->count() }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ACCOUNT INFO -->
        <div class="col-lg-6">
            <div class="dashboard-block">
                <div class="dashboard-block-header">
                    <i class="fas fa-user-circle"></i>
                    <h4>Informasi Akun</h4>
                </div>
                <div class="dashboard-block-body">
                    <div class="profile-info-list">
                        <div class="profile-info-item">
                            <div class="profile-info-label">Nama Lengkap</div>
                            <div class="profile-info-value">{{ $student->nama }}</div>
                        </div>
                        <div class="profile-info-item">
                            <div class="profile-info-label">NIM (Nomor Induk Mahasiswa)</div>
                            <div class="profile-info-value">{{ $student->nim }}</div>
                        </div>
                        <div class="profile-info-item">
                            <div class="profile-info-label">Program Studi</div>
                            <div class="profile-info-value">{{ $student->program_studi }}</div>
                        </div>
                        <div class="profile-info-item">
                            <div class="profile-info-label">Kelas</div>
                            <div class="profile-info-value">{{ $student->kelas }}</div>
                        </div>
                        <div class="profile-info-item">
                            <div class="profile-info-label">Peringkat Prestasi</div>
                            <div class="profile-info-value">#{{ $rank }} <span style="font-weight: normal; color: var(--text-muted); font-size: 0.8rem;">dari seluruh mahasiswa aktif</span></div>
                        </div>
                        <div class="profile-info-item">
                            <div class="profile-info-label">Nomor Handphone</div>
                            <div class="profile-info-value">{{ $student->no_hp ?? '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById('achievementsChart').getContext('2d');
        
        var penghargaanCount = {{ $student->penghargaans->count() }};
        var sertifikatCount = {{ $student->sertifikats->count() }};
        var perlombaanCount = {{ $student->perlombaans->count() }};
        var portofolioCount = {{ $student->portofolios->count() }};
        
        var total = penghargaanCount + sertifikatCount + perlombaanCount + portofolioCount;
        
        var chartData = [penghargaanCount, sertifikatCount, perlombaanCount, portofolioCount];
        var chartColors = ['#7367f0', '#28c76f', '#ea5455', '#00cfdd'];
        
        if (total === 0) {
            chartData = [1, 1, 1, 1];
            chartColors = ['#e9ecef', '#e9ecef', '#e9ecef', '#e9ecef'];
        }
        
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Penghargaan', 'Sertifikat', 'Perlombaan', 'Portofolio'],
                datasets: [{
                    data: chartData,
                    backgroundColor: chartColors,
                    borderWidth: total === 0 ? 0 : 3,
                    borderColor: '#ffffff',
                    hoverBorderColor: '#ffffff',
                    hoverOffset: total === 0 ? 0 : 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '78%',
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        enabled: total > 0,
                        callbacks: {
                            label: function(context) {
                                var label = context.label || '';
                                var value = context.raw || 0;
                                return ' ' + label + ': ' + value + ' Prestasi';
                            }
                        },
                        padding: 10,
                        bodyFont: {
                            size: 13,
                            family: "'Inter', sans-serif"
                        },
                        titleFont: {
                            size: 13,
                            family: "'Outfit', sans-serif"
                        }
                    }
                },
                animation: {
                    duration: 1200,
                    easing: 'easeOutBack'
                }
            }
        });
    });
</script>
@endsection
