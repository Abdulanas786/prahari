



    <!-- HEADER -->
    
        </form>
    </div>

    <!-- CHARTS -->
    <div class="row g-4">

        <!-- Cases Trend -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <h5 class="fw-bold mb-4">Cases Trend</h5>

                    <canvas id="settingsCasesChart" height="220"></canvas>
                </div>
            </div>
        </div>

        <!-- Revenue Trend -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <h5 class="fw-bold mb-4">Revenue Trend</h5>

                    <canvas id="settingsRevenueChart" height="220"></canvas>
                </div>
            </div>
        </div>

    </div>

    <!-- PRAHARI PERFORMANCE -->
    <div class="card border-0 shadow-sm rounded-4 mt-4">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">Prahari Performance Reports</h5>

                <div class="dropdown">
                    <button class="btn btn-dark dropdown-toggle px-4 shadow-sm" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-box-arrow-up me-2"></i> Export
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 rounded-3" aria-labelledby="exportDropdown">
                        <li>
                            <a class="dropdown-item py-2 d-flex align-items-center gap-2" href="{{ route('reports.export.csv') }}">
                                <i class="bi bi-filetype-csv text-success fs-5"></i> Export CSV
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item py-2 d-flex align-items-center gap-2" href="{{ route('reports.export.pdf') }}">
                                <i class="bi bi-filetype-pdf text-danger fs-5"></i> Export PDF
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Prahari Name</th>
                            <th>Total Cases</th>
                            <th>Total Challans</th>
                            <th>Earnings</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($prahariPerformance as $key => $prahari)

                            <tr>
                                <td>{{ $key + 1 }}</td>

                                <td>{{ $prahari->Prahari }}</td>

                                <td>{{ $prahari->cases_count }}</td>

                                <td>{{ $prahari->challans_count }}</td>

                                <td>
                                    ₹ {{ number_format($prahari->total_earnings ?? 0, 2) }}
                                </td>

                                <td>
                                    @if($prahari->status == 'Active')
                                        <span class="badge bg-success">
                                            Active
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            Inactive
                                        </span>
                                    @endif
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="text-center">
                                    No Records Found
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>




<!-- Chart JS -->

@push('page-script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    // CASES TREND
    let settingsCasesCtx = document.getElementById('settingsCasesChart');

    new Chart(settingsCasesCtx, {
        type: 'line',

        data: {
            labels: @json($months),

            datasets: [{
                label: 'Cases',

                data: @json($casesData),

                borderWidth: 3,

                tension: 0.4,

                fill: false
            }]
        }
    });


    // REVENUE TREND
    let settingsRevenueCtx = document.getElementById('settingsRevenueChart');

    new Chart(settingsRevenueCtx, {
        type: 'bar',

        data: {
            labels: @json($months),

            datasets: [{
                label: 'Revenue',

                data: @json($revenueData),

                borderWidth: 1
            }]
        }
    });

</script>


@endpush
