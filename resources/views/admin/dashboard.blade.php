@extends('admin.layouts.master')

@section('page-content')
    <div class="d-flex align-items-center justify-content-between mb-4 mt-4">
        <h4 class="fw-bold mb-0 text-dark fs-4">Dashboard</h4>
    </div>
    
    <div class="row mt-2">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <p class="text-muted mb-2">Total Prahari</p>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bold mb-0">{{ number_format($totalPrahari) }}</h3>
                        </div>
                        <div class="avatar avatar-md bg-primary-transparent rounded-circle">
                            <i class="bi bi-person-badge fs-5 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <p class="text-muted mb-2">Total Cases</p>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bold mb-0">{{ number_format($totalCases) }}</h3>
                        </div>
                        <div class="avatar avatar-md bg-secondary-transparent rounded-circle">
                            <i class="bi bi-briefcase fs-5 text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <p class="text-muted mb-2">Total Challans</p>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bold mb-0">{{ number_format($totalChallans) }}</h3>
                        </div>
                        <div class="avatar avatar-md bg-success-transparent rounded-circle">
                            <i class="bi bi-file-earmark-text fs-5 text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <p class="text-muted mb-2">Total Revenue</p>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bold mb-0">₹ {{ number_format($totalRevenue, 2) }}</h3>
                        </div>
                        <div class="avatar avatar-md bg-warning-transparent rounded-circle">
                            <i class="bi bi-currency-rupee fs-5 text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <p class="text-muted mb-2">Pending Withdrawals</p>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bold mb-0">₹ {{ number_format($pendingWithdrawals, 2) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <p class="text-muted mb-2">Today's Cases</p>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bold mb-0">{{ number_format($todaysCases) }}</h3>
                        </div>
                        <div class="fs-12 text-success">
                            <i class="bi bi-arrow-up-right me-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <p class="text-muted mb-2">Today's Challans</p>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bold mb-0">{{ number_format($todaysChallans) }}</h3>
                        </div>
                        <div class="fs-12 text-success">
                            <i class="bi bi-arrow-up-right me-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <p class="text-muted mb-2">Active Prahari</p>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bold mb-0">{{ number_format($activePrahari) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8 col-lg-12 mb-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Cases Overview</h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ $activeFilterText }}
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('dashboardAdmin', ['filter' => 'week']) }}">This Week</a></li>
                            <li><a class="dropdown-item" href="{{ route('dashboardAdmin', ['filter' => 'month']) }}">This Month</a></li>
                            <li><a class="dropdown-item" href="{{ route('dashboardAdmin', ['filter' => 'year']) }}">This Year</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div id="cases-overview-chart" style="height: 320px;"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-12 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Challan Status</h5>
                </div>
                <div class="card-body">
                    <div id="challan-status-chart" style="height: 320px;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-script')
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Dynamic data from controller
            var casesTrendData = @json($casesTrend);
            var challanTrendData = @json($challanTrendData);
            var challanStatusData = @json($challanStatus);
            var chartLabelsData = @json($chartLabels);

            // Cases Overview Chart
            var casesOptions = {
                series: [{
                    name: 'Total Cases',
                    data: casesTrendData
                }, {
                    name: 'Total Challans',
                    data: challanTrendData
                }],
                chart: {
                    height: 320,
                    type: 'area',
                    toolbar: { show: false }
                },
                colors: ['#0d6efd', '#20c997'],
                dataLabels: { enabled: false },
                stroke: { curve: 'smooth', width: 3 },
                xaxis: {
                    categories: chartLabelsData,
                    labels: { style: { colors: '#6c757d' } }
                },
                grid: {
                    borderColor: '#ebedf3',
                    strokeDashArray: 4
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right'
                }
            };
            var casesChart = new ApexCharts(document.querySelector('#cases-overview-chart'), casesOptions);
            casesChart.render();

            // Challan Status Chart
            var statusOptions = {
                series: [
                    challanStatusData['Paid'],
                    challanStatusData['Pending'],
                    challanStatusData['Cancelled']
                ],
                chart: {
                    type: 'donut',
                    height: 320
                },
                labels: ['Paid', 'Pending', 'Cancelled'],
                colors: ['#0d6efd', '#ffc107', '#dc3545'],
                plotOptions: {
                    pie: {
                        donut: {
                            size: '70%'
                        }
                    }
                },
                legend: {
                    position: 'bottom'
                }
            };
            var statusChart = new ApexCharts(document.querySelector('#challan-status-chart'), statusOptions);
            statusChart.render();
        });
    </script>
@endpush