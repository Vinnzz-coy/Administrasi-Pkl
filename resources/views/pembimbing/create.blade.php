@extends('layouts.app')

@section('title', 'Tambah Pembimbing')

@section('content')

{{-- ================= HEADER ================= --}}
<div class="mb-6 animate-slide-down">
    <div class="greeting-card rounded-2xl shadow-lg p-6 md:p-8">
        <div class="flex items-center justify-between">

            <div>
                <h1 class="text-3xl md:text-4xl font-bold mb-1">
                    Tambah Pembimbing
                </h1>
                <p class="text-white/80 text-sm">
                    Lengkapi data pembimbing sekolah
                </p>
            </div>

            
        </div>
    </div>
</div>

{{-- ================= FORM ================= --}}
<div class="container mx-auto">
    <div class="bg-white rounded-2xl shadow-md p-6 md:p-8
                animate-scale-fade">

        <form action="{{ route('pembimbing.store') }}" method="POST"
              class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf

            {{-- Nama --}}
            <div class="animate-stagger">
                <label class="block font-semibold mb-1">Nama Lengkap</label>
                <input type="text" name="nama" required
                       class="form-input"
                       placeholder="Nama pembimbing">
            </div>

            {{-- NIP --}}
            <div class="animate-stagger">
                <label class="block font-semibold mb-1">NIP</label>
                <input type="text" name="nip" required
                       class="form-input"
                       placeholder="Nomor Induk Pegawai">
            </div>

            {{-- Pangkat --}}
            <div class="animate-stagger">
                <label class="block font-semibold mb-1">Pangkat</label>
                <input type="text" name="pangkat"
                       class="form-input"
                       placeholder="Penata Muda">
            </div>

            {{-- Golongan --}}
            <div class="animate-stagger">
                <label class="block font-semibold mb-1">Golongan</label>
                <input type="text" name="golongan"
                       class="form-input"
                       placeholder="III/a">
            </div>

            {{-- Jabatan --}}
            <div class="animate-stagger">
                <label class="block font-semibold mb-1">Jabatan</label>
                <input type="text" name="jabatan"
                       class="form-input"
                       placeholder="Guru Pembimbing">
            </div>

            {{-- Jam --}}
            <div class="animate-stagger">
                <label class="block font-semibold mb-1">Jumlah Jam Mengajar</label>
                <input type="number" name="jumlah_jam_mengajar" required
                       class="form-input"
                       placeholder="Jumlah jam">
            </div>

            {{-- BUTTON --}}

            <div class="md:col-span-2 flex justify-between items-center mt-6 animate-stagger">

            <a href="{{ route('pembimbing.index') }}"
            class="px-6 py-3 rounded-xl border font-semibold
                    hover:bg-gray-100 transition">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>

            <div class="flex gap-3">
                <a href="{{ route('pembimbing.index') }}"
                class="px-6 py-3 rounded-xl border font-semibold
                        hover:bg-gray-100 transition">
                    Batal
                </a>

                <button
                    class="bg-primary text-white px-6 py-3 rounded-xl font-semibold
                        hover:bg-primary/90 hover:scale-105 transition-all duration-300">
                    <i class="fas fa-save mr-2"></i> Simpan Data
                </button>
            </div>

        </div>


        </form>
    </div>
</div>
@include('layouts.animation')


@endsection
