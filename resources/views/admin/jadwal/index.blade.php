@extends('admin.base')

@section('title', 'Jadwal Pelajaran')

@section('content')
    <div class="container-fluid" id="app">
        <div class="card bg-primary-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Jadwal Pelajaran</h4>
                        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '/'">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted text-decoration-none"
                                        href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active text-primary" aria-current="page">Jadwal Pelajaran</li>
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
                        <div class="col-md-2">
                            <select name="kelas_id" class="form-select">
                                <option value="">Semua Kelas</option>
                                @foreach($kelas as $k)
                                    <option value="{{ $k->id }}" {{ (string)request('kelas_id')===(string)$k->id ? 'selected':'' }}>
                                        {{ $k->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="guru_id" class="form-select">
                                <option value="">Semua Guru</option>
                                @foreach($guru as $g)
                                    <option value="{{ $g->id }}" {{ (string)request('guru_id')===(string)$g->id ? 'selected':'' }}>
                                        {{ $g->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="hari" class="form-select">
                                <option value="">Semua Hari</option>
                                @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $h)
                                    <option value="{{ $h }}" {{ request('hari')===$h ? 'selected':'' }}>{{ $h }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary" type="submit">Filter</button>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.jadwal.create') }}" class="btn btn-primary">
                                    <i class="ti ti-plus me-1 ms-n1"></i> Tambah Jadwal
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
                                <th>Hari</th>
                                <th>Jam</th>
                                <th>Kelas</th>
                                <th>Mapel</th>
                                <th>Guru</th>
                                <th>Ruang</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jadwal as $item)
                                <tr class="align-middle">
                                    <td class="text-center">{{ ($jadwal->currentPage() - 1) * $jadwal->perPage() + $loop->iteration }}</td>
                                    <td>{{ $item->hari }}</td>
                                    <td>{{ substr($item->jam_mulai,0,5) }} - {{ substr($item->jam_selesai,0,5) }}</td>
                                    <td>{{ $item->kelas?->nama }}</td>
                                    <td>{{ $item->mapel?->nama }}</td>
                                    <td>{{ $item->guru?->nama }}</td>
                                    <td>{{ $item->ruang ?? '-' }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('admin.jadwal.edit', $item->id) }}"
                                                class="btn btn-warning btn-sm" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Edit">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.jadwal.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Belum ada jadwal pelajaran</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $jadwal->links() }}
            </div>
        </div>
    </div>
@endsection
