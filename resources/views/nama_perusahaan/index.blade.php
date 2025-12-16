@extends('layouts.app')

@section('title', 'Data DUDI')

@section('content')

{{-- HEADER --}}
<div class="mb-6">
    <div class="greeting-card rounded-2xl shadow-lg p-6 md:p-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold mb-2">
                    Data DUDI
                </h1>
                <p class="text-blue-100 text-lg">
                    Kelola data Dunia Usaha & Dunia Industri (DUDI)
                </p>
            </div>

            <a href="{{ route('dudi.create') }}"
               class="bg-white text-blue-600 font-semibold px-6 py-3 rounded-xl shadow hover:bg-blue-50 transition">
                <i class="fas fa-plus mr-2"></i> Tambah DUDI
            </a>
        </div>
    </div>
</div>

{{-- STATISTIK --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-2xl shadow-md p-6 card-hover">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-gray-500 text-sm">Total DUDI</h3>
                <p class="text-3xl font-bold text-dark">{{ $dudis->count() }}</p>
            </div>
            <div class="bg-purple-100 p-4 rounded-xl">
                <i class="fas fa-building text-purple-500 text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-md p-6 card-hover">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-gray-500 text-sm">Total Kapasitas</h3>
                <p class="text-3xl font-bold text-dark">
                    {{ $dudis->sum('daya_tampung') }}
                </p>
            </div>
            <div class="bg-green-100 p-4 rounded-xl">
                <i class="fas fa-users text-green-500 text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-md p-6 card-hover">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-gray-500 text-sm">Rata-rata Daya Tampung</h3>
                <p class="text-3xl font-bold text-dark">
                    {{ round($dudis->avg('daya_tampung')) ?? 0 }}
                </p>
            </div>
            <div class="bg-blue-100 p-4 rounded-xl">
                <i class="fas fa-chart-line text-blue-500 text-2xl"></i>
            </div>
        </div>
    </div>
</div>

{{-- LIST DUDI --}}
<div class="bg-white rounded-2xl shadow-md p-6">
    <h2 class="text-xl font-bold text-dark mb-6">Daftar DUDI</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full border-separate border-spacing-y-3">
            <thead>
                <tr class="text-left text-gray-500 text-sm">
                    <th class="px-4">Nama</th>
                    <th class="px-4">Pimpinan</th>
                    <th class="px-4">Pembimbing</th>
                    <th class="px-4">Jabatan</th>
                    <th class="px-4 text-center">Daya Tampung</th>
                    <th class="px-4 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($dudis as $dudi)
                    <tr class="bg-gray-50 hover:bg-gray-100 transition rounded-xl">
                        <td class="px-4 py-3 font-semibold text-dark">
                            {{ $dudi->nama }}
                            <p class="text-sm text-gray-500">{{ $dudi->alamat }}</p>
                        </td>
                        <td class="px-4 py-3">{{ $dudi->pimpinan }}</td>
                        <td class="px-4 py-3">{{ $dudi->pembimbing }}</td>
                        <td class="px-4 py-3">{{ $dudi->jabatan }}</td>
                        <td class="px-4 py-3 text-center">
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                {{ $dudi->daya_tampung }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center space-x-2">
                            <a href="{{ route('dudi.show', $dudi->id_dudi) }}"
                               class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('dudi.edit', $dudi->id_dudi) }}"
                               class="text-yellow-500 hover:text-yellow-700">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('dudi.destroy', $dudi->id_dudi) }}"
                                  method="POST" class="inline"
                                  onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-6 text-gray-500">
                            Data DUDI belum tersedia
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
