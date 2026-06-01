
    
        
        <div class="modal fade" id="settingsChallansModal" tabindex="-1" aria-labelledby="userModal" data-bs-keyboard="false"
            aria-hidden="true">
            <!-- Scrollable modal -->
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header">
                        <h6 class="modal-title fw-bold" id="staticBackdropLabel2">Create Challan</h6>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="settingsChallansForm" action="{{ url('account/challans') }}" method="GET" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body p-4">
                            <input type="hidden" class="form-control" name="challans_id" id="challans_id">
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
                                <label for="case_id" class="form-label fw-medium text-dark">Case ID <span class="text-danger">*</span></label>
                                <select class="form-select shadow-none" id="case_id" name="case_id" required>
                                    <option value="">Select Case</option>
                                    @foreach($cases as $c)
                                        <option value="{{ $c->id }}">{{ $c->id }} - {{ $c->Location }}</option>
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
                                <label for="status" class="form-label fw-medium text-dark">Status <span class="text-danger">*</span></label>
                                <select class="form-select shadow-none" id="status" name="status" required>
                                    <option value="">Select Status</option>
                                    <option value="Paid">Paid</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Cancelled">Cancelled</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="Date" class="form-label fw-medium text-dark">Violation Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control shadow-none" id="Date" name="Date" required>
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

        <!-- View Challan Modal -->
        <div class="modal fade" id="settingsViewChallansModal" tabindex="-1" aria-labelledby="viewChallanModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-light py-3">
                        <h6 class="modal-title fw-bold text-dark" id="viewChallanModalLabel">
                            <i class="bi bi-file-earmark-text text-primary me-2"></i>Challan Details
                        </h6>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                            <div class="bg-primary-transparent text-primary rounded-3 p-3 me-3 d-flex align-items-center justify-content-center" style="width: 54px; height: 54px; font-size: 1.5rem; background-color: rgba(13, 110, 253, 0.08);">
                                <i class="bi bi-receipt-cutoff"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1 text-dark">Challan ID: <span id="vChallanId">#</span></h6>
                                <span class="badge" id="vChallanStatusBadge"></span>
                            </div>
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="d-flex justify-content-between border-bottom pb-2">
                                    <span class="text-dark small">Case ID</span>
                                    <span class="fw-semibold text-dark small" id="vCaseIdVal">-</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-between border-bottom pb-2">
                                    <span class="text-dark small">Prahari Name</span>
                                    <span class="fw-semibold text-dark small" id="vPrahariNameVal">-</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-between border-bottom pb-2">
                                    <span class="text-dark small">Type / Category</span>
                                    <span class="fw-semibold text-dark small" id="vCategoryTypeVal">-</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-between border-bottom pb-2">
                                    <span class="text-dark small">Amount</span>
                                    <span class="fw-bold text-success small" id="vAmountVal">-</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-between border-bottom pb-2">
                                    <span class="text-dark small">Date</span>
                                    <span class="fw-semibold text-dark small" id="vDateVal">-</span>
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
                        <h6 class="modal-title fw-bold" id="importCsvModalLabel">Import Challans from CSV</h6>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <!-- Instructions & Template Info -->
                        <div class="alert alert-light border mb-4 rounded-3 bg-light">
                            <h6 class="fw-bold text-dark mb-2"><i class="bi bi-info-circle-fill text-info me-2"></i>Expected CSV Schema</h6>
                            <p class="small text-muted mb-2">Ensure your CSV file contains these headers (case-insensitive):</p>
                            <div class="d-flex flex-wrap gap-2">
                                <span class="badge bg-white border text-dark font-monospace py-2 px-3 fs-7">Prahari</span>
                                <span class="badge bg-white border text-dark font-monospace py-2 px-3 fs-7">Case_ID</span>
                                <span class="badge bg-white border text-dark font-monospace py-2 px-3 fs-7">Category</span>
                                <span class="badge bg-white border text-dark font-monospace py-2 px-3 fs-7">status</span>
                                <span class="badge bg-white border text-dark font-monospace py-2 px-3 fs-7">Date</span>
                            </div>
                            <p class="small text-muted mt-2 mb-0">Note: <strong>Prahari</strong> and <strong>Category</strong> can be name or ID. <strong>Date</strong> format should be YYYY-MM-DD.</p>
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
                                            <th>Case ID</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>Date</th>
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
                    <input type="text" id="settingsChallansSearch" class="form-control border-start-0 ps-0 shadow-none" placeholder="Search by Challan ID, Prahari...">
                </div>
                <button class="btn btn-outline-secondary d-flex align-items-center gap-2 px-4 shadow-sm bg-white text-dark border">
                    <i class="bi bi-funnel"></i> Filter
                </button>
            </div>

            <div class="table-responsive">
                <table class="table text-nowrap align-middle" id="settingsChallansTable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-muted fw-semibold pb-3 text-uppercase" style="font-size: 0.85rem;">S.No.</th>
                            <th class="text-muted fw-semibold pb-3 text-uppercase" style="font-size: 0.85rem;">Case ID</th>
                            <th class="text-muted fw-semibold pb-3 text-uppercase" style="font-size: 0.85rem;">Prahari Name</th>
                            <th class="text-muted fw-semibold pb-3 text-uppercase" style="font-size: 0.85rem;">Amount</th>
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


    
@push('page-script')
<script>
$(document).ready(function() {

    // 🔹 OPEN MODAL
    $('.addChallansBtn').on('click', function() {
        $('#settingsChallansForm')[0].reset();
        $('#challans_id').val('');
        $('.form-control, .form-select').removeClass('is-valid is-invalid');
        $('.invalid-feedback').remove();
        $('#staticBackdropLabel2').text('Create Challan');

        
    });

    // 🔹 DATATABLE
    let settingsChallansTable = $('#settingsChallansTable').DataTable({
        processing: true,
        serverSide: true,
        dom: '<"top">rt<"row mt-3"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>><"clear">', // Removes default search
        ajax: "{{ route('challans.index') }}",
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'case_id' },
            { data: 'prahari_name' },
            { data: 'amount' },
            { data: 'status' },
            { data: 'violation_date' },
            { data: 'action', orderable: false, searchable: false }
        ]
    });

    // 🔹 Bind custom search input
    $('#settingsChallansSearch').on('keyup', function() {
        settingsChallansTable.search(this.value).draw();
    });

    // 🔹 VALIDATION
    $('#settingsChallansForm').validate({
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
            case_id: { required: true },
            category_id: { required: true },
            status: { required: true },
            Date: { required: true }
        },
        messages: {
            prahari_id: { required: "Please select a Prahari." },
            case_id: { required: "Please select a Case ID." },
            category_id: { required: "Please select a Category." },
            status: { required: "Please select a Status." },
            Date: { required: "Please select a Date." }
        },

        submitHandler: function(form) {

            let id = $('#challans_id').val();
            let url = id 
                ? "{{ url('account/challans') }}/" + id 
                : "{{ url('account/challans') }}";

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
                    $('#settingsChallansForm')[0].reset();
                    $('#settingsChallansModal').modal('hide');
                    settingsChallansTable.ajax.reload();
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

        $.get("{{ url('account/challans') }}/" + id + "/edit", function(res) {
            const data = res.data;
            $('#vChallanId').text('#' + data.id);
            $('#vCaseIdVal').text(data.case_id ? '#' + data.case_id : 'N/A');
            $('#vPrahariNameVal').text(data.prahari ? data.prahari.Prahari : 'N/A');
            $('#vCategoryTypeVal').text(data.category ? data.category.Type : 'N/A');
            
            const amt = data.category ? Number(data.category.Amount) : 0;
            $('#vAmountVal').text('₹ ' + amt.toLocaleString('en-IN'));

            $('#vDateVal').text(data.Date ? new Date(data.Date).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' }) : 'N/A');

            // Format Status Badge
            const status = data.status || 'Pending';
            const badge = $('#vChallanStatusBadge');
            badge.removeClass('bg-success bg-warning bg-danger text-dark text-white');
            if (status === 'Paid') {
                badge.addClass('bg-success text-white').text('Paid');
            } else if (status === 'Pending') {
                badge.addClass('bg-warning text-dark').text('Pending');
            } else {
                badge.addClass('bg-danger text-white').text('Cancelled');
            }

            new bootstrap.Modal('#settingsViewChallansModal').show();
        });
    });

    // 🔹 EDIT
    $(document).on('click', '.editBtn', function() {
        let id = $(this).data('id');

        $.get("{{ url('account/challans') }}/" + id + "/edit", function(res) {

            $('#challans_id').val(res.data.id);
            $('#prahari_id').val(res.data.prahari_id);
            $('#case_id').val(res.data.case_id);
            $('#category_id').val(res.data.category_id);
            $('#status').val(res.data.status);
            $('#Date').val(res.data.Date);

            $('#staticBackdropLabel2').text('Edit Challan');
            
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
                    url: "{{ url('account/challans') }}/" + id,
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
                        settingsChallansTable.ajax.reload();
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
    const expectedHeaders = ['prahari', 'case_id', 'case id', 'category', 'type', 'status', 'date'];
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

    const caseMap = {};
    $('#case_id option').each(function() {
        const val = $(this).val();
        if (val) {
            caseMap[val] = val;
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
            const caseVal = colIndices['case_id'] !== -1 ? rowData[colIndices['case_id']] : (colIndices['case id'] !== -1 ? rowData[colIndices['case id']] : '');
            const cVal = colIndices['category'] !== -1 ? rowData[colIndices['category']] : (colIndices['type'] !== -1 ? rowData[colIndices['type']] : '');
            const st = colIndices['status'] !== -1 ? rowData[colIndices['status']] : '';
            const dt = colIndices['date'] !== -1 ? rowData[colIndices['date']] : '';

            const mappedPrahariId = prahariMap[pVal.trim().toLowerCase()] || '';
            const mappedCaseId = caseMap[caseVal.trim()] || '';
            const mappedCategoryId = categoryMap[cVal.trim().toLowerCase()] || '';

            const item = {
                prahari_id: mappedPrahariId,
                prahari_name: pVal,
                case_id: mappedCaseId,
                case_name: caseVal,
                category_id: mappedCategoryId,
                category_name: cVal,
                status: st,
                Date: dt
            };

            if (item.status) {
                const sVal = item.status.trim().toLowerCase();
                if (sVal === 'paid') item.status = 'Paid';
                else if (sVal === 'pending') item.status = 'Pending';
                else if (sVal === 'cancelled') item.status = 'Cancelled';
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
            if (!r.case_id) errors.push(`Case ID "${r.case_name}" not found`);
            if (!r.category_id) errors.push(`Category "${r.category_name}" not found`);
            if (!['Paid', 'Pending', 'Cancelled'].includes(r.status)) errors.push("Invalid status");
            if (!r.Date) errors.push("Date missing");

            const badge = errors.length === 0 
                ? `<span class="badge bg-success text-white">Valid</span>` 
                : `<span class="badge bg-danger text-white">${errors.join(', ')}</span>`;

            tbody.append(`
                <tr>
                    <td>${idx + 1}</td>
                    <td>${escapeHtml(r.prahari_name)} (${r.prahari_id || 'Not Found'})</td>
                    <td>${escapeHtml(r.case_name)}</td>
                    <td>${escapeHtml(r.category_name)} (${r.category_id || 'Not Found'})</td>
                    <td>${escapeHtml(r.status)}</td>
                    <td>${escapeHtml(r.Date)}</td>
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
                settingsChallansTable.ajax.reload();
                return;
            }

            const item = parsedData[currentIdx];
            const percentage = Math.round(((currentIdx) / parsedData.length) * 100);
            $('#progressStatus').text(`Importing row ${currentIdx + 1} of ${parsedData.length}...`);
            $('#progressPercentage').text(`${percentage}%`);
            $('#importProgressBar').css('width', `${percentage}%`);

            $.ajax({
                url: "{{ url('account/challans') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    prahari_id: item.prahari_id,
                    case_id: item.case_id,
                    category_id: item.category_id,
                    status: item.status,
                    Date: item.Date
                },
                success: function() {
                    successCount++;
                    currentIdx++;
                    importNextRow();
                },
                error: function(xhr) {
                    failCount++;
                    let errMsg = `Row ${currentIdx + 2} (Case ID ${item.case_name || 'Unknown'}): `;
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
