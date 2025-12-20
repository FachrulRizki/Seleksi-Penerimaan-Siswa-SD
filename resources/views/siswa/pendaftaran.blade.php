@extends('siswa.base')

@section('title', 'Pendaftaran')

@push('style')
    <style>
        body {
            background-color: #f0f7ff;
            min-height: 100vh;
        }
        .form-control:focus {
            border-color: #5D87FF;
            box-shadow: 0 0 0 0.25rem rgba(93, 135, 255, 0.1);
            background-color: #fff;
        }
        .bg-light-subtle {
            background-color: #f8fbff;
            border: 2px dashed #d1e3ff !important;
        }
        .input-group-text {
            border-color: #dee2e6;
        }
    </style>
@endpush

@section('content')
<div class="container py-4 py-md-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            
            <div class="text-center mb-4 d-none d-md-block">
                <div class="d-flex justify-content-center align-items-center gap-2">
                    <span class="badge rounded-circle bg-success p-2"><i class="ti ti-check fs-4"></i></span>
                    <div style="width: 50px; height: 2px; background: #13deb9;"></div>
                    <span class="badge rounded-circle bg-primary p-2"><i class="ti ti-number-2 fs-4"></i></span>
                    <h6 class="mb-0 fw-bold text-primary ms-2">Lengkapi Data Pendaftaran</h6>
                </div>
            </div>

            <div class="card border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-primary p-4 text-white text-center border-0">
                    <h4 class="fw-bold mb-1 text-white">Formulir Pendaftaran</h4>
                    <p class="mb-0 opacity-75 small">Silakan lengkapi data Ananda untuk menyelesaikan proses pendaftaran</p>
                </div>
                
                <div class="card-body p-4 p-md-5">
                    @if(session('error'))
                        <div class="alert alert-danger border-0 shadow-sm rounded-3 d-flex align-items-center">
                            <i class="ti ti-alert-circle me-2 fs-5"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('siswa.pendaftaran.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label fw-bold text-dark">Nama Lengkap Orang Tua / Wali</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="ti ti-user text-muted"></i></span>
                                    <input type="text" name="nama_orang_tua" 
                                           class="form-control border-start-0 bg-light @error('nama_orang_tua') is-invalid @enderror" 
                                           placeholder="Contoh: Budi Santoso" 
                                           value="{{ old('nama_orang_tua') }}" required>
                                </div>
                                @error('nama_orang_tua')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold text-dark">Alamat Tinggal Lengkap</label>
                                    <textarea name="alamat" rows="3" 
                                              class="form-control bg-light @error('alamat') is-invalid @enderror" 
                                              placeholder="Jl. Melati No. 123, RT 01/02, Kecamatan..." required>{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="p-3 border rounded-4 bg-light-subtle shadow-sm h-100">
                                    <label class="form-label fw-bold text-primary d-flex align-items-center">
                                        <i class="ti ti-file-description me-2"></i> Akta Kelahiran
                                    </label>
                                    <input type="file" name="file_akta" 
                                           class="form-control @error('file_akta') is-invalid @enderror" 
                                           accept=".jpg,.png,.pdf" required>
                                    <div class="mt-2 text-muted" style="font-size: 0.75rem;">
                                        *Format: JPG, PNG, atau PDF (Maks. 2MB)
                                    </div>
                                    @error('file_akta')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="p-3 border rounded-4 bg-light-subtle shadow-sm h-100">
                                    <label class="form-label fw-bold text-primary d-flex align-items-center">
                                        <i class="ti ti-files me-2"></i> Kartu Keluarga (KK)
                                    </label>
                                    <input type="file" name="file_kk" 
                                           class="form-control @error('file_kk') is-invalid @enderror" 
                                           accept=".jpg,.png,.pdf" required>
                                    <div class="mt-2 text-muted" style="font-size: 0.75rem;">
                                        *Format: JPG, PNG, atau PDF (Maks. 2MB)
                                    </div>
                                    @error('file_kk')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-5">
                            <button type="submit" class="btn btn-primary btn-lg w-100 rounded-4 py-3 fs-5 fw-bold">
                                <i class="ti ti-send me-1"></i> Kirim Sekarang
                            </button>
                            <p class="text-center text-muted mt-3 small">
                                <i class="ti ti-lock-access me-1"></i> Data Anda aman dan terenkripsi dalam sistem kami.
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection