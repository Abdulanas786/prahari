<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
        <h6 class="fw-bold text-dark mb-0 fs-5">Profile Information</h6>
        <p class="text-muted small mt-1">Update your account's profile information and email address.</p>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('settings.update') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label fw-medium text-dark">Name</label>
                <input type="text" class="form-control shadow-none @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="form-label fw-medium text-dark">Email Address</label>
                <input type="email" class="form-control shadow-none @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <hr class="text-muted opacity-25 my-4">

            <div class="mb-4">
                <h6 class="fw-bold text-dark fs-5">Update Password</h6>
                <p class="text-muted small mt-1">Ensure your account is using a long, random password to stay secure. Leave blank to keep your current password.</p>
            </div>

            <div class="mb-3">
                <label for="current_password" class="form-label fw-medium text-dark">Current Password</label>
                <input type="password" class="form-control shadow-none @error('current_password') is-invalid @enderror" id="current_password" name="current_password" placeholder="Enter current password">
                @error('current_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="password" class="form-label fw-medium text-dark">New Password</label>
                    <input type="password" class="form-control shadow-none @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter new password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mt-3 mt-md-0">
                    <label for="password_confirmation" class="form-label fw-medium text-dark">Confirm Password</label>
                    <input type="password" class="form-control shadow-none" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password">
                </div>
            </div>

            <hr class="text-muted opacity-25 my-4">

            <div class="mb-4">
                <h6 class="fw-bold text-dark fs-5">Global Module Settings</h6>
                <p class="text-muted small mt-1">Enable or disable main sections of the Admin Panel across the application.</p>
            </div>

            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="module_dashboard" name="module_dashboard" value="1" {{ $globalModules['module_dashboard'] == '1' ? 'checked' : '' }}>
                        <label class="form-check-label fw-medium text-dark" for="module_dashboard">Dashboard</label>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="module_payments" name="module_payments" value="1" {{ $globalModules['module_payments'] == '1' ? 'checked' : '' }}>
                        <label class="form-check-label fw-medium text-dark" for="module_payments">Amount of Prahari (Payments)</label>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="module_reports" name="module_reports" value="1" {{ $globalModules['module_reports'] == '1' ? 'checked' : '' }}>
                        <label class="form-check-label fw-medium text-dark" for="module_reports">Reports</label>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="module_challans" name="module_challans" value="1" {{ $globalModules['module_challans'] == '1' ? 'checked' : '' }}>
                        <label class="form-check-label fw-medium text-dark" for="module_challans">Challans</label>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm fw-medium">Save Changes</button>
            </div>
        </form>
    </div>
</div>
