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

        <a href="{{ route('siswa.index') }}"
           class="bg-white text-blue-600 px-5 py-3 rounded-xl font-semibold shadow hover:bg-blue-50 transition">
            ← Kembali
        </a>
    </div>
</div>

<div class="bg-white p-6 md:p-8 rounded-2xl shadow mx-6">
    <h2 class="text-2xl font-bold mb-6 text-blue-600">Masukkan Data</h2>

    <form action="{{ route('siswa.store') }}" method="POST" class="space-y-5">
        @csrf

        {{-- Nama --}}
        <div>
            <label class="font-medium">Nama</label>
            <input type="text"
                   name="nama"
                   value="{{ old('nama') }}"
                   class="w-full border rounded-lg px-3 py-2"
                   required>
        </div>

        {{-- Alamat --}}
        <div>
            <label class="font-medium">Alamat</label>
            <textarea name="alamat"
                      class="w-full border rounded-lg px-3 py-2">{{ old('alamat') }}</textarea>
        </div>

        {{-- Jenis Kelamin --}}
        <div>
            <label class="font-medium">Jenis Kelamin</label>
            <select name="jenis_kelamin"
                    class="w-full border rounded-lg px-3 py-2"
                    required>
                <option value="">-- Pilih --</option>
                <option value="L" @selected(old('jenis_kelamin') == 'L')>Laki-laki</option>
                <option value="P" @selected(old('jenis_kelamin') == 'P')>Perempuan</option>
            </select>
        </div>

        {{-- Jurusan --}}
        <div>
            <label class="font-medium">Jurusan</label>
            <select name="id_jurusan"
                    class="w-full border rounded-lg px-3 py-2"
                    {{ auth()->user()->role === 'admin_jurusan' ? 'disabled' : '' }}>

                <option value="">-- Pilih --</option>

                @foreach($jurusan as $j)
                    <option value="{{ $j->id_jurusan }}"
                        @selected(old('id_jurusan') == $j->id_jurusan)>
                        {{ $j->jurusan }}
                    </option>
                @endforeach
            </select>

            {{-- kirim hidden jika admin jurusan --}}
            @if(auth()->user()->role === 'admin_jurusan')
                <input type="hidden" name="id_jurusan" value="{{ auth()->user()->jurusan_id }}">
            @endif
        </div>

        {{-- Pembimbing --}}
        <div>
            <label class="font-medium">Pembimbing Sekolah</label>
            <select name="id_pembimbing"
                    class="w-full border rounded-lg px-3 py-2"
                    required>
                <option value="">-- Pilih --</option>
                @foreach($pembimbing as $p)
                    <option value="{{ $p->id_pembimbing }}"
                        @selected(old('id_pembimbing') == $p->id_pembimbing)>
                        {{ $p->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- DUDI --}}
        <div>
            <label class="font-medium">DUDI</label>
            <select name="id_dudi"
                    class="w-full border rounded-lg px-3 py-2"
                    required>

                <option value="">-- Pilih --</option>

                @foreach($dudi as $d)
                    <option value="{{ $d->id_dudi }}"
                        {{ $d->isPenuh() ? 'disabled' : '' }}
                        @selected(old('id_dudi') == $d->id_dudi)>
                        {{ $d->nama }}
                        ({{ $d->siswas->count() }}/{{ $d->daya_tampung }})
                        {{ $d->isPenuh() ? ' - PENUH' : '' }}
                    </option>
                @endforeach
            </select>

            <p class="text-xs text-gray-500 mt-1">
                DUDI dengan kapasitas penuh tidak dapat dipilih
            </p>
        </div>

        {{-- Kelas --}}
        <div>
            <label class="font-medium">Kelas</label>
            <input type="text"
                   name="kelas"
                   value="{{ old('kelas') }}"
                   class="w-full border rounded-lg px-3 py-2"
                   required>
        </div>

        {{-- Kendaraan --}}
        <div>
            <label class="font-medium">Kendaraan</label>
            <select name="kendaraan"
                    class="w-full border rounded-lg px-3 py-2"
                    required>
                <option value="">-- Pilih --</option>
                <option value="pribadi" @selected(old('kendaraan') == 'pribadi')>
                    Kendaraan Pribadi
                </option>
                <option value="umum" @selected(old('kendaraan') == 'umum')>
                    Kendaraan Umum
                </option>
            </select>
        </div>

        {{-- BUTTON --}}
        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('siswa.index') }}"
               class="px-4 py-2 rounded-lg border">
                Batal
            </a>

            <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                Simpan
            </button>
        </div>

    </form>
</div>

@endsection
