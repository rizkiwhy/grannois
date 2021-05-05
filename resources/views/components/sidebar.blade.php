<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('src/dist/img/11.png') }}" alt="AdminLTE Logo" class="brand-image elevation-3 img-circle"
            style="opacity: .8">
        <span class="brand-text font-weight-dark">GrannoIS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('src/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Beranda</p>
                    </a>
                </li>
                @if (Auth::user()->role_id === 1)
                    <li class="nav-item">
                        <a class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Kurikulum
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                @endif
                @if (in_array(Auth::user()->role_id, [1, 2]))
                    <li class="nav-item">
                        <a href="{{ route('activity.index') }}" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>
                                Kegiatan
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('announcement.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-bullhorn"></i>
                            <p>
                                Pengumuman
                            </p>
                        </a>
                    </li>
                @endif
                @if (in_array(Auth::user()->role_id, [1, 2, 3]))
                    <li class="nav-item">
                        <a href="{{ route('graduation.index') }}" class="nav-link">
                            {{-- @if (in_array(Auth::user()->role_id, [1, 2]))
                            @elseif(Auth::user()->role_id === 3) --}}
                            {{-- <a href="{{ route('graduation/show/' . Auth::user()->role_id . ') }}" --}}
                            {{-- class="nav-link"> --}}
                            {{-- @endif --}}
                            <i class="nav-icon fas fa-graduation-cap"></i>
                            <p>
                                Kelulusan
                            </p>
                        </a>
                    </li>

                @endif
                @if (Auth::user()->role_id === 1)
            </ul>
            </li>
            @endif
            @if (in_array(Auth::user()->role_id, [1, 2]))
                <li class="nav-item">
                    <a class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Master
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
            @endif
            {{-- end !3 --}}
            {{-- if 1 --}}
            @if (Auth::user()->role_id === 1)
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                App
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('role.index') }}" class="nav-link">
                                    <i class="fas fa-users-cog nav-icon"></i>
                                    <p>Role</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.index') }}" class="nav-link">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>User</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Kurikulum
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
            @endif
            {{-- end 1 --}}
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('competencyofexpertise.index') }}" class="nav-link">
                        <i class="fas fa-th nav-icon"></i>
                        <p>Kompetensi Keahlian</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('student.index') }}" class="nav-link">
                        <i class="fas fa-user-graduate nav-icon"></i>
                        <p>Siswa</p>
                    </a>
                </li>
            </ul>
            </li>
            </ul>
            </li>
            {{-- @endif --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

    {{-- <div class="sidebar-custom">
        <a href="#" class="btn btn-link"><i class="fas fa-cogs"></i></a>
        <a href="#" class="btn btn-secondary hide-on-collapse pos-right swalLogout"><i
                class="fas fa-sign-out-alt"></i></a>
    </div>
    <!-- /.sidebar-custom --> --}}

</aside>
