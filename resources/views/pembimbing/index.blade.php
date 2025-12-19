@extends('layouts.app') 

@section('title', 'Data Pembimbing')

@section('content')

{{-- HEADER GRADIENT --}}
<div class="mb-6">
    <div class="greeting-card rounded-2xl shadow-lg p-6 md:p-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>
                <h1 class="text-3xl md:text-4xl font-bold mb-2">
                    Data Pembimbing
                </h1>
            </div>
                <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4 min-w-[220px] text-center md:text-right">
                    <p class="text-sm text-blue-100">
                        Hari ini
                    </p>
                    <p class="text-2xl font-bold" id="current-date">
                        --
                    </p>
                    <p class="text-sm text-blue-100 mt-1" id="current-time">
                        --
                    </p>
                </div>

        </div>
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-2xl shadow-md p-6 card-hover">
        <div class="flex justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Pembimbing</p>
                <p class="text-3xl font-bold text-dark">
                    {{ $pembimbing->total() }}
                </p>
            </div>
            <div class="bg-green-100 p-3 rounded-xl">
                <i class="fas fa-chalkboard-teacher text-green-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-md p-6 card-hover">
        <div class="flex justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Jam Ajar</p>
                <p class="text-3xl font-bold text-dark">
                    {{ $pembimbing->sum('jumlah_jam_mengajar') }}
                </p>
            </div>
            <div class="bg-blue-100 p-3 rounded-xl">
                <i class="fas fa-clock text-blue-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-md p-6 card-hover">
        <div class="flex justify-between">
            <div>
                <p class="text-gray-500 text-sm">Rata-rata Jam</p>
                <p class="text-3xl font-bold text-dark">
                    {{ round($pembimbing->avg('jumlah_jam_mengajar')) }}
                </p>
            </div>
            <div class="bg-purple-100 p-3 rounded-xl">
                <i class="fas fa-chart-line text-purple-600 text-2xl"></i>
            </div>
        </div>
    </div>
</div>



{{-- CARD TABEL --}}
<div class="hidden md:block bg-white rounded-2xl shadow-md p-4 md:p-6 animate-fade-in">
<div class="flex flex-col md:flex-row md:justify-between md:items-center mb-4 gap-4">
    {{-- Form pencarian --}}
    <form method="GET" class="flex gap-2 w-full md:w-2/3">
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Cari nama / NIP pembimbing..."
               class="border rounded-lg px-4 py-2 w-full">
        <button type="submit" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Cari</button>
    </form>

    {{-- Tombol tambah --}}
    <a href="{{ route('pembimbing.create') }}"
       class="bg-primary text-white p-3 rounded-xl shadow hover:bg-blue-600 transition-all duration-300 transform hover:-translate-y-1 hover:scale-105">
        <i class="tambah pembimbing"></i>Tambah Pembimbing
    </a>
</div>


    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

   

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-3 py-3 text-left">No</th>
                    <th class="px-3 py-3">Nama</th>
                    <th class="px-3 py-3">NIP</th>
                    <th class="px-3 py-3">Pangkat</th>
                    <th class="px-3 py-3">Golongan</th>
                    <th class="px-3 py-3">Jabatan</th>
                    <th class="px-3 py-3">Jam Ajar</th>
                    <th class="px-3 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pembimbing as $item)
                <tr onclick="window.location='{{ route('pembimbing.show', $item->id_pembimbing) }}'"
                class="border-b hover:bg-gray-50 transition cursor-pointer">
                    <td class="px-3 py-2">{{ $pembimbing->firstItem() + $loop->index }}</td>
                    <td class="px-3 py-2">{{ $item->nama }}</td>
                    <td class="px-3 py-2">{{ $item->nip }}</td>
                    <td class="px-3 py-2">{{ $item->pangkat ?? '-' }}</td>
                    <td class="px-3 py-2">{{ $item->golongan ?? '-' }}</td>
                    <td class="px-3 py-2">{{ $item->jabatan ?? '-' }}</td>
                    <td class="px-3 py-2 text-center">
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-medium">
                            {{ $item->jumlah_jam_mengajar }} Jam
                        </span>
                    </td>
                    <td class="px-3 py-2" onclick="event.stopPropagation()">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('pembimbing.edit', $item->id_pembimbing) }}"
                                onclick="event.stopPropagation()"
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg text-xs">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('pembimbing.destroy', $item->id_pembimbing) }}"
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
                    <td colspan="8" class="text-center py-8 text-gray-500">
                        Data pembimbing belum tersedia
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
       {{ $pembimbing->withQueryString()->links() }}
    </div>
</div>

{{-- MOBILE CARD VIEW --}}
<div class="md:hidden space-y-4 mt-6">
@foreach($pembimbing as $item)
    <div class="bg-white rounded-xl shadow p-4">
        <h3 class="font-bold text-lg">{{ $item->nama }}</h3>
        <p class="text-sm text-gray-500">NIP: {{ $item->nip }}</p>

        <div class="mt-3 text-sm space-y-1">
            <p><strong>Pangkat:</strong> {{ $item->pangkat ?? '-' }}</p>
            <p><strong>Golongan:</strong> {{ $item->golongan ?? '-' }}</p>
            <p><strong>Jabatan:</strong> {{ $item->jabatan ?? '-' }}</p>
            <p>
                <strong>Jam Ajar:</strong>
                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">
                    {{ $item->jumlah_jam_mengajar }} Jam
                </span>
            </p>
        </div>

        <div class="flex gap-2 mt-4">
            <a href="{{ route('pembimbing.edit', $item->id_pembimbing) }}"
               class="flex-1 bg-yellow-500 text-white text-center py-2 rounded-lg">
                Edit
            </a>

            <form action="{{ route('pembimbing.destroy', $item->id_pembimbing) }}"
                method="POST"
                class="delete-form">
                @csrf
                @method('DELETE')
                <button type="button"
                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-xs delete-btn">
                    <i class="fas fa-trash"></i>
                </button>
            </form>

        </div>
    </div>
@endforeach
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function updateDateTime() {
            const now = new Date();
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

            const dayName = days[now.getDay()];
            const date = now.getDate();
            const monthName = months[now.getMonth()];
            const year = now.getFullYear();

            let hours = now.getHours();
            let minutes = now.getMinutes();
            let seconds = now.getSeconds();

            hours = hours < 10 ? '0' + hours : hours;
            minutes = minutes < 10 ? '0' + minutes : minutes;
            seconds = seconds < 10 ? '0' + seconds : seconds;

            document.getElementById('current-date').textContent = `${dayName}, ${date} ${monthName} ${year}`;
            document.getElementById('current-time').textContent = `${hours}:${minutes}:${seconds}`;
        }

        setInterval(updateDateTime, 1000);
        updateDateTime();

        document.getElementById('float-menu-btn').addEventListener('click', function() {
            document.getElementById('float-menu-content').classList.toggle('active');
        });

        document.addEventListener('click', function(event) {
            const floatMenu = document.getElementById('float-menu-content');
            const floatBtn = document.getElementById('float-menu-btn');

            if (!floatMenu.contains(event.target) && !floatBtn.contains(event.target)) {
                floatMenu.classList.remove('active');
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function (e) {
            e.stopPropagation(); // biar tidak ikut klik baris

            const form = this.closest('form');

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Data pembimbing akan dihapus permanen',
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
