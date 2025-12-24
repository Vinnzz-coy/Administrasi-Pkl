@extends('layouts.app')

@section('title', 'Edit Pembimbing')

@section('content')

@php
    use Illuminate\Support\Str;
@endphp

{{-- ================= HEADER ================= --}}
<div class="mb-6 animate-slide-down">
    <div class="greeting-card rounded-2xl shadow-lg p-6 md:p-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>
                <h1 class="text-3xl md:text-4xl font-bold mb-1">
                    Edit Pembimbing
                </h1>
                <p class="text-white/80 text-sm">
                    Perbarui data pembimbing sekolah dan DUDI yang dibimbing
                </p>
            </div>

            <a href="{{ route('pembimbing.index') }}"
                class="bg-white text-primary px-5 py-3 rounded-xl shadow hover:bg-gray-100 transition">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>

        </div>
    </div>
</div>

{{-- ================= FORM ================= --}}
<div class="container mx-auto">
    <div class="bg-white rounded-2xl shadow-md p-6 md:p-8 animate-scale-fade">

        <form
            action="{{ route('pembimbing.update', $pembimbing->id_pembimbing) }}"
            method="POST"
            enctype="multipart/form-data"
            class="grid grid-cols-1 md:grid-cols-2 gap-6"
        >
            @csrf
            @method('PUT')

            {{-- ================= DATA UTAMA ================= --}}
            <div class="md:col-span-2">
                <h2 class="text-lg font-bold mb-3 text-gray-700">
                    Data Pembimbing
                </h2>
                <div class="h-px bg-gray-200"></div>
            </div>

            {{-- Nama --}}
            <div>
                <label class="block font-semibold mb-1">Nama Lengkap</label>
                <input
                    type="text"
                    name="nama"
                    value="{{ old('nama', $pembimbing->nama) }}"
                    class="form-input"
                    required
                >
                @error('nama')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- NIP --}}
            <div>
                <label class="block font-semibold mb-1">NIP</label>
                <input
                    type="text"
                    name="nip"
                    value="{{ old('nip', $pembimbing->nip) }}"
                    class="form-input"
                    required
                >
                @error('nip')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Pangkat --}}
            <div>
                <label class="block font-semibold mb-1">Pangkat</label>
                <input
                    type="text"
                    name="pangkat"
                    value="{{ old('pangkat', $pembimbing->pangkat) }}"
                    class="form-input"
                >
            </div>

            {{-- Golongan --}}
            <div>
                <label class="block font-semibold mb-1">Golongan</label>
                <input
                    type="text"
                    name="golongan"
                    value="{{ old('golongan', $pembimbing->golongan) }}"
                    class="form-input"
                >
            </div>

            {{-- Jabatan --}}
            <div>
                <label class="block font-semibold mb-1">Jabatan</label>
                <input
                    type="text"
                    name="jabatan"
                    value="{{ old('jabatan', $pembimbing->jabatan) }}"
                    class="form-input"
                >
            </div>

            {{-- Jam Mengajar --}}
            <div>
                <label class="block font-semibold mb-1">Jumlah Jam Mengajar / Minggu</label>
                <input
                    type="number"
                    name="jumlah_jam_mengajar"
                    min="0"
                    value="{{ old('jumlah_jam_mengajar', $pembimbing->jumlah_jam_mengajar) }}"
                    class="form-input"
                    required
                >
            </div>

            {{-- Nomor HP --}}
            <div>
                <label class="block font-semibold mb-1">Nomor HP</label>
                <input
                    type="text"
                    name="no_hp"
                    value="{{ old('no_hp', $pembimbing->no_hp) }}"
                    class="form-input"
                    placeholder="08xxxxxxxxxx"
                >
            </div>

            {{-- Foto --}}
            <div>
                <label class="block font-semibold mb-1">Foto Pembimbing</label>
                <input
                    type="file"
                    name="foto"
                    accept="image/*"
                    class="form-input"
                >

                @if ($pembimbing->foto)
                    <div class="mt-3">
                        <p class="text-sm text-gray-500 mb-1">Foto saat ini:</p>
                        <img
                            src="{{ asset('storage/' . $pembimbing->foto) }}"
                            alt="Foto Pembimbing"
                            class="w-24 h-24 rounded-lg object-cover border"
                        >
                    </div>
                @endif
            </div>

            {{-- ================= DUDI ================= --}}
            <div class="md:col-span-2 mt-4">
                <h2 class="text-lg font-bold mb-3 text-gray-700">
                    DUDI yang Dibimbing
                </h2>
                <div class="h-px bg-gray-200 mb-4"></div>

                <label class="block font-semibold mb-2">
                    Pilih Satu atau Lebih DUDI
                </label>

                <select
                    name="dudi_ids[]"
                    multiple
                    required
                    class="form-input h-44"
                >
                    @foreach ($dudis as $dudi)
                        <option
                            value="{{ $dudi->id_dudi }}"
                            {{ in_array($dudi->id_dudi, old('dudi_ids', $selectedDudi)) ? 'selected' : '' }}
                        >
                            {{ $dudi->nama }} • {{ Str::limit($dudi->alamat, 45) }}
                        </option>
                    @endforeach
                </select>

                <p class="text-sm text-gray-500 mt-2">
                    Tahan Ctrl (Windows) atau Cmd (Mac) untuk memilih lebih dari satu
                </p>

                @error('dudi_ids')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- ================= ACTION ================= --}}
            <div class="md:col-span-2 flex justify-between items-center mt-8">

                <a href="{{ route('pembimbing.index') }}"
                    class="px-6 py-3 rounded-xl border font-semibold hover:bg-gray-100 transition">
                    Batal
                </a>

                <button
                    type="submit"
                    class="bg-primary text-white px-8 py-3 rounded-xl font-semibold
                        hover:bg-primary/90 hover:scale-105 transition-all duration-300"
                >
                    <i class="fas fa-save mr-2"></i> Simpan Perubahan
                </button>

            </div>

        </form>
    </div>
</div>

@endsection
