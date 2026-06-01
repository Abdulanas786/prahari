@extends('admin.layouts.master')

@section('page-content')
<div class="d-flex align-items-center justify-content-between mb-4 mt-4">
    <div class="d-flex align-items-center gap-3">
        <a href="{{ route('prahari.index') }}" class="btn btn-light shadow-sm border-0 px-3 py-2 rounded-3">
            <i class="bi bi-arrow-left me-1"></i> Back to List
        </a>
        <h4 class="fw-bold mb-0 text-dark fs-4">Prahari Details</h4>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Header Card -->
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4" style="background: linear-gradient(135deg, #ffffff, #f8f9fa);">
            <div class="card-body p-4 p-md-5 d-flex flex-column flex-md-row align-items-md-center justify-content-between">
                <div class="d-flex align-items-center gap-4">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center text-primary fw-bold" style="width: 80px; height: 80px; font-size: 2rem;">
                        {{ substr($prahari->Prahari, 0, 1) }}
                    </div>
                    <div>
                        <h2 class="fw-bold text-dark mb-1">{{ $prahari->Prahari }}</h2>
                        <div class="d-flex align-items-center gap-3 text-muted">
                            <span><i class="bi bi-telephone-fill text-primary me-1"></i> {{ $prahari->Mobile }}</span>
                            <span><i class="bi bi-hash text-info me-1"></i> ID: {{ $prahari->id }}</span>
                        </div>
                    </div>
                </div>
                <div class="mt-4 mt-md-0 d-flex flex-column align-items-md-end">
                    <div class="mb-2">
                        @if($prahari->status === 'Active')
                            <span class="badge bg-success bg-opacity-10 text-success border border-success px-3 py-2 rounded-pill fw-semibold"><i class="bi bi-check-circle-fill me-1"></i> Active</span>
                        @else
                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger px-3 py-2 rounded-pill fw-semibold"><i class="bi bi-x-circle-fill me-1"></i> Inactive</span>
                        @endif
                    </div>
                    <small class="text-muted"><i class="bi bi-calendar3 me-1"></i> Joined: {{ $prahari->created_at->format('d M Y') }}</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 5 Summary Cards -->
<div class="row g-4 mb-4">
    <div class="col-xl col-md-4 col-sm-6">
        <div class="card border-0 shadow-sm h-100 rounded-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1 fw-semibold text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">Total Cases</p>
                        <h3 class="mb-0 fw-bold text-dark">{{ $casesTotal }}</h3>
                    </div>
                    <div class="bg-danger bg-opacity-10 rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                        <i class="bi bi-folder-fill text-danger fs-5"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl col-md-4 col-sm-6">
        <div class="card border-0 shadow-sm h-100 rounded-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1 fw-semibold text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">Total Challans</p>
                        <h3 class="mb-0 fw-bold text-dark">{{ $challansTotal }}</h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                        <i class="bi bi-receipt text-warning fs-5"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl col-md-4 col-sm-6">
        <div class="card border-0 shadow-sm h-100 rounded-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1 fw-semibold text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">Total Earnings</p>
                        <h3 class="mb-0 fw-bold text-dark">₹{{ number_format($totalEarnings, 0) }}</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                        <i class="bi bi-graph-up-arrow text-primary fs-5"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl col-md-6 col-sm-6">
        <div class="card border-0 shadow-sm h-100 rounded-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1 fw-semibold text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">Withdrawn</p>
                        <h3 class="mb-0 fw-bold text-dark">₹{{ number_format($totalApproved, 0) }}</h3>
                    </div>
                    <div class="bg-info bg-opacity-10 rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                        <i class="bi bi-wallet2 text-info fs-5"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl col-md-6 col-sm-12">
        <div class="card border-0 shadow-sm h-100 rounded-4" style="background: linear-gradient(135deg, #22c55e, #16a34a);">
            <div class="card-body p-4 text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-white-50 mb-1 fw-semibold text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">Available Balance</p>
                        <h3 class="mb-0 fw-bold text-white">₹{{ number_format($remainingBalance, 0) }}</h3>
                    </div>
                    <div class="bg-white bg-opacity-25 rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                        <i class="bi bi-currency-rupee text-white fs-5"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Prahari Information -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-header bg-white border-0 pt-4 pb-0">
                <h6 class="fw-bold text-dark mb-0"><i class="bi bi-person-vcard text-primary me-2"></i> Prahari Profile</h6>
            </div>
            <div class="card-body p-4">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                        <span class="text-muted">Aadhaar Status</span>
                        <span class="fw-medium text-dark">{{ $prahari->AadhaarStatus }}</span>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                        <span class="text-muted">Bank Account</span>
                        <span class="fw-medium text-dark text-break ps-3 text-end">{{ $prahari->Bank_account_detail }}</span>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                        <span class="text-muted">Mobile</span>
                        <span class="fw-medium text-dark">{{ $prahari->Mobile }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Activity Breakdowns -->
    <div class="col-lg-8">
        <div class="row g-4 h-100">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-0 pt-4 pb-0">
                        <h6 class="fw-bold text-dark mb-0"><i class="bi bi-pie-chart-fill text-danger me-2"></i> Cases Breakdown</h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="d-flex align-items-center gap-2"><div class="rounded-circle bg-danger" style="width:10px; height:10px;"></div> Open</span>
                                <span class="fw-bold text-dark">{{ $casesOpen }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="d-flex align-items-center gap-2"><div class="rounded-circle bg-warning" style="width:10px; height:10px;"></div> In Progress</span>
                                <span class="fw-bold text-dark">{{ $casesInProgress }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="d-flex align-items-center gap-2"><div class="rounded-circle bg-success" style="width:10px; height:10px;"></div> Closed</span>
                                <span class="fw-bold text-dark">{{ $casesClosed }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-0 pt-4 pb-0">
                        <h6 class="fw-bold text-dark mb-0"><i class="bi bi-bar-chart-fill text-warning me-2"></i> Challans Breakdown</h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="d-flex align-items-center gap-2"><div class="rounded-circle bg-success" style="width:10px; height:10px;"></div> Paid</span>
                                <span class="fw-bold text-dark">{{ $challansPaid }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="d-flex align-items-center gap-2"><div class="rounded-circle bg-warning" style="width:10px; height:10px;"></div> Pending</span>
                                <span class="fw-bold text-dark">{{ $challansPending }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="d-flex align-items-center gap-2"><div class="rounded-circle bg-secondary" style="width:10px; height:10px;"></div> Cancelled</span>
                                <span class="fw-bold text-dark">{{ $challansCancelled }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white border-0 pt-4 pb-0">
                        <h6 class="fw-bold text-dark mb-0"><i class="bi bi-wallet-fill text-info me-2"></i> Withdrawals Overview</h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="row text-center g-4">
                            <div class="col-md-4 border-end">
                                <p class="text-muted small mb-1 text-uppercase fw-semibold">Total Requested</p>
                                <h5 class="fw-bold text-dark mb-0">₹{{ number_format($totalRequested, 0) }}</h5>
                            </div>
                            <div class="col-md-4 border-end">
                                <p class="text-muted small mb-1 text-uppercase fw-semibold">Pending</p>
                                <h5 class="fw-bold text-warning mb-0">₹{{ number_format($totalPending, 0) }}</h5>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted small mb-1 text-uppercase fw-semibold">Approved</p>
                                <h5 class="fw-bold text-success mb-0">₹{{ number_format($totalApproved, 0) }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
