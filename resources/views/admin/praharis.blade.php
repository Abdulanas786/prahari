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
        <h4 class="fw-bold mb-0 text-dark fs-4">Prahari</h4>
        <div>
            <button class="btn btn-info text-white shadow-sm px-4 py-2 fw-medium me-2" id="importCsvBtn"><i class="bi bi-file-earmark-arrow-up"></i> Import CSV</button>
            <a href="{{ route('prahari.index', ['export' => 'csv']) }}" class="btn btn-success shadow-sm px-4 py-2 fw-medium me-2"><i class="bi bi-file-earmark-spreadsheet"></i> Export CSV</a>
            <button class="btn btn-primary addBtn shadow-sm px-4 py-2 fw-medium">+ Add Prahari</button>
        </div>
        
        <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModal" data-bs-keyboard="false"
            aria-hidden="true">
            <!-- Scrollable modal -->
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header">
                        <h6 class="modal-title fw-bold" id="staticBackdropLabel2">Create Prahari</h6>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="praharisForm" action="{{ url('account/prahari') }}" method="POST">
                        @csrf
                        <div class="modal-body p-4">
                            <input type="hidden" class="form-control" name="prahari_id" id="prahari_id">
                            <div class="mb-3">
                                <label for="Prahari" class="form-label fw-medium text-dark">Prahari <span class="text-danger">*</span></label>
                                <input type="text" class="form-control shadow-none" id="Prahari" name="Prahari"
                                    placeholder="Enter Prahari name" required>
                            </div>

                            <div class="mb-3">
                                <label for="Mobile" class="form-label fw-medium text-dark">Mobile <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control shadow-none" id="Mobile" name="Mobile"
                                    placeholder="Enter mobile number" required>
                            </div>

                            <div class="mb-3">
                                <label for="AadhaarStatus" class="form-label fw-medium text-dark">Aadhaar Status <span class="text-danger">*</span></label>
                                <select class="form-select shadow-none" id="AadhaarStatus" name="AadhaarStatus" required>
                                    <option value="">Select Status</option>
                                    <option value="Verified">Verified</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Rejected">Rejected</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="Bank_account_detail" class="form-label fw-medium text-dark">Bank Account Detail <span class="text-danger">*</span></label>
                                <input type="text" class="form-control shadow-none" id="Bank_account_detail" name="Bank_account_detail"
                                    placeholder="Enter bank account detail" required>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label fw-medium text-dark">Status <span class="text-danger">*</span></label>
                                <select class="form-select shadow-none" id="status" name="status" required>
                                    <option value="">Select Status</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
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

        <!-- Import CSV Modal -->
        <div class="modal fade" id="importCsvModal" tabindex="-1" aria-labelledby="importCsvModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header">
                        <h6 class="modal-title fw-bold" id="importCsvModalLabel">Import Praharis from CSV</h6>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <!-- Instructions & Template Info -->
                        <div class="alert alert-light border mb-4 rounded-3 bg-light">
                            <h6 class="fw-bold text-dark mb-2"><i class="bi bi-info-circle-fill text-info me-2"></i>Expected CSV Schema</h6>
                            <p class="small text-muted mb-2">Ensure your CSV file contains these headers (case-insensitive):</p>
                            <div class="d-flex flex-wrap gap-2">
                                <span class="badge bg-white border text-dark font-monospace py-2 px-3 fs-7">Prahari</span>
                                <span class="badge bg-white border text-dark font-monospace py-2 px-3 fs-7">Mobile</span>
                                <span class="badge bg-white border text-dark font-monospace py-2 px-3 fs-7">AadhaarStatus</span>
                                <span class="badge bg-white border text-dark font-monospace py-2 px-3 fs-7">Bank_account_detail</span>
                                <span class="badge bg-white border text-dark font-monospace py-2 px-3 fs-7">status</span>
                            </div>
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
                                            <th>Mobile</th>
                                            <th>AadhaarStatus</th>
                                            <th>Bank Account</th>
                                            <th>Status</th>
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
                    <input type="text" id="customSearch" class="form-control border-start-0 ps-0 shadow-none" placeholder="Search by Name, Mobile, Prahari ID...">
                </div>
                <button class="btn btn-outline-secondary d-flex align-items-center gap-2 px-4 shadow-sm bg-white text-dark border">
                    <i class="bi bi-funnel"></i> Filter
                </button>
            </div>

            <div class="table-responsive">
                <table class="table text-nowrap align-middle" id="praharisTable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-muted fw-semibold pb-3 text-uppercase" style="font-size: 0.85rem;">S.No</th>
                            <th class="text-muted fw-semibold pb-3 text-uppercase" style="font-size: 0.85rem;">Prahari</th>
                            <th class="text-muted fw-semibold pb-3 text-uppercase" style="font-size: 0.85rem;">Mobile</th>
                            <th class="text-muted fw-semibold pb-3 text-uppercase" style="font-size: 0.85rem;">Aadhaar Status</th>
                            <th class="text-muted fw-semibold pb-3 text-uppercase" style="font-size: 0.85rem;">Bank Account</th>
                            <th class="text-muted fw-semibold pb-3 text-uppercase" style="font-size: 0.85rem;">Status</th>
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

            $('.addBtn').on('click', function() {
                $('#praharisForm')[0].reset();
                $('#prahari_id').val('');

                $('.form-control').removeClass('is-valid is-invalid');
                $('.invalid-feedback').remove();

                $('#staticBackdropLabel2').text('Add Prahari');

                let modal = new bootstrap.Modal(document.getElementById('userModal'));
                modal.show();
            });

            // Remove error instantly when typing/changing
            $('#praharisForm').on('input change', '.form-control', function() {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            });

            let table = $('#praharisTable').DataTable({
                processing: true,
                serverSide: true,
                dom: '<"top">rt<"row mt-3"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>><"clear">', // Removes default search (f)
                ajax: "{{ route('prahari.index') }}",
                columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'Prahari',
                    name: 'Prahari'
                },
                {
                    data: 'Mobile',
                    name: 'Mobile'
                },
                {
                    data: 'AadhaarStatus',
                    name: 'AadhaarStatus'
                },
                {
                    data: 'Bank_account_detail',
                    name: 'Bank_account_detail'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

            // Bind custom search input
            $('#customSearch').on('keyup', function() {
                table.search(this.value).draw();
            });

            $('#praharisForm').validate({
                rules: {
                    Prahari: {
                        required: true,
                        minlength: 3
                    },
                    Mobile: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 15,
                    },
                    AadhaarStatus: {
                        required: true
                    },
                    Bank_account_detail: {
                        required: true,
                        minlength: 3
                    },
                    status: {
                        required: true
                    }
                },

                messages: {
                    Prahari: {
                        required: "Please enter prahari name"
                    },
                    Mobile: {
                        required: "Please enter mobile number",
                        digits: "Please enter only digits",
                        minlength: "Mobile number must be at least 10 digits",
                        maxlength: "Mobile number may be at most 15 digits"
                    },
                    AadhaarStatus: {
                        required: "Please select Aadhaar status"
                    },
                    Bank_account_detail: {
                        required: "Please enter bank account detail"
                    },
                    status: {
                        required: "Please select status"
                    }
                },

                errorElement: 'div',
                errorClass: 'invalid-feedback',

                highlight: function(element) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },

                unhighlight: function(element) {
                    $(element).removeClass('is-invalid').addClass('is-valid');
                },

                errorPlacement: function(error, element) {
                    if (!element.next('.invalid-feedback').length) {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function(form) {

                    let csrfToken = "{{ csrf_token() }}";
                    let id = $('#prahari_id').val();
                    let baseUrl = "{{ url('account/prahari') }}";
                    let url = id ? baseUrl + '/' + id : baseUrl;
                    let data = new FormData(form);
                    data.append('_token', csrfToken);
                    if (id) {
                        data.append('_method', 'PUT');
                    }

                    $('.form-control').removeClass('is-invalid');
                    $('.invalid-feedback').remove();

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: data,
                        processData: false,
                        contentType: false,

                        beforeSend: function() {
                            $('button[type="submit"]')
                                .prop('disabled', true)
                                .text('Submitting...');
                        },

                        success: function(response) {
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonColor: '#3085d6'
                            });

                            $('#praharisForm')[0].reset();

                            $('.form-control').removeClass('is-valid is-invalid');
                            $('.invalid-feedback').remove();

                            $('#userModal').modal('hide');
                            table.ajax.reload();

                            $('button[type="submit"]')
                                .prop('disabled', false)
                                .text('Submit');
                        },

                        error: function(xhr) {
                            $('button[type="submit"]')
                                .prop('disabled', false)
                                .text('Submit');

                            if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                                let errors = xhr.responseJSON.errors;

                                $.each(errors, function(field, messages) {
                                    let input = $('#' + field);

                                    input.addClass('is-invalid');

                                    if (!input.next('.invalid-feedback').length) {
                                        input.after(`
                                            <div class="invalid-feedback">
                                                ${messages[0]}
                                            </div>
                                        `);
                                    }
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Something went wrong',
                                    icon: 'error',
                                    confirmButtonColor: '#3085d6'
                                });
                            }
                        }
                    });

                    return false;
                }
            });

            $(document).on('click', '.editBtn', function() {
                let id = $(this).data('id');
                let url = "{{ url('account/prahari') }}" + '/' + id + '/edit';

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(res) {
                        $('#praharisForm')[0].reset();
                        $('.form-control').removeClass('is-valid is-invalid');
                        $('.invalid-feedback').remove();
                        $('#prahari_id').val(res.data.id);
                        $('#Prahari').val(res.data.Prahari);
                        $('#Mobile').val(res.data.Mobile);
                        $('#AadhaarStatus').val(res.data.AadhaarStatus);
                        $('#Bank_account_detail').val(res.data.Bank_account_detail);
                        $('#status').val(res.data.status);
                        $('#staticBackdropLabel2').text('Edit Prahari');
                        let modal = new bootstrap.Modal(document.getElementById('userModal'));
                        modal.show();
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
            });

            $(document).on('click', '.deleteBtn', function() {
                let id = $(this).data('id');
                let url = "{{ url('account/prahari') }}" + '/' + id;
                let csrfToken = "{{ csrf_token() }}";

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
                            url: url,
                            type: 'POST',
                            data: {
                                _method: 'DELETE',
                                _token: csrfToken
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
            const expectedHeaders = ['prahari', 'mobile', 'aadhaarstatus', 'bank_account_detail', 'status'];
            let parsedData = [];

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

                const matchedCount = expectedHeaders.filter(eh => colIndices[eh] !== -1).length;
                 if (matchedCount === 0) {
                     Swal.fire({
                         title: 'Columns Mismatch',
                         text: "Could not match any expected columns. Please check your headers.",
                         icon: 'error',
                         confirmButtonColor: '#3085d6'
                     });
                     return;
                 }

                parsedData = [];
                const previewRows = [];
                
                for (let i = 1; i < rows.length; i++) {
                    const rowData = rows[i];
                    if (rowData.length === 1 && rowData[0] === '') continue;

                    const item = {
                        Prahari: colIndices['prahari'] !== -1 ? rowData[colIndices['prahari']] : '',
                        Mobile: colIndices['mobile'] !== -1 ? rowData[colIndices['mobile']] : '',
                        AadhaarStatus: colIndices['aadhaarstatus'] !== -1 ? rowData[colIndices['aadhaarstatus']] : '',
                        Bank_account_detail: colIndices['bank_account_detail'] !== -1 ? rowData[colIndices['bank_account_detail']] : '',
                        status: colIndices['status'] !== -1 ? rowData[colIndices['status']] : ''
                    };
                    
                    if (item.status) {
                        item.status = item.status.trim().charAt(0).toUpperCase() + item.status.trim().slice(1).toLowerCase();
                    }
                    if (item.AadhaarStatus) {
                        item.AadhaarStatus = item.AadhaarStatus.trim().charAt(0).toUpperCase() + item.AadhaarStatus.trim().slice(1).toLowerCase();
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
                    if (!r.Prahari || r.Prahari.length < 3) errors.push("Name too short");
                    if (!r.Mobile || !/^\d{10,15}$/.test(r.Mobile.trim())) errors.push("Invalid mobile");
                    if (!['Verified', 'Pending', 'Rejected'].includes(r.AadhaarStatus)) errors.push("Invalid Aadhaar status");
                    if (!r.Bank_account_detail || r.Bank_account_detail.length < 3) errors.push("Invalid Bank details");
                    if (!['Active', 'Inactive'].includes(r.status)) errors.push("Invalid Status");

                    const badge = errors.length === 0 
                        ? `<span class="badge bg-success text-white">Valid</span>` 
                        : `<span class="badge bg-danger text-white">${errors.join(', ')}</span>`;

                    tbody.append(`
                        <tr>
                            <td>${idx + 1}</td>
                            <td>${escapeHtml(r.Prahari)}</td>
                            <td>${escapeHtml(r.Mobile)}</td>
                            <td>${escapeHtml(r.AadhaarStatus)}</td>
                            <td>${escapeHtml(r.Bank_account_detail)}</td>
                            <td>${escapeHtml(r.status)}</td>
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
                        url: "{{ url('account/prahari') }}",
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            Prahari: item.Prahari,
                            Mobile: item.Mobile,
                            AadhaarStatus: item.AadhaarStatus,
                            Bank_account_detail: item.Bank_account_detail,
                            status: item.status
                        },
                        success: function() {
                            successCount++;
                            currentIdx++;
                            importNextRow();
                        },
                        error: function(xhr) {
                            failCount++;
                            let errMsg = `Row ${currentIdx + 2} (${item.Prahari || 'Unknown'}): `;
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