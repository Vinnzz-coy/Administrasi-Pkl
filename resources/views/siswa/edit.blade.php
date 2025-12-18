@extends('layouts.app')

@section('title', 'Edit Siswa')

@section('content')

<div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow">

    <!-- HEADER -->
    <div class="greeting-card rounded-2xl shadow-lg p-6 mb-6 bg-linear-to-r from-blue-500 to-blue-600 text-white">
        <h2 class="text-3xl font-bold">
            Edit Data Siswa PKL
        </h2>
    </div>

    <form action="{{ route('siswa.update', $siswa->id_siswa) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- NAMA -->
        <div>
            <label class="font-medium">Nama</label>
            <input type="text" name="nama"
                   value="{{ old('nama', $siswa->nama) }}"
                   class="w-full border rounded-lg px-3 py-2" required>
        </div>

        <!-- ALAMAT -->
        <div>
            <label class="font-medium">Alamat</label>
            <textarea name="alamat"
                      class="w-full border rounded-lg px-3 py-2">{{ old('alamat', $siswa->alamat) }}</textarea>
        </div>

        <!-- JENIS KELAMIN -->
        <div>
            <label class="font-medium">Jenis Kelamin</label>
            <select name="jenis_kelamin"
                    class="w-full border rounded-lg px-3 py-2" required>
                <option value="L" @selected(old('jenis_kelamin', $siswa->jenis_kelamin) == 'L')>
                    Laki-laki
                </option>
                <option value="P" @selected(old('jenis_kelamin', $siswa->jenis_kelamin) == 'P')>
                    Perempuan
                </option>
            </select>
        </div>

        <!-- JURUSAN -->
        <div>
            <label class="font-medium">Jurusan</label>
            <select name="id_jurusan"
                    class="w-full border rounded-lg px-3 py-2 text-gray-800" required>
                @foreach($jurusan as $j)
                    <option value="{{ $j->id_jurusan }}"
                        @selected(old('id_jurusan', $siswa->id_jurusan) == $j->id_jurusan)>
                        {{ $j->jurusan }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- PEMBIMBING -->
        <div>
            <label class="font-medium">Pembimbing</label>
            <select name="id_pembimbing"
                    class="w-full border rounded-lg px-3 py-2 text-gray-800" required>
                @foreach($pembimbing as $p)
                    <option value="{{ $p->id_pembimbing }}"
                        @selected(old('id_pembimbing', $siswa->id_pembimbing) == $p->id_pembimbing)>
                        {{ $p->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- DUDI -->
        <div>
            <label class="font-medium">DUDI</label>
            <select name="id_dudi"
                    class="w-full border rounded-lg px-3 py-2 text-gray-800 bg-white" required>
                @foreach($dudi as $d)
                    <option value="{{ $d->id_dudi }}"
                            class="text-gray-800 bg-white"
                            @selected(old('id_dudi', $siswa->id_dudi) == $d->id_dudi)>
                        {{ $d->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- KELAS -->
        <div>
            <label class="font-medium">Kelas</label>
            <input type="text" name="kelas"
                   value="{{ old('kelas', $siswa->kelas) }}"
                   class="w-full border rounded-lg px-3 py-2" required>
        </div>

        <!-- KENDARAAN -->
        <div>
            <label class="font-medium">Kendaraan</label>

            <select
                name="kendaraan"
                class="w-full border rounded-lg px-3 py-2 bg-white text-gray-800"
                required>

                <option value=""
                    style="background-color:#ffffff; color:#9ca3af;"
                    @selected(old('kendaraan', $siswa->kendaraan) == '')>
                    -- Pilih --
                </option>

                <option value="pribadi"
                    style="background-color:#ffffff; color:#1f2937;"
                    @selected(old('kendaraan', $siswa->kendaraan) == 'pribadi')>
                    Kendaraan Pribadi
                </option>

                <option value="umum"
                    style="background-color:#ffffff; color:#1f2937;"
                    @selected(old('kendaraan', $siswa->kendaraan) == 'umum')>
                    Kendaraan Umum
                </option>
            </select>
        </div>

        <!-- BUTTON -->
        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('siswa.index') }}"
               class="px-4 py-2 rounded-lg border">
                Batal
            </a>

            <button class="bg-blue-600 text-white px-6 py-2 rounded-lg">
                Update
            </button>
        </div>
    </form>
</div>

@endsection
