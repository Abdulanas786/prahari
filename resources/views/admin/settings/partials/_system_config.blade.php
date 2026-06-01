<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
        <h6 class="fw-bold text-dark mb-0 fs-5">System Configurations</h6>
        <p class="text-muted small mt-1">Configure global application settings and parameters.</p>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('settings.updateSystemConfig') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="website_name" class="form-label fw-medium text-dark">Website / App Name</label>
                    <input type="text" class="form-control shadow-none @error('website_name') is-invalid @enderror" id="website_name" name="website_name" value="{{ old('website_name', $systemConfig['website_name']) }}" required>
                    @error('website_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="admin_contact" class="form-label fw-medium text-dark">Admin Contact Email</label>
                    <input type="email" class="form-control shadow-none @error('admin_contact') is-invalid @enderror" id="admin_contact" name="admin_contact" value="{{ old('admin_contact', $systemConfig['admin_contact']) }}" required>
                    @error('admin_contact')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="revenue_percentage" class="form-label fw-medium text-dark">Prahari Revenue Share (%)</label>
                    <input type="number" class="form-control shadow-none @error('revenue_percentage') is-invalid @enderror" id="revenue_percentage" name="revenue_percentage" value="{{ old('revenue_percentage', $systemConfig['revenue_percentage']) }}" min="0" max="100" required>
                    @error('revenue_percentage')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="default_status" class="form-label fw-medium text-dark">Default User Status</label>
                    <select class="form-select shadow-none @error('default_status') is-invalid @enderror" id="default_status" name="default_status" required>
                        <option value="Active" {{ (old('default_status', $systemConfig['default_status']) == 'Active') ? 'selected' : '' }}>Active</option>
                        <option value="Inactive" {{ (old('default_status', $systemConfig['default_status']) == 'Inactive') ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('default_status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-end mt-3">
                <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm fw-medium">Save Configurations</button>
            </div>
        </form>
    </div>
</div>
