@extends('admin.base')

@section('title', 'Tambah Soal')

@section('content')
<div class="container-fluid">
    <div class="card bg-primary-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Tambah Soal Baru</h4>
                    <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '/'">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="{{ route('admin.soal.index') }}">Bank Soal</a></li>
                            <li class="breadcrumb-item active text-primary" aria-current="page">Tambah Soal</li>
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
            <div class="d-flex align-items-center">
                <i class="ti ti-alert-circle me-2 fs-5"></i>
                {{ session('error') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('admin.soal.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="card-title mb-0">Konten Visual</h5>
                    </div>
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <label class="form-label fw-bold">Gambar Soal <span class="text-danger">*</span></label>
                            
                            <div class="border rounded-3 mb-3 d-flex align-items-center justify-content-center bg-light" style="height: 250px; overflow: hidden;">
                                <img id="img-preview" src="{{ asset('assets/images/backgrounds/placeholder.png') }}" class="img-fluid" style="max-height: 100%; object-fit: contain;">
                            </div>
                            
                            <input type="file" id="gambar_soal" accept="image/*" name="gambar_soal" 
                                class="form-control @error('gambar_soal') is-invalid @enderror" 
                                onchange="previewImage()">
                            
                            <small class="text-muted d-block mt-2 text-start">Format: JPG, PNG, WEBP. Maks: 2MB</small>
                            @error('gambar_soal')
                                <div class="invalid-feedback text-start">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="card-title mb-0">Detail Pilihan Jawaban</h5>
                    </div>
                    <div class="card-body">
                        <div class="row row-gap-4">
                            @foreach (['A', 'B', 'C', 'D'] as $i => $label)
                                <div class="col-12">
                                    <label class="form-label fw-bold">Opsi {{ $label }}</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-primary-subtle text-primary fw-bold">{{ $label }}</span>
                                        <input type="text" name="opsi[]" 
                                            class="form-control @error('opsi.'.$i) is-invalid @enderror" 
                                            placeholder="Masukkan teks pilihan {{ $label }}" 
                                            value="{{ old('opsi.'.$i) }}">
                                        @error('opsi.'.$i)
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <hr class="my-4">

                        <div class="mb-3">
                            <label class="form-label fw-bold text-success">
                                <i class="ti ti-checkbox me-1"></i>Jawaban yang Benar <span class="text-danger">*</span>
                            </label>
                            <select name="jawaban" class="form-select border-success @error('jawaban') is-invalid @enderror">
                                <option value="" selected disabled>-- Pilih Kunci Jawaban --</option>
                                <option value="0" {{ old('jawaban') == '0' ? 'selected' : '' }}>Opsi A</option>
                                <option value="1" {{ old('jawaban') == '1' ? 'selected' : '' }}>Opsi B</option>
                                <option value="2" {{ old('jawaban') == '2' ? 'selected' : '' }}>Opsi C</option>
                                <option value="3" {{ old('jawaban') == '3' ? 'selected' : '' }}>Opsi D</option>
                            </select>
                            @error('jawaban')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer bg-light d-flex gap-2 justify-content-end">
                        <a href="{{ route('admin.soal.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="ti ti-device-floppy me-1"></i> Simpan Soal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
    <script>
        function previewImage() {
            const image = document.querySelector('#gambar_soal');
            const imgPreview = document.querySelector('#img-preview');

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endpush