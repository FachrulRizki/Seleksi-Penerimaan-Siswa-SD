@extends('admin.base')

@section('title', 'Dashboard')

@push('style')
    <style>
    .btn-white {
        background: #fff;
        color: #5D87FF;
        border: 1px solid #fff;
    }
    .btn-white:hover {
        background: #f1f3f9;
        color: #4570EA;
    }
    .fs-7 {
        font-size: 1.5rem !important;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="card w-100 bg-primary-subtle overflow-hidden shadow-none mb-4">
        <div class="card-body position-relative">
            <div class="row align-items-center">
                <div class="col-sm-7">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle overflow-hidden me-3 shadow-sm" style="width: 50px; height: 50px; border: 3px solid #fff;">
                            <img src="https://ui-avatars.com/api/?name={{ Auth::guard('admin')->user()->nama }}&background=5D87FF&color=fff" 
                                 alt="user-img" class="img-fluid">
                        </div>
                        <div>
                            <h4 class="fw-bold mb-1">Selamat Datang, {{ Auth::guard('admin')->user()->nama }}! 👋</h4>
                            <p class="text-dark mb-0 opacity-75">Pantau progres seleksi siswa hari ini.</p>
                        </div>
                    </div>
                    <div class="d-flex gap-3 mt-4">
                        <a href="{{ route('admin.soal.index') }}" class="btn btn-primary px-4 shadow-sm">
                            <i class="ti ti-books me-1"></i> Kelola Soal
                        </a>
                        <a href="{{ route('admin.peserta.index') }}" class="btn btn-white px-4 shadow-sm">
                            <i class="ti ti-users me-1"></i> Data Peserta Ujian
                        </a>
                    </div>
                </div>
                <div class="col-sm-5 d-none d-sm-block">
                    <div class="welcome-bg-img text-end">
                        <img src="{{ asset('assets/images/backgrounds/banner.png') }}" alt="welcome" class="img-fluid mb-n4" style="max-height: 200px;">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <p class="text-muted fw-medium mb-1">Total Peserta</p>
                            <h3 class="fw-bold mb-0">{{ number_format($stats['total_siswa']) }}</h3>
                        </div>
                        <div class="bg-primary-subtle text-primary rounded-3 p-2">
                            <i class="ti ti-users fs-7"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="progress bg-primary-subtle" style="height: 6px;">
                            <div class="progress-bar bg-primary" style="width: 100%"></div>
                        </div>
                        <small class="text-muted d-block mt-2">Total siswa terdaftar</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <p class="text-muted fw-medium mb-1">Sudah Ujian</p>
                            <h3 class="fw-bold mb-0 text-warning">{{ number_format($stats['sudah_ujian']) }}</h3>
                        </div>
                        <div class="bg-warning-subtle text-warning rounded-3 p-2">
                            <i class="ti ti-edit fs-7"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        @php $percentUjian = $stats['total_siswa'] > 0 ? ($stats['sudah_ujian'] / $stats['total_siswa']) * 100 : 0; @endphp
                        <div class="progress bg-warning-subtle" style="height: 6px;">
                            <div class="progress-bar bg-warning" style="width: {{ $percentUjian }}%"></div>
                        </div>
                        <small class="text-muted d-block mt-2">{{ round($percentUjian) }}% dari total peserta</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <p class="text-muted fw-medium mb-1">Lulus Seleksi</p>
                            <h3 class="fw-bold mb-0 text-success">{{ number_format($stats['lulus_seleksi']) }}</h3>
                        </div>
                        <div class="bg-success-subtle text-success rounded-3 p-2">
                            <i class="ti ti-certificate fs-7"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        @php $percentLulus = $stats['sudah_ujian'] > 0 ? ($stats['lulus_seleksi'] / $stats['sudah_ujian']) * 100 : 0; @endphp
                        <div class="progress bg-success-subtle" style="height: 6px;">
                            <div class="progress-bar bg-success" style="width: {{ $percentLulus }}%"></div>
                        </div>
                        <small class="text-muted d-block mt-2">{{ round($percentLulus) }}% dari peserta ujian</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <p class="text-muted fw-medium mb-1">Daftar Ulang</p>
                            <h3 class="fw-bold mb-0 text-info">{{ number_format($stats['sudah_pendaftaran']) }}</h3>
                        </div>
                        <div class="bg-info-subtle text-info rounded-3 p-2">
                            <i class="ti ti-user-check fs-7"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        @php $percentDaftar = $stats['lulus_seleksi'] > 0 ? ($stats['sudah_pendaftaran'] / $stats['lulus_seleksi']) * 100 : 0; @endphp
                        <div class="progress bg-info-subtle" style="height: 6px;">
                            <div class="progress-bar bg-info" style="width: {{ $percentDaftar }}%"></div>
                        </div>
                        <small class="text-muted d-block mt-2">{{ round($percentDaftar) }}% dari siswa lulus</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection