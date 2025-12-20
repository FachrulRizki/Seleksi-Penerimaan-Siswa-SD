@extends('admin.base')

@section('title', 'Data Siswa')

@section('content')
    <div class="container-fluid" id="app">
        <div class="card bg-primary-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Data Siswa</h4>
                        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '/'">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted text-decoration-none"
                                        href="{{ route('admin.dashboard') }}">Dashboard</a>
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
                <form action="" method="get" class="mb-4 pb-4 border-bottom">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="search" class="form-control" placeholder="Cari siswa..." name="search"
                                value="{{ request('search') }}">
                        </div>
                        <div class="col-md-8">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.siswa.export') }}" class="btn btn-success">
                                    <i class="ti ti-file-export me-1 ms-n1"></i> Export
                                </a>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#modalTambah" class="btn btn-primary">
                                    <i class="ti ti-plus me-1 ms-n1"></i> Tambah Siswa
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table w-100 text-nowrap">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 60px">No</th>
                                <th>Nama Lengkap</th>
                                <th>No. Ujian</th>
                                <th class="text-center">Status Ujian</th>
                                <th class="text-center">Status Lulus</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($siswa as $item)
                                <tr class="align-middle">
                                    <td class="text-center">
                                        {{ ($siswa->currentPage() - 1) * $siswa->perPage() + $loop->iteration }}</td>
                                    <td>{{ $item->nama_lengkap }}</td>
                                    <td>{{ $item->nomor_ujian }}</td>
                                    <td class="text-center">
                                        @if ($item->hasilUjian()->exists())
                                            <span class="badge bg-success fs-2">Sudah Ujian</span>
                                        @else
                                            <span class="badge bg-warning fs-2">Belum Ujian</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($item->hasilUjian()->exists())
                                            @if ($item->isLulus())
                                                <span class="badge bg-success fs-2">Lulus</span>
                                            @else
                                                <span class="badge bg-danger fs-2">Tidak Lulus</span>
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('admin.siswa.show', $item->id) }}"
                                                class="btn btn-primary btn-sm" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Detail">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.siswa.edit', $item->id) }}"
                                                class="btn btn-warning btn-sm" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Edit">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.siswa.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus siswa ini?')">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data siswa</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $siswa->appends(['search' => request('search')])->links() }}
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalTambahLabel">Tambah Siswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.siswa.store') }}" method="post" id="formTambah">
                        @csrf
                        <div>
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap" placeholder="Budiono Siregar">
                            @error('nama_lengkap')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" form="formTambah" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
