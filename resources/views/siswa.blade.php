<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa PKL</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- ================= NAVBAR ================= -->
    <nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-semibold">Dashboard Siswa PKL</h1>

        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            + Tambah Siswa
        </button>
    </nav>

    <!-- ================= CONTENT WRAPPER ================= -->
    <div class="px-6 py-6">

        <!-- ============ FILTERS / SEARCH ============ -->
        <div class="bg-white p-5 rounded-xl shadow mb-5">
            <div class="grid grid-cols-3 gap-4">

                <!-- Search -->
                <div>
                    <label class="text-sm font-medium">Cari Siswa</label>
                    <input 
                        type="text" 
                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg"
                        placeholder="Nama, NIS, atau Perusahaan..."
                    >
                </div>

                <!-- Jurusan -->
                <div>
                    <label class="text-sm font-medium">Jurusan</label>
                    <select 
                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg"
                    >
                        <option value="">Semua Jurusan</option>
                        <option>Teknik Komputer</option>
                        <option>Teknik Mesin</option>
                        <option>Bisnis Daring</option>
                    </select>
                </div>

                <!-- Status -->
                <div>
                    <label class="text-sm font-medium">Status</label>
                    <select 
                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg"
                    >
                        <option value="">Semua Status</option>
                        <option>Aktif</option>
                        <option>Pending</option>
                        <option>Selesai</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- ============ STATISTIK ============ -->
        <div class="grid grid-cols-4 gap-4 mb-5">

            <div class="bg-white p-4 rounded-xl shadow text-center">
                <p class="text-gray-500">Total Siswa</p>
                <p class="text-2xl font-bold">{{ $total ?? 0 }}</p>
            </div>

            <div class="bg-white p-4 rounded-xl shadow text-center">
                <p class="text-gray-500">Aktif</p>
                <p class="text-2xl text-green-600 font-bold">{{ $aktif ?? 0 }}</p>
            </div>

            <div class="bg-white p-4 rounded-xl shadow text-center">
                <p class="text-gray-500">Pending</p>
                <p class="text-2xl text-yellow-600 font-bold">{{ $pending ?? 0 }}</p>
            </div>

            <div class="bg-white p-4 rounded-xl shadow text-center">
                <p class="text-gray-500">Selesai</p>
                <p class="text-2xl text-blue-600 font-bold">{{ $selesai ?? 0 }}</p>
            </div>
        </div>

        <!-- ============ TABLE ============ -->
        <div class="bg-white p-5 rounded-xl shadow">

            <table class="w-full text-left">
                <thead>
                    <tr class="border-b">
                        <th class="py-3">Siswa</th>
                        <th>NIS</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                        <th>Perusahaan</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($siswa ?? [] as $row)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 flex items-center space-x-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($row->nama) }}"
                                    class="w-9 h-9 rounded-full">
                                <div>
                                    <p class="font-semibold">{{ $row->nama }}</p>
                                    <p class="text-xs text-gray-500">{{ $row->jurusan }}</p>
                                </div>
                            </td>

                            <td>{{ $row->nis }}</td>
                            <td>{{ $row->kelas }}</td>
                            <td>{{ $row->jurusan }}</td>
                            <td>{{ $row->perusahaan }}</td>

                            <td>
                                @if($row->status == 'Aktif')
                                    <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs">Aktif</span>
                                @elseif($row->status == 'Pending')
                                    <span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-xs">Pending</span>
                                @else
                                    <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-xs">Selesai</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            @if(isset($siswa))
                <div class="mt-4">
                    {{ $siswa->links() }}
                </div>
            @endif
        </div>
    </div>

</body>
</html>
