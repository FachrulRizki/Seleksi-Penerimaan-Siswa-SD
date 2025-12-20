@extends('admin.base')

@section('title', 'Edit Siswa')
    
@section('content')
    <div class="container-fluid">
        <div class="card bg-primary-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Edit Siswa</h4>
                        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '/'">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted text-decoration-none" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a class="text-muted text-decoration-none" href="{{ route('admin.siswa.index') }}">Data Siswa</a>
                                </li>
                                <li class="breadcrumb-item active text-primary" aria-current="page">Edit Siswa</li>
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

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <div class="d-flex gap-2 justify-content-start">
                    <i class="ti ti-circle-x-filled text-danger fs-6"></i>
                    {{ session('error') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.siswa.update', $siswa->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" placeholder="Budiono Siregar" value="{{ old('nama_lengkap', $siswa->nama_lengkap) }}">
                        @error('nama_lengkap')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('admin.siswa.index') }}" class="btn bg-primary-subtle text-primary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection