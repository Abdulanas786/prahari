@extends('admin.layouts.master')

@section('page-content')
    <div class="d-flex align-items-center justify-content-between mb-4 mt-4">
        <h4 class="fw-bold mb-0 text-dark fs-4">Control Panel</h4>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> Please fix the errors below.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <!-- Vertical Tabs Nav -->
        <div class="col-xl-3 col-lg-4 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3">
                    <div class="nav flex-column nav-pills custom-v-tabs" id="settings-tabs" role="tablist" aria-orientation="vertical">
                        <button class="nav-link text-start mb-2 {{ session('active_tab') ? '' : 'active' }}" id="v-pills-dashboard-tab" data-bs-toggle="pill" data-bs-target="#v-pills-dashboard" type="button" role="tab" aria-controls="v-pills-dashboard" aria-selected="true">
                            <i class="bi bi-grid-1x2-fill me-2"></i> Dashboard & Quick Actions
                        </button>
                        <button class="nav-link text-start mb-2 {{ session('active_tab') == 'config' ? 'active' : '' }}" id="v-pills-config-tab" data-bs-toggle="pill" data-bs-target="#v-pills-config" type="button" role="tab" aria-controls="v-pills-config" aria-selected="false">
                            <i class="bi bi-gear-fill me-2"></i> System Configurations
                        </button>
                        <hr class="text-muted opacity-25 my-2">
                        <button class="nav-link text-start mb-2" id="v-pills-prahari-tab" data-bs-toggle="pill" data-bs-target="#v-pills-prahari" type="button" role="tab" aria-controls="v-pills-prahari" aria-selected="false">
                            <i class="bi bi-people-fill me-2"></i> Prahari Management
                        </button>
                        <button class="nav-link text-start mb-2" id="v-pills-cases-tab" data-bs-toggle="pill" data-bs-target="#v-pills-cases" type="button" role="tab" aria-controls="v-pills-cases" aria-selected="false">
                            <i class="bi bi-folder-fill me-2"></i> Cases Management
                        </button>
                        <button class="nav-link text-start mb-2" id="v-pills-challans-tab" data-bs-toggle="pill" data-bs-target="#v-pills-challans" type="button" role="tab" aria-controls="v-pills-challans" aria-selected="false">
                            <i class="bi bi-receipt me-2"></i> Challans Management
                        </button>
                        <button class="nav-link text-start mb-2" id="v-pills-payments-tab" data-bs-toggle="pill" data-bs-target="#v-pills-payments" type="button" role="tab" aria-controls="v-pills-payments" aria-selected="false">
                            <i class="bi bi-currency-rupee me-2"></i> Payments Management
                        </button>
                        <hr class="text-muted opacity-25 my-2">
                        <button class="nav-link text-start mb-2" id="v-pills-reports-tab" data-bs-toggle="pill" data-bs-target="#v-pills-reports" type="button" role="tab" aria-controls="v-pills-reports" aria-selected="false">
                            <i class="bi bi-bar-chart-fill me-2"></i> Reports & Analytics
                        </button>
                        <button class="nav-link text-start {{ session('active_tab') == 'account' ? 'active' : '' }}" id="v-pills-account-tab" data-bs-toggle="pill" data-bs-target="#v-pills-account" type="button" role="tab" aria-controls="v-pills-account" aria-selected="false">
                            <i class="bi bi-person-fill me-2"></i> Account Settings
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs Content -->
        <div class="col-xl-9 col-lg-8">
            <div class="tab-content" id="settings-tabsContent">
                
                <div class="tab-pane fade {{ session('active_tab') ? '' : 'show active' }}" id="v-pills-dashboard" role="tabpanel" aria-labelledby="v-pills-dashboard-tab">
                    @include('admin.settings.partials._quick_actions')
                </div>

                <div class="tab-pane fade {{ session('active_tab') == 'config' ? 'show active' : '' }}" id="v-pills-config" role="tabpanel" aria-labelledby="v-pills-config-tab">
                    @include('admin.settings.partials._system_config')
                </div>

                <div class="tab-pane fade" id="v-pills-prahari" role="tabpanel" aria-labelledby="v-pills-prahari-tab">
                    @include('admin.settings.partials._praharis')
                </div>

                <div class="tab-pane fade" id="v-pills-cases" role="tabpanel" aria-labelledby="v-pills-cases-tab">
                    @include('admin.settings.partials._cases')
                </div>

                <div class="tab-pane fade" id="v-pills-challans" role="tabpanel" aria-labelledby="v-pills-challans-tab">
                    @include('admin.settings.partials._challans')
                </div>

                <div class="tab-pane fade" id="v-pills-payments" role="tabpanel" aria-labelledby="v-pills-payments-tab">
                    @include('admin.settings.partials._payments')
                </div>

                <div class="tab-pane fade" id="v-pills-reports" role="tabpanel" aria-labelledby="v-pills-reports-tab">
                    @include('admin.settings.partials._reports')
                </div>

                <div class="tab-pane fade {{ session('active_tab') == 'account' ? 'show active' : '' }}" id="v-pills-account" role="tabpanel" aria-labelledby="v-pills-account-tab">
                    @include('admin.settings.partials._account')
                </div>

            </div>
        </div>
    </div>
@endsection

@push('page-script')
<style>
    .custom-v-tabs .nav-link {
        color: #495057;
        border-radius: 8px;
        padding: 12px 16px;
        font-weight: 500;
        transition: all 0.2s ease-in-out;
    }
    .custom-v-tabs .nav-link:hover {
        background-color: #f8f9fa;
        color: #1a202c;
    }
    .custom-v-tabs .nav-link.active {
        background-color: #1a202c;
        color: #ffffff;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    
    /* Make datatables inside tabs responsive */
    .tab-pane .table-responsive {
        overflow-x: auto;
    }
</style>

<script>
$(document).ready(function() {
    // When a tab is shown, if there is a DataTable inside, we need to adjust its columns
    // because DataTables initialized in hidden tabs might have 0 width
    $('button[data-bs-toggle="pill"]').on('shown.bs.tab', function (e) {
        $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
    });

    // Move all modals to the body to prevent them from being hidden by inactive tabs
    $('.modal').appendTo('body');
});
</script>
@endpush