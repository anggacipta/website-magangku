<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
            {{--            <li class="nav-item">--}}
            {{--                <a class="nav-link nav-icon-hover" href="javascript:void(0)">--}}
            {{--                    <i class="ti ti-bell-ringing"></i>--}}
            {{--                    <div class="notification bg-primary rounded-circle"></div>--}}
            {{--                </a>--}}
            {{--            </li>--}}
        </ul>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        @if(auth()->user()->hasRole('mahasiswa'))
                            <img src="{{ \Illuminate\Support\Facades\Storage::url('public/images/mahasiswa_profile/' . auth()->user()->mahasiswa->photo) }}" alt="" width="35" height="35" class="rounded-circle">
                        @elseif(auth()->user()->hasRole('perusahaan'))
                            <img src="{{ asset('storage/images/perusahaan_profile/' . auth()->user()->perusahaan->photo) }}" alt="" width="35" height="35" class="rounded-circle">
                        @else
                            <img src="{{ asset('images/default_profile.png') }}" alt="" width="35" height="35" class="rounded-circle">
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                        <div class="message-body">
                            @if(auth()->user()->hasRole('mahasiswa'))
                                <a href="{{ route('profile.mahasiswa') }}" class="d-flex align-items-center gap-2 dropdown-item">
                                    <i class="ti ti-user fs-6"></i>
                                    <p class="mb-0 fs-3">My Profile</p>
                                </a>
                            @elseif(auth()->user()->hasRole('perusahaan'))
                                <a href="{{ route('profile.perusahaan') }}" class="d-flex align-items-center gap-2 dropdown-item">
                                    <i class="ti ti-user fs-6"></i>
                                    <p class="mb-0 fs-3">My Profile</p>
                                </a>
                            @endif
                            <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-mail fs-6"></i>
                                <p class="mb-0 fs-3">My Account</p>
                            </a>
                            <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-list-check fs-6"></i>
                                <p class="mb-0 fs-3">My Task</p>
                            </a>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</button>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
