@extends('siswa.base')

@section('title', 'Hasil Ujian')

@push('style')
    <style>
        body {
            background-color: #f0f7ff;
        }
        .fw-black { font-weight: 900; }
        .display-2 { font-size: 5rem; }
        
        .border-dashed { border-style: dashed !important; }

        .card {
            border: 8px solid white;
        }
    </style>
@endpush

@section('content')
<div class="container d-flex align-items-center justify-content-center py-5" style="min-height: 90vh">
    <div class="col-12 col-md-8 col-lg-6">

        <div class="card border-0 rounded-4 overflow-hidden animate__animated animate__zoomIn">
            <div class="{{ $hasil->lulus ? 'bg-success' : 'bg-warning' }} p-4 text-center text-white position-relative">
                <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10" style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>
                <h3 class="fw-bold mb-0 position-relative text-white">Hasil Ujian Kamu</h3>
            </div>

            <div class="card-body text-center p-4 p-md-5">
                
                <div class="mb-4">
                    @if($hasil->lulus)
                        <div class="display-1 mb-2 animate__animated animate__tada animate__infinite">🏆</div>
                        <h2 class="fw-black text-success mb-1">HEBAT!</h2>
                    @else
                        <div class="display-1 mb-2 animate__animated animate__pulse animate__infinite">💪</div>
                        <h2 class="fw-black text-warning mb-1">SEMANGAT!</h2>
                    @endif
                </div>

                <div class="bg-light rounded-4 p-4 mb-4 border border-2 border-primary-subtle shadow-sm">
                    <p class="text-muted fw-bold mb-1">Jumlah Jawaban Benar:</p>
                    <div class="display-2 fw-black text-primary mb-0" style="line-height: 1;">
                        {{ $hasil->jumlah_benar }}
                    </div>
                    <p class="text-primary-emphasis fw-medium mt-2 mb-0">Wah, kamu pintar sekali! 🌟</p>
                </div>

                @if($hasil->lulus)
                    <div class="alert alert-success border-0 rounded-4 p-3 mb-4">
                        <p class="fs-5 mb-0">
                            Selamat ya, kamu dinyatakan <strong>LULUS</strong> seleksi! 🥳
                        </p>
                    </div>

                    <div class="d-grid gap-3">
                        <a href="{{ route('siswa.pendaftaran') }}"
                           class="btn btn-success btn-lg rounded-4 py-3 fs-5 fw-bold shadow-sm animate__animated animate__pulse animate__infinite">
                            Ayo Daftar Sekarang!
                        </a>
                    </div>

                    @if ($hasil->siswa->pendaftaran()->exists())
                        <form action="{{ route('siswa.logout') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger rounded-pill mt-4 px-4 fw-bold">
                                <i class="ti ti-logout me-1"></i> Keluar
                            </button>
                        </form>
                    @endif
                @else
                    <div class="alert alert-warning border-0 rounded-4 p-3 shadow-sm mb-4 text-dark">
                        <p class="mb-0">
                            Terima kasih sudah mencoba ya. Kamu sudah melakukan yang terbaik!
                        </p>
                    </div>

                    <div class="p-3 rounded-4 bg-light border border-dashed border-2">
                        <p class="text-muted small mb-0">
                            Minta tolong Ayah atau Bunda untuk menghubungi Bapak/Ibu Guru di sekolah ya untuk informasi selanjutnya. 😊
                        </p>
                    </div>
                    
                    <form action="{{ route('siswa.logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger rounded-pill mt-4 px-4 fw-bold">
                            <i class="ti ti-logout me-1"></i> Keluar
                        </button>
                    </form>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
    @if($hasil->lulus)
        <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
        <script>
            var count = 200;
            var defaults = {
            origin: { y: 0.7 },
            zIndex: 9999
            };

            function fire(particleRatio, opts) {
            confetti({
                ...defaults,
                ...opts,
                particleCount: Math.floor(count * particleRatio)
            });
            }

            fire(0.25, { spread: 26, startVelocity: 55, });
            fire(0.2, { spread: 60, });
            fire(0.35, { spread: 100, decay: 0.91, scalar: 0.8 });
            fire(0.1, { spread: 120, startVelocity: 25, decay: 0.92, scalar: 1.2 });
            fire(0.1, { spread: 120, startVelocity: 45, });
        </script>
    @endif
@endpush