@extends('admin.base')

@section('title', 'Data Siswa')

@section('content')
    <div class="container-fluid">
        <div class="card bg-primary-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Data Siswa</h4>
                        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '/'">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted text-decoration-none" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a class="text-muted text-decoration-none" href="{{ route('guru.kelas.index') }}">Kelas & Siswa</a>
                                </li>
                                <li class="breadcrumb-item active text-primary" aria-current="page">Data Siswa</li>
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

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-2">Kelas {{ $kelas->nama }}</h4>
                        <div class="text-muted">Wali Kelas: {{ $kelas->waliGuru?->nama ?? '-' }}</div>
                    </div>
                    <a href="{{ route('guru.kelas.index') }}" class="btn btn-light">Kembali</a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="" method="get" class="mb-4 pb-4 border-bottom">
                    <div class="row row-gap-3">
                        <div class="col-md-4">
                            <input type="search" class="form-control" placeholder="Cari nama / nis / nisn..." name="search" value="{{ request('search') }}">
                        </div>
                        <div class="col-md-2 d-flex gap-2">
                            <button class="btn btn-primary w-100" type="submit">Filter</button>
                            <a href="{{ route('guru.kelas.show', $kelas->id) }}" class="btn bg-danger-subtle text-danger w-100">Reset</a>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table align-middle w-100 text-nowrap">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama Lengkap</th>
                                <th>NIS</th>
                                <th>NISN</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Lahir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($siswa as $i => $s)
                                <tr>
                                    <td class="text-center">{{ ($siswa->currentPage() - 1) * $siswa->perPage() + $loop->iteration }}</td>
                                    <td>{{ $s->nama }}</td>
                                    <td>{{ $s->nis }}</td>
                                    <td>{{ $s->nisn }}</td>
                                    <td>{{ $s->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                    <td>{{ $s->tanggal_lahir?->translatedFormat('d F Y') ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Belum ada siswa di kelas ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $siswa->links() }}
            </div>
        </div>
    </div>
@endsection
