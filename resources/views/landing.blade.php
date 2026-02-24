@extends('landing_base')

@section('title', 'SD Negeri 7 Teluk Pandan - Berkarakter & Berprestasi')

@section('content')
    @php
        $schoolName = 'SDN 7 Teluk Pandan';
    @endphp

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg fixed-top py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#top">
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="bi bi-mortarboard-fill"></i>
                </div>
                <span class="fw-extra-bold text-dark fs-5">{{ $schoolName }}</span>
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#beranda">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tentang">Profil</a></li>
                    <li class="nav-item"><a class="nav-link" href="#ppdb">PPDB Online</a></li>
                    <li class="nav-item"><a class="nav-link" href="#program">Program</a></li>
                    <li class="nav-item"><a class="nav-link" href="#fasilitas">Fasilitas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                </ul>
                <div class="d-flex gap-2">
                    <a href="{{ route('login') }}" class="btn btn-outline-brand btn-sm px-4">Admin/Guru</a>
                    <a href="{{ route('peserta.login') }}" class="btn btn-primary btn-sm px-4">Login Siswa</a>
                </div>
            </div>
        </div>
    </nav>

    {{-- HERO SECTION --}}
    <section id="beranda" class="pt-5 pb-5 mt-5 d-flex align-items-center" style="min-height: 85vh; background: linear-gradient(135deg, #fff 0%, #f3f0ff 100%);">
        <div class="container">
            <div class="row align-items-center flex-column-reverse flex-lg-row">
                {{-- Text Content --}}
                <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-right">
                    <div class="d-inline-block px-3 py-2 rounded-pill bg-white border border-primary text-primary fw-bold mb-3 small shadow-sm">
                        <i class="bi bi-stars me-1"></i> Penerimaan Siswa Baru Telah Dibuka!
                    </div>
                    <h1 class="display-4 fw-extra-bold lh-sm mb-3">
                        Membangun Generasi <br>
                        <span class="text-brand">Cerdas & Berkarakter</span>
                    </h1>
                    <p class="lead text-muted mb-4 pe-lg-5">
                        Selamat datang di website resmi {{ $schoolName }}. Kami berkomitmen memberikan pendidikan dasar terbaik dengan lingkungan yang aman, nyaman, dan menyenangkan bagi anak Anda.
                    </p>

                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('peserta.daftar') }}" class="btn btn-primary btn-lg shadow-lg">
                            <i class="bi bi-pencil-square me-2"></i> Daftar Sekarang
                        </a>
                        <a href="#ppdb" class="btn btn-outline-brand btn-lg">
                            <i class="bi bi-info-circle me-2"></i> Info Alur
                        </a>
                    </div>

                    <div class="row mt-5 g-3">
                        <div class="col-auto">
                            <div class="d-flex align-items-center gap-2">
                                <h1 class="fw-bold mb-0 text-brand">A</h1>
                                <div class="text-muted lh-1">Akreditasi<br>Sekolah</div>
                            </div>
                        </div>
                        <div class="col-auto border-start ps-3">
                            <div class="d-flex align-items-center gap-2">
                                <h1 class="fw-bold mb-0 text-brand">250+</h1>
                                <div class="text-muted lh-1">Siswa<br>Aktif</div>
                            </div>
                        </div>
                        <div class="col-auto border-start ps-3">
                            <div class="d-flex align-items-center gap-2">
                                <h1 class="fw-bold mb-0 text-brand">11</h1>
                                <div class="text-muted lh-1">Guru<br>Profesional</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Hero Image / Illustration --}}
                <div class="col-lg-6 position-relative text-center" data-aos="fade-left">
                    <div class="position-absolute top-50 start-50 translate-middle w-100 h-100 bg-primary opacity-10 rounded-circle" style="filter: blur(80px); z-index: -1;"></div>
                    
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?q=80&w=2022&auto=format&fit=crop" 
                             alt="Siswa SD Belajar" 
                             class="img-fluid rounded-5 shadow-lg position-relative z-1"
                             style="border: 8px solid rgba(255,255,255,0.6);">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FEATURES / KEUNGGULAN --}}
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="0">
                    <div class="card-modern p-4 h-100 text-center border-bottom border-4 border-primary">
                        <div class="icon-box-circle mx-auto bg-primary bg-opacity-10 text-primary">
                            <i class="bi bi-heart-pulse"></i>
                        </div>
                        <h5 class="fw-bold mt-3">Ramah Anak</h5>
                        <p class="text-muted">Lingkungan belajar yang inklusif, aman, dan memprioritaskan kenyamanan psikologis siswa.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-modern p-4 h-100 text-center border-bottom border-4 border-warning">
                        <div class="icon-box-circle mx-auto bg-warning bg-opacity-10 text-warning">
                            <i class="bi bi-lightbulb"></i>
                        </div>
                        <h5 class="fw-bold mt-3">Kreatif & Inovatif</h5>
                        <p class="text-muted">Metode pembelajaran yang merangsang kreativitas dan kemampuan berpikir kritis siswa.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-modern p-4 h-100 text-center border-bottom border-4 border-success">
                        <div class="icon-box-circle mx-auto bg-success bg-opacity-10 text-success">
                            <i class="bi bi-trophy"></i>
                        </div>
                        <h5 class="fw-bold mt-3">Berorientasi Prestasi</h5>
                        <p class="text-muted">Mendukung minat dan bakat siswa untuk meraih prestasi akademik maupun non-akademik.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- TENTANG --}}
    <section id="tentang" class="py-5 bg-soft">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 order-2 order-lg-1" data-aos="fade-right">
                    <div class="row g-3">
                        <div class="col-6">
                            <img src="https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&q=80&w=600" class="img-fluid rounded-4 shadow-sm w-100 mb-3" alt="Kegiatan 1">
                        </div>
                        <div class="col-6 mt-5">
                            <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&q=80&w=600" class="img-fluid rounded-4 shadow-sm w-100 mb-3" alt="Kegiatan 3">
                            <div class="p-4 bg-primary text-white rounded-4 text-center">
                                <div class="fw-bold fs-5">Visi</div>
                                <div class="opacity-75">Mewujudkan Siswa Berkarakter & Berprestasi</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left">
                    <span class="subtitle">Tentang Kami</span>
                    <h2 class="fw-extra-bold mb-4">Mengenal Lebih Dekat <br>{{ $schoolName }}</h2>
                    <p class="text-muted mb-4">
                        Kami percaya bahwa pendidikan dasar adalah pondasi terpenting dalam kehidupan. Di sini, kami tidak hanya mengajarkan calistung, tetapi juga menanamkan nilai-nilai moral, agama, dan kebangsaan.
                    </p>
                    
                    <ul class="list-unstyled">
                        <li class="d-flex align-items-start gap-3 mb-3">
                            <i class="bi bi-check-circle-fill text-success fs-5"></i>
                            <div>
                                <h6 class="fw-bold mb-0">Tenaga Pendidik Berkualitas</h6>
                                <span class="small text-muted">Guru yang sabar, tersertifikasi, dan berpengalaman.</span>
                            </div>
                        </li>
                        <li class="d-flex align-items-start gap-3 mb-3">
                            <i class="bi bi-check-circle-fill text-success fs-5"></i>
                            <div>
                                <h6 class="fw-bold mb-0">Kurikulum Terbaru</h6>
                                <span class="small text-muted">Menerapkan kurikulum yang relevan dengan perkembangan zaman.</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- PPDB ALUR SECTION (Highlight) --}}
    <section id="ppdb" class="py-5 position-relative overflow-hidden">
        {{-- Background Pattern --}}
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-white" style="z-index: -2;"></div>
        
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span class="subtitle">PPDB Online</span>
                <h2>Alur Pendaftaran Siswa Baru</h2>
                <p class="text-muted col-lg-6 mx-auto">Proses pendaftaran dirancang mudah dan transparan. Ikuti langkah berikut untuk bergabung dengan keluarga besar kami.</p>
            </div>

            <div class="row g-4 position-relative">
                @php
                    $steps = [
                        ['1', 'Daftar Akun', 'Isi nama & tanggal lahir untuk dapat No. Ujian', 'bi-person-plus-fill'],
                        ['2', 'Login Peserta', 'Masuk menggunakan No. Ujian & Tanggal Lahir', 'bi-box-arrow-in-right'],
                        ['3', 'Ujian Seleksi', 'Kerjakan soal tes potensi dasar secara online', 'bi-pencil-square'],
                        ['4', 'Pengumuman', 'Lihat hasil kelulusan secara realtime', 'bi-megaphone-fill'],
                    ];
                @endphp

                @foreach ($steps as $step)
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="text-center bg-white p-4 rounded-4 shadow-sm h-100 position-relative">
                            <div class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle fs-4 mb-3 shadow" style="width: 70px; height: 70px;">
                                <i class="bi {{ $step[3] }}"></i>
                            </div>
                            <h5 class="fw-bold">Langkah {{ $step[0] }}</h5>
                            <h6 class="fw-bold text-brand">{{ $step[1] }}</h6>
                            <p class="text-muted small mb-0">{{ $step[2] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-5" data-aos="zoom-in">
                <div class="p-4 bg-light rounded-4 border d-inline-block">
                    <h5 class="fw-bold mb-3">Siap untuk mendaftar?</h5>
                    <div class="d-flex gap-2 justify-content-center flex-wrap">
                        <a href="{{ route('peserta.daftar') }}" class="btn btn-primary btn-lg px-5">
                            <i class="bi bi-rocket-takeoff me-2"></i> Mulai Pendaftaran
                        </a>
                        <a href="{{ route('peserta.login') }}" class="btn btn-outline-secondary btn-lg px-5">
                            Login Peserta
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- PROGRAM --}}
    <section id="program" class="py-5 bg-soft">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span class="subtitle">Ekstrakurikuler & Program</span>
                <h2>Mengembangkan Potensi</h2>
            </div>

            <div class="row g-4">
                {{-- Card loop dengan variasi warna border --}}
                @php
                    $programs = [
                        ['Pramuka', 'Membentuk karakter mandiri, disiplin, dan cinta alam.', 'bi-compass', 'border-primary'],
                        ['Seni Tari & Musik', 'Menyalurkan bakat seni dan melestarikan budaya.', 'bi-music-note-beamed', 'border-danger'],
                        ['Dokter Kecil (UKS)', 'Edukasi kesehatan dan pertolongan pertama.', 'bi-bandaid', 'border-success'],
                        ['Olahraga', 'Futsal, Bulutangkis, dan Senam untuk fisik yang kuat.', 'bi-dribbble', 'border-warning'],
                        ['Tahfidz Qur\'an', 'Program unggulan hafalan surat-surat pendek.', 'bi-book-half', 'border-info'],
                        ['Komputer Dasar', 'Pengenalan teknologi sejak dini.', 'bi-laptop', 'border-dark'],
                    ];
                @endphp

                @foreach ($programs as $prog)
                    <div class="col-md-6 col-lg-4" data-aos="fade-up">
                        <div class="card-modern p-4 h-100 {{ $prog[3] }} border-start border-4 rounded-3">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <i class="bi {{ $prog[2] }} fs-5 text-primary"></i>
                                <h5 class="fw-bold mb-0">{{ $prog[0] }}</h5>
                            </div>
                            <p class="text-muted mb-0">{{ $prog[1] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- FASILITAS (Grid Layout) --}}
    <section id="fasilitas" class="py-5">
        <div class="container">
            <div class="section-header">
                <span class="subtitle">Sarana Prasarana</span>
                <h2>Fasilitas Sekolah</h2>
            </div>
            
            <div class="row g-3">
                <div class="col-lg-8" data-aos="zoom-in">
                    <div class="position-relative overflow-hidden rounded-4 h-100 group-hover-zoom">
                        <img src="https://images.unsplash.com/photo-1580582932707-520aed937b7b?auto=format&fit=crop&q=80&w=1000" class="w-100 h-100 object-fit-cover" alt="Ruang Kelas" style="min-height: 300px;">
                        <div class="position-absolute bottom-0 start-0 w-100 p-4 bg-gradient-to-t">
                            <h5 class="text-white fw-bold mb-0 text-shadow">Ruang Kelas Nyaman</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row g-3 h-100">
                        <div class="col-12" data-aos="zoom-in" data-aos-delay="100">
                            <div class="position-relative overflow-hidden rounded-4 h-100">
                                <img src="https://images.unsplash.com/photo-1481627834876-b7833e8f5570?auto=format&fit=crop&q=80&w=600" class="w-100 h-100 object-fit-cover" alt="Perpustakaan">
                                <div class="position-absolute bottom-0 start-0 w-100 p-3 bg-dark bg-opacity-50">
                                    <h6 class="text-white fw-bold mb-0">Perpustakaan</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-12" data-aos="zoom-in" data-aos-delay="200">
                            <div class="position-relative overflow-hidden rounded-4 h-100">
                                <img src="https://images.unsplash.com/photo-1562774053-701939374585?auto=format&fit=crop&q=80&w=600" class="w-100 h-100 object-fit-cover" alt="Lapangan">
                                <div class="position-absolute bottom-0 start-0 w-100 p-3 bg-dark bg-opacity-50">
                                    <h6 class="text-white fw-bold mb-0">Halaman Luas</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FAQ ACCORDION --}}
    <section class="py-5 bg-white border-top">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold">Pertanyaan Sering Diajukan</h3>
                    </div>
                    <div class="accordion accordion-flush" id="faqAcc">
                        @php
                            $faqs = [
                                ['Bagaimana cara mendaftar?', 'Klik tombol "Daftar Seleksi", isi formulir singkat, dan Anda akan mendapatkan Nomor Ujian.'],
                                ['Apakah tes dilakukan di sekolah?', 'Saat ini tes dilakukan secara online melalui website ini yang bisa diakses lewat HP atau Laptop.'],
                                ['Apa saja syarat pendaftaran ulang?', 'Membawa Fotokopi Akta Kelahiran, KK, KTP Orang Tua, dan pas foto (detail akan diinfokan setelah lulus).'],
                            ];
                        @endphp
                        @foreach($faqs as $idx => $f)
                        <div class="accordion-item border mb-3 rounded-3 overflow-hidden shadow-sm">
                            <h2 class="accordion-header">
                                <button class="accordion-button {{ $idx!=0?'collapsed':'' }} fw-bold bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{$idx}}">
                                    {{ $f[0] }}
                                </button>
                            </h2>
                            <div id="faq{{$idx}}" class="accordion-collapse collapse {{ $idx==0?'show':'' }}" data-bs-parent="#faqAcc">
                                <div class="accordion-body text-muted">
                                    {{ $f[1] }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- KONTAK & FOOTER --}}
    <footer id="kontak" class="bg-dark text-white pt-5">
        <div class="container pb-5">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h4 class="fw-bold text-white mb-3">{{ $schoolName }}</h4>
                    <p class="text-light">
                        Mewujudkan pendidikan yang berkualitas untuk generasi masa depan yang cerdas dan berakhlak mulia.
                    </p>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-sm btn-outline-light rounded-pill"><i class="bi bi-facebook fs-4"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-light rounded-pill"><i class="bi bi-instagram fs-4"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-light rounded-pill"><i class="bi bi-youtube fs-4"></i></a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h5 class="fw-bold text-white mb-3">Kontak Kami</h5>
                    <ul class="list-unstyled text-light">
                        <li class="mb-2"><i class="bi bi-geo-alt me-2"></i> Jl. Raya Teluk Pandan, Pesawaran</li>
                        <li class="mb-2"><i class="bi bi-telephone me-2"></i> (0721) 123-4567</li>
                        <li class="mb-2"><i class="bi bi-whatsapp me-2"></i> 0812-3456-7890</li>
                        <li class="mb-2"><i class="bi bi-envelope me-2"></i> info@sdn7telukpandan.sch.id</li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5 class="fw-bold text-white mb-3">Akses Cepat</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('peserta.daftar') }}" class="text-light text-decoration-none hover-white">Daftar Seleksi</a></li>
                        <li class="mb-2"><a href="{{ route('peserta.login') }}" class="text-light text-decoration-none hover-white">Login Peserta</a></li>
                        <li class="mb-2"><a href="{{ route('login') }}" class="text-light text-decoration-none hover-white">Login Guru/Admin</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="bg-black bg-opacity-20 py-3 text-center text-light small">
            &copy; {{ date('Y') }} {{ $schoolName }}. All Rights Reserved.
        </div>
    </footer>

    {{-- Sticky CTA Button for Mobile --}}
    <div class="sticky-cta d-lg-none">
        <a href="{{ route('peserta.daftar') }}" class="btn btn-primary rounded-pill shadow-lg px-4">
            <i class="bi bi-pencil-square me-1"></i> Daftar
        </a>
    </div>
@endsection