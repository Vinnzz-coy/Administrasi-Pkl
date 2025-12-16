@extends('layouts.app')
@section('title', 'Detail DUDI')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-2xl shadow-md p-6">

        <h2 class="text-2xl font-bold mb-6">Detail DUDI</h2>

        <div class="space-y-3">
            <p><b>Nama:</b> {{ $dudi->nama }}</p>
            <p><b>Alamat:</b> {{ $dudi->alamat }}</p>
            <p><b>Pimpinan:</b> {{ $dudi->pimpinan }}</p>
            <p><b>Pembimbing:</b> {{ $dudi->pembimbing }}</p>
            <p><b>Jabatan:</b> {{ $dudi->jabatan }}</p>
            <p><b>Daya Tampung:</b> {{ $dudi->daya_tampung }}</p>
        </div>

        <div class="mt-6">
            <a href="{{ route('dudi.index') }}"
               class="px-5 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                Kembali
            </a>
        </div>

    </div>
</div>
@endsection
