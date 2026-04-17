@extends('admin.base')

@section('title', 'Detail Peserta Ujian')

@push('style')
    <style>
        .bg-light-primary { background-color: #ecf2ff; }
        .bg-light-subtle { background-color: #fafbfb; }
        .fs-10 { font-size: 3.5rem !important; }
        .btn-white {
            background: white;
            transition: all 0.2s ease;
        }
        .btn-white:hover {
            background: #f8f9fa;
            transform: translateY(-2px);
        }
        .border-dashed { border-style: dashed !important; }
    </style>
@endpush

@section('content')
<div class="container-fluid">
    @php
        $hasilUjian = $peserta->hasilUjian;
        $hasHasilUjian = !is_null($hasilUjian);
        $isSelesaiUjian = $hasHasilUjian && !is_null($hasilUjian->waktu_selesai);
        $isLulus = $isSelesaiUjian && $hasilUjian->lulus;

        $statusColor = !$hasHasilUjian ? 'warning' : (!$isSelesaiUjian ? 'info' : ($isLulus ? 'success' : 'danger'));
        $statusText = !$hasHasilUjian ? 'Belum Ujian' : (!$isSelesaiUjian ? 'Sedang Ujian' : ($isLulus ? 'LULUS' : 'TIDAK LULUS'));

        $durasiDetik = null;
        if ($hasilUjian?->waktu_mulai) {
            $durasiDetik = $hasilUjian->waktu_mulai->diffInSeconds($hasilUjian->waktu_selesai ?? now());
        }

        $durasiPengerjaan = $durasiDetik !== null
            ? sprintf(
                '%02d:%02d:%02d',
                intdiv($durasiDetik, 3600),
                intdiv($durasiDetik % 3600, 60),
                $durasiDetik % 60
            )
            : '-';
    @endphp

    <div class="card bg-primary-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Detail Peserta Ujian</h4>
                    <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '/'">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="{{ route('admin.peserta.index') }}">Data Peserta Ujian</a></li>
                            <li class="breadcrumb-item active text-primary" aria-current="page">{{ $peserta->nomor_ujian }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-3">
                    <div class="text-end mb-n5">
                        <img src="{{ asset('assets/images/backgrounds/banner.png') }}" class="img-fluid" style="width: 180px">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="card overflow-hidden shadow-sm">
                <div class="bg-{{ $statusColor }}" style="height: 10px;"></div>
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <div class="bg-light-primary d-inline-block rounded-circle p-3">
                            <i class="ti ti-user fs-10 text-primary"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-1">{{ $peserta->nama_lengkap }}</h5>
                    <p class="text-muted mb-3">{{ $peserta->nomor_ujian }}</p>
                    <span class="badge bg-{{ $statusColor }}-subtle text-{{ $statusColor }} fs-3 px-3 py-2 rounded-pill fw-bold">
                        {{ $statusText }}
                    </span>
                </div>
                <div class="border-top p-3 bg-light-subtle">
                    <div class="row text-center">
                        <div class="col-6 border-end">
                            <h6 class="mb-0 fw-bold">Benar</h6>
                            <p class="mb-0 text-muted">{{ $isSelesaiUjian ? $hasilUjian->jumlah_benar : '-' }}</p>
                        </div>
                        <div class="col-6">
                            <h6 class="mb-0 fw-bold">Daftar Ulang</h6>
                            <p class="mb-0 text-muted">{{ $peserta->pendaftaran ? 'Sudah' : 'Belum' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-grid gap-2 mb-4">
                <a href="{{ route('admin.peserta.index') }}" class="btn btn-outline-primary fw-semibold">
                    <i class="ti ti-arrow-left me-1"></i> Kembali ke Daftar
                </a>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0 d-flex align-items-center">
                        <i class="ti ti-award text-warning me-2 fs-5"></i> Hasil Ujian Seleksi
                    </h5>
                </div>
                <div class="card-body">
                    @if ($isSelesaiUjian)
                        <div class="d-flex align-items-center p-3 border rounded bg-light-subtle mb-3">
                            <div class="bg-white rounded p-3 shadow-sm text-center me-4" style="min-width: 100px;">
                                <div class="text-muted small">Skor Benar</div>
                                <h2 class="mb-0 fw-bold text-primary">{{ $hasilUjian->jumlah_benar }}</h2>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Status Kelulusan</h6>
                                <p class="mb-0 text-muted small">
                                    {{ $hasilUjian->lulus
                                        ? 'Selamat! Peserta dinyatakan memenuhi ambang batas nilai.' 
                                        : 'Maaf, peserta belum memenuhi kriteria kelulusan seleksi.' }}
                                </p>
                            </div>
                        </div>
                    @elseif ($hasHasilUjian)
                        <div class="alert alert-info border-0 d-flex align-items-center mb-3 shadow-none">
                            <i class="ti ti-clock-play text-info fs-6 me-3"></i>
                            <div>
                                <h6 class="mb-1 fw-bold">Ujian Sedang Berlangsung</h6>
                                <p class="mb-0 text-muted small">Peserta sudah memulai ujian, tetapi belum menyelesaikannya.</p>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-4 bg-light rounded border border-dashed">
                            <i class="ti ti-hourglass-empty fs-7 text-muted mb-2 d-block"></i>
                            <p class="mb-0 text-muted">Belum ada data hasil ujian untuk peserta ini.</p>
                        </div>
                    @endif

                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="border rounded p-3 h-100 bg-light-subtle">
                                <div class="text-muted small mb-1">Waktu Mulai</div>
                                <h6 class="mb-0 fw-semibold">
                                    {{ $hasilUjian?->waktu_mulai ? $hasilUjian->waktu_mulai->translatedFormat('d F Y, H:i:s') : '-' }}
                                </h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border rounded p-3 h-100 bg-light-subtle">
                                <div class="text-muted small mb-1">Waktu Selesai</div>
                                <h6 class="mb-0 fw-semibold">
                                    {{ $hasilUjian?->waktu_selesai ? $hasilUjian->waktu_selesai->translatedFormat('d F Y, H:i:s') : '-' }}
                                </h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border rounded p-3 h-100 bg-light-subtle">
                                <div class="text-muted small mb-1">Durasi Pengerjaan</div>
                                <h6 class="mb-0 fw-semibold">{{ $durasiPengerjaan }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0 d-flex align-items-center">
                        <i class="ti ti-file-description text-primary me-2 fs-5"></i> Data Pendaftaran Ulang
                    </h5>
                </div>
                <div class="card-body">
                    @if ($peserta->pendaftaran)
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="text-muted small d-block mb-1">Nama Orang Tua / Wali</label>
                                <h6 class="fw-semibold mb-0">{{ $peserta->pendaftaran->nama_orang_tua }}</h6>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small d-block mb-1">Alamat Tinggal</label>
                                <h6 class="fw-semibold mb-0">{{ $peserta->pendaftaran->alamat }}</h6>
                            </div>
                            <div class="col-12 mt-4">
                                <div class="p-3 border rounded bg-primary-subtle">
                                    <h6 class="fw-bold text-primary mb-3">Lampiran Dokumen</h6>
                                    <div class="d-flex gap-2">
                                        <a href="{{ asset('storage/' . $peserta->pendaftaran->file_akta) }}" target="_blank" 
                                           class="btn btn-white shadow-sm border-0 flex-grow-1 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-pdf me-2 text-danger fs-5"></i> Akta Kelahiran
                                        </a>
                                        <a href="{{ asset('storage/' . $peserta->pendaftaran->file_kk) }}" target="_blank" 
                                           class="btn btn-white shadow-sm border-0 flex-grow-1 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-files me-2 text-info fs-5"></i> Kartu Keluarga
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-light border-0 d-flex align-items-center mb-0 shadow-none">
                            <i class="ti ti-alert-circle text-muted fs-6 me-3"></i>
                            <div>
                                <h6 class="mb-1 fw-bold">Belum Daftar Ulang</h6>
                                <p class="mb-0 text-muted small">Peserta belum mengisi formulir pendaftaran ulang dan mengunggah dokumen.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
