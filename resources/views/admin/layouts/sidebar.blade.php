@php
  $isAdmin = Auth::guard('admin')->check();
  $isGuru  = Auth::guard('guru')->check();
  $user    = $isAdmin ? Auth::guard('admin')->user() : ($isGuru ? Auth::guard('guru')->user() : null);

  $nama = $user?->nama ?? '-';
  $roleLabel = $isAdmin ? 'Admin' : 'Guru';

  $dashboardUrl = $isAdmin ? route('admin.dashboard') : route('guru.dashboard');
@endphp
<aside class="left-sidebar with-vertical">
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ $dashboardUrl }}" class="text-nowrap logo-img">
                <img src="{{ asset('assets/images/logos/dark-logo.png') }}" class="dark-logo" width="160"
                    alt="Logo-Dark" />
                <img src="{{ asset('assets/images/logos/light-logo.png') }}" class="light-logo" width="160"
                    alt="Logo-light" />
            </a>
            <a href="javascript:void(0)" class="sidebartoggler ms-auto text-decoration-none fs-5 d-block d-xl-none">
                <i class="ti ti-x"></i>
            </a>
        </div>

        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Umum</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link {{ $isAdmin ? (request()->routeIs('admin.dashboard') ? 'active' : '') : (request()->routeIs('guru.dashboard') ? 'active' : '') }}"
                        href="{{ $dashboardUrl }}" id="get-url" aria-expanded="false">
                        <span><i class="ti ti-home"></i></span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                @if ($isAdmin)
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Master Data</span>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->routeIs('admin.guru.*') ? 'active' : '' }}"
                            href="{{ route('admin.guru.index') }}" id="get-url" aria-expanded="false">
                            <span><i class="ti ti-school"></i></span>
                            <span class="hide-menu">Data Guru</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->routeIs('admin.kelas.*') ? 'active' : '' }}"
                            href="{{ route('admin.kelas.index') }}" id="get-url" aria-expanded="false">
                            <span><i class="ti ti-category"></i></span>
                            <span class="hide-menu">Data Kelas</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}"
                            href="{{ route('admin.siswa.index') }}" id="get-url" aria-expanded="false">
                            <span><i class="ti ti-users"></i></span>
                            <span class="hide-menu">Data Siswa</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->routeIs('admin.mapel.*') ? 'active' : '' }}"
                            href="{{ route('admin.mapel.index') }}" id="get-url" aria-expanded="false">
                            <span><i class="ti ti-books"></i></span>
                            <span class="hide-menu">Data Mapel</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->routeIs('admin.jadwal.*') ? 'active' : '' }}"
                            href="{{ route('admin.jadwal.index') }}" id="get-url" aria-expanded="false">
                            <span><i class="ti ti-calendar"></i></span>
                            <span class="hide-menu">Jadwal Pelajaran</span>
                        </a>
                    </li>

                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Ujian Seleksi</span>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->routeIs('admin.peserta.*') ? 'active' : '' }}"
                            href="{{ route('admin.peserta.index') }}" id="get-url" aria-expanded="false">
                            <span><i class="ti ti-users"></i></span>
                            <span class="hide-menu">Peserta Ujian</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->routeIs('admin.soal.*') ? 'active' : '' }}"
                            href="{{ route('admin.soal.index') }}" id="get-url" aria-expanded="false">
                            <span><i class="ti ti-books"></i></span>
                            <span class="hide-menu">Bank Soal</span>
                        </a>
                    </li>
                @endif

                @if($isGuru)
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Guru</span>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->routeIs('guru.jadwal') ? 'active' : '' }}"
                            href="{{ route('guru.jadwal') }}">
                            <span><i class="ti ti-calendar"></i></span>
                            <span class="hide-menu">Jadwal Pelajaran</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->routeIs('guru.kelas.*') ? 'active' : '' }}"
                            href="{{ route('guru.kelas.index') }}">
                            <span><i class="ti ti-users"></i></span>
                            <span class="hide-menu">Kelas & Siswa</span>
                        </a>
                    </li>
                @endif

            </ul>
        </nav>

        <div class="fixed-profile p-3 mx-4 mb-2 bg-primary-subtle rounded mt-3">
            <div class="hstack gap-3">
                <div class="d-flex align-items-center">
                    <div class="overflow-hidden rounded-circle">
                        <div class="ratio ratio-1x1" style="height: 35px; width: 35px">
                            <img src="https://ui-avatars.com/api/?name={{ $nama }}&background=5D87FF&color=fff"
                                class="rounded-circle" width="35" height="35" alt="Profil" />
                        </div>
                    </div>
                </div>
                <div class="john-title text-nowrap text-truncate">
                    <h6 class="mb-0 fs-4 fw-semibold text-truncate">{{ $nama }}</h6>
                    <span class="fs-2 text-capitalize">{{ $roleLabel }}</span>
                </div>
                <button class="border-0 bg-transparent text-primary ms-auto" tabindex="0" type="submit"
                    form="logout-form" aria-label="logout" data-bs-toggle="tooltip" data-bs-placement="top"
                    data-bs-title="logout">
                    <i class="ti ti-power fs-6"></i>
                </button>
            </div>
        </div>
    </div>
</aside>
