@extends('admin.base')

@section('title', 'Data Guru')

@section('content')
    <div class="container-fluid" id="app">
        <div class="card bg-primary-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Data Guru</h4>
                        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '/'">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted text-decoration-none"
                                        href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active text-primary" aria-current="page">Data Guru</li>
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
                    <div class="row row-gap-3">
                        <div class="col-md-4">
                            <input type="search" class="form-control" placeholder="Cari nama / username / nip..." name="search"
                                value="{{ request('search') }}">
                        </div>
                        <div class="col-md-8">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.guru.create') }}" class="btn btn-primary">
                                    <i class="ti ti-plus me-1 ms-n1"></i> Tambah Guru
                                </a>
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
                                <th>Username</th>
                                <th>NIP</th>
                                <th>No. HP</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($gurus as $item)
                                <tr class="align-middle">
                                    <td class="text-center">
                                        {{ ($gurus->currentPage() - 1) * $gurus->perPage() + $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->nip ?? '-' }}</td>
                                    <td>{{ $item->no_hp ?? '-' }}</td>
                                    <td class="text-center">
                                        @if ($item->is_active)
                                            <span class="badge bg-success fs-2">Aktif</span>
                                        @else
                                            <span class="badge bg-danger fs-2">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('admin.guru.edit', $item->id) }}"
                                                class="btn btn-warning btn-sm" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Edit">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.guru.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus guru ini?')">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada data guru</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $gurus->links() }}
            </div>
        </div>
    </div>
@endsection
