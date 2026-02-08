<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center"
        href="{{ route(strtolower(auth()->user()->role->name) . '.dashboard') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('frontend-dashboard/img/logo/logo2.png') }}">
        </div>
        <div class="sidebar-brand-text mx-3">KlinikKu</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="{{ route(strtolower(auth()->user()->role->name) . '.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Features
    </div>

    @if(auth()->user()->role->hasPermission('view_data_pasien') || auth()->user()->role->hasPermission('view_data_obat') || auth()->user()->role->hasPermission('view_rekam_medis'))
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
                aria-expanded="true" aria-controls="collapseBootstrap">
                <i class="fas fa-fw fa-database"></i>
                <span>Data Master</span>
            </a>
            <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Menu Utama</h6>
                    @if(auth()->user()->role->hasPermission('view_data_pasien'))
                        <a class="collapse-item" href="{{ route('data_pasien.index') }}">
                            <i class="fas fa-user-injured mr-2"></i> Data Pasien
                        </a>
                    @endif
                    @if(auth()->user()->role->hasPermission('view_rekam_medis'))
                        <a class="collapse-item" href="{{ route('rekam_medis.index') }}">
                            <i class="fas fa-notes-medical mr-2"></i> Rekam Medis
                        </a>
                    @endif
                    @if(auth()->user()->role->hasPermission('view_data_obat'))
                        <a class="collapse-item" href="{{ route('data-obat') }}">
                            <i class="fas fa-pills mr-2"></i> Data Obat
                        </a>
                    @endif
                </div>
            </div>
        </li>
    @endif

    @if(auth()->user()->role->hasPermission('view_pembayaran'))
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-fw fa-coins"></i>
                <span>Pembayaran</span></a>
        </li>
    @endif

    @if(auth()->user()->role->hasPermission('view_lab_radiologi'))
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-fw fa-flask"></i>
                <span>Lab & Radiologi</span></a>
        </li>
    @endif

    @if(auth()->user()->role->hasPermission('view_laporan'))
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-fw fa-file-invoice"></i>
                <span>Laporan</span></a>
        </li>
    @endif

    @if(auth()->user()->role->hasPermission('view_roles') || auth()->user()->role->hasPermission('view_users') || auth()->user()->role->hasPermission('view_poli'))
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true"
                aria-controls="collapseForm">
                <i class="fab fa-fw fa-wpforms"></i>
                <span>Konfigurasi</span>
            </a>
            <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Config</h6>
                    @if(auth()->user()->role->hasPermission('view_roles'))
                        <a class="collapse-item" href="{{ route('roles.index') }}">Roles</a>
                    @endif
                    @if(auth()->user()->role->hasPermission('view_poli'))
                        <a class="collapse-item" href="#">Master Poli</a>
                    @endif
                    @if(auth()->user()->role->hasPermission('view_tindakan'))
                        <a class="collapse-item" href="#">Master Tindakan</a>
                    @endif
                </div>
            </div>
        </li>
    @endif

    <hr class="sidebar-divider">
    <div class="version" id="version-ruangadmin"></div>
</ul>