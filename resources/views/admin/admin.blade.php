@extends('admin.layouts.master')

@push('page-style')
<style>
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
</style>
@endpush

@section('page-content')
    <div class="d-flex align-items-center justify-content-between mb-4 mt-4">
        <h4 class="fw-bold mb-0 text-dark fs-4">Sub-Admins</h4>
        <div>
            <button class="btn btn-info text-white shadow-sm px-4 py-2 fw-medium me-2" id="importCsvBtn"><i class="bi bi-file-earmark-arrow-up"></i> Import CSV</button>
            <a href="{{ route('admins.index', ['export' => 'csv']) }}" class="btn btn-success shadow-sm px-4 py-2 fw-medium me-2"><i class="bi bi-file-earmark-spreadsheet"></i> Export CSV</a>
            <button class="btn btn-primary addBtn shadow-sm px-4 py-2 fw-medium">+ Add Sub-Admin</button>
        </div>
        
        <div class="modal fade" id="adminModal" tabindex="-1" aria-labelledby="adminModal" data-bs-keyboard="false"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header">
                        <h6 class="modal-title fw-bold" id="modalTitle">Create Sub-Admin</h6>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="adminForm" action="{{ route('admins.store') }}" method="POST">
                        @csrf
                        <div class="modal-body p-4">
                            <input type="hidden" class="form-control" name="admin_id" id="admin_id">
                            
                            <div class="mb-3">
                                <label for="name" class="form-label fw-medium text-dark">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control shadow-none" id="name" name="name"
                                    placeholder="Enter full name" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-medium text-dark">Email address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control shadow-none" id="email" name="email"
                                    placeholder="Enter email address" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-medium text-dark">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control shadow-none" id="password" name="password"
                                    placeholder="Enter password" required>
                                <div id="passwordHint" class="form-text text-muted" style="display: none;">Leave blank to keep existing password</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-medium text-dark mb-2">Permissions <span class="text-danger">*</span></label>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input permission-chk" type="checkbox" name="permissions[]" value="manage_praharis" id="perm_praharis">
                                            <label class="form-check-label text-muted fs-13" for="perm_praharis">
                                            Manage Praharis
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input permission-chk" type="checkbox" name="permissions[]" value="manage_cases" id="perm_cases">
                                            <label class="form-check-label text-muted fs-13" for="perm_cases">
                                                Manage Cases
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input permission-chk" type="checkbox" name="permissions[]" value="manage_challans" id="perm_challans">
                                            <label class="form-check-label text-muted fs-13" for="perm_challans">
                                                Manage Challans
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input permission-chk" type="checkbox" name="permissions[]" value="manage_payments" id="perm_payments">
                                            <label class="form-check-label text-muted fs-13" for="perm_payments">
                                                Manage Payments
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input permission-chk" type="checkbox" name="permissions[]" value="manage_reports" id="perm_reports">
                                            <label class="form-check-label text-muted fs-13" for="perm_reports">
                                                Manage Reports
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input permission-chk" type="checkbox" name="permissions[]" value="manage_admins" id="perm_admins">
                                            <label class="form-check-label text-muted fs-13" for="perm_admins">
                                                Manage Admins
                                            </label>
                                        </div>
                                    </div>
                                </div>
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
                        <h6 class="modal-title fw-bold" id="importCsvModalLabel">Import Sub-Admins from CSV</h6>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <!-- Instructions & Template Info -->
                        <div class="alert alert-light border mb-4 rounded-3 bg-light">
                            <h6 class="fw-bold text-dark mb-2"><i class="bi bi-info-circle-fill text-info me-2"></i>Expected CSV Schema</h6>
                            <p class="small text-muted mb-2">Ensure your CSV file contains these headers (case-insensitive):</p>
                            <div class="d-flex flex-wrap gap-2">
                                <span class="badge bg-white border text-dark font-monospace py-2 px-3 fs-7">Name</span>
                                <span class="badge bg-white border text-dark font-monospace py-2 px-3 fs-7">Email</span>
                                <span class="badge bg-white border text-dark font-monospace py-2 px-3 fs-7">Password</span>
                                <span class="badge bg-white border text-dark font-monospace py-2 px-3 fs-7">Permissions</span>
                            </div>
                            <p class="small text-muted mt-2 mb-0">Note: <strong>Permissions</strong> can be comma-separated list. E.g. "manage_praharis, manage_cases".</p>
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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Permissions</th>
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
            <div class="table-responsive">
                <table class="table text-nowrap align-middle" id="adminsTable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-muted fw-semibold pb-3 text-uppercase" style="font-size: 0.85rem;">S.No.</th>
                            <th class="text-muted fw-semibold pb-3 text-uppercase" style="font-size: 0.85rem;">Name</th>
                            <th class="text-muted fw-semibold pb-3 text-uppercase" style="font-size: 0.85rem;">Email</th>
                            <th class="text-muted fw-semibold pb-3 text-uppercase" style="font-size: 0.85rem;">Permissions</th>
                            <th class="text-muted fw-semibold pb-3 text-uppercase" style="font-size: 0.85rem;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('page-script')
<script>
$(document).ready(function() {

    let table = $('#adminsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admins.index') }}",
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name' },
            { data: 'email' },
            { data: 'permissions' },
            { data: 'action', orderable: false, searchable: false }
        ]
    });

    $('.addBtn').on('click', function() {
        $('#adminForm')[0].reset();
        $('#admin_id').val('');
        $('#modalTitle').text('Add Sub-Admin');
        $('#password').attr('required', true);
        $('#passwordHint').hide();
        $('.permission-chk').prop('checked', false);
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').remove();
        new bootstrap.Modal('#adminModal').show();
    });

    $('#adminForm').on('submit', function(e) {
        e.preventDefault();
        
        let id = $('#admin_id').val();
        let url = id ? "{{ url('account/admins') }}/" + id : "{{ route('admins.store') }}";
        
        let data = new FormData(this);
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
                $('#adminModal').modal('hide');
                table.ajax.reload();
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').remove();
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
    });

    $(document).on('click', '.editBtn', function() {
        let id = $(this).data('id');
        $('#adminForm')[0].reset();
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();
        
        $.get("{{ url('account/admins') }}/" + id + "/edit", function(res) {
            $('#admin_id').val(res.data.id);
            $('#name').val(res.data.name);
            $('#email').val(res.data.email);
            $('#password').removeAttr('required');
            $('#passwordHint').show();
            
            $('.permission-chk').prop('checked', false);
            if (res.data.permissions && res.data.permissions.length > 0) {
                res.data.permissions.forEach(function(perm) {
                    $('input[value="' + perm + '"]').prop('checked', true);
                });
            }

            $('#modalTitle').text('Edit Sub-Admin');
            new bootstrap.Modal('#adminModal').show();
        });
    });

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
                    url: "{{ url('account/admins') }}/" + id,
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
    const expectedHeaders = ['name', 'email', 'password', 'permissions'];
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

        parsedData = [];
        const previewRows = [];
        
        for (let i = 1; i < rows.length; i++) {
            const rowData = rows[i];
            if (rowData.length === 1 && rowData[0] === '') continue;

            const name = colIndices['name'] !== -1 ? rowData[colIndices['name']] : '';
            const email = colIndices['email'] !== -1 ? rowData[colIndices['email']] : '';
            const password = colIndices['password'] !== -1 ? rowData[colIndices['password']] : '';
            const permissionsRaw = colIndices['permissions'] !== -1 ? rowData[colIndices['permissions']] : '';

            // Split permissions by comma or semicolon
            const perms = permissionsRaw.split(/[;,]/).map(p => p.trim()).filter(p => p !== '');

            const item = {
                name: name,
                email: email,
                password: password,
                permissions: perms
            };

            parsedData.push(item);
            if (previewRows.length < 5) {
                previewRows.push(item);
            }
        }

        const tbody = $('#previewTable tbody');
        tbody.empty();
        previewRows.forEach((r, idx) => {
            let errors = [];
            if (!r.name || r.name.length < 3) errors.push("Name too short");
            if (!r.email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(r.email.trim())) errors.push("Invalid email");
            if (!r.password || r.password.length < 6) errors.push("Password too short (min 6)");

            const badge = errors.length === 0 
                ? `<span class="badge bg-success text-white">Valid</span>` 
                : `<span class="badge bg-danger text-white">${errors.join(', ')}</span>`;

            tbody.append(`
                <tr>
                    <td>${idx + 1}</td>
                    <td>${escapeHtml(r.name)}</td>
                    <td>${escapeHtml(r.email)}</td>
                    <td>••••••••</td>
                    <td>${escapeHtml(r.permissions.join(', '))}</td>
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

            // Build payload
            let data = {
                _token: "{{ csrf_token() }}",
                name: item.name,
                email: item.email,
                password: item.password,
                permissions: item.permissions
            };

            $.ajax({
                url: "{{ route('admins.store') }}",
                type: 'POST',
                data: data,
                success: function() {
                    successCount++;
                    currentIdx++;
                    importNextRow();
                },
                error: function(xhr) {
                    failCount++;
                    let errMsg = `Row ${currentIdx + 2} (${item.name || 'Unknown'}): `;
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