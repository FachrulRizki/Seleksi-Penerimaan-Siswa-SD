<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'SD Negeri 7 Teluk Pandan')</title>
    <meta name="description"
        content="Website resmi SD Negeri 7 Teluk Pandan - informasi sekolah, PPDB/Seleksi, layanan akademik, dan pengumuman.">
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    {{-- AOS Animation Library --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    {{-- Bootstrap 5 --}}
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --brand: #5D87FF;
            --brand-dark: #5e50ee;
            --accent: #ff9f43;
            --soft: #f4f6f8;
            --text-dark: #2c3e50;
            --text-muted: #6c757d;
        }

        body {
            color: var(--text-dark);
            overflow-x: hidden;
        }

        /* Utilities */
        .text-brand { color: var(--brand) !important; }
        .bg-soft { background-color: var(--soft) !important; }
        .fw-extra-bold { font-weight: 800; }

        /* Buttons */
        .btn {
            border-radius: 50px;
            padding: 0.6rem 1.5rem;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .btn-brand {
            background: var(--brand);
            border: 2px solid var(--brand);
            color: #fff;
            box-shadow: 0 4px 15px rgba(115, 103, 240, 0.3);
        }

        .btn-brand:hover {
            background: var(--brand-dark);
            border-color: var(--brand-dark);
            color: #fff;
            transform: translateY(-2px);
        }

        .btn-outline-brand {
            border: 2px solid var(--brand);
            color: var(--brand);
            background: transparent;
        }

        .btn-outline-brand:hover {
            background: var(--brand);
            color: #fff;
        }

        /* Navbar */
        .navbar {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
        }
        .nav-link {
            font-weight: 700;
            color: var(--text-dark);
            margin: 0 5px;
        }
        .nav-link:hover, .nav-link.active {
            color: var(--brand);
        }

        /* Card Modernization */
        .card-modern {
            border: none;
            border-radius: 20px;
            background: #fff;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            overflow: hidden;
        }
        .card-modern:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }

        /* Section Titles */
        .section-header {
            margin-bottom: 3rem;
            text-align: center;
        }
        .section-header .subtitle {
            color: var(--brand);
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
            display: block;
            margin-bottom: 0.5rem;
        }
        .section-header h2 {
            font-weight: 800;
            font-size: 2.5rem;
        }

        /* Icon Boxes */
        .icon-box-circle {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(115, 103, 240, 0.1);
            color: var(--brand);
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #c1c1c1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--brand); }

        /* Floating CTA */
        .sticky-cta {
            position: fixed;
            right: 20px;
            bottom: 20px;
            z-index: 999;
            animation: bounceIn 1s;
        }

        @keyframes bounceIn {
            0% { opacity: 0; transform: scale(0.3); }
            50% { opacity: 1; transform: scale(1.05); }
            70% { transform: scale(0.9); }
            100% { transform: scale(1); }
        }

        html { scroll-behavior: smooth; }

        #preloader {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: #ffffff;
            z-index: 99999;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: opacity 0.5s ease-out, visibility 0.5s ease-out;
        }

        /* Animasi Ikon Preloader */
        .preloader-icon {
            font-size: 3.5rem;
            color: var(--brand);
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.7; }
            100% { transform: scale(1); opacity: 1; }
        }

        .preloader-hide {
            opacity: 0;
            visibility: hidden;
        }
    </style>

    @stack('styles')
</head>

<body>

    <div id="preloader">
        <div class="preloader-icon">
            <i class="bi bi-mortarboard-fill"></i>
        </div>
        <div class="mt-3 fw-bold text-muted letter-spacing-1">Memuat halaman...</div>
    </div>

    @yield('content')

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Init Animation on Scroll
        AOS.init({
            once: true,
            offset: 100,
            duration: 800,
        });

        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');
            setTimeout(() => {
                preloader.classList.add('preloader-hide');
                setTimeout(() => {
                    preloader.style.display = 'none';
                }, 500); 
            }, 500);
        });
    </script>
    @stack('scripts')
</body>

</html>