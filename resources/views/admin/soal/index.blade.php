@extends('admin.base')

@section('title', 'Bank Soal')

@section('content')
    <div class="container-fluid mb-4" id="app">
        <div class="card bg-primary-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Bank Soal</h4>
                        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '/'">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted text-decoration-none"
                                        href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active text-primary" aria-current="page">Bank Soal</li>
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

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <div class="d-flex gap-2 justify-content-start">
                    <i class="ti ti-circle-check-filled text-success fs-6"></i>
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

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
                <form action="" method="get">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('admin.soal.create') }}" class="btn btn-primary">
                                <i class="ti ti-plus me-1 ms-n1"></i> Tambah Soal
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row g-3">
            @forelse ($soal as $item)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100">
                        <div class="card-body p-4 pb-2">
                            <div class="position-relative">
                                <img src="{{ asset('storage/' . $item->gambar_soal) }}" class="card-img-top rounded"
                                    style="height: 180px; object-fit: cover;" alt="Gambar Soal">

                                <span class="badge bg-primary position-absolute top-0 start-0 m-2">
                                    #{{ ($soal->currentPage() - 1) * $soal->perPage() + $loop->iteration }}
                                </span>
                            </div>

                            <div class="row g-2 mt-3">
                                <div class="col-lg-6">
                                    <a href="{{ route('admin.soal.edit', $item->id) }}" class="btn btn-warning w-100"
                                        data-bs-toggle="tooltip" title="Edit Soal">
                                        <i class="ti ti-edit me-1"></i> Edit
                                    </a>
                                </div>
                                <div class="col-lg-6">
                                    <form action="{{ route('admin.soal.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger w-100" data-bs-toggle="tooltip"
                                            title="Hapus Soal"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus soal ini?')">
                                            <i class="ti ti-trash me-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-secondary text-center">
                        Belum ada soal yang ditambahkan.
                    </div>
                </div>
            @endforelse
        </div>
        <div class="mt-4">
            {{ $soal->appends(['search' => request('search')])->links() }}
        </div>
    </div>
@endsection
