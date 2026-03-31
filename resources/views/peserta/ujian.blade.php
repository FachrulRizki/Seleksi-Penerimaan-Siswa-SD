@extends('peserta.base')

@section('title', 'Ujian Seleksi')

@push('style')
    <style>
        body {
            background-color: #f0f7ff;
            padding-bottom: 80px;
        }

        .small-mobile-text {
            font-size: 0.9rem;
        }

        .option-text {
            font-size: 1.1rem;
        }

        @media (min-width: 768px) {
            .small-mobile-text {
                font-size: 1.25rem;
            }

            .option-text {
                font-size: 1.4rem;
            }

            body {
                padding-bottom: 0;
            }

            .nav-container {
                position: relative;
                box-shadow: none !important;
                border: none !important;
                padding: 0 !important;
            }
        }

        @media (max-width: 767.98px) {
            .nav-container {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                z-index: 1030;
            }

            .image-frame img {
                max-height: 200px !important;
            }
        }

        .btn-option {
            background-color: #fff;
            border: 3px solid #f1f3f9;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .btn-check:checked+.btn-option {
            background-color: #ecf2ff;
            border-color: #5D87FF;
            transform: scale(0.98);
        }

        .label-circle-mobile {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 800;
            font-size: 1.2rem;
            flex-shrink: 0;
            box-shadow: 0 3px 0 rgba(0, 0, 0, 0.1);
        }

        @media (min-width: 768px) {
            .label-circle-mobile {
                width: 50px;
                height: 50px;
                font-size: 1.5rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid py-2 px-3 py-md-4">
        <div class="row justify-content-center mb-3 mb-md-4">
            <div class="col-12 col-md-8">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="fw-bold text-primary small-mobile-text">Soal Nomor {{ $nomor }}</span>
                    <span class="badge bg-danger text-white px-3 py-2 rounded-pill shadow-sm">
                        ⏱ <span id="timer">00:00</span>
                    </span>
                    <span class="badge rounded-pill bg-warning text-dark px-2 px-md-3 py-2 shadow-sm">
                        🌟 {{ $nomor }}/{{ $totalSoal }}
                    </span>
                </div>
                <div class="progress rounded-pill shadow-sm" style="height: 15px; background-color: #e9ecef;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar"
                        style="width: {{ ($nomor / $totalSoal) * 100 }}%">
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card border-0 rounded-4 rounded-md-5 overflow-hidden">
                    <div class="card-body p-3 p-md-5">
                        @error('opsi_jawaban_id')
                            <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4 animate__animated animate__shakeX"
                                role="alert">
                                <div class="d-flex align-items-center">
                                    <span class="fs-4 me-2">⚠️</span>
                                    <strong class="text-danger">Waduh! Pilih salah satu jawaban dulu ya... 😊</strong>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror

                        <div class="text-center mb-4">
                            <div
                                class="image-frame p-2 p-md-3 bg-light rounded-4 border border-4 border-primary-subtle shadow-sm">
                                <img src="{{ asset('storage/' . $soal->gambar_soal) }}" class="img-fluid rounded-3"
                                    style="max-height: 250px; width: auto; object-fit: contain;" alt="Gambar Soal">
                            </div>
                        </div>

                        <form method="POST" action="{{ route('peserta.ujian.submit') }}" id="formUjian">
                            @csrf
                            <input type="hidden" name="soal_id" value="{{ $soal->id }}">
                            <input type="hidden" name="nomor" value="{{ $nomor }}">

                            <div class="row g-3 g-md-4">
                                @foreach ($soal->opsiJawaban as $key => $opsi)
                                    @php
                                        $colors = ['#FF6B6B', '#4ECDC4', '#FFD93D', '#6BCB77'];
                                        $labels = ['A', 'B', 'C', 'D'];
                                    @endphp
                                    <div class="col-12 col-md-6">
                                        <input type="radio" name="opsi_jawaban_id" id="opsi_{{ $opsi->id }}"
                                            value="{{ $opsi->id }}" class="btn-check" @checked(optional($jawaban)->opsi_jawaban_id == $opsi->id)>

                                        <label
                                            class="btn-option d-flex align-items-center w-100 p-2 p-md-3 rounded-4 border-3 shadow-sm"
                                            for="opsi_{{ $opsi->id }}">
                                            <div class="label-circle-mobile me-2 me-md-3"
                                                style="background-color: {{ $colors[$key] ?? '#5D87FF' }}">
                                                {{ $labels[$key] }}
                                            </div>
                                            <span class="option-text fw-bold text-dark">{{ $opsi->teks_opsi }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="py-4 py-md-5"></div>

                            <div
                                class="nav-container d-flex justify-content-between align-items-center bg-white p-3 border-top shadow-lg">
                                @if ($nomor > 1)
                                    <a href="{{ route('peserta.ujian.show', $nomor - 1) }}"
                                        class="btn bg-primary-subtle text-primary rounded-pill px-3 py-2 fw-bold">
                                        <i class="ti ti-arrow-left"></i> <span
                                            class="d-none d-sm-inline ms-1">Sebelumnya</span>
                                    </a>
                                @else
                                    <div style="width: 50px;"></div>
                                @endif

                                <button type="submit"
                                    onclick="document.getElementsByName('nomor')[0].value={{ $nomor + 1 }}"
                                    class="btn {{ $nomor < $totalSoal ? 'btn-primary' : 'btn-success' }} btn-lg rounded-pill px-4 px-md-5 py-2 py-md-3 fs-5 fw-bold btn-next-mobile">
                                    {{ $nomor < $totalSoal ? 'Lanjut' : 'Selesai' }}
                                    <i
                                        class="ti {{ $nomor < $totalSoal ? 'ti-arrow-right' : 'ti-circle-check' }} ms-1"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
window.onload = function () {

    console.log("TIMER START");

    const DURASI = 30 * 60;

    const waktuMulaiStr = "{{ optional($hasil->waktu_mulai)->timestamp }}";
    const waktuMulai = parseInt(waktuMulaiStr);

    const timerEl = document.getElementById('timer');

    console.log("waktuMulai:", waktuMulai);
    console.log("element:", timerEl);

    if (!waktuMulai || !timerEl) {
        console.error("Timer gagal start");
        return;
    }

    function updateTimer() {
        const sekarang = Math.floor(Date.now() / 1000);
        const sisa = DURASI - (sekarang - waktuMulai);

        if (sisa <= 0) {
            timerEl.innerHTML = "00:00";
            alert("Waktu habis!");
            document.getElementById('formUjian').submit();
            return;
        }

        const menit = Math.floor(sisa / 60);
        const detik = sisa % 60;

        timerEl.innerHTML =
            String(menit).padStart(2, '0') + ":" +
            String(detik).padStart(2, '0');
    }

    setInterval(updateTimer, 1000);
    updateTimer();
};
</script>
@endpush
