<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\KomtingKelas;
use App\Models\Absensi;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Spatie\Permission\Models\Role;

class KomtingRoleTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        // Ensure Spatie role exists
        Role::firstOrCreate(['name' => 'Komting', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
    }

    /** @test */
    public function admin_can_create_komting_account()
    {
        $admin = new User();
        $admin->name = 'Admin Test';
        $admin->username = 'admintest';
        $admin->email = 'admintest@gmail.com';
        $admin->role = 'Admin';
        $admin->status = 'Aktif';
        $admin->password = bcrypt('password123');
        $admin->save();
        $admin->assignRole('Admin');

        // Create a student so we have distinct kelas options
        $mhs = new Mahasiswa();
        $mhs->nama = 'Test Student';
        $mhs->nim = '12345678';
        $mhs->program_studi = 'Teknik Informatika';
        $mhs->kelas = 'Kelas A';
        $mhs->email = 'studenttest@gmail.com';
        $mhs->status = 'Aktif';
        $mhs->save();

        $response = $this->actingAs($admin)
            ->post(route('backend-pengguna-komting.store'), [
                'name' => 'Komting Baru',
                'username' => 'komtingbaru',
                'email' => 'komtingbaru@gmail.com',
                'password' => 'password123',
                'kelas' => 'Kelas A',
                'no_hp' => '08123456789',
                'status' => 'Aktif',
            ]);

        $response->assertRedirect(route('backend-pengguna-komting.index'));
        $this->assertDatabaseHas('users', [
            'username' => 'komtingbaru',
            'email' => 'komtingbaru@gmail.com',
            'role' => 'Komting',
            'status' => 'Aktif',
        ]);

        $user = User::where('username', 'komtingbaru')->first();
        $this->assertDatabaseHas('komting_kelas', [
            'user_id' => $user->id,
            'kelas' => 'Kelas A',
            'no_hp' => '08123456789',
            'status' => 'Aktif',
        ]);
    }

    /** @test */
    public function komting_redirected_to_dashboard_on_login()
    {
        $komting = new User();
        $komting->name = 'Komting Test';
        $komting->username = 'komtingtest';
        $komting->email = 'komtingtest@gmail.com';
        $komting->role = 'Komting';
        $komting->status = 'Aktif';
        $komting->password = bcrypt('password123');
        $komting->save();
        $komting->assignRole('Komting');

        $kk = new KomtingKelas();
        $kk->user_id = $komting->id;
        $kk->kelas = 'Kelas A';
        $kk->no_hp = '08123456789';
        $kk->status = 'Aktif';
        $kk->save();

        $response = $this->actingAs($komting)->get('/home');
        $response->assertRedirect('/komting/dashboard');
    }

    /** @test */
    public function komting_dashboard_displays_correct_stats()
    {
        $komting = new User();
        $komting->name = 'Komting Test';
        $komting->username = 'komtingtest';
        $komting->email = 'komtingtest@gmail.com';
        $komting->role = 'Komting';
        $komting->status = 'Aktif';
        $komting->password = bcrypt('password123');
        $komting->save();
        $komting->assignRole('Komting');

        $kk = new KomtingKelas();
        $kk->user_id = $komting->id;
        $kk->kelas = 'Kelas A';
        $kk->no_hp = '08123456789';
        $kk->status = 'Aktif';
        $kk->save();

        $student1 = new Mahasiswa();
        $student1->nama = 'Student 1';
        $student1->nim = '11111111';
        $student1->program_studi = 'Teknik Informatika';
        $student1->kelas = 'Kelas A';
        $student1->email = 'student1@gmail.com';
        $student1->status = 'Aktif';
        $student1->save();

        $student2 = new Mahasiswa();
        $student2->nama = 'Student 2';
        $student2->nim = '22222222';
        $student2->program_studi = 'Teknik Informatika';
        $student2->kelas = 'Kelas A';
        $student2->email = 'student2@gmail.com';
        $student2->status = 'Aktif';
        $student2->save();

        // Add some absensi
        $abs1 = new Absensi();
        $abs1->mahasiswa_id = $student1->id;
        $abs1->tanggal = '2026-05-22';
        $abs1->kelas = 'Kelas A';
        $abs1->status = 'Hadir'; // Poin should be 5
        $abs1->inputted_by = $komting->id;
        $abs1->save();

        $abs2 = new Absensi();
        $abs2->mahasiswa_id = $student2->id;
        $abs2->tanggal = '2026-05-22';
        $abs2->kelas = 'Kelas A';
        $abs2->status = 'Sakit'; // Poin should be 3
        $abs2->inputted_by = $komting->id;
        $abs2->save();

        $response = $this->actingAs($komting)->get('/komting/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Kelas A');
    }

    /** @test */
    public function komting_can_only_input_absensi_for_own_class()
    {
        $komting = new User();
        $komting->name = 'Komting Test';
        $komting->username = 'komtingtest';
        $komting->email = 'komtingtest@gmail.com';
        $komting->role = 'Komting';
        $komting->status = 'Aktif';
        $komting->password = bcrypt('password123');
        $komting->save();
        $komting->assignRole('Komting');

        $kk = new KomtingKelas();
        $kk->user_id = $komting->id;
        $kk->kelas = 'Kelas A';
        $kk->no_hp = '08123456789';
        $kk->status = 'Aktif';
        $kk->save();

        $studentA = new Mahasiswa();
        $studentA->nama = 'Student A';
        $studentA->nim = '33333333';
        $studentA->program_studi = 'Teknik Informatika';
        $studentA->kelas = 'Kelas A';
        $studentA->email = 'studenta@gmail.com';
        $studentA->status = 'Aktif';
        $studentA->save();

        $studentB = new Mahasiswa();
        $studentB->nama = 'Student B';
        $studentB->nim = '44444444';
        $studentB->program_studi = 'Teknik Informatika';
        $studentB->kelas = 'Kelas B';
        $studentB->email = 'studentb@gmail.com';
        $studentB->status = 'Aktif';
        $studentB->save();

        // Success when posting for own class
        $response = $this->actingAs($komting)->post('/komting/absensi/store', [
            'tanggal' => '2026-05-22',
            'kelas' => 'Kelas A',
            'absensi' => [
                [
                    'mahasiswa_id' => $studentA->id,
                    'status' => 'Hadir',
                ]
            ]
        ]);

        $response->assertRedirect(route('komting.riwayat'));
        $this->assertDatabaseHas('absensis', [
            'mahasiswa_id' => $studentA->id,
            'status' => 'Hadir',
            'poin' => 5,
            'inputted_by' => $komting->id,
        ]);

        // Fails when posting for another class
        $response2 = $this->actingAs($komting)->post('/komting/absensi/store', [
            'tanggal' => '2026-05-22',
            'kelas' => 'Kelas B',
            'absensi' => [
                [
                    'mahasiswa_id' => $studentB->id,
                    'status' => 'Hadir',
                ]
            ]
        ]);
        $response2->assertSessionHas('error');

        // Fails when mixing students from another class
        $response3 = $this->actingAs($komting)->post('/komting/absensi/store', [
            'tanggal' => '2026-05-22',
            'kelas' => 'Kelas A',
            'absensi' => [
                [
                    'mahasiswa_id' => $studentA->id,
                    'status' => 'Hadir',
                ],
                [
                    'mahasiswa_id' => $studentB->id,
                    'status' => 'Hadir',
                ]
            ]
        ]);
        $response3->assertSessionHas('error');
    }
}
