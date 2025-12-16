@extends('layouts.app')
@section('title', 'Tambah DUDI')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl shadow-md p-6">

        <h2 class="text-2xl font-bold mb-6">Tambah Data DUDI</h2>

        <form action="{{ route('dudi.store') }}" method="POST" class="space-y-5">
            @csrf

            @include('dudi.form')

            <div class="flex justify-end gap-3">
                <a href="{{ route('dudi.index') }}"
                   class="px-5 py-2 rounded-lg bg-gray-200 hover:bg-gray-300">
                    Batal
                </a>
                <button class="px-6 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                    Simpan
                </button>
            </div>
        </form>

    </div>
</div>
@endsection
