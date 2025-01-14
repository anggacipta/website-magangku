<aside class="left-sidebar with-vertical">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <div>
                <img src="{{ asset('assets/logo-images/logo_magangku_seme8.png') }}" width="50" height="50">
            </div>
            <div>
                <p class="fs-4 fw-bold mt-3" style="">Magangku</p>
            </div>
            <div>
                <a href="javascript:void(0)" class="sidebartoggler ms-auto text-decoration-none fs-5 d-block d-xl-none">
                    <i class="ti ti-x"></i>
                </a>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-dashboard"></i>
                    </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <span class="d-flex">
                        <i class="ti ti-layout-dashboard"></i>
                    </span>
                        <span class="hide-menu">
                        Data Master
                    </span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('angkatan.index') }}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Data Angkatan</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('prodi.index') }}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Data Prodi</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('keahlian.index') }}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Data Keahlian</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Pembimbing KP</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('pembimbing.index') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-user-circle"></i>
                    </span>
                        <span class="hide-menu">Data Pembimbing KP</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('pembimbing.create') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-user-plus"></i>
                    </span>
                        <span class="hide-menu">Tambah Pembimbing KP</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Mahasiswa</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('mahasiswa.index') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-user-circle"></i>
                    </span>
                        <span class="hide-menu">Data Mahasiswa</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('mahasiswa.create') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-user-plus"></i>
                    </span>
                        <span class="hide-menu">Tambah Mahasiswa</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Perusahaan</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('perusahaan.index') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-user-circle"></i>
                    </span>
                        <span class="hide-menu">Data Perusahaan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('perusahaan.create') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-user-plus"></i>
                    </span>
                        <span class="hide-menu">Tambah Perusahaan</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Riwayat Magang</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('riwayat-magang.index') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-file-check"></i>
                    </span>
                        <span class="hide-menu">Data Riwayat Magang</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('riwayat-magang.create') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-square-plus"></i>
                    </span>
                        <span class="hide-menu">Tambah Riwayat Magang</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Kerja Praktek</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('berkas-kp') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-folders"></i>
                    </span>
                        <span class="hide-menu">Berkas KP</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('surat-kp.index') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-file-check"></i>
                    </span>
                        <span class="hide-menu">Data Surat KP</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('surat-kp.create') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-file-check"></i>
                    </span>
                        <span class="hide-menu">Ajukan Surat KP</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('surat-kp.create') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-file-delta"></i>
                    </span>
                        <span class="hide-menu">Upload Surat Perusahaan</span>
                    </a>
                </li>


                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Permission & Roles</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('roles.index') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-user-circle"></i>
                    </span>
                        <span class="hide-menu">Data Roles</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('roles.create') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-user-circle"></i>
                    </span>
                        <span class="hide-menu">Tambah Roles</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('permissions.index') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-license"></i>
                    </span>
                        <span class="hide-menu">Data Permissions</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('permissions.create') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-license"></i>
                    </span>
                        <span class="hide-menu">Tambah Permissions</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
        <div class="fixed-profile p-3 mx-4 mb-2 bg-secondary-subtle rounded mt-3">
            <div class="hstack gap-3">
                <div class="john-img">
                    @if(auth()->user()->hasRole('mahasiswa'))
                        <img src="{{ Storage::url('images/mahasiswa_profile/' . auth()->user()->mahasiswa->photo) }}" alt="" width="35" height="35" class="rounded-circle">
                    @elseif(auth()->user()->hasRole('perusahaan'))
                        <img src="{{ Storage::url('images/mahasiswa_profile/' . auth()->user()->perusahaan->photo) }}" alt="" width="35" height="35" class="rounded-circle">
                    @else
                        <img src="{{ asset('images/default_profile.png') }}" alt="" width="35" height="35" class="rounded-circle">
                    @endif
                </div>
{{--                <div class="john-title">--}}
{{--                    <h6 class="mb-0 fs-4 fw-semibold">{{ explode(' ', auth()->user()->name)[0] }}</h6>--}}
{{--                    <span class="fs-2">{{ auth()->user()->roles->pluck('name')->first() }}</span>--}}
{{--                </div>--}}
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button class="btn btn-sm btn-outline-primary">Logout</button>
                </form>
            </div>
        </div>
    </div>
    <!-- End Sidebar scroll-->
</aside>
