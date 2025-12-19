@extends('layouts.app')

@section('title', 'Data DUDI')

@section('content')

{{-- ================= HEADER ================= --}}
<div class="mb-6 animate-slide-down">
    <div class="greeting-card rounded-2xl shadow-lg p-6 md:p-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>
                <h1 class="text-3xl md:text-4xl font-bold mb-1">
                    Data DUDI
                </h1>
                <p class="text-white/80 text-sm">
                    Dunia Usaha & Dunia Industri
                </p>
            </div>

            {{-- WAKTU --}}
            <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4 text-center md:text-right min-w-[230px]">
                <p class="text-sm text-blue-100">Hari ini</p>
                <p class="text-xl font-bold" id="current-date">--</p>
                <p class="text-sm text-blue-100" id="current-time">--</p>
            </div>

        </div>
    </div>
</div>

{{-- ================= STATISTIK ================= --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">

    <div class="bg-white rounded-2xl shadow-md p-6 card-hover animate-fade">
        <div class="flex justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total DUDI</p>
                <p class="text-3xl font-bold">
                    {{ $dudis->count() }}
                </p>
            </div>
            <div class="bg-purple-100 p-3 rounded-xl">
                <i class="fas fa-building text-purple-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-md p-6 card-hover animate-fade delay-1">
        <div class="flex justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Daya Tampung</p>
                <p class="text-3xl font-bold">
                    {{ $dudis->sum('daya_tampung') }}
                </p>
            </div>
            <div class="bg-green-100 p-3 rounded-xl">
                <i class="fas fa-users text-green-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-md p-6 card-hover animate-fade delay-2">
        <div class="flex justify-between">
            <div>
                <p class="text-gray-500 text-sm">Rata-rata Daya Tampung</p>
                <p class="text-3xl font-bold">
                    {{ round($dudis->avg('daya_tampung')) ?? 0 }}
                </p>
            </div>
            <div class="bg-blue-100 p-3 rounded-xl">
                <i class="fas fa-chart-line text-blue-600 text-2xl"></i>
            </div>
        </div>
    </div>

</div>

{{-- ================= CARD TABEL ================= --}}
<div class="bg-white rounded-2xl shadow-md p-4 md:p-6 animate-scale-fade">

    {{-- SEARCH --}}
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-4">

        <form method="GET" class="flex gap-2 w-full md:w-2/3">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Cari nama DUDI / pimpinan..."
                   class="w-full border rounded-lg px-4 py-2">
            <button class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                Cari
            </button>
        </form>
            <!-- Tambah -->
        <a href="{{ route('dudi.create') }}"
           class="bg-primary text-white px-5 py-3 rounded-xl shadow
                  hover:bg-blue-600 transition-all hover:scale-105">
            <i class=""></i> Tambah DUDI
        </a>

    </div>

    
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- TABEL --}}
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-3 py-3">Nama</th>
                    <th class="px-3 py-3">Pimpinan</th>
                    <th class="px-3 py-3">Pembimbing</th>
                    <th class="px-3 py-3">Jabatan</th>
                    <th class="px-3 py-3 text-center">Daya Tampung</th>
                    <th class="px-3 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse($dudis as $dudi)
            <tr
                onclick="window.location='{{ route('dudi.show', $dudi->id_dudi) }}'"
                class="border-b hover:bg-gray-50 transition cursor-pointer">

                <td class="px-3 py-2 font-semibold">
                    {{ $dudi->nama }}
                    <p class="text-xs text-gray-500">{{ $dudi->alamat }}</p>
                </td>
                    <td class="px-3 py-2">{{ $dudi->pimpinan }}</td>
                    <td class="px-3 py-2">{{ $dudi->pembimbing }}</td>
                    <td class="px-3 py-2">{{ $dudi->jabatan }}</td>
                    <td class="px-3 py-2 text-center">
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-medium">
                            {{ $dudi->daya_tampung }}
                        </span>
                    </td>
                    <td class="px-3 py-2 text-center">
                        <div class="flex justify-center gap-2">
                            <!-- <a href="{{ route('dudi.show', $dudi->id_dudi) }}"
                               class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-xs">
                                <i class="fas fa-eye"></i>
                            </a> -->

                            <a href="{{ route('dudi.edit', $dudi->id_dudi) }}"
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg text-xs">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('dudi.destroy', $dudi->id_dudi) }}"
                                  method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    class="bg-red-500 text-white px-3 py-1 rounded-lg text-xs delete-btn">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-8 text-gray-500">
                        Data DUDI belum tersedia
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

{{-- ================= SCRIPT JAM ================= --}}
<script>
function updateDateTime() {
    const now = new Date();
    const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    const months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

    document.getElementById('current-date').innerText =
        days[now.getDay()] + ', ' + now.getDate() + ' ' +
        months[now.getMonth()] + ' ' + now.getFullYear();

    document.getElementById('current-time').innerText =
        now.toLocaleTimeString('id-ID');
}
setInterval(updateDateTime, 1000);
updateDateTime();
</script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function (e) {
            e.stopPropagation(); 

            const form = this.closest('form');

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Data Dudi akan dihapus permanen',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
    </script>



@endsection
