@extends('layouts.app')

@section('title', 'Tambah Siswa')

@section('content')

<div class="greeting-card rounded-2xl shadow-lg p-6 md:p-8 bg-linear-to-r from-blue-500 to-blue-600 text-white mb-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl md:text-4xl font-bold mb-2">
                Tambah Siswa PKL
            </h1>
            <p class="text-blue-100 text-sm">
                Form input data siswa peserta PKL
            </p>
        </div>

        <div class="flex flex-col md:items-end gap-3">
            <a href="{{ route('siswa.index') }}"
               class="inline-flex items-center justify-center bg-white text-blue-600 px-5 py-3 rounded-xl font-semibold shadow hover:bg-blue-50 transition">
                ← Kembali
            </a>
        </div>
    </div>
</div>
<div class="bg-white p-6 md:p-8 rounded-2xl shadow mx-6">
    <h2 class="text-2xl font-bold mb-6 text-blue-600">Masukkan Data</h2>

    <form action="{{ route('siswa.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="font-medium">Nama</label>
            <input type="text" name="nama" class="w-full border rounded-lg px-3 py-2" required>
        </div>

        <div>
            <label class="font-medium">Alamat</label>
            <textarea name="alamat" class="w-full border rounded-lg px-3 py-2"></textarea>
        </div>

        <div>
            <label class="font-medium">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="w-full border rounded-lg px-3 py-2" required>
                <option value="">-- Pilih --</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>

        <div>
            <label class="font-medium">Jurusan</label>

            <select
                name="id_jurusan"
                class="w-full border rounded-lg px-3 py-2 bg-white text-gray-800">

                <option value="" disabled selected
                    style="background-color:#ffffff; color:#9ca3af;">
                    -- Pilih --
                </option>

                @foreach($jurusan as $j)
                    <option
                        value="{{ $j->id_jurusan }}"
                        style="background-color:#ffffff; color:#1f2937;">
                        {{ $j->jurusan }}
                    </option>
                @endforeach
            </select>
        </div>


        <div>
            <label class="font-medium">Pembimbing</label>
            <select
                name="id_pembimbing"
                class="w-full border rounded-lg px-3 py-2 bg-white text-gray-800">

                <option value="" disabled selected class="text-gray-400">
                    -- Pilih --
                </option>

                @foreach($pembimbing as $p)
                    <option
                        value="{{ $p->id_pembimbing }}"
                        class="text-gray-800 bg-white">
                        {{ $p->nama }}
                    </option>
                @endforeach
            </select>
        </div>


        <div>
            <label class="font-medium">DUDI</label>
            <select name="id_dudi"
                    class="w-full border rounded-lg px-3 py-2"
                    required>

                <option value="" disabled selected>
                    -- Pilih --
                </option>

                @foreach($dudi as $d)
                    <option value="{{ $d->id_dudi }}">
                        {{ $d->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="font-medium">Kelas</label>
            <input type="text" name="kelas" class="w-full border rounded-lg px-3 py-2" required>
        </div>

        <div>
            <label class="font-medium">Kendaraan</label>
            <input type="text" name="kendaraan" class="w-full border rounded-lg px-3 py-2">
        </div>

        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('siswa.index') }}" class="px-4 py-2 rounded-lg border">Batal</a>
            <button class="bg-blue-600 text-white px-6 py-2 rounded-lg">
                Simpan
            </button>
        </div>
    </form>
</div>

@endsection
