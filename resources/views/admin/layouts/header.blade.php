<!-- app-header -->
<header class="app-header sticky" id="header">

    <!-- Start::main-header-container -->
    <div class="main-header-container container-fluid">

        <!-- Start::header-content-left -->
        <div class="header-content-left">

            <!-- Start::header-element -->
            <div class="header-element">
                <div class="horizontal-logo">
                    <a href="index.html" class="header-logo">
                        <img src="{{ asset('assets/images/brand-logos/desktop-logo.png') }}" alt="logo" class="desktop-logo">
                        <img src="{{ asset('assets/images/brand-logos/toggle-logo.png') }}" alt="logo" class="toggle-logo">
                        <img src="{{ asset('assets/images/brand-logos/desktop-dark.png') }}" alt="logo" class="desktop-dark">
                        <img src="{{ asset('assets/images/brand-logos/toggle-dark.png') }}" alt="logo" class="toggle-dark">
                    </a>
                </div>
            </div>
            <!-- End::header-element -->

            <!-- Start::header-element -->
            <div class="header-element mx-lg-0 mx-2">
                <a aria-label="Hide Sidebar" class="sidemenu-toggle header-link" data-bs-toggle="sidebar"
                    href="javascript:void(0);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="header-link-icon menu-btn" width="24"
                        height="24" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="1.5" d="M4 5h12M4 12h16M4 19h8" color="currentColor" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="header-link-icon menu-btn-close" width="24"
                        height="24" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="1.5" d="m18 6l-6 6m0 0l-6 6m6-6l6 6m-6-6L6 6" color="currentColor" />
                    </svg>
                </a>
            </div>
            <!-- End::header-element -->

        </div>
        <!-- End::header-content-left -->

        <!-- Start::header-content-right -->
        <ul class="header-content-right">
            <!-- Start::header-element -->
            <li class="header-element d-flex align-items-center">
                <div class="dropdown">
                    <button class="btn btn-light bg-white border d-flex align-items-center gap-2 rounded-pill px-3 py-1 shadow-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border-color: #e2e8f0 !important; margin-right: 15px;">
                        <div class="bg-secondary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 28px; height: 28px;">
                            <i class="bi bi-person-fill text-secondary fs-5"></i>
                        </div>
                        <span class="fw-semibold text-dark fs-6" style="letter-spacing: 0.2px; margin-bottom: 0;">{{ auth()->user()->name ?? 'Admin User' }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 rounded-3">
                        <li><a class="dropdown-item py-2" href="{{ route('settings.index') }}"><i class="bi bi-gear me-2 text-muted"></i> Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item py-2 text-danger"><i class="bi bi-box-arrow-right me-2"></i> Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- End::header-element -->
        </ul>
        <!-- End::header-content-right -->

    </div>
    <!-- End::main-header-container -->

</header>
<!-- /app-header -->