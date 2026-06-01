@extends('admin.layouts.master')

@push('page-style')
<style>
    /* Custom Pagination Styling */
    .dataTables_wrapper .dataTables_paginate .pagination {
        gap: 5px;
    }
    .dataTables_wrapper .dataTables_paginate .page-item.active .page-link {
        background-color: #1a202c !important;
        border-color: #1a202c !important;
        color: white !important;
        border-radius: 6px !important;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .dataTables_wrapper .dataTables_paginate .page-item .page-link {
        color: #4a5568 !important;
        background: transparent;
        border: 1px solid transparent;
        font-weight: 600;
        border-radius: 6px !important;
        padding: 0.4rem 0.8rem;
    }
    .dataTables_wrapper .dataTables_paginate .page-item .page-link:hover {
        background-color: #f1f5f9 !important;
        border-color: #e2e8f0 !important;
    }
    /* Add subtle border to the last page number (like 20 in the image) and prev/next if visible */
    .dataTables_wrapper .dataTables_paginate .page-item:last-child .page-link,
    .dataTables_wrapper .dataTables_paginate .page-item:first-child .page-link {
        border: 1px solid #e2e8f0;
    }
</style>
@endpush

@section('page-content')
    <div class="d-flex align-items-center justify-content-between mb-4 mt-4">
        <h4 class="fw-bold mb-0 text-dark fs-4">Cases</h4>
        <div>
            <button class="btn btn-info text-white shadow-sm px-4 py-2 fw-medium me-2" id="importCsvBtn"><i class="bi bi-file-earmark-arrow-up"></i> Import CSV</button>
            <a href="{{ route('cases.index', ['export' => 'csv']) }}" class="btn btn-success shadow-sm px-4 py-2 fw-medium me-2"><i class="bi bi-file-earmark-spreadsheet"></i> Export CSV</a>
            <button class="btn btn-primary addBtn shadow-sm px-4 py-2 fw-medium">+ Add Case</button>
        </div>
        
        <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModal" data-bs-keyboard="false"
            aria-hidden="true">
            <!-- Scrollable modal -->
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header">
                        <h6 class="modal-title fw-bold" id="staticBackdropLabel2">Create Case</h6>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="casesForm" action="{{ url('account/cases') }}" method="GET" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body p-4">
                            <input type="hidden" class="form-control" name="cases_id" id="cases_id">
                            <div class="mb-3">
                                <label for="prahari_id" class="form-label fw-medium text-dark">Prahari <span class="text-danger">*</span></label>
                                <select class="form-select shadow-none" id="prahari_id" name="prahari_id" required>
                                    <option value="">Select Prahari</option>
                                    @foreach($praharis as $p)
                                        <option value="{{ $p->id }}">{{ $p->Prahari }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="category_id" class="form-label fw-medium text-dark">Type <span class="text-danger">*</span></label>
                                <select class="form-select shadow-none" id="category_id" name="category_id" required>
                                    <option value="">Select Type</option>
                                    @foreach($categories as $c)
                                        <option value="{{ $c->id }}">{{ $c->Type }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="Location" class="form-label fw-medium text-dark">Location <span class="text-danger">*</span></label>
                                <input type="text" class="form-control shadow-none" id="Location" name="Location"
                                    placeholder="Enter Location" required>
                            </div>

                            <div class="mb-3">
                                <label for="evidence_file" class="form-label fw-medium text-dark">Evidence <span class="text-danger">*</span></label>
                                <input type="text" class="form-control shadow-none" id="evidence_file" name="evidence_file" 
                                placeholder="Enter Evidence" required>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label fw-medium text-dark">Status <span class="text-danger">*</span></label>
                                <select class="form-select shadow-none" id="status" name="status" required>
                                    <option value="">Select Status</option>
                                    <option value="Open">Open</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Closed">Closed</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="violation_date" class="form-label fw-medium text-dark">Violation Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control shadow-none" id="violation_date" name="violation_date" required>
                            </div>
                        </div>
                        <div class="modal-footer border-top-0">
                            <button type="button" class="btn btn-light shadow-sm" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary shadow-sm">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- View Case Modal -->
        <div class="modal fade" id="viewCaseModal" tabindex="-1" aria-labelledby="viewCaseModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-light py-3">
                        <h6 class="modal-title fw-bold text-dark" id="viewCaseModalLabel">
                            <i class="bi bi-file-earmark-text text-primary me-2"></i>Case Details
                        </h6>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                            <div class="bg-primary-transparent text-primary rounded-3 p-3 me-3 d-flex align-items-center justify-content-center" style="width: 54px; height: 54px; font-size: 1.5rem; background-color: rgba(13, 110, 253, 0.08);">
                                <i class="bi bi-shield-fill"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1 text-dark">Case ID: <span id="vCaseId">#</span></h6>
                                <span class="badge" id="vStatusBadge"></span>
                            </div>
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="d-flex justify-content-between border-bottom pb-2">
                                    <span class="text-dark small">Prahari Name</span>
                                    <span class="fw-semibold text-dark small" id="vPrahariName">-</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-between border-bottom pb-2">
                                    <span class="text-dark small">Type / Category</span>
                                    <span class="fw-semibold text-dark small" id="vCategoryType">-</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-between border-bottom pb-2">
                                    <span class="text-dark small">Location</span>
                                    <span class="fw-semibold text-dark small" id="vLocation">-</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-between border-bottom pb-2">
                                    <span class="text-dark small">Violation Date</span>
                                    <span class="fw-semibold text-dark small" id="vViolationDate">-</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex flex-column">
                                    <span class="text-dark small mb-1">Evidence Reference</span>
                                    <div class="p-3 bg-light rounded-3 border">
                                        <i class="bi bi-paperclip text-muted me-1"></i>
                                        <span class="font-monospace small text-dark" id="vEvidenceFile">-</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 py-3 bg-light">
                        <button type="button" class="btn btn-light shadow-sm w-100 fw-medium" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Import CSV Modal -->
        <div class="modal fade" id="importCsvModal" tabindex="-1" aria-labelledby="importCsvModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header">
                        <h6 class="modal-title fw-bold" id="importCsvModalLabel">Import Cases from CSV</h6>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <!-- Instructions & Template Info -->
                        <div class="alert alert-light border mb-4 rounded-3 bg-light">
                            <h6 class="fw-bold text-dark mb-2"><i class="bi bi-info-circle-fill text-info me-2"></i>Expected CSV Schema</h6>
                            <p class="small text-muted mb-2">Ensure your CSV file contains these headers (case-insensitive):</p>
                            <div class="d-flex flex-wrap gap-2">
                                <span class="badge bg-white border text-dark font-monospace py-2 px-3 fs-7">Prahari</span>
                                <span class="badge bg-white border text-dark font-monospace py-2 px-3 fs-7">Category</span>
                                <span class="badge bg-white border text-dark font-monospace py-2 px-3 fs-7">Location</span>
                                <span class="badge bg-white border text-dark font-monospace py-2 px-3 fs-7">Evidence</span>
                                <span class="badge bg-white border text-dark font-monospace py-2 px-3 fs-7">status</span>
                                <span class="badge bg-white border text-dark font-monospace py-2 px-3 fs-7">Violation_Date</span>
                            </div>
                            <p class="small text-muted mt-2 mb-0">Note: <strong>Prahari</strong> and <strong>Category</strong> can be name or ID. <strong>Violation_Date</strong> format should be YYYY-MM-DD.</p>
                        </div>

                        <!-- Drag & Drop Area -->
                        <div class="drag-drop-zone border border-2 border-dashed rounded-3 p-5 text-center cursor-pointer mb-4 bg-light" id="dragDropZone" style="border-color: #cbd5e1 !important; transition: all 0.2s ease-in-out;">
                            <i class="bi bi-cloud-arrow-up text-muted display-4"></i>
                            <h5 class="mt-3 fw-semibold text-dark">Drag & drop your CSV file here</h5>
                            <p class="text-muted small mb-0">or click to browse from your computer</p>
                            <input type="file" id="csvFileInput" accept=".csv" class="d-none">
                        </div>

                        <!-- Parsing / Mapping Preview -->
                        <div id="previewContainer" class="d-none">
                            <h6 class="fw-bold text-dark mb-3">Preview & Validation (Top 5 rows)</h6>
                            <div class="table-responsive border rounded-3 mb-4">
                                <table class="table table-sm table-hover mb-0" id="previewTable">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Prahari</th>
                                            <th>Category</th>
                                            <th>Location</th>
                                            <th>Evidence</th>
                                            <th>Status</th>
                                            <th>Violation Date</th>
                                            <th>Validation</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Progress Section -->
                        <div id="importProgressContainer" class="d-none mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-medium text-dark" id="progressStatus">Importing...</span>
                                <span class="fw-bold text-primary" id="progressPercentage">0%</span>
                            </div>
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" id="importProgressBar" role="progressbar" style="width: 0%;"></div>
                            </div>
                        </div>

                        <!-- Summary Section -->
                        <div id="importSummaryContainer" class="d-none mb-0">
                            <div class="alert alert-success border-0 shadow-sm d-flex align-items-start p-3 rounded-3" id="summarySuccessAlert">
                                <i class="bi bi-check-circle-fill text-success fs-4 me-3"></i>
                                <div>
                                    <h6 class="fw-bold text-dark mb-1">Import Completed</h6>
                                    <p class="small text-muted mb-0" id="summaryText"></p>
                                </div>
                            </div>
                            <div id="importErrorsList" class="mt-3 d-none">
                                <h6 class="fw-bold text-danger mb-2">Error Logs:</h6>
                                <div class="bg-light border rounded-3 p-3 text-danger font-monospace small" style="max-height: 150px; overflow-y: auto;" id="errorsLog">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn btn-light shadow-sm" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary shadow-sm d-none" id="startImportBtn">Start Import</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <!-- Custom Search and Filter -->
            <div class="d-flex justify-content-end mb-4 gap-3">
                <div class="input-group" style="width: 350px;">
                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                    <input type="text" id="customSearch" class="form-control border-start-0 ps-0 shadow-none" placeholder="Search by Case ID, Prahari...">
                </div>
                <button class="btn btn-outline-secondary d-flex align-items-center gap-2 px-4 shadow-sm bg-white text-dark border">
                    <i class="bi bi-funnel"></i> Filter
                </button>
            </div>

            <div class="table-responsive">
                <table class="table text-nowrap align-middle" id="praharisTable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-muted fw-semibold pb-3 text-uppercase" style="font-size: 0.85rem;">S.No.</th>
                            <th class="text-muted fw-semibold pb-3 text-uppercase" style="font-size: 0.85rem;">Case ID</th>
                            <th class="text-muted fw-semibold pb-3 text-uppercase" style="font-size: 0.85rem;">Prahari Name</th>
                            <th class="text-muted fw-semibold pb-3 text-uppercase" style="font-size: 0.85rem;">Type</th>
                            <th class="text-muted fw-semibold pb-3 text-uppercase" style="font-size: 0.85rem;">Location</th>
                            <th class="text-muted fw-semibold pb-3 text-uppercase" style="font-size: 0.85rem;">Status</th>
                            <th class="text-muted fw-semibold pb-3 text-uppercase" style="font-size: 0.85rem;">Violation Date</th>
                            <th class="text-muted fw-semibold pb-3 text-uppercase" style="font-size: 0.85rem;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- To be stored with Ajax --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('page-script')
    <script>
$(document).ready(function() {

    // 🔹 OPEN MODAL
    $('.addBtn').on('click', function() {
        $('#casesForm')[0].reset();
        $('#cases_id').val('');
        $('.form-control, .form-select').removeClass('is-valid is-invalid');
        $('.invalid-feedback').remove();
        $('#staticBackdropLabel2').text('Add Case');

        new bootstrap.Modal('#userModal').show();
    });

    // 🔹 DATATABLE
    let table = $('#praharisTable').DataTable({
        processing: true,
        serverSide: true,
        dom: '<"top">rt<"row mt-3"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>><"clear">', // Removes default search
        ajax: "{{ route('cases.index') }}",
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'id' },
            { data: 'prahari_name' },
            { data: 'category_name' },
            { data: 'Location' },
            { data: 'status' },
            { data: 'violation_date' },
            { data: 'action', orderable: false, searchable: false }
        ]
    });

    // 🔹 Bind custom search input
    $('#customSearch').on('keyup', function() {
        table.search(this.value).draw();
    });

    // 🔹 VALIDATION
    $('#casesForm').validate({
        errorElement: 'div',
        errorClass: 'invalid-feedback text-danger',
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        highlight: function (element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element) {
            $(element).removeClass('is-invalid');
        },
        rules: {
            prahari_id: { required: true },
            category_id: { required: true },
            Location: { required: true, minlength: 3 },
            evidence_file: { required: true },
            status: { required: true },
            violation_date: { required: true }
        },
        messages: {
            prahari_id: { required: "Please select a Prahari." },
            category_id: { required: "Please select a Type." },
            Location: { 
                required: "Please enter a Location.",
                minlength: "Location must be at least 3 characters."
            },
            evidence_file: { required: "Please enter Evidence details." },
            status: { required: "Please select a Status." },
            violation_date: { required: "Please select a Violation Date." }
        },

        submitHandler: function(form) {

            let id = $('#cases_id').val();
            let url = id 
                ? "{{ url('account/cases') }}/" + id 
                : "{{ url('account/cases') }}";

            let data = new FormData(form);

            if (id) {
                data.append('_method', 'PUT');
            }

            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                processData: false,
                contentType: false,

                success: function(res) {
                    Swal.fire({
                        title: 'Success!',
                        text: res.message,
                        icon: 'success',
                        confirmButtonColor: '#3085d6'
                    });
                    $('#casesForm')[0].reset();
                    $('#userModal').modal('hide');
                    table.ajax.reload();
                },

                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(field, msg) {
                            let input = $('#' + field);
                            input.addClass('is-invalid');
                            input.after(`<div class="invalid-feedback">${msg[0]}</div>`);
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Error occurred',
                            icon: 'error',
                            confirmButtonColor: '#3085d6'
                        });
                    }
                }
            });

            return false;
        }
    });

    // 🔹 VIEW DETAILS
    $(document).on('click', '.viewBtn', function() {
        let id = $(this).data('id');

        $.get("{{ url('account/cases') }}/" + id + "/edit", function(res) {
            const data = res.data;
            $('#vCaseId').text('#' + data.id);
            $('#vPrahariName').text(data.prahari ? data.prahari.Prahari : 'N/A');
            $('#vCategoryType').text(data.category ? data.category.Type : 'N/A');
            $('#vLocation').text(data.Location || 'N/A');
            $('#vViolationDate').text(data.violation_date ? new Date(data.violation_date).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' }) : 'N/A');
            $('#vEvidenceFile').text(data.evidence_file || 'No evidence file attached');

            // Format Status Badge
            const status = data.status || 'Open';
            const badge = $('#vStatusBadge');
            badge.removeClass('bg-success bg-warning bg-danger bg-info');
            if (status === 'Open') {
                badge.addClass('bg-warning text-dark').text('Open');
            } else if (status === 'In Progress') {
                badge.addClass('bg-info text-white').text('In Progress');
            } else {
                badge.addClass('bg-success text-white').text('Closed');
            }

            new bootstrap.Modal('#viewCaseModal').show();
        });
    });

    // 🔹 EDIT
    $(document).on('click', '.editBtn', function() {
        let id = $(this).data('id');

        $.get("{{ url('account/cases') }}/" + id + "/edit", function(res) {

            $('#cases_id').val(res.data.id);
            $('#prahari_id').val(res.data.prahari_id);
            $('#category_id').val(res.data.category_id);
            $('#Location').val(res.data.Location);
            $('#status').val(res.data.status);
            $('#violation_date').val(res.data.violation_date);

            $('#staticBackdropLabel2').text('Edit Case');
            new bootstrap.Modal('#userModal').show();
        });
    });

    // 🔹 DELETE
    $(document).on('click', '.deleteBtn', function() {
        let id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ url('account/cases') }}/" + id,
                    type: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        Swal.fire({
                            title: 'Deleted!',
                            text: res.message,
                            icon: 'success',
                            confirmButtonColor: '#3085d6'
                        });
                        table.ajax.reload();
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong',
                            icon: 'error',
                            confirmButtonColor: '#3085d6'
                        });
                    }
                });
            }
        });
    });

    // -------------------------------------------------------------
    // CSV IMPORT FUNCTIONALITY
    // -------------------------------------------------------------
    const expectedHeaders = ['prahari', 'category', 'type', 'location', 'evidence', 'evidence_file', 'status', 'violation_date', 'violation date'];
    let parsedData = [];

    // Build lookups
    const prahariMap = {};
    $('#prahari_id option').each(function() {
        const val = $(this).val();
        const txt = $(this).text().trim().toLowerCase();
        if (val) {
            prahariMap[txt] = val;
            prahariMap[val] = val;
        }
    });

    const categoryMap = {};
    $('#category_id option').each(function() {
        const val = $(this).val();
        const txt = $(this).text().trim().toLowerCase();
        if (val) {
            categoryMap[txt] = val;
            categoryMap[val] = val;
        }
    });

    $('#importCsvBtn').on('click', function() {
        $('#csvFileInput').val('');
        parsedData = [];
        resetImportModal();
        new bootstrap.Modal(document.getElementById('importCsvModal')).show();
    });

    const zone = document.getElementById('dragDropZone');
    const fileInput = document.getElementById('csvFileInput');

    zone.addEventListener('click', () => fileInput.click());
    zone.addEventListener('dragover', (e) => {
        e.preventDefault();
        zone.style.backgroundColor = '#e2e8f0';
        zone.style.borderColor = '#475569';
    });
    zone.addEventListener('dragleave', () => {
        zone.style.backgroundColor = '';
        zone.style.borderColor = '';
    });
    zone.addEventListener('drop', (e) => {
        e.preventDefault();
        zone.style.backgroundColor = '';
        zone.style.borderColor = '';
        if (e.dataTransfer.files.length) {
            fileInput.files = e.dataTransfer.files;
            handleFileSelect();
        }
    });

    fileInput.addEventListener('change', handleFileSelect);

    function handleFileSelect() {
        const file = fileInput.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(e) {
            parseAndPreview(e.target.result);
        };
        reader.readAsText(file);
    }

    function parseAndPreview(csvText) {
        const rows = parseCSV(csvText);
        if (rows.length < 2) {
            Swal.fire({
                title: 'Invalid CSV',
                text: "Invalid CSV file. It must contain at least headers and one data row.",
                icon: 'error',
                confirmButtonColor: '#3085d6'
            });
            return;
        }

        const headers = rows[0].map(h => h.trim().toLowerCase());
        
        const colIndices = {};
        expectedHeaders.forEach(eh => {
            colIndices[eh] = headers.indexOf(eh);
        });

        parsedData = [];
        const previewRows = [];
        
        for (let i = 1; i < rows.length; i++) {
            const rowData = rows[i];
            if (rowData.length === 1 && rowData[0] === '') continue;

            const pVal = colIndices['prahari'] !== -1 ? rowData[colIndices['prahari']] : '';
            const cVal = colIndices['category'] !== -1 ? rowData[colIndices['category']] : (colIndices['type'] !== -1 ? rowData[colIndices['type']] : '');
            const loc = colIndices['location'] !== -1 ? rowData[colIndices['location']] : '';
            const ev = colIndices['evidence'] !== -1 ? rowData[colIndices['evidence']] : (colIndices['evidence_file'] !== -1 ? rowData[colIndices['evidence_file']] : '');
            const st = colIndices['status'] !== -1 ? rowData[colIndices['status']] : '';
            const vd = colIndices['violation_date'] !== -1 ? rowData[colIndices['violation_date']] : (colIndices['violation date'] !== -1 ? rowData[colIndices['violation date']] : '');

            const mappedPrahariId = prahariMap[pVal.trim().toLowerCase()] || '';
            const mappedCategoryId = categoryMap[cVal.trim().toLowerCase()] || '';

            const item = {
                prahari_id: mappedPrahariId,
                prahari_name: pVal,
                category_id: mappedCategoryId,
                category_name: cVal,
                Location: loc,
                evidence_file: ev,
                status: st,
                violation_date: vd
            };

            if (item.status) {
                const sVal = item.status.trim().toLowerCase();
                if (sVal === 'open') item.status = 'Open';
                else if (sVal === 'in progress' || sVal === 'in-progress' || sVal === 'progress') item.status = 'In Progress';
                else if (sVal === 'closed') item.status = 'Closed';
            }

            parsedData.push(item);
            if (previewRows.length < 5) {
                previewRows.push(item);
            }
        }

        const tbody = $('#previewTable tbody');
        tbody.empty();
        previewRows.forEach((r, idx) => {
            let errors = [];
            if (!r.prahari_id) errors.push(`Prahari "${r.prahari_name}" not found`);
            if (!r.category_id) errors.push(`Category "${r.category_name}" not found`);
            if (!r.Location || r.Location.length < 3) errors.push("Location invalid");
            if (!r.evidence_file) errors.push("Evidence missing");
            if (!['Open', 'In Progress', 'Closed'].includes(r.status)) errors.push("Invalid status");
            if (!r.violation_date) errors.push("Violation date missing");

            const badge = errors.length === 0 
                ? `<span class="badge bg-success text-white">Valid</span>` 
                : `<span class="badge bg-danger text-white">${errors.join(', ')}</span>`;

            tbody.append(`
                <tr>
                    <td>${idx + 1}</td>
                    <td>${escapeHtml(r.prahari_name)} (${r.prahari_id || 'Not Found'})</td>
                    <td>${escapeHtml(r.category_name)} (${r.category_id || 'Not Found'})</td>
                    <td>${escapeHtml(r.Location)}</td>
                    <td>${escapeHtml(r.evidence_file)}</td>
                    <td>${escapeHtml(r.status)}</td>
                    <td>${escapeHtml(r.violation_date)}</td>
                    <td>${badge}</td>
                </tr>
            `);
        });

        $('#previewContainer').removeClass('d-none');
        $('#startImportBtn').removeClass('d-none');
    }

    $('#startImportBtn').on('click', function() {
        if (parsedData.length === 0) return;

        $(this).addClass('d-none');
        $('#previewContainer').addClass('d-none');
        $('#dragDropZone').addClass('d-none');
        $('#importProgressContainer').removeClass('d-none');

        let currentIdx = 0;
        let successCount = 0;
        let failCount = 0;
        let errorLogs = [];

        function importNextRow() {
            if (currentIdx >= parsedData.length) {
                $('#importProgressContainer').addClass('d-none');
                $('#importSummaryContainer').removeClass('d-none');
                $('#summaryText').html(`Successfully processed <strong>${parsedData.length}</strong> items. <br><span class="text-success">Succeeded: <strong>${successCount}</strong></span>, <span class="text-danger">Failed: <strong>${failCount}</strong></span>`);
                
                if (errorLogs.length > 0) {
                    $('#importErrorsList').removeClass('d-none');
                    $('#errorsLog').html(errorLogs.join('<br>'));
                }
                table.ajax.reload();
                return;
            }

            const item = parsedData[currentIdx];
            const percentage = Math.round(((currentIdx) / parsedData.length) * 100);
            $('#progressStatus').text(`Importing row ${currentIdx + 1} of ${parsedData.length}...`);
            $('#progressPercentage').text(`${percentage}%`);
            $('#importProgressBar').css('width', `${percentage}%`);

            $.ajax({
                url: "{{ url('account/cases') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    prahari_id: item.prahari_id,
                    category_id: item.category_id,
                    Location: item.Location,
                    evidence_file: item.evidence_file,
                    status: item.status,
                    violation_date: item.violation_date
                },
                success: function() {
                    successCount++;
                    currentIdx++;
                    importNextRow();
                },
                error: function(xhr) {
                    failCount++;
                    let errMsg = `Row ${currentIdx + 2} (${item.Location || 'Unknown'}): `;
                    if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                        const errors = xhr.responseJSON.errors;
                        const firstError = Object.values(errors)[0][0];
                        errMsg += firstError;
                    } else {
                        errMsg += "Server Error";
                    }
                    errorLogs.push(errMsg);
                    currentIdx++;
                    importNextRow();
                }
            });
        }

        importNextRow();
    });

    function resetImportModal() {
        $('#previewContainer').addClass('d-none');
        $('#startImportBtn').addClass('d-none');
        $('#dragDropZone').removeClass('d-none');
        $('#importProgressContainer').addClass('d-none');
        $('#importSummaryContainer').addClass('d-none');
        $('#importErrorsList').addClass('d-none');
        $('#errorsLog').empty();
        $('#importProgressBar').css('width', '0%');
    }

    function parseCSV(text) {
        let lines = [];
        let row = [""];
        let inQuotes = false;
        for (let i = 0; i < text.length; i++) {
            let c = text[i];
            let next = text[i+1];
            if (c === '"') {
                if (inQuotes && next === '"') {
                    row[row.length - 1] += '"';
                    i++;
                } else {
                    inQuotes = !inQuotes;
                }
            } else if (c === ',' && !inQuotes) {
                row.push("");
            } else if ((c === '\r' || c === '\n') && !inQuotes) {
                if (c === '\r' && next === '\n') {
                    i++;
                }
                lines.push(row);
                row = [""];
            } else {
                row[row.length - 1] += c;
            }
        }
        if (row.length > 1 || row[0] !== "") {
            lines.push(row);
        }
        return lines;
    }

    function escapeHtml(text) {
        if (!text) return '';
        return text.toString()
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

});
</script>
@endpush