@extends('layouts.app') 

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 bg-gray-50">
    
    {{-- HEADER KONTEN UTAMA --}}
    <header class="mb-8 pb-4 border-b border-gray-200">
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">👤 Profil Saya</h1>
        <p class="text-base text-gray-500 mt-1">Perbarui detail profil guru dan informasi kepegawaian Anda.</p>
    </header>

    <div class="flex flex-col lg:flex-row gap-x-10 gap-y-8">
       
        <div class="w-full lg:w-1/4">
            <nav class="bg-white rounded-xl shadow-lg p-4">
                <h3 class="text-sm font-semibold uppercase text-gray-500 mb-4 tracking-wider">Navigasi</h3>
                <div class="space-y-1">
                    <a href="#" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg text-blue-700 bg-blue-50 hover:bg-blue-100 transition duration-150">
                        <i class="fas fa-id-card w-5 h-5 mr-3"></i> Detail Profil
                    </a>
                    <a href="{{ route('pengaturan.akun.index') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg text-gray-600 hover:text-gray-800 hover:bg-gray-50 transition duration-150">
                        <i class="fas fa-lock w-5 h-5 mr-3"></i> Ganti Kata Sandi
                    </a>
                    <a href="#" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg text-gray-600 hover:text-gray-800 hover:bg-gray-50 transition duration-150">
                        <i class="fas fa-history w-5 h-5 mr-3"></i> Log Aktivitas
                    </a>
                </div>
            </nav>
        </div>

    
        <div class="w-full lg:w-3/4 space-y-8">
            
            {{-- Pesan Sukses --}}
            @if (session('success'))
                <div class="p-4 text-sm text-green-700 bg-green-50 rounded-lg border border-green-200" role="alert">
                    <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                </div>
            @endif
            
            {{-- Mengambil data guru dari User yang sedang login --}}
            @php
                $guru = Auth::user()->guru; // Kita asumsikan relasi ini sudah BERHASIL
            @endphp

            {{-- CARD: DETAIL PROFIL GURU & FOTO --}}
            <div class="bg-white p-6 sm:p-8 rounded-xl shadow-2xl border border-gray-100">
                <h2 class="text-xl font-bold text-gray-800 mb-6 border-b pb-3">Informasi Kepegawaian</h2>
                
                {{-- Form harus memiliki enctype untuk upload file (Foto Profil) --}}
                <form method="POST" action="{{ route('pengaturan.akun.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-6">
                        
                        {{-- BLOK FOTO PROFIL --}}
                        <div class="flex items-center space-x-6 pb-4">
                            <div class="relative w-24 h-24 rounded-full overflow-hidden bg-gray-200 border-4 border-white shadow-md">
                                {{-- Ganti link foto ini dengan path foto user Anda --}}
                                <img class="object-cover w-full h-full" src="{{ asset($guru->foto_profile ?? 'images/default-avatar.png') }}" alt="Foto Profil">
                            </div>
                            <div>
                                <label for="foto_profile" class="cursor-pointer inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition duration-150 shadow-sm">
                                    <i class="fas fa-camera mr-2"></i> Ganti Foto
                                </label>
                                <input id="foto_profile" name="foto_profile" type="file" class="sr-only">
                                @error('foto_profile')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">JPG atau PNG, maks 1MB.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        
                        {{-- FORM NAMA --}}
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                            <input type="text" class="form-input @error('nama') border-red-500 @enderror" id="nama" name="nama" value="{{ old('nama', $guru->nama ?? '') }}" required>
                            @error('nama') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        
                        {{-- FORM NIP (Read-only) --}}
                        <div>
                            <label for="nip" class="block text-sm font-medium text-gray-500">NIP</label>
                            <input type="text" class="form-input bg-gray-50 cursor-not-allowed text-gray-600" id="nip" value="{{ $guru->nip ?? Auth::user()->nip }}" readonly disabled>
                        </div>

                        {{-- FORM PANGKAT --}}
                        <div>
                            <label for="pangkat" class="block text-sm font-medium text-gray-700">Pangkat</label>
                            <input type="text" class="form-input @error('pangkat') border-red-500 @enderror" id="pangkat" name="pangkat" value="{{ old('pangkat', $guru->pangkat ?? '') }}">
                            @error('pangkat') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        {{-- FORM GOLONGAN --}}
                        <div>
                            <label for="golongan" class="block text-sm font-medium text-gray-700">Golongan</label>
                            <input type="text" class="form-input @error('golongan') border-red-500 @enderror" id="golongan" name="golongan" value="{{ old('golongan', $guru->golongan ?? '') }}">
                            @error('golongan') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        {{-- FORM JABATAN --}}
                        <div>
                            <label for="jabatan" class="block text-sm font-medium text-gray-700">Jabatan</label>
                            <input type="text" class="form-input @error('jabatan') border-red-500 @enderror" id="jabatan" name="jabatan" value="{{ old('jabatan', $guru->jabatan ?? '') }}">
                            @error('jabatan') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        {{-- FORM JUMLAH JAM MENGAJAR --}}
                        <div>
                            <label for="jumlah_jam_mengajar" class="block text-sm font-medium text-gray-700">Jumlah Jam Mengajar</label>
                            <input type="number" min="0" class="form-input @error('jumlah_jam_mengajar') border-red-500 @enderror" id="jumlah_jam_mengajar" name="jumlah_jam_mengajar" value="{{ old('jumlah_jam_mengajar', $guru->jumlah_jam_mengajar ?? 0) }}">
                            @error('jumlah_jam_mengajar') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                    </div>
                    
                    <div class="mt-8 pt-4 border-t border-gray-100">
                        <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-semibold rounded-lg shadow-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300 transform hover:scale-[1.01]">
                            <i class="fas fa-save mr-2"></i> Simpan Perubahan Profil
                        </button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>

<style>
/* Menambahkan style untuk input agar tidak mengulang class Tailwind di setiap input */
.form-input {
    @apply mt-1 block w-full rounded-lg shadow-sm p-3 transition duration-150 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50;
}
</style>
@endsection