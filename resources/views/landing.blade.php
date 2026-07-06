<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Administrasi PKL — Platform manajemen Praktik Kerja Lapangan modern untuk sekolah menengah kejuruan. RBAC, otomasi dokumen, monitoring DU/DI.">
    <meta name="theme-color" content="#0B0F19">
    <title>Administrasi PKL — Platform Manajemen PKL Modern</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'] },
                    colors: {
                        ink: {
                            50:  '#F9FAFB',
                            100: '#F3F4F6',
                            200: '#E5E7EB',
                            300: '#D1D5DB',
                            400: '#9CA3AF',
                            500: '#6B7280',
                            600: '#4B5563',
                            700: '#374151',
                            800: '#1F2937',
                            900: '#0B0F19',
                        },
                        accent: {
                            50:  '#EEF2FF',
                            100: '#E0E7FF',
                            500: '#6366F1',
                            600: '#4F46E5',
                            700: '#4338CA',
                        },
                    },
                    boxShadow: {
                        soft: '0 1px 2px rgba(11,15,25,0.04), 0 1px 1px rgba(11,15,25,0.03)',
                        card: '0 1px 3px rgba(11,15,25,0.05), 0 8px 24px -8px rgba(11,15,25,0.08)',
                        ring: '0 0 0 1px rgba(11,15,25,0.06), 0 1px 2px rgba(11,15,25,0.04)',
                    },
                    letterSpacing: { tightest: '-0.04em' },
                }
            }
        }
    </script>
    <style>
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', ui-sans-serif, system-ui, sans-serif; -webkit-font-smoothing: antialiased; text-rendering: optimizeLegibility; }
        body { overflow-x: hidden; background: #FFFFFF; color: #0B0F19; }

        /* Subtle dot grid for hero backdrop */
        .bg-mesh {
            background-color: #FFFFFF;
            background-image:
                radial-gradient(at 20% 10%, rgba(99,102,241,0.08) 0px, transparent 50%),
                radial-gradient(at 80% 0%,  rgba(99,102,241,0.05) 0px, transparent 50%),
                radial-gradient(at 70% 80%, rgba(99,102,241,0.06) 0px, transparent 50%);
        }
        .bg-grid {
            background-image: linear-gradient(rgba(11,15,25,0.04) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(11,15,25,0.04) 1px, transparent 1px);
            background-size: 32px 32px;
            mask-image: radial-gradient(ellipse at center, black 30%, transparent 70%);
        }

        /* Reveal on scroll */
        .reveal { opacity: 0; transform: translateY(16px); transition: opacity .6s ease, transform .6s ease; }
        .reveal.in { opacity: 1; transform: translateY(0); }

        /* Navbar */
        .nav { transition: background-color .25s ease, box-shadow .25s ease, border-color .25s ease; }
        .nav.scrolled { background: rgba(255,255,255,0.85); backdrop-filter: saturate(180%) blur(12px); border-bottom-color: rgba(11,15,25,0.08); box-shadow: 0 1px 0 rgba(11,15,25,0.02); }

        /* Buttons */
        .btn { display:inline-flex; align-items:center; justify-content:center; gap:.5rem; font-weight:600; border-radius:.75rem; transition: transform .15s ease, background-color .15s ease, color .15s ease, box-shadow .15s ease, border-color .15s ease; }
        .btn-primary { background:#0B0F19; color:#fff; }
        .btn-primary:hover { background:#1F2937; transform: translateY(-1px); box-shadow: 0 8px 20px -8px rgba(11,15,25,.35); }
        .btn-ghost { background:transparent; color:#0B0F19; border:1px solid #E5E7EB; }
        .btn-ghost:hover { border-color:#0B0F19; }
        .btn-accent { background:#4F46E5; color:#fff; }
        .btn-accent:hover { background:#4338CA; transform: translateY(-1px); box-shadow: 0 8px 20px -8px rgba(79,70,229,.5); }

        /* Feature card hover */
        .feat { transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease; }
        .feat:hover { transform: translateY(-3px); box-shadow: 0 1px 3px rgba(11,15,25,.05), 0 12px 32px -10px rgba(11,15,25,.12); border-color:#E0E7FF; }

        /* Hero mock card float */
        @keyframes floaty { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-6px); } }
        .floaty { animation: floaty 6s ease-in-out infinite; }

        /* Section padding */
        .sec { padding: clamp(64px, 8vw, 112px) 0; }

        /* Focus ring */
        :focus-visible { outline: 2px solid #4F46E5; outline-offset: 2px; border-radius: 6px; }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 10px; height: 10px; }
        ::-webkit-scrollbar-track { background: #F9FAFB; }
        ::-webkit-scrollbar-thumb { background: #D1D5DB; border-radius: 8px; }
        ::-webkit-scrollbar-thumb:hover { background: #9CA3AF; }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation: none !important; transition: none !important; scroll-behavior: auto !important; }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <header class="nav fixed top-0 inset-x-0 z-50 bg-white/0 border-b border-transparent">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="h-16 md:h-20 flex items-center justify-between">
                <a href="#" class="flex items-center gap-2.5 group">
                    <span class="w-9 h-9 rounded-xl bg-[#0B0F19] text-white grid place-items-center font-bold tracking-tight">A</span>
                    <span class="font-semibold text-[#0B0F19] text-[15px] tracking-tight">Administrasi<span class="text-[#9CA3AF] font-normal">PKL</span></span>
                </a>

                <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-[#4B5563]">
                    <a href="#features"  class="hover:text-[#0B0F19] transition">Fitur</a>
                    <a href="#benefits"  class="hover:text-[#0B0F19] transition">Keuntungan</a>
                    <a href="#about"     class="hover:text-[#0B0F19] transition">Tentang</a>
                </nav>

                <div class="flex items-center gap-2">
                    <a href="{{ route('login') }}" class="btn btn-primary px-4 py-2.5 text-sm hidden sm:inline-flex">Login</a>
                    <button id="menuBtn" class="md:hidden p-2 rounded-lg text-[#374151] hover:bg-[#F3F4F6]" aria-label="Buka menu" aria-expanded="false">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
                    </button>
                </div>
            </div>

            <div id="mobileMenu" class="md:hidden hidden pb-4">
                <div class="rounded-xl border border-[#E5E7EB] bg-white p-2 shadow-soft">
                    <a href="#features" class="block px-3 py-2.5 rounded-lg text-sm text-[#374151] hover:bg-[#F9FAFB]">Fitur</a>
                    <a href="#benefits" class="block px-3 py-2.5 rounded-lg text-sm text-[#374151] hover:bg-[#F9FAFB]">Keuntungan</a>
                    <a href="#about"    class="block px-3 py-2.5 rounded-lg text-sm text-[#374151] hover:bg-[#F9FAFB]">Tentang</a>
                    <a href="{{ route('login') }}" class="block px-3 py-2.5 rounded-lg text-sm font-semibold text-white bg-[#0B0F19] text-center mt-1">Login</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero -->
    <section class="bg-mesh pt-28 md:pt-36 pb-20 md:pb-28 relative">
        <div class="absolute inset-0 bg-grid pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="grid lg:grid-cols-12 gap-12 lg:gap-10 items-center">
                <div class="lg:col-span-7">
                    <span class="reveal in inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-[#EEF2FF] text-[#4338CA] text-xs font-semibold ring-1 ring-inset ring-[#E0E7FF]">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#EEF2FF]0"></span>
                        Built for SMK • Laravel 12 + PostgreSQL
                    </span>

                    <h1 class="reveal mt-5 text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tightest text-[#0B0F19] leading-[1.05]">
                        Administrasi PKL,
                        <span class="block text-[#6B7280]">tanpa repot.</span>
                    </h1>

                    <p class="reveal mt-6 text-lg text-[#4B5563] leading-relaxed max-w-xl">
                        Kelola Praktik Kerja Lapangan secara terpusat — penempatan DU/DI, otomasi surat, hingga monitoring siswa, dalam satu sistem yang ringan dan terintegrasi.
                    </p>

                    <div class="reveal mt-8 flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('login') }}" class="btn btn-primary px-6 py-3.5 text-sm">
                            Mulai Sekarang
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 5l7 7-7 7"/></svg>
                        </a>
                        <a href="#features" class="btn btn-ghost px-6 py-3.5 text-sm">
                            Pelajari Fitur
                        </a>
                    </div>

                    <dl class="reveal mt-12 grid grid-cols-3 gap-6 max-w-md">
                        <div>
                            <dt class="text-3xl font-extrabold text-[#0B0F19] tracking-tight">8+</dt>
                            <dd class="text-sm text-[#6B7280] mt-1">Jurusan didukung</dd>
                        </div>
                        <div>
                            <dt class="text-3xl font-extrabold text-[#0B0F19] tracking-tight">100%</dt>
                            <dd class="text-sm text-[#6B7280] mt-1">Terintegrasi</dd>
                        </div>
                        <div>
                            <dt class="text-3xl font-extrabold text-[#0B0F19] tracking-tight">24/7</dt>
                            <dd class="text-sm text-[#6B7280] mt-1">Akses sistem</dd>
                        </div>
                    </dl>
                </div>

                <div class="lg:col-span-5">
                    <div class="relative floaty">
                        <div class="absolute -inset-6 bg-[#E0E7FF]/60 rounded-3xl blur-2xl"></div>

                        <div class="relative rounded-2xl bg-white shadow-card ring-1 ring-ink-200/70 p-4">
                            <div class="rounded-xl border border-[#E5E7EB] overflow-hidden">
                                <div class="flex items-center gap-1.5 px-3.5 py-2.5 border-b border-[#E5E7EB] bg-[#F9FAFB]">
                                    <span class="w-2.5 h-2.5 rounded-full bg-[#E5E7EB]"></span>
                                    <span class="w-2.5 h-2.5 rounded-full bg-[#E5E7EB]"></span>
                                    <span class="w-2.5 h-2.5 rounded-full bg-[#E5E7EB]"></span>
                                    <span class="ml-2 text-xs text-[#6B7280] font-medium">app.administrasi-pkl / dashboard</span>
                                </div>

                                <div class="p-5 grid grid-cols-3 gap-3">
                                    <div class="col-span-2 rounded-lg bg-[#F9FAFB] p-4">
                                        <p class="text-xs text-[#6B7280]">Total Siswa Aktif</p>
                                        <p class="text-2xl font-bold text-[#0B0F19] mt-1 tracking-tight">412</p>
                                        <p class="text-xs text-[#4F46E5] mt-1 font-medium">+12% bulan ini</p>
                                    </div>
                                    <div class="rounded-lg bg-[#0B0F19] text-white p-4">
                                        <p class="text-xs text-[#9CA3AF]">DU/DI</p>
                                        <p class="text-2xl font-bold mt-1 tracking-tight">28</p>
                                        <p class="text-xs text-[#9CA3AF] mt-1">mitra aktif</p>
                                    </div>

                                    <div class="col-span-3 rounded-lg border border-[#E5E7EB] p-4">
                                        <div class="flex items-center justify-between">
                                            <p class="text-xs font-medium text-[#374151]">Penempatan per Jurusan</p>
                                            <span class="text-xs text-[#9CA3AF]">Q3 2025</span>
                                        </div>
                                        <div class="mt-3 space-y-2.5">
                                            <div><div class="flex justify-between text-xs text-[#4B5563] mb-1"><span>RPL</span><span>86%</span></div><div class="h-1.5 rounded-full bg-[#F3F4F6] overflow-hidden"><div class="h-full bg-[#0B0F19]" style="width:86%"></div></div></div>
                                            <div><div class="flex justify-between text-xs text-[#4B5563] mb-1"><span>TKJ</span><span>72%</span></div><div class="h-1.5 rounded-full bg-[#F3F4F6] overflow-hidden"><div class="h-full bg-[#0B0F19]" style="width:72%"></div></div></div>
                                            <div><div class="flex justify-between text-xs text-[#4B5563] mb-1"><span>MM</span><span>64%</span></div><div class="h-1.5 rounded-full bg-[#F3F4F6] overflow-hidden"><div class="h-full bg-[#0B0F19]" style="width:64%"></div></div></div>
                                            <div><div class="flex justify-between text-xs text-[#4B5563] mb-1"><span>AKL</span><span>58%</span></div><div class="h-1.5 rounded-full bg-[#F3F4F6] overflow-hidden"><div class="h-full bg-[#0B0F19]" style="width:58%"></div></div></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="hidden sm:block absolute -bottom-6 -left-6 w-44 rounded-xl bg-white shadow-card ring-1 ring-ink-200/70 p-3.5">
                            <div class="flex items-center gap-2.5">
                                <span class="w-9 h-9 rounded-lg bg-[#EEF2FF] text-[#4F46E5] grid place-items-center">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><path d="M9 13h6M9 17h6"/></svg>
                                </span>
                                <div>
                                    <p class="text-xs text-[#6B7280]">Surat Otomatis</p>
                                    <p class="text-sm font-semibold text-[#0B0F19]">PDF • 0.3s</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-16 md:mt-20 border-t border-[#E5E7EB] pt-8">
                <p class="text-xs uppercase tracking-widest text-[#9CA3AF] text-center">Dipercaya untuk program PKL di sekolah kejuruan</p>
                <div class="mt-6 flex flex-wrap justify-center items-center gap-x-10 gap-y-4 text-[#9CA3AF]">
                    <span class="font-semibold tracking-tight text-sm">SMKN 1</span>
                    <span class="font-semibold tracking-tight text-sm">SMKN 2</span>
                    <span class="font-semibold tracking-tight text-sm">SMKN 3</span>
                    <span class="font-semibold tracking-tight text-sm">SMKN 4</span>
                    <span class="font-semibold tracking-tight text-sm">SMKN 5</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="sec bg-[#F9FAFB]/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl">
                <p class="reveal text-sm font-semibold text-[#4F46E5] tracking-wide uppercase">Fitur</p>
                <h2 class="reveal mt-3 text-3xl md:text-5xl font-extrabold tracking-tightest text-[#0B0F19] leading-tight">Dirancang untuk alur PKL yang sebenarnya.</h2>
                <p class="reveal mt-4 text-lg text-[#4B5563]">Bukan sekadar database siswa — ini adalah sistem operasional yang menyentuh setiap langkah, dari pendaftaran hingga laporan akhir.</p>
            </div>

            <div class="mt-14 grid grid-cols-1 md:grid-cols-6 gap-5">
                <!-- Bento: RBAC spans 4 cols -->
                <div class="reveal feat md:col-span-4 rounded-2xl bg-white border border-[#E5E7EB] p-7 md:p-8 flex flex-col sm:flex-row gap-6">
                    <span class="w-12 h-12 rounded-xl bg-[#EEF2FF] text-[#4F46E5] grid place-items-center shrink-0">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2 4 6v6c0 5 3.5 9 8 10 4.5-1 8-5 8-10V6z"/></svg>
                    </span>
                    <div>
                        <h3 class="text-xl font-bold text-[#0B0F19] tracking-tight">RBAC 3 Tingkat</h3>
                        <p class="mt-2 text-[#4B5563] leading-relaxed">Hak akses granular untuk <span class="font-medium text-[#0B0F19]">Super Admin</span>, <span class="font-medium text-[#0B0F19]">Admin Jurusan</span>, dan <span class="font-medium text-[#0B0F19]">Siswa</span> — minim kesalahan, maksimal keamanan.</p>
                        <div class="mt-5 flex flex-wrap gap-2 text-xs">
                            <span class="px-2.5 py-1 rounded-full bg-[#F3F4F6] text-[#374151] font-medium">Super Admin</span>
                            <span class="px-2.5 py-1 rounded-full bg-[#F3F4F6] text-[#374151] font-medium">Admin Jurusan</span>
                            <span class="px-2.5 py-1 rounded-full bg-[#F3F4F6] text-[#374151] font-medium">Siswa</span>
                        </div>
                    </div>
                </div>

                <div class="reveal feat md:col-span-2 rounded-2xl bg-white border border-[#E5E7EB] p-7">
                    <span class="w-12 h-12 rounded-xl bg-[#EEF2FF] text-[#4F46E5] grid place-items-center">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M3 5v6c0 1.7 4 3 9 3s9-1.3 9-3V5"/><path d="M3 11v6c0 1.7 4 3 9 3s9-1.3 9-3v-6"/></svg>
                    </span>
                    <h3 class="mt-5 text-lg font-bold text-[#0B0F19] tracking-tight">Data Terpadu</h3>
                    <p class="mt-2 text-sm text-[#4B5563] leading-relaxed">CRUD siswa, jurusan, pembimbing, dan logistik dalam satu tempat.</p>
                </div>

                <div class="reveal feat md:col-span-2 rounded-2xl bg-white border border-[#E5E7EB] p-7">
                    <span class="w-12 h-12 rounded-xl bg-[#EEF2FF] text-[#4F46E5] grid place-items-center">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><path d="M9 13h6M9 17h4"/></svg>
                    </span>
                    <h3 class="mt-5 text-lg font-bold text-[#0B0F19] tracking-tight">Otomasi Dokumen</h3>
                    <p class="mt-2 text-sm text-[#4B5563] leading-relaxed">Template DOCX → PDF sekali klik. Tidak ada lagi copy-paste manual.</p>
                </div>

                <div class="reveal feat md:col-span-2 rounded-2xl bg-white border border-[#E5E7EB] p-7">
                    <span class="w-12 h-12 rounded-xl bg-[#EEF2FF] text-[#4F46E5] grid place-items-center">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a14 14 0 0 1 0 18M12 3a14 14 0 0 0 0 18"/></svg>
                    </span>
                    <h3 class="mt-5 text-lg font-bold text-[#0B0F19] tracking-tight">Monitoring DU/DI</h3>
                    <p class="mt-2 text-sm text-[#4B5563] leading-relaxed">Kalkulasi kuota mitra secara real-time. Tidak ada penempatan ganda.</p>
                </div>

                <div class="reveal feat md:col-span-2 rounded-2xl bg-white border border-[#E5E7EB] p-7">
                    <span class="w-12 h-12 rounded-xl bg-[#EEF2FF] text-[#4F46E5] grid place-items-center">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    </span>
                    <h3 class="mt-5 text-lg font-bold text-[#0B0F19] tracking-tight">Autentikasi Ganda</h3>
                    <p class="mt-2 text-sm text-[#4B5563] leading-relaxed">Login via <span class="font-medium text-[#0B0F19]">username</span> atau <span class="font-medium text-[#0B0F19]">NIS</span> — ramah untuk siswa.</p>
                </div>

                <div class="reveal feat md:col-span-3 rounded-2xl bg-[#0B0F19] text-white border border-[#0B0F19] p-7">
                    <div class="flex items-center gap-3">
                        <span class="w-12 h-12 rounded-xl bg-white/10 grid place-items-center">
                            <svg class="w-6 h-6 text-[#6366F1]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="2"/><path d="M12 18h.01"/></svg>
                        </span>
                        <h3 class="text-lg font-bold tracking-tight">Responsif di semua perangkat</h3>
                    </div>
                    <p class="mt-3 text-sm text-[#D1D5DB] leading-relaxed">Desktop, tablet, maupun ponsel — antarmuka tetap konsisten dan cepat karena dibangun di atas Tailwind CSS.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits -->
    <section id="benefits" class="sec">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-12 lg:gap-16">
                <div class="lg:col-span-5">
                    <p class="reveal text-sm font-semibold text-[#4F46E5] tracking-wide uppercase">Keuntungan</p>
                    <h2 class="reveal mt-3 text-3xl md:text-5xl font-extrabold tracking-tightest text-[#0B0F19] leading-tight">Hasil yang terasa, bukan hanya fitur.</h2>
                    <p class="reveal mt-4 text-lg text-[#4B5563]">Empat dampak langsung yang akan Anda rasakan di minggu pertama penerapan.</p>
                </div>

                <div class="lg:col-span-7">
                    <ol class="space-y-2">
                        <li class="reveal feat flex gap-5 p-5 rounded-xl border border-transparent hover:border-[#E5E7EB] hover:bg-white">
                            <span class="text-sm font-bold text-[#D1D5DB] w-8 shrink-0">01</span>
                            <div>
                                <h3 class="text-lg font-semibold text-[#0B0F19] tracking-tight">Hemat waktu administrasi</h3>
                                <p class="mt-1 text-[#4B5563]">Tugas yang biasanya makan berhari-hari, selesai dalam hitungan jam lewat otomasi template.</p>
                            </div>
                        </li>
                        <li class="reveal feat flex gap-5 p-5 rounded-xl border border-transparent hover:border-[#E5E7EB] hover:bg-white">
                            <span class="text-sm font-bold text-[#D1D5DB] w-8 shrink-0">02</span>
                            <div>
                                <h3 class="text-lg font-semibold text-[#0B0F19] tracking-tight">Analitik yang bisa ditindaklanjuti</h3>
                                <p class="mt-1 text-[#4B5563]">Lihat sebaran siswa, kepadatan DU/DI, dan progres PKL lewat dasbor yang jelas.</p>
                            </div>
                        </li>
                        <li class="reveal feat flex gap-5 p-5 rounded-xl border border-transparent hover:border-[#E5E7EB] hover:bg-white">
                            <span class="text-sm font-bold text-[#D1D5DB] w-8 shrink-0">03</span>
                            <div>
                                <h3 class="text-lg font-semibold text-[#0B0F19] tracking-tight">Kolaborasi yang lebih baik</h3>
                                <p class="mt-1 text-[#4B5563]">Admin, pembimbing, dan siswa bekerja di sumber data yang sama. Tidak ada lagi versi dokumen yang tercecer.</p>
                            </div>
                        </li>
                        <li class="reveal feat flex gap-5 p-5 rounded-xl border border-transparent hover:border-[#E5E7EB] hover:bg-white">
                            <span class="text-sm font-bold text-[#D1D5DB] w-8 shrink-0">04</span>
                            <div>
                                <h3 class="text-lg font-semibold text-[#0B0F19] tracking-tight">Standar profesional</h3>
                                <p class="mt-1 text-[#4B5563]">Sistem yang mengikuti kaidah administratif sekolah — siap audit, siap akreditasi.</p>
                            </div>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- About -->
    <section id="about" class="sec bg-[#0B0F19] text-white relative overflow-hidden">
        <div class="absolute -top-32 -right-24 w-[480px] h-[480px] rounded-full bg-[#4F46E5]/20 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-32 -left-24 w-[420px] h-[420px] rounded-full bg-[#EEF2FF]0/10 blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <div>
                    <p class="reveal text-sm font-semibold text-[#6366F1] tracking-wide uppercase">Tentang</p>
                    <h2 class="reveal mt-3 text-3xl md:text-5xl font-extrabold tracking-tightest leading-tight">Dibangun dari pengalaman PKL nyata.</h2>
                    <p class="reveal mt-5 text-[#D1D5DB] text-lg leading-relaxed">Sistem ini lahir dari kebutuhan riil di lapangan — dikembangkan selama program PKL, diuji oleh admin sekolah, dan disempurnakan berdasarkan umpan balik pengguna.</p>
                    <p class="reveal mt-4 text-[#D1D5DB] text-lg leading-relaxed">Tumpukan teknologi modern seperti Laravel, PostgreSQL, dan Tailwind CSS memastikan performa optimal dan pengalaman yang konsisten.</p>

                    <dl class="reveal mt-10 grid grid-cols-3 gap-6 border-t border-white/10 pt-8">
                        <div>
                            <dt class="text-3xl font-extrabold tracking-tight">2025</dt>
                            <dd class="text-sm text-[#9CA3AF] mt-1">Tahun peluncuran</dd>
                        </div>
                        <div>
                            <dt class="text-3xl font-extrabold tracking-tight">8+</dt>
                            <dd class="text-sm text-[#9CA3AF] mt-1">Jurusan</dd>
                        </div>
                        <div>
                            <dt class="text-3xl font-extrabold tracking-tight">100%</dt>
                            <dd class="text-sm text-[#9CA3AF] mt-1">Terintegrasi</dd>
                        </div>
                    </dl>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="reveal feat rounded-2xl bg-white/5 ring-1 ring-white/10 p-6">
                        <svg class="w-7 h-7 text-[#6366F1]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 0 0 .3 1.8l.1.1a2 2 0 1 1-2.8 2.8l-.1-.1a1.7 1.7 0 0 0-1.8-.3 1.7 1.7 0 0 0-1 1.5V21a2 2 0 1 1-4 0v-.1a1.7 1.7 0 0 0-1-1.5 1.7 1.7 0 0 0-1.8.3l-.1.1a2 2 0 1 1-2.8-2.8l.1-.1a1.7 1.7 0 0 0 .3-1.8 1.7 1.7 0 0 0-1.5-1H3a2 2 0 1 1 0-4h.1a1.7 1.7 0 0 0 1.5-1 1.7 1.7 0 0 0-.3-1.8l-.1-.1a2 2 0 1 1 2.8-2.8l.1.1a1.7 1.7 0 0 0 1.8.3h.1a1.7 1.7 0 0 0 1-1.5V3a2 2 0 1 1 4 0v.1a1.7 1.7 0 0 0 1 1.5 1.7 1.7 0 0 0 1.8-.3l.1-.1a2 2 0 1 1 2.8 2.8l-.1.1a1.7 1.7 0 0 0-.3 1.8v.1a1.7 1.7 0 0 0 1.5 1H21a2 2 0 1 1 0 4h-.1a1.7 1.7 0 0 0-1.5 1z"/></svg>
                        <h3 class="mt-4 font-semibold tracking-tight">Tumpukan modern</h3>
                        <p class="mt-1 text-sm text-[#9CA3AF]">Laravel 12, PostgreSQL, Tailwind CSS</p>
                    </div>
                    <div class="reveal feat rounded-2xl bg-white/5 ring-1 ring-white/10 p-6">
                        <svg class="w-7 h-7 text-[#6366F1]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17.5 19a4.5 4.5 0 1 0-1.4-8.78 7 7 0 1 0-11.6 6.78"/><path d="M12 19v3M9 22h6"/></svg>
                        <h3 class="mt-4 font-semibold tracking-tight">Cloud-ready</h3>
                        <p class="mt-1 text-sm text-[#9CA3AF]">Docker container, deploy di mana saja</p>
                    </div>
                    <div class="reveal feat rounded-2xl bg-white/5 ring-1 ring-white/10 p-6">
                        <svg class="w-7 h-7 text-[#6366F1]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2 4 6v6c0 5 3.5 9 8 10 4.5-1 8-5 8-10V6z"/><path d="m9 12 2 2 4-4"/></svg>
                        <h3 class="mt-4 font-semibold tracking-tight">Aman by default</h3>
                        <p class="mt-1 text-sm text-[#9CA3AF]">Enkripsi end-to-end & RBAC ketat</p>
                    </div>
                    <div class="reveal feat rounded-2xl bg-white/5 ring-1 ring-white/10 p-6">
                        <svg class="w-7 h-7 text-[#6366F1]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 11a9 9 0 0 1 18 0v3a2 2 0 0 1-2 2h-2v-7h4M3 11v3a2 2 0 0 0 2 2h2v-7H3"/></svg>
                        <h3 class="mt-4 font-semibold tracking-tight">Dukungan responsif</h3>
                        <p class="mt-1 text-sm text-[#9CA3AF]">Tim siap membantu implementasi</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="sec">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="reveal rounded-3xl bg-[#F9FAFB] border border-[#E5E7EB] px-8 py-14 md:px-14 md:py-16 text-center">
                <h2 class="text-3xl md:text-5xl font-extrabold tracking-tightest text-[#0B0F19] leading-tight">Siap memodernisasi administrasi PKL?</h2>
                <p class="mt-5 text-lg text-[#4B5563] max-w-2xl mx-auto">Mulai sekarang dan rasakan administrasinya lebih ringan, datanya lebih rapi, dan laporannya lebih siap.</p>
                <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="{{ route('login') }}" class="btn btn-primary px-6 py-3.5 text-sm">
                        Akses Sistem Sekarang
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 5l7 7-7 7"/></svg>
                    </a>
                    <a href="#features" class="btn btn-ghost px-6 py-3.5 text-sm">Lihat Fitur</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-[#0B0F19] text-[#9CA3AF] border-t border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="grid grid-cols-2 md:grid-cols-5 gap-10">
                <div class="col-span-2">
                    <a href="#" class="flex items-center gap-2.5">
                        <span class="w-9 h-9 rounded-xl bg-white text-[#0B0F19] grid place-items-center font-bold">A</span>
                        <span class="font-semibold text-white tracking-tight">Administrasi<span class="text-[#9CA3AF] font-normal">PKL</span></span>
                    </a>
                    <p class="mt-4 text-sm leading-relaxed max-w-xs">Platform manajemen PKL modern untuk sekolah menengah kejuruan.</p>
                </div>
                <div>
                    <h4 class="text-white text-sm font-semibold tracking-tight">Produk</h4>
                    <ul class="mt-4 space-y-2.5 text-sm">
                        <li><a href="#features" class="hover:text-white transition">Fitur</a></li>
                        <li><a href="#benefits" class="hover:text-white transition">Keuntungan</a></li>
                        <li><a href="#about"    class="hover:text-white transition">Tentang</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white text-sm font-semibold tracking-tight">Sumber Daya</h4>
                    <ul class="mt-4 space-y-2.5 text-sm">
                        <li><a href="#" class="hover:text-white transition">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition">Dokumentasi</a></li>
                        <li><a href="#" class="hover:text-white transition">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white text-sm font-semibold tracking-tight">Legal</h4>
                    <ul class="mt-4 space-y-2.5 text-sm">
                        <li><a href="#" class="hover:text-white transition">Privasi</a></li>
                        <li><a href="#" class="hover:text-white transition">Ketentuan</a></li>
                        <li><a href="#" class="hover:text-white transition">Lisensi</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-12 pt-8 border-t border-white/5 flex flex-col md:flex-row items-center justify-between gap-3 text-xs">
                <p>© 2025 Administrasi PKL. Semua hak dilindungi.</p>
                <p>Dibuat untuk sekolah kejuruan Indonesia.</p>
            </div>
        </div>
    </footer>

    <script>
        // Navbar scroll state
        const nav = document.querySelector('.nav');
        const onScroll = () => nav.classList.toggle('scrolled', window.scrollY > 8);
        document.addEventListener('scroll', onScroll, { passive: true });
        onScroll();

        // Mobile menu
        const menuBtn = document.getElementById('menuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        menuBtn?.addEventListener('click', () => {
            const open = mobileMenu.classList.toggle('hidden') === false;
            menuBtn.setAttribute('aria-expanded', open);
        });
        mobileMenu?.querySelectorAll('a').forEach(a => a.addEventListener('click', () => {
            mobileMenu.classList.add('hidden');
            menuBtn.setAttribute('aria-expanded', 'false');
        }));

        // Reveal on scroll
        const io = new IntersectionObserver((entries) => {
            entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
        document.querySelectorAll('.reveal').forEach(el => io.observe(el));
    </script>
</body>
</html>
