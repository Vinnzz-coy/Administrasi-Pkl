@extends('layouts.app')

@section('title', 'Detail Pembimbing')

@section('content')

{{-- HEADER --}}
<div class="mb-6">
    <div class="greeting-card rounded-2xl shadow-lg p-6 md:p-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold">
                    {{ $pembimbing->nama }}
                </h1>
                <p class="text-white/80">
                    NIP: {{ $pembimbing->nip }}
                </p>
            </div>

            <a href="{{ route('pembimbing.index') }}"
               class="bg-white text-primary px-5 py-3 rounded-xl shadow">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>
</div>

{{-- INFO PEMBIMBING --}}
<div class="bg-white rounded-2xl shadow p-6 mb-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
        <p><strong>Pangkat:</strong> {{ $pembimbing->pangkat ?? '-' }}</p>
        <p><strong>Golongan:</strong> {{ $pembimbing->golongan ?? '-' }}</p>
        <p><strong>Jabatan:</strong> {{ $pembimbing->jabatan ?? '-' }}</p>
    </div>
</div>

{{-- DAFTAR SISWA --}}
<div class="bg-white rounded-2xl shadow p-6">
    <h2 class="text-xl font-bold mb-4">
        Daftar Siswa Bimbingan
    </h2>

    @if($pembimbing->siswas->count())
        <ul class="divide-y">
            @foreach($pembimbing->siswas as $siswa)
                <li class="py-3 flex justify-between">
                    <span>{{ $siswa->nama }}</span>
                    <span class="text-gray-500 text-sm">
                        {{ $siswa->nis ?? '' }}
                    </span>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-gray-500 italic">
            Belum ada siswa bimbingan
        </p>
    @endif
</div>

@endsection
