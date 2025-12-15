<?php

namespace App\Http\Controllers;

use App\Models\Guru; // WAJIB: Import Model Guru Anda
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule; 
use Illuminate\Support\Facades\Storage; // WAJIB: Untuk menangani file

class PengaturanAkunController extends Controller
{
    /**
     * Menampilkan halaman pengaturan kata sandi dan nama user.
     */
    public function index()
    {
        return view('pengaturan.akun', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Menampilkan halaman profil guru (My Profile)
     */
    public function indexProfile()
    {
        return view('pengaturan.my-profile', [
            // Kita kirimkan Model User. Relasi guru akan diakses di Blade.
            'user' => Auth::user(), 
        ]);
    }


    /**
     * Memproses pembaruan data akun (Nama, Password, dan Profil Guru/Foto).
     * Method ini akan menangani kedua form (dari akun.blade dan my-profile.blade)
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        // Cek data guru terkait
        $guru = $user->guru;

        
        // Aturan Dasar (Nama User & Password)
        $rules = [
            'nama' => ['required', 'string', 'max:255'],
            'current_password' => ['nullable', 'required_with:new_password', 'current_password'],
            'new_password' => ['nullable', 'min:8', 'confirmed'],
        ];

        // Tambahkan aturan Profil Guru jika data guru ada
        if ($guru) {
            $rules += [
                // Aturan untuk kolom di tabel 'guru'
                'pangkat'               => ['nullable', 'string', 'max:100'],
                'golongan'              => ['nullable', 'string', 'max:100'],
                'jabatan'               => ['nullable', 'string', 'max:100'],
                'jumlah_jam_mengajar'   => ['nullable', 'integer', 'min:0'],
                'foto_profile'          => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:1024'], 
            ];
        }

        $request->validate($rules, [
            'current_password.current_password' => 'Kata sandi saat ini tidak cocok.',
            'new_password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'foto_profile.max' => 'Ukuran foto maksimal adalah 1MB.',
            
        ]);

       
        // Update Nama di tabel users (jika Anda memiliki kolom nama di users)
        $user->nama = $request->nama;

        // Update Password
        if ($request->filled('new_password')) {
            $user->password = bcrypt($request->new_password);
        }

        $user->save();

        if ($guru && $request->has('pangkat')) {
            
            $guru->nama = $request->nama; // Nama guru juga diperbarui
            $guru->pangkat = $request->pangkat ?? null;
            $guru->golongan = $request->golongan ?? null;
            $guru->jabatan = $request->jabatan ?? null;
            $guru->jumlah_jam_mengajar = $request->jumlah_jam_mengajar ?? 0;

            // Handle upload Foto Profile
            if ($request->hasFile('foto_profile')) {
                
                // Hapus foto lama jika ada dan bukan default
                $old_photo_path = $guru->foto_profile;
                if ($old_photo_path && $old_photo_path !== 'images/default-avatar.png' && Storage::disk('public')->exists($old_photo_path)) {
                    Storage::disk('public')->delete($old_photo_path);
                }

                // Simpan foto baru
                $path = $request->file('foto_profile')->store('profiles', 'public');
                $guru->foto_profile = $path;
            }

            $guru->save();
        }

        if ($request->has('pangkat') || $request->has('jabatan')) {
             return redirect()->route('pengaturan.profile.index')->with('success', 'Detail Profil Guru berhasil diperbarui!');
        }
        
        return redirect()->route('pengaturan.akun.index')->with('success', 'Pengaturan akun berhasil diperbarui!');
    }
}