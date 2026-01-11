@extends('admin.base')

@section('title', 'Dashboard Guru')

@push('style')
    <style>
    .btn-white {
        background: #fff;
        color: #5D87FF;
        border: 1px solid #fff;
    }
    .btn-white:hover {
        background: #f1f3f9;
        color: #4570EA;
    }
    .fs-7 {
        font-size: 1.5rem !important;
    }
</style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="card w-100 bg-primary-subtle overflow-hidden shadow-none mb-4">
            <div class="card-body position-relative">
                <div class="row align-items-center">
                    <div class="col-sm-7">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle overflow-hidden me-3 shadow-sm" style="width: 50px; height: 50px; border: 3px solid #fff;">
                                <img src="https://ui-avatars.com/api/?name={{ $guru->nama }}&background=5D87FF&color=fff" 
                                    alt="user-img" class="img-fluid">
                            </div>
                            <div>
                                <h4 class="fw-bold mb-1">Selamat Datang, {{ $guru->nama }}! 👋</h4>
                                <p class="text-dark mb-0 opacity-75">Berikut jadwal kamu di hari <strong>{{ $hari }}</strong>.</p>
                            </div>
                        </div>
                        <div class="d-flex gap-3 mt-4">
                            <a href="{{ route('guru.jadwal') }}" class="btn btn-primary px-4 shadow-sm">
                                <i class="ti ti-calendar me-1"></i> Lihat Jadwal
                            </a>
                            <a href="{{ route('guru.kelas.index') }}" class="btn btn-white px-4 shadow-sm">
                                <i class="ti ti-users me-1"></i> Data kelas & Siswa
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-5 d-none d-sm-block">
                        <div class="welcome-bg-img text-end">
                            <img src="{{ asset('assets/images/backgrounds/banner.png') }}" alt="welcome" class="img-fluid mb-n4" style="max-height: 200px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="fw-semibold mb-3">Jadwal Hari Ini</h5>

                @if ($jadwalHariIni->isEmpty())
                    <div class="text-muted">Tidak ada jadwal hari ini.</div>
                @else
                    <div class="table-responsive">
                        <table class="table align-middle w-100 text-nowrap">
                            <thead>
                                <tr>
                                    <th>Jam</th>
                                    <th>Kelas</th>
                                    <th>Mapel</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwalHariIni as $j)
                                    <tr>
                                        <td>{{ substr($j->jam_mulai, 0, 5) }} - {{ substr($j->jam_selesai, 0, 5) }}</td>
                                        <td>
                                            <a
                                                href="{{ route('guru.kelas.show', $j->kelas_id) }}">{{ $j->kelas?->nama }}</a>
                                        </td>
                                        <td>{{ $j->mapel?->nama }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
