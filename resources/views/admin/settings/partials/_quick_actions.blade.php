<div class="row g-4 mb-4">
    <div class="col-xl-3 col-sm-6">
        <div class="card border-0 shadow-sm h-100 rounded-4" style="background: linear-gradient(135deg, #f8f9fa, #e9ecef);">
            <div class="card-body p-4 d-flex flex-column justify-content-between">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <p class="text-muted mb-1 fw-semibold text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">Total Prahari</p>
                        <h3 class="mb-0 fw-bold text-dark">{{ $totalPrahari }}</h3>
                    </div>
                    <div class="bg-white rounded-circle p-2 shadow-sm d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                        <i class="bi bi-people-fill text-primary fs-5"></i>
                    </div>
                </div>
                <button class="btn btn-sm btn-primary w-100 fw-medium shadow-sm rounded-3 mt-3 addPrahariBtn" data-bs-toggle="modal" data-bs-target="#settingsPrahariModal">
                    <i class="bi bi-plus-circle me-1"></i> Add Prahari
                </button>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-sm-6">
        <div class="card border-0 shadow-sm h-100 rounded-4" style="background: linear-gradient(135deg, #f8f9fa, #e9ecef);">
            <div class="card-body p-4 d-flex flex-column justify-content-between">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <p class="text-muted mb-1 fw-semibold text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">Total Cases</p>
                        <h3 class="mb-0 fw-bold text-dark">{{ $totalCases }}</h3>
                    </div>
                    <div class="bg-white rounded-circle p-2 shadow-sm d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                        <i class="bi bi-folder-fill text-danger fs-5"></i>
                    </div>
                </div>
                <button class="btn btn-sm btn-danger w-100 fw-medium shadow-sm rounded-3 mt-3 addCasesBtn" data-bs-toggle="modal" data-bs-target="#settingsCasesModal">
                    <i class="bi bi-plus-circle me-1"></i> Create Case
                </button>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-sm-6">
        <div class="card border-0 shadow-sm h-100 rounded-4" style="background: linear-gradient(135deg, #f8f9fa, #e9ecef);">
            <div class="card-body p-4 d-flex flex-column justify-content-between">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <p class="text-muted mb-1 fw-semibold text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">Total Challans</p>
                        <h3 class="mb-0 fw-bold text-dark">{{ $totalChallans }}</h3>
                    </div>
                    <div class="bg-white rounded-circle p-2 shadow-sm d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                        <i class="bi bi-receipt text-warning fs-5"></i>
                    </div>
                </div>
                <button class="btn btn-sm btn-warning text-dark w-100 fw-medium shadow-sm rounded-3 mt-3 addChallansBtn" data-bs-toggle="modal" data-bs-target="#settingsChallansModal">
                    <i class="bi bi-plus-circle me-1"></i> Generate Challan
                </button>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-sm-6">
        <div class="card border-0 shadow-sm h-100 rounded-4" style="background: linear-gradient(135deg, #f8f9fa, #e9ecef);">
            <div class="card-body p-4 d-flex flex-column justify-content-between">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <p class="text-muted mb-1 fw-semibold text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">Total Revenue</p>
                        <h3 class="mb-0 fw-bold text-dark">₹{{ number_format($totalRevenue, 2) }}</h3>
                    </div>
                    <div class="bg-white rounded-circle p-2 shadow-sm d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                        <i class="bi bi-currency-rupee text-success fs-5"></i>
                    </div>
                </div>
                <button class="btn btn-sm btn-success w-100 fw-medium shadow-sm rounded-3 mt-3 addPaymentsBtn" data-bs-toggle="modal" data-bs-target="#settingsPaymentsModal">
                    <i class="bi bi-plus-circle me-1"></i> Add Payment
                </button>
            </div>
        </div>
    </div>
</div>
