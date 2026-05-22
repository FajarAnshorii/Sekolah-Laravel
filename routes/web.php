<?php

use App\Http\Controllers\Backend\SettingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ======= FRONTEND ======= \\

Route::get('/buat-admin', function () {
    try {
        // Buat role Admin jika belum ada
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'Admin']);
        
        $user = \App\Models\User::where('email', 'admin@gmail.com')->first();
        if (!$user) {
            $user = new \App\Models\User();
            $user->name = 'Admin';
            $user->username = 'admin';
            $user->email = 'admin@gmail.com';
        }
        $user->role = 'Admin';
        $user->status = 'Aktif';
        $user->password = \Illuminate\Support\Facades\Hash::make('Bismillah');
        $user->save();

        // Assign role
        $user->assignRole('Admin');

        return 'Akun Admin berhasil dibuat/direset!<br>Email: <b>admin@gmail.com</b><br>Password: <b>Bismillah</b><br><br><a href="/login">Klik di sini untuk Login</a>';
    } catch (\Exception $e) {
        return 'Gagal membuat akun Admin: ' . $e->getMessage();
    }
});

Route::get('/debug-db', function () {
    try {
        $users = \App\Models\User::all();
        $output = "<h3>Daftar Pengguna (users):</h3><table border='1' cellpadding='5'><tr><th>Nama</th><th>Username</th><th>Email</th><th>Role</th><th>Status</th></tr>";
        foreach ($users as $u) {
            $output .= "<tr><td>{$u->name}</td><td>{$u->username}</td><td>{$u->email}</td><td>{$u->role}</td><td>{$u->status}</td></tr>";
        }
        $output .= "</table>";

        $mahasiswa = \App\Models\Mahasiswa::limit(5)->get();
        $output .= "<h3>Daftar Mahasiswa (5 Sampel):</h3><table border='1' cellpadding='5'><tr><th>Nama</th><th>NIM</th><th>Email</th><th>Status</th></tr>";
        foreach ($mahasiswa as $m) {
            $output .= "<tr><td>{$m->nama}</td><td>{$m->nim}</td><td>{$m->email}</td><td>{$m->status}</td></tr>";
        }
        $output .= "</table>";
        
        return $output;
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});

Route::get('/','Frontend\IndexController@index');

    ///// MENU \\\\\
        //// PROFILE SEKOLAJ \\\\
        Route::get('profile-sekolah',[App\Http\Controllers\Frontend\IndexController::class,'profileSekolah'])->name('profile.sekolah');

        //// VISI dan MISI
        Route::get('visi-dan-misi',[App\Http\Controllers\Frontend\IndexController::class,'visimisi'])->name('visimisi.sekolah');

        //// PROGRAM STUDI \\\\
        Route::get('program/{slug}', [App\Http\Controllers\Frontend\MenuController::class, 'programStudi']);
        //// PROGRAM STUDI \\\\
        Route::get('kegiatan/{slug}', [App\Http\Controllers\Frontend\MenuController::class, 'kegiatan']);

        /// BERITA \\\
        Route::get('berita',[App\Http\Controllers\Frontend\IndexController::class,'berita'])->name('berita');
        Route::get('berita/{slug}',[App\Http\Controllers\Frontend\IndexController::class,'detailBerita'])->name('detail.berita');

        /// EVENT \\\
        Route::get('event/{slug}',[App\Http\Controllers\Frontend\IndexController::class,'detailEvent'])->name('detail.event');
        Route::get('event',[App\Http\Controllers\Frontend\IndexController::class,'events'])->name('event');

Auth::routes(['register' => false]);


// ======= BACKEND ======= \\
Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

     /// PROFILE \\\
    Route::resource('profile-settings',Backend\ProfileController::class);
    /// SETTINGS \\\
      Route::prefix('settings')->group( function(){
        // BANK
        Route::get('/',[App\Http\Controllers\Backend\SettingController::class,'index'])->name('settings');
        // TAMBAH BANK
        Route::post('add-bank',[App\Http\Controllers\Backend\SettingController::class,'addBank'])->name('settings.add.bank');
        // NOTIFICATIONS
        Route::put('notifications/{id}',[SettingController::class,'notifications']);
      });


    /// CHANGE PASSWORD
    Route::put('profile-settings/change-password/{id}',[App\Http\Controllers\Backend\ProfileController::class, 'changePassword'])->name('profile.change-password');

    Route::prefix('/')->middleware('role:Admin')->group( function (){
        ///// WEBSITE \\\\\
        Route::resources([
            /// PROFILE SEKOLAH \\
            'backend-profile-sekolah'   => Backend\Website\ProfilSekolahController::class,
            /// VISI & MISI \\\
            'backend-visimisi'  => Backend\Website\VisidanMisiController::class,
            //// PROGRAM STUDI \\\\
            'program-studi' =>  Backend\Website\ProgramController::class,
            /// KEGIATAN \\\
            'backend-kegiatan' => Backend\Website\KegiatanController::class,
            /// IMAGE SLIDER \\\
            'backend-imageslider' => Backend\Website\ImageSliderController::class,
            /// ABOUT \\\
            'backend-about' => Backend\Website\AboutController::class,
            /// VIDEO \\\
            'backend-video' => Backend\Website\VideoController::class,
            /// KATEGORI BERITA \\\
            'backend-kategori-berita'   => Backend\Website\KategoriBeritaController::class,
            /// BERITA \\\
            'backend-berita' => Backend\Website\BeritaController::class,
            /// EVENT \\\
            'backend-event' => Backend\Website\EventsController::class,
            /// FOOTER \\\
            'backend-footer'    => Backend\Website\FooterController::class,
        ]);

        ///// PENGGUNA \\\\\
        Route::resources([
            /// PENGAJAR \\\
            'backend-pengguna-pengajar' => Backend\Pengguna\PengajarController::class,
            /// STAF \\\
            'backend-pengguna-staf' => Backend\Pengguna\StafController::class,
            /// MURID \\\
            'backend-pengguna-murid' => Backend\Pengguna\MuridController::class,
            /// PPDB \\\
            'backend-pengguna-ppdb' => Backend\Pengguna\PPDBController::class,
            /// PERPUSTAKAAN \\\
            'backend-pengguna-perpus' => Backend\Pengguna\PerpusController::class,
            /// BENDAHARA \\\
            'backend-pengguna-bendahara'  => Backend\Pengguna\BendaharaController::class,
            /// MAHASISWA \\\
            'backend-pengguna-mahasiswa'  => Backend\Pengguna\MahasiswaController::class,
            'backend-pengguna-komting'    => Backend\Pengguna\KomtingController::class,
            
            /// PRESTASI SUB-RESOURCES \\\
            'backend-prestasi-penghargaan' => Backend\Pengguna\PrestasiPenghargaanController::class,
            'backend-prestasi-sertifikat' => Backend\Pengguna\PrestasiSertifikatController::class,
            'backend-prestasi-perlombaan' => Backend\Pengguna\PrestasiPerlombaanController::class,
            'backend-prestasi-portofolio' => Backend\Pengguna\PrestasiPortofolioController::class,
        ]);

        /// PRESTASI CORE ROUTES \\\
        Route::get('backend-prestasi-overview', [App\Http\Controllers\Backend\Pengguna\PrestasiController::class, 'overview'])->name('backend-prestasi-overview');
        Route::get('backend-prestasi-detail/{id}', [App\Http\Controllers\Backend\Pengguna\PrestasiController::class, 'showDetail'])->name('backend-prestasi-detail');

        /// ABSENSI \\\
        Route::resource('backend-absensi', App\Http\Controllers\Backend\AbsensiController::class);
        Route::get('backend-absensi-rekap', [App\Http\Controllers\Backend\AbsensiController::class, 'rekap'])->name('backend-absensi.rekap');
    });
});

// ======= KOMTING DASHBOARD ======= \\
Route::prefix('komting')->middleware(['auth', 'komting-auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Komting\KomtingDashboardController::class, 'dashboard'])->name('komting.dashboard');
    Route::get('/absensi', [App\Http\Controllers\Komting\KomtingDashboardController::class, 'absensi'])->name('komting.absensi');
    Route::post('/absensi/store', [App\Http\Controllers\Komting\KomtingDashboardController::class, 'storeAbsensi'])->name('komting.absensi.store');
    Route::get('/riwayat-absensi', [App\Http\Controllers\Komting\KomtingDashboardController::class, 'riwayat'])->name('komting.riwayat');
});

// ======= PORTAL MAHASISWA (FRONTEND) ======= \\
Route::prefix('portal-mahasiswa')->group(function () {
    // Guest Routes
    Route::get('/login', [App\Http\Controllers\Frontend\PortalMahasiswaController::class, 'showLogin'])->name('portal-mahasiswa.login');
    Route::post('/login', [App\Http\Controllers\Frontend\PortalMahasiswaController::class, 'login'])->name('portal-mahasiswa.login.post');

    // Authenticated Routes
    Route::middleware('portal-mahasiswa-auth')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Frontend\PortalMahasiswaController::class, 'dashboard'])->name('portal-mahasiswa.dashboard');
        Route::post('/logout', [App\Http\Controllers\Frontend\PortalMahasiswaController::class, 'logout'])->name('portal-mahasiswa.logout');

        // CRUD Achievement resources
        Route::resource('penghargaan', App\Http\Controllers\Frontend\PortalMahasiswa\PenghargaanController::class, ['names' => 'portal-mahasiswa.penghargaan']);
        Route::resource('sertifikat', App\Http\Controllers\Frontend\PortalMahasiswa\SertifikatController::class, ['names' => 'portal-mahasiswa.sertifikat']);
        Route::resource('perlombaan', App\Http\Controllers\Frontend\PortalMahasiswa\PerlombaanController::class, ['names' => 'portal-mahasiswa.perlombaan']);
        Route::resource('portofolio', App\Http\Controllers\Frontend\PortalMahasiswa\PortofolioController::class, ['names' => 'portal-mahasiswa.portofolio']);
    });
});
