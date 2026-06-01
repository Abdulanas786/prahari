<!-- Start::app-sidebar -->
<aside class="app-sidebar sticky" id="sidebar">

    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
        <a href="{{ route('dashboardAdmin') }}" class="header-logo-text text-nowrap text-decoration-none">
            <i class="bi bi-grid-3x3-gap fs-4 align-middle me-2"></i>
            <span class="fs-6 fw-bold align-middle">PRAHARI ADMIN</span>
        </a>
    </div>
    <!-- End::main-sidebar-header -->

    <!-- Start::main-sidebar -->
    <div class="main-sidebar" id="sidebar-scroll">

        <!-- Start::nav -->
        <nav class="main-menu-container nav nav-pills flex-column sub-open">
            <div class="slide-left" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                </svg>
            </div>
            <ul class="main-menu">

                @php
                    $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
                @endphp

                @if(($settings['module_dashboard'] ?? '1') == '1')
                <li class="slide">
                    <a href="{{ route('dashboardAdmin') }}" class="side-menu__item">
                        <i class="bi bi-house me-2 text-primary fs-5"></i>
                        <span class="side-menu__label">Dashboard</span>
                    </a>
                </li>
                @endif
                <li class="slide">
                    <a href="{{ route('prahari.index') }}" class="side-menu__item">
                        <i class="bi bi-person-badge me-2 text-primary fs-5"></i>
                        <span class="side-menu__label">Prahari</span>
                    </a>
                </li>
                <li class="slide">
                    <a href="{{ route('cases.index') }}" class="side-menu__item">
                        <i class="bi bi-briefcase me-2 text-primary fs-5"></i>
                        <span class="side-menu__label">Cases</span>
                    </a>
                </li>
                @if(($settings['module_challans'] ?? '1') == '1')
                <li class="slide">
                    <a href="{{ route('challans.index') }}" class="side-menu__item">
                        <i class="bi bi-file-earmark-text me-2 text-primary fs-5"></i>
                        <span class="side-menu__label">Challans</span>
                    </a>
                </li>
                @endif
                @if(($settings['module_payments'] ?? '1') == '1')
                <li class="slide">
                    <a href="{{ route('payments.index') }}" class="side-menu__item">
                        <i class="bi bi-credit-card me-2 text-primary fs-5"></i>
                        <span class="side-menu__label">Payments</span>
                    </a>
                </li>
                @endif
                @if(($settings['module_reports'] ?? '1') == '1')
                <li class="slide">
                    <a href="{{ route('reports.index') }}" class="side-menu__item">
                        <i class="bi bi-bar-chart me-2 text-primary fs-5"></i>
                        <span class="side-menu__label">Reports</span>
                    </a>
                </li>
                @endif
                <li class="slide">
                    <a href="{{ route('admins.index') }}" class="side-menu__item">
                        <i class="bi bi-shield-lock me-2 text-primary fs-5"></i>
                        <span class="side-menu__label">Admins</span>
                    </a>
                </li>
                <li class="slide">
                    <a href="{{ route('settings.index') }}" class="side-menu__item">
                        <i class="bi bi-gear me-2 text-primary fs-5"></i>
                        <span class="side-menu__label">Settings</span>
                    </a>
                </li>
                  
                <!-- Start::ide -->

                <li class="slide">
                    <a href="{{ route('logout') }}" class="side-menu__item"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-left me-2 text-primary fs-5"></i>
                        <span class="side-menu__label">Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                </svg></div>
        </nav>
        <!-- End::nav -->

    </div>
    <!-- End::main-sidebar -->

</aside>
<!-- End::app-sidebar -->