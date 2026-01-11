@extends('admin.base')

@section('title', 'Data Mapel')

@section('content')
    <div class="container-fluid" id="app">
        <div class="card bg-primary-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Data Mapel</h4>
                        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '/'">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted text-decoration-none"
                                        href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active text-primary" aria-current="page">Data Mapel</li>
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
                            <input type="search" class="form-control" placeholder="Cari nama mapel..." name="search"
                                value="{{ request('search') }}">
                        </div>
                        <div class="col-md-8">
                            <div class="d-flex justify-content-end gap-2">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">
                                    <i class="ti ti-plus me-1 ms-n1"></i> Tambah Mapel
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
                                <th>Nama Mapel</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($mapel as $item)
                                <tr class="align-middle">
                                    <td class="text-center">{{ ($mapel->currentPage() - 1) * $mapel->perPage() + $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <div data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                <button
                                                    type="button"
                                                    class="btn btn-warning btn-sm btn-edit"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalEdit"
                                                    data-id="{{ $item->id }}"
                                                    data-nama="{{ $item->nama }}"
                                                >
                                                    <i class="ti ti-edit"></i>
                                                </button>
                                            </div>
                                            <form action="{{ route('admin.mapel.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus mapel ini?')">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Belum ada data mapel</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $mapel->links() }}
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalCreate" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.mapel.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Mapel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label class="form-label">Nama Mapel</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Contoh: PAI / PJOK / Bahasa Inggris">
                            @error('nama')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" id="formEdit">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Mapel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label class="form-label">Nama Mapel</label>
                            <input type="text" name="nama" id="editNama" class="form-control" placeholder="Nama mapel...">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const formEdit = document.getElementById('formEdit');
        const editNama = document.getElementById('editNama');

        document.querySelectorAll('.btn-edit').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.getAttribute('data-id');
                const nama = btn.getAttribute('data-nama');

                // set action form PUT ke /admin/mapel/{id}
                formEdit.action = `{{ url('admin/mapel') }}/${id}`;
                editNama.value = nama ?? '';
                editNama.focus();
            });
        });

        // auto reopen modal create kalau validation error dari form create
        @if ($errors->any())
            const modalCreateEl = document.getElementById('modalCreate');
            if (modalCreateEl) {
                const modal = new bootstrap.Modal(modalCreateEl);
                modal.show();
            }
        @endif
    });
</script>
@endpush