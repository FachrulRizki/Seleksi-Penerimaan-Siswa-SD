@extends('admin.base')

@section('title', 'Jadwal Pelajaran')

@section('content')
    <div class="container-fluid">
        <div class="card bg-primary-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Jadwal Pelajaran</h4>
                        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '/'">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted text-decoration-none" href="{{ route('admin.dashboard') }}">Dashboard</a>
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

        @forelse($items as $hari => $list)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="fw-semibold mb-3">{{ $hari }}</h5>
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
                                @foreach ($list as $j)
                                    <tr>
                                        <td>{{ substr($j->jam_mulai, 0, 5) }} - {{ substr($j->jam_selesai, 0, 5) }}</td>
                                        <td>
                                            <a href="{{ route('guru.kelas.show', $j->kelas_id) }}">{{ $j->kelas?->nama }}</a>
                                        </td>
                                        <td>{{ $j->mapel?->nama }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @empty
            <div class="card">
                <div class="card-body text-muted">Belum ada jadwal.</div>
            </div>
        @endforelse
    </div>
@endsection
