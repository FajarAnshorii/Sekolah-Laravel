<?php

namespace App\Http\Controllers\Backend\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\KomtingKelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use ErrorException;
use Session;
use DB;
use Validator;

class KomtingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $komting = User::with('komtingKelas')->where('role', 'Komting')->get();
        return view('backend.pengguna.komting.index', compact('komting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas_options = Mahasiswa::distinct()->pluck('kelas')->filter()->toArray();
        return view('backend.pengguna.komting.create', compact('kelas_options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'username' => 'required|max:255|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
                'kelas' => 'required|string|max:100',
                'status' => 'required|in:Aktif,Nonaktif',
            ],
            [
                'name.required'     => 'Nama tidak boleh kosong.',
                'username.required' => 'Username tidak boleh kosong.',
                'username.unique'   => 'Username sudah digunakan.',
                'email.required'    => 'Email tidak boleh kosong.',
                'email.unique'      => 'Email sudah pernah digunakan.',
                'email.email'       => 'Email yang dimasukan tidak valid.',
                'password.required' => 'Password tidak boleh kosong.',
                'password.min'      => 'Password minimal 6 karakter.',
                'kelas.required'    => 'Kelas yang ditugaskan harus dipilih.',
                'status.required'   => 'Status harus dipilih.',
            ]
            );

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $user = new User();
            $user->name            = $request->name;
            $user->username        = $request->username;
            $user->email           = $request->email;
            $user->role            = 'Komting';
            $user->status          = $request->status === 'Aktif' ? 'Aktif' : 'Tidak Aktif';
            $user->foto_profile    = '';
            $user->password        = bcrypt($request->password);
            $user->save();

            if ($user) {
                $komtingKelas = new KomtingKelas();
                $komtingKelas->user_id = $user->id;
                $komtingKelas->kelas   = $request->kelas;
                $komtingKelas->no_hp   = $request->no_hp;
                $komtingKelas->status  = $request->status; // 'Aktif' atau 'Nonaktif'
                $komtingKelas->save();
            }

            // Ensure Spatie role Komting exists
            Role::firstOrCreate(['name' => 'Komting', 'guard_name' => 'web']);
            $user->assignRole('Komting');
            
            DB::commit();
            Session::flash('success', 'Akun Komting Berhasil disimpan !');
            return redirect()->route('backend-pengguna-komting.index');
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('error', 'Gagal menyimpan Komting: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $komting = User::with('komtingKelas')->where('role', 'Komting')->find($id);
        if (!$komting) {
            abort(404);
        }
        $kelas_options = Mahasiswa::distinct()->pluck('kelas')->filter()->toArray();
        return view('backend.pengguna.komting.edit', compact('komting', 'kelas_options'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'username' => ['required', 'max:255', Rule::unique('users')->ignore($id)],
                'email' => ['required', 'email', Rule::unique('users')->ignore($id)],
                'kelas' => 'required|string|max:100',
                'status' => 'required|in:Aktif,Nonaktif',
            ],
            [
                'name.required'     => 'Nama tidak boleh kosong.',
                'username.required' => 'Username tidak boleh kosong.',
                'username.unique'   => 'Username sudah digunakan.',
                'email.required'    => 'Email tidak boleh kosong.',
                'email.unique'      => 'Email sudah pernah digunakan.',
                'email.email'       => 'Email yang dimasukan tidak valid.',
                'kelas.required'    => 'Kelas yang ditugaskan harus dipilih.',
                'status.required'   => 'Status harus dipilih.',
            ]
            );

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $user = User::find($id);
            if (!$user) {
                abort(404);
            }

            $user->name            = $request->name;
            $user->username        = $request->username;
            $user->email           = $request->email;
            $user->status          = $request->status === 'Aktif' ? 'Aktif' : 'Tidak Aktif';
            
            if ($request->filled('password')) {
                $user->password    = bcrypt($request->password);
            }
            $user->update();

            $komtingKelas = KomtingKelas::where('user_id', $id)->first();
            if (!$komtingKelas) {
                $komtingKelas = new KomtingKelas();
                $komtingKelas->user_id = $id;
            }
            $komtingKelas->kelas   = $request->kelas;
            $komtingKelas->no_hp   = $request->no_hp;
            $komtingKelas->status  = $request->status;
            $komtingKelas->save();

            // Re-assign role just in case
            Role::firstOrCreate(['name' => 'Komting', 'guard_name' => 'web']);
            if (!$user->hasRole('Komting')) {
                $user->assignRole('Komting');
            }

            DB::commit();
            Session::flash('success', 'Akun Komting Berhasil diupdate !');
            return redirect()->route('backend-pengguna-komting.index');
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('error', 'Gagal mengupdate Komting: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $user = User::find($id);
            if ($user) {
                $user->delete();
                DB::commit();
                Session::flash('success', 'Akun Komting Berhasil dihapus !');
            }
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('error', 'Gagal menghapus Komting: ' . $e->getMessage());
        }
        return redirect()->route('backend-pengguna-komting.index');
    }
}
