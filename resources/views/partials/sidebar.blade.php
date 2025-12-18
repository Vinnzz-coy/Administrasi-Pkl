<div class="flex h-screen overflow-hidden">
    <!-- Overlay Mobile -->
    <div class="overlay" id="overlay"></div>

    <!-- Sidebar -->
    <aside class="sidebar w-64 bg-white shadow-4xl shadow-gray-900/50 flex flex-col z-30">

        <!-- Logo Sekolah -->
        <div class="p-6 border-b">
            <div class="flex items-center">
                <div class="w-50 h-50 rounded-lg overflow-hidden flex items-center justify-center">
                    <img src="{{ asset('asset/logo-smk-lengkap.webp') }}"
                        alt="Logo Sekolah"
                        class="w-full h-full object-contain">
                </div>
            </div>
        </div>

        <!-- Profile Admin -->
        <div class="p-6 border-b">
            <div class="flex items-center cursor-pointer" id="profile-toggle">
                <div class="w-12 h-12 rounded-full bg-linear-to-r from-primary to-secondary flex items-center justify-center overflow-hidden border-2 border-white shadow">
                    <img src="{{ asset('asset/default-avatar.webp') }}"
                        alt="Admin"
                        class="w-full h-full object-cover">
                </div>
                <div class="ml-4">
                    <h3 class="font-semibold text-dark">
                        {{ auth()->user()->name }}
                    </h3>
                    <p class="text-gray-500 text-sm">
                        NIP. {{ auth()->user()->nip }}
                    </p>
                </div>
                <i class="fas fa-chevron-down text-gray-400 ml-auto transition-transform duration-300"
                    id="profile-chevron"></i>
            </div>

            <!-- Menu Profile -->
            <div class="mt-4 hidden animate-slide-down" id="profile-menu">
                <a href="{{ route('dashboard') }}"
                    class="block py-2 px-4 rounded-lg hover:bg-gray-100 text-gray-700 transition-colors">
                    <i class="fas fa-user-circle mr-3 text-primary"></i> Profil Saya
                </a>

                <a href="{{ route('dashboard') }}"
                    class="block py-2 px-4 rounded-lg hover:bg-gray-100 text-gray-700 transition-colors">
                    <i class="fas fa-cog mr-3 text-primary"></i> Pengaturan Akun
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full text-left py-2 px-4 rounded-lg hover:bg-gray-100 text-gray-700 transition-colors">
                        <i class="fas fa-sign-out-alt mr-3 text-primary"></i> Keluar
                    </button>
                </form>
            </div>
        </div>

        <!-- Menu Navigasi -->
        <nav class="flex-1 p-4 overflow-y-auto">
            <ul class="space-y-2">

                <li>
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center py-3 px-4 rounded-lg active-menu">
                        <i class="fas fa-tachometer-alt text-primary mr-3"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('siswa.index') }}"
                        class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-user-graduate text-blue-500 mr-3"></i>
                        <span>Data Siswa PKL</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-chalkboard-teacher text-green-500 mr-3"></i>
                        <span>Data Pembimbing</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-building text-purple-500 mr-3"></i>
                        <span>Data Perusahaan</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-file-contract text-yellow-500 mr-3"></i>
                        <span>Buat Surat Penjajakan</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-print text-red-500 mr-3"></i>
                        <span>Cetak Surat Penempatan</span>
                    </a>
                </li>

                <li class="pt-6">
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-cog text-gray-500 mr-3"></i>
                        <span>Pengaturan</span>
                    </a>
                </li>

            </ul>
        </nav>

        <!-- Footer -->
        <div class="p-4 border-t text-center text-gray-500 text-sm">
            <p>© 2025 SMK Negeri 1 Wonosobo</p>
            <p class="text-xs mt-1">Sistem PKL v1.0</p>
        </div>

    </aside>
</div>
