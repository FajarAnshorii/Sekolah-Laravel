<style>
.rankings-area {
    padding: 80px 0;
    background: #fcfdfe;
}
.rankings-title-wrapper {
    margin-bottom: 60px;
    text-align: center;
}
.rankings-title-wrapper h2 {
    font-size: 36px;
    font-weight: 800;
    color: #0c2340;
    margin-bottom: 15px;
    position: relative;
    display: inline-block;
}
.rankings-title-wrapper h2::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 4px;
    background: linear-gradient(90deg, #fd7e14, #ffc107);
    border-radius: 2px;
}
.rankings-title-wrapper p {
    font-size: 16px;
    color: #6c757d;
}
.ranking-card {
    background: #ffffff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    position: relative;
    border: 1px solid rgba(0, 0, 0, 0.03);
    margin-bottom: 30px;
    text-align: center;
    padding-bottom: 25px;
}
.ranking-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
}
.ranking-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 10px;
    transition: all 0.3s ease;
}
/* Gold Rank */
.rank-1::before { background: linear-gradient(90deg, #ffd700, #ffa500); }
.rank-1 .rank-badge { background: linear-gradient(135deg, #ffd700, #ffa500); color: #fff; }
.rank-1 .avatar-container { border-color: #ffd700; background: linear-gradient(135deg, #fff7e6, #ffecc2); color: #b27c00; }
.rank-1 .points-badge { background: linear-gradient(135deg, #ffd700, #ffa500); color: #fff; }

/* Silver Rank */
.rank-2::before { background: linear-gradient(90deg, #e0e0e0, #9e9e9e); }
.rank-2 .rank-badge { background: linear-gradient(135deg, #e0e0e0, #9e9e9e); color: #fff; }
.rank-2 .avatar-container { border-color: #b0bec5; background: linear-gradient(135deg, #eceff1, #cfd8dc); color: #546e7a; }
.rank-2 .points-badge { background: linear-gradient(135deg, #b0bec5, #78909c); color: #fff; }

/* Bronze Rank */
.rank-3::before { background: linear-gradient(90deg, #cd7f32, #8b4513); }
.rank-3 .rank-badge { background: linear-gradient(135deg, #cd7f32, #8b4513); color: #fff; }
.rank-3 .avatar-container { border-color: #cd7f32; background: linear-gradient(135deg, #fbe9e7, #ffccbc); color: #bf360c; }
.rank-3 .points-badge { background: linear-gradient(135deg, #d84315, #8b4513); color: #fff; }

/* Fourth Rank */
.rank-4::before { background: linear-gradient(90deg, #3f51b5, #5c6bc0); }
.rank-4 .rank-badge { background: linear-gradient(135deg, #3f51b5, #5c6bc0); color: #fff; }
.rank-4 .avatar-container { border-color: #3f51b5; background: linear-gradient(135deg, #e8eaf6, #c5cae9); color: #1a237e; }
.rank-4 .points-badge { background: linear-gradient(135deg, #3f51b5, #5c6bc0); color: #fff; }

.rank-badge {
    position: absolute;
    top: 20px;
    right: 20px;
    padding: 6px 14px;
    border-radius: 30px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    z-index: 10;
}
.avatar-section {
    padding-top: 45px;
    margin-bottom: 20px;
    display: flex;
    justify-content: center;
    position: relative;
}
.avatar-container {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    border: 4px solid #eee;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    font-weight: 800;
    position: relative;
    box-shadow: 0 8px 20px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}
.ranking-card:hover .avatar-container {
    transform: scale(1.08);
}
.rank-crown {
    position: absolute;
    top: -15px;
    left: 50%;
    transform: translateX(-50%);
    font-size: 28px;
    z-index: 5;
    animation: float 2s ease-in-out infinite;
}
@keyframes float {
    0% { transform: translate(-50%, 0px); }
    50% { transform: translate(-50%, -6px); }
    100% { transform: translate(-50%, 0px); }
}
.student-info {
    padding: 0 20px;
}
.student-name {
    font-size: 16px;
    font-weight: 800;
    color: #0c2340;
    margin-bottom: 6px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.student-nim {
    font-size: 12px;
    color: #888;
    margin-bottom: 12px;
    font-family: monospace;
    letter-spacing: 0.5px;
    display: block;
}
.student-class {
    font-size: 11px;
    font-weight: 700;
    color: #495057;
    background: #e9ecef;
    padding: 4px 12px;
    border-radius: 12px;
    display: inline-block;
    margin-bottom: 18px;
}
.points-badge {
    display: inline-block;
    padding: 8px 24px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 14px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    margin-bottom: 20px;
}
.achievement-summary {
    display: flex;
    justify-content: space-around;
    border-top: 1px dashed #e9ecef;
    padding-top: 18px;
    margin-top: 10px;
}
.achievement-item {
    font-size: 11px;
    color: #6c757d;
    display: flex;
    flex-direction: column;
    align-items: center;
    cursor: pointer;
    transition: all 0.2s ease;
}
.achievement-item:hover {
    transform: translateY(-2px);
}
.achievement-item i {
    font-size: 18px;
    margin-bottom: 6px;
    color: #0c2340;
}
.achievement-item .count {
    font-weight: 700;
    color: #212529;
    font-size: 12px;
}

/* Placeholder card styling */
.placeholder-card {
    background: #fcfcfc;
    border: 2px dashed #e2e8f0;
    box-shadow: none !important;
    opacity: 0.6;
}
.placeholder-card:hover {
    transform: none !important;
    box-shadow: none !important;
}
.placeholder-avatar {
    border-color: #cbd5e1 !important;
    background: #f8fafc !important;
    color: #94a3b8 !important;
}
.placeholder-card::before {
    background: linear-gradient(90deg, #cbd5e1, #cbd5e1) !important;
}
</style>

<div class="rankings-area">
    <div class="container">
        <div class="rankings-title-wrapper">
            <h2>Peringkat Prestasi Siswa</h2>
            <p>Apresiasi bagi siswa-siswi aktif dengan perolehan poin keaktifan dan prestasi tertinggi</p>
        </div>
    </div>
    <div class="container">
        <div class="row" style="display: flex; flex-wrap: wrap; justify-content: center;">
            @for ($r = 1; $r <= 4; $r++)
                @php
                    $student = (isset($top_students) && isset($top_students[$r - 1])) ? $top_students[$r - 1] : null;
                @endphp
                
                @if($student)
                    @php
                        $words = explode(' ', $student->nama);
                        $initials = '';
                        foreach (array_slice($words, 0, 2) as $w) {
                            $initials .= strtoupper(substr($w, 0, 1));
                        }
                        $rankClass = 'rank-' . $student->rank;
                    @endphp
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="ranking-card {{ $rankClass }}">
                            <span class="rank-badge">Juara {{ $student->rank }}</span>
                            
                            <div class="avatar-section">
                                @if($student->rank == 1)
                                    <div class="rank-crown">👑</div>
                                @elseif($student->rank == 2)
                                    <div class="rank-crown">🥈</div>
                                @elseif($student->rank == 3)
                                    <div class="rank-crown">🥉</div>
                                @endif
                                
                                <div class="avatar-container">
                                    {{ $initials }}
                                </div>
                            </div>
                            
                            <div class="student-info">
                                <h3 class="student-name" title="{{ $student->nama }}">{{ $student->nama }}</h3>
                                <span class="student-nim">NIM: {{ $student->nim }}</span>
                                <span class="student-class">{{ $student->kelas ?? 'Mahasiswa' }}</span>
                                
                                <div class="points-badge-wrapper">
                                    <span class="points-badge">{{ $student->total_poin }} Poin</span>
                                </div>
                                
                                <div class="achievement-summary">
                                    <div class="achievement-item" title="Penghargaan">
                                        <i class="fa fa-trophy" style="color: #f39c12;"></i>
                                        <span class="count">{{ count($student->penghargaans) }}</span>
                                    </div>
                                    <div class="achievement-item" title="Sertifikat">
                                        <i class="fa fa-certificate" style="color: #27ae60;"></i>
                                        <span class="count">{{ count($student->sertifikats) }}</span>
                                    </div>
                                    <div class="achievement-item" title="Perlombaan">
                                        <i class="fa fa-flag" style="color: #e74c3c;"></i>
                                        <span class="count">{{ count($student->perlombaans) }}</span>
                                    </div>
                                    <div class="achievement-item" title="Portofolio">
                                        <i class="fa fa-briefcase" style="color: #2980b9;"></i>
                                        <span class="count">{{ count($student->portofolios) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="ranking-card rank-{{ $r }} placeholder-card">
                            <span class="rank-badge" style="background: #e2e8f0; color: #64748b;">Juara {{ $r }}</span>
                            
                            <div class="avatar-section">
                                <div class="avatar-container placeholder-avatar">
                                    <i class="fa fa-user" aria-hidden="true" style="color: #cbd5e1;"></i>
                                </div>
                            </div>
                            
                            <div class="student-info">
                                <h3 class="student-name">&nbsp;</h3>
                                <span class="student-nim">&nbsp;</span>
                                <span class="student-class" style="background: transparent; color: transparent; margin-bottom: 18px;">&nbsp;</span>
                                
                                <div class="points-badge-wrapper">
                                    <span class="points-badge" style="background: transparent; color: transparent; box-shadow: none;">&nbsp;</span>
                                </div>
                                
                                <div class="achievement-summary" style="border-top: 1px dashed transparent; opacity: 0;">
                                    <div class="achievement-item">
                                        <i class="fa fa-trophy"></i>
                                        <span class="count">0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endfor
        </div>
    </div>
</div>