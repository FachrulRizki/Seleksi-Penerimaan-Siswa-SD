@extends('admin.base')

@section('title', 'Kelas & Siswa')

@section('content')
    <div class="container-fluid">
        <div class="card bg-primary-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Kelas & Siswa</h4>
                        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '/'">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted text-decoration-none" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active text-primary" aria-current="page">Kelas & Siswa</li>
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

        <div class="row g-3">
            @forelse($kelas as $k)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="fw-semibold mb-1">Kelas {{ $k->nama }}</h5>
                            <div class="text-muted mb-3">{{ $k->siswa_count }} siswa</div>
                            <a href="{{ route('guru.kelas.show', $k->id) }}" class="btn btn-primary">Lihat Siswa</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-muted">Tidak ada kelas.</div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
