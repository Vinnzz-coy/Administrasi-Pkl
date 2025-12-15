<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

<script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6',
                        secondary: '#1e40af',
                        accent: '#10b981',
                        dark: '#1f2937',
                        light: '#f9fafb',
                        'card-bg': '#ffffff'
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.5s ease-out',
                        'slide-down': 'slideDown 0.3s ease-out',
                        'pulse-slow': 'pulse 3s infinite',
                        'bounce-slow': 'bounce 2s infinite',
                        'float': 'float 6s ease-in-out infinite',
                        'slide-in-right': 'slideInRight 0.3s ease-out',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(20px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        slideDown: {
                            '0%': { transform: 'translateY(-10px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        },
                        slideInRight: {
                            '0%': { transform: 'translateX(100%)', opacity: '0' },
                            '100%': { transform: 'translateX(0)', opacity: '1' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        .sidebar {
            transition: all 0.3s ease;
        }

        .main-content {
            transition: all 0.3s ease;
        }

        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px -10px rgba(0, 0, 0, 0.15);
        }

        .active-menu {
            background-color: #eff6ff;
            border-left: 4px solid #3b82f6;
            color: #1e40af;
            font-weight: 600;
        }

        .greeting-card {
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
            color: white;
        }

        .chart-container {
            position: relative;
            height: 300px;
        }

        /* Mobile floating menu */
        .mobile-float-menu {
            position: fixed;
            bottom: 30px;
            right: 20px;
            z-index: 100;
            display: none;
        }

        .mobile-float-menu.active {
            display: block;
            animation: slideInRight 0.3s ease-out;
        }

        .float-menu-btn {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.5);
            cursor: pointer;
        }

        .float-menu-content {
            position: absolute;
            bottom: 70px;
            right: 0;
            background: white;
            border-radius: 15px;
            padding: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            min-width: 200px;
            display: none;
        }

        .float-menu-content.active {
            display: block;
            animation: slideInRight 0.3s ease-out;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -100%;
                z-index: 50;
                height: 100vh;
                overflow-y: auto;
                width: 280px;
            }

            .sidebar.active {
                left: 0;
                box-shadow: 5px 0 25px rgba(0, 0, 0, 0.1);
            }

            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 40;
            }

            .overlay.active {
                display: block;
            }

            .mobile-float-menu {
                display: block;
            }

            /* Perbaikan untuk menu mobile agar tidak gelap */
            nav a {
                color: #4b5563;
            }

            nav a:hover, nav a.active-menu {
                color: #1e40af;
                background-color: #eff6ff;
            }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 overflow-hidden">

<div class="flex h-screen">

    {{-- Overlay mobile --}}
    <div class="overlay" id="overlay"></div>

    {{-- Sidebar --}}
    @auth
        <aside class="sidebar h-screen sticky top-0 shrink-0">
            @include('partials.sidebar')
        </aside>
    @endauth

    {{-- Content --}}
    <div class="flex-1 flex flex-col overflow-hidden">

        {{-- MAIN SCROLL AREA --}}
        <main class="flex-1 overflow-y-auto bg-gray-100 p-4 md:p-6">
            @yield('content')
        </main>

    </div>

</div>

{{-- JS sementara digabung --}}
<script>
    // Profile toggle
    const profileToggle = document.getElementById('profile-toggle');
    if (profileToggle) {
        profileToggle.addEventListener('click', () => {
            const menu = document.getElementById('profile-menu');
            const icon = document.getElementById('profile-chevron');
            menu.classList.toggle('hidden');
            icon.style.transform = menu.classList.contains('hidden')
                ? 'rotate(0deg)'
                : 'rotate(180deg)';
        });
    }

    // Active menu
    document.querySelectorAll('nav a').forEach(link => {
        link.addEventListener('click', e => {
            document.querySelectorAll('nav a').forEach(i => i.classList.remove('active-menu'));
            link.classList.add('active-menu');
        });
    });
</script>

</body>
</html>
